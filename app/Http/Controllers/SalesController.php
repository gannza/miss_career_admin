<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Repositories\SalesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Branches;
use App\Models\Clients;
use Log;
use App\Models\Sales;
use App\Models\Employees;
use App\Models\ClientTypes;
use App\Models\SalesItems;
use App\Models\Models;
use App\Models\Stocks;
use App\Models\stockMovements;

class SalesController extends AppBaseController
{
    /** @var  SalesRepository */
    private $salesRepository;

    public function __construct(SalesRepository $salesRepo)
    {
        $this->salesRepository = $salesRepo;
    }

    /**
     * Display a listing of the Sales.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->salesRepository->pushCriteria(new RequestCriteria($request));
        if(Auth::user()->role==0){
            $saless = $this->salesRepository->all();
        }else{
            if(Auth::user()->role==2){
                //For Tail
            $saless = $this->salesRepository->findByField('operator_id', Auth::user()->id);
            }else{
                 //For Branch Manager
                $saless = $this->salesRepository->findByField('branch_id', Auth::user()->branch_id);  
            }
        }

        
       
       $sales=[];
        foreach($saless as $sale){
           
           $sales[]=$this->transform($sale);
       }
       
        return view('sales.index')
            ->with('sales', $sales);
    }

    function transform(Sales $sale){
        $sale['client']=Clients::where('id',$sale->customer_id)->first();
        $sale['client_type']=ClientTypes::where('id',$sale['client']['client_type_id'])->first();
        $sale['branch']=Branches::where('id',$sale->branch_id)->first();
        $sale['operator']=Employees::where('id',$sale->operator_id)->first();
        return $sale;
    }
    /**
     * Show the form for creating a new Sales.
     *
     * @return Response
     */
    public function create()
    {
        if(Auth::user()->role==0){
            $branch=Branches::pluck('name','id','branch_id');
        }else{
            $branch=Branches::where('id',Auth::user()->branch_id)->pluck('name','id','branch_id');
        } 
        $sales['cart']=0;
        return view('sales.create')->with('branchs', $branch)
        ->with('clients', Clients::pluck('name','id'))
        ->with('method', ['Cash'=>'Cash'])
        ->with('status', ['Unpaid'=>'Unpaid','Paid'=>'Paid'])
        ->with('cart', false);
    }

    /**
     * Store a newly created Sales in storage.
     *
     * @param CreateSalesRequest $request
     *
     * @return Response
     */
    public function store(CreateSalesRequest $request)
    {
        $input = $request->all();
        $input['operator_id']=Auth::user()->id;
        $sales = $this->salesRepository->create($input);

        Flash::success('Sales saved successfully.');

        return redirect(route('sales.edit', [$sales->id]));
    }

    /**
     * Display the specified Sales.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            Flash::error('Sales not found');

            return redirect(route('sales.index'));
        }

        return view('sales.show')->with('sales', $sales);
    }

   

    /**
     * Show the form for editing the specified Sales.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            Flash::error('Sales not found');

            return redirect(route('sales.index'));
        }
        if(Auth::user()){
            if(Auth::user()->role==0){
                $branch=Branches::pluck('name','id','branch_id');
            }else{
                $branch=Branches::where('id',Auth::user()->branch_id)->pluck('name','id','branch_id');
            } 
        }
        
        return view('sales.edit')->with('sales', $sales)->with('branchs', $branch)
        ->with('clients', Clients::pluck('name','id'))
        ->with('method', ['Cash'=>'Cash'])
        ->with('status', ['Unpaid'=>'Unpaid','Paid'=>'Paid'])
        ->with('cart', true)
        ->with('cartItems', $this->getcartItems($id))
        ->with('total_amount', $this->totals($id,'total_amount'))
        ->with('taxable_vat', $this->totals($id,'taxable_vat'));

    }
    function getcartItems($id){
        $lists=[];
        foreach(SalesItems::where('sale_id',$id)->get() as $cart){
            $stock=Stocks::where('id',$cart->model_id)->first();;
            $cart['model']=Models::where('id',$stock->model_id)->first();
            $lists[]=$cart;
        }
        return $lists;
    }
    function totals($id,$field){
        $totals=[];
        foreach(SalesItems::where('sale_id',$id)->get() as $cart){
            $sale=Sales::find($cart->sale_id);
            if($field=='total_amount'){
                $totals[]=$cart->price*$cart->qty;
            }else if($field=='taxable_vat'){
                $taxable_amount=100.00 * $cart->price*$cart->qty / (100 + $sale->tax_rate);
                $taxable_vat=$sale->tax_rate / 100 * $taxable_amount;
                $totals[]=$taxable_vat;
            }
            
        }
        return $this->arrayAdd($totals);
    }

  

    /**
     * Update the specified Sales in storage.
     *
     * @param  int              $id
     * @param UpdateSalesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalesRequest $request)
    {
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            Flash::error('Sales not found');

            return redirect(route('sales.index'));
        }
        $sales = $this->salesRepository->update($request->all(), $id);

        Flash::success('Sales updated successfully.');

        return redirect(route('sales.index'));
    }

    /**
     * Remove the specified Sales from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            Flash::error('Sales not found');

            return redirect(route('sales.index'));
        }

        $this->salesRepository->delete($id);

        Flash::success('Sales deleted successfully.');

        return redirect(route('sales.index'));
    }
    public function destroyCartItem($id)
    {
        $item=SalesItems::find($id);
        if($item){
            $stock=Stocks::find($item->model_id);
            $stock->qty=$stock->qty+$item->qty;
            $stock->save();
            $stockmvement=stockMovements::where('added_qty',$item->qty)
            ->where('model_id',$stock->model_id)
            ->where('branch_id',$stock->branch_id)->orderBy('updated_at','desc')->first();
            if($stockmvement){
                $stockmvement->delete();
            }
            $item->delete();
            return  $item;
        }
    }
    public function addCartItem(Request $request)
    {
        $sales = SalesItems::create($request->all());
      
        $stock=Stocks::find($sales->model_id);
        $sum=$stock->qty-$sales->qty;
        $stock->qty=$sum;
        $stock->save();

        $branch=Branches::where('id',$stock->branch_id)->first();
        $model=Models::where('id',$stock->model_id)->first();
       $transction=['currenty_qty'=>$stock->qty,
       'action'=>'Customer sales',
       'reason'=>'Remove',
       'removed_qty'=>0,
       'transfered_qty'=>0,
       'added_qty'=>$request['qty']
         ,'messages'=>'Remove '. $request['qty'].' qty  of '. $model['name'].' in '.$branch['name'].' stock','model_id'=>$model['id'],'branch_id'=>$branch['branch_id']];
    
        stockMovements::create($transction);

        return $sales;
    }
    
}
