<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStocksRequest;
use App\Http\Requests\UpdateStocksRequest;
use App\Repositories\StocksRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;
use App\Models\Branches;
use App\Models\Stocks;
use App\Models\stockMovements;
use Auth;
use Log;

class StocksController extends AppBaseController
{
    /** @var  StocksRepository */
    private $stocksRepository;

    public function __construct(StocksRepository $stocksRepo)
    {
        $this->stocksRepository = $stocksRepo;
    }

    /**
     * Display a listing of the Stocks.
     *
     * @param Request $request
     * @return Response
     */
  
    public function index(Request $request)
    {
        $stocks=[];
        $this->stocksRepository->pushCriteria(new RequestCriteria($request));
       
        if(Auth::user()->role==0){
            $stockss = $this->stocksRepository->all();
        }else{
            $stockss = $this->stocksRepository->findByField('branch_id', Auth::user()->branch_id);
        }
       
         foreach($stockss as $stock){
            $stocks[]=$this->transform($stock);
        }
        return !$this->authorized()?view('anauthorized.index'): view('stocks.index')
                    ->with('stocks', $stocks);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        $model['branch']=Branches::where('id',$model->branch_id)->first();
        return $model;
    }
    /**
     * Show the form for creating a new Stocks.
     *
     * @return Response
     */
    public function create()
    {
        $branch=[];
        if(Auth::user()->role==0){
            $branch=Branches::pluck('name','id','branch_id');
        }else{
            $branch=Branches::where('id',Auth::user()->branch_id)->pluck('name','id','branch_id');
        }   
        $stocks=[];
        $stocks['transfer']=false;
        $stocks['add']=true;
        return view('stocks.create')->with('models', Models::pluck('name','id'))
        ->with('branchs', $branch)
        ->with('stocks', $stocks);
    }

    /**
     * Store a newly created Stocks in storage.
     *
     * @param CreateStocksRequest $request
     *
     * @return Response
     */
    public function store(CreateStocksRequest $request)
    {
       
        $input = $request->all();
       
        $w=Stocks::where('model_id',$input['model_id'])->where('branch_id',$input['branch_id'])->first();
        if($w){
            $sum_qty=$w->qty+$input['added_qty'];
            $sum_total=$input['added_qty']+$w->total_entered_qty;
            $w->total_entered_qty=$sum_total;
            $w->added_qty=$input['added_qty'];
            
            $w->qty=$sum_qty;
            $w->save();

        }else{
            $sum_qty=$input['added_qty'];
            $input['total_entered_qty']= $input['added_qty'];
            $input['added_qty']=$input['added_qty'];
            $input['qty']=$input['added_qty'];

            $this->stocksRepository->create($input);
    
        }
        $branch=Branches::where('id',$input['branch_id'])->first();
        $model=Models::where('id',$input['model_id'])->first();

       $transction=['currenty_qty'=> $sum_qty,
       'action'=>$input['action'],
       'reason'=>$input['reason'],
       'added_qty'=>$input['added_qty'],
       'removed_qty'=>0,
       'transfered_qty'=>0
    ,'messages'=>'Add '. $input['added_qty'].' qty  of '. $model['name'].' in '.$branch['name'].' stock','model_id'=>$input['model_id'],'branch_id'=>$input['branch_id']];
    
        stockMovements::create($transction);

        Flash::success('Stocks saved successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stocks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stocks', $stocks);
    }

    /**
     * Show the form for editing the specified Stocks.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,Request $req)
    {
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }
        $stocks['transfer']=$req['transfer'];
        $stocks['edit']=true;
        $stocks['add']=false;
        $branch=Branches::where('id','!=',$stocks->branch_id)->pluck('name','id','branch_id');
         
        return view('stocks.edit')->with('stocks', $stocks)->with('models', Models::pluck('name','id'))
        ->with('branchs', $branch);
    }

    /**
     * Update the specified Stocks in storage.
     *
     * @param  int              $id
     * @param UpdateStocksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStocksRequest $request)
    {
        $stocks = $this->stocksRepository->findWithoutFail($id);
        $input=$request->all();
        if (empty($stocks)) {
            Flash::error('Stocks not found');
            return redirect(route('stocks.index'));
        }
        if($input['transfer']){
            $branch=Branches::where('id',$input['branch_id'])->first();
            $model=Models::where('id',$input['model_id'])->first();

            $sum_qty=$stocks->qty-$input['added_qty'];
            $sum_total=$stocks->total_entered_qty-$input['added_qty'];
            $stocks->total_entered_qty=$sum_total;
            $stocks->added_qty=$input['added_qty'];
            $stocks->qty=$sum_qty;
            $stocks->save();

            $transction=['currenty_qty'=>$sum_qty,
            'action'=>$input['action'],
             'reason'=>$input['reason'],
            'added_qty'=>0,
             'removed_qty'=>0,
            'transfered_qty'=>$input['added_qty'],
            'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty  of '. $model['name'].' in '.$branch['name'].' stock','model_id'=>$input['model_id'],'branch_id'=>$input['branch_id']];

            stockMovements::create($transction);

            $transfered_stock=Stocks::where('model_id',$input['model_id'])->where('branch_id',$input['transfered_branch_id'])->first();
            
            if($transfered_stock){
                // add qty to main stock if exists
                    $sum_qty=$transfered_stock->qty+$input['added_qty'];
                    $sum_total=$transfered_stock->total_entered_qty+$input['added_qty'];
                    $transfered_stock->total_entered_qty=$sum_total;
                    $transfered_stock->added_qty=$input['added_qty'];
                    $transfered_stock->qty=$sum_qty;
                    $transfered_stock->save();
                    $branch_t=Branches::where('id',$input['transfered_branch_id'])->first();
                    $main_transction=['currenty_qty'=> $sum_qty,
                        'action'=>'Add',
                        'reason'=>'Receive Transfered',
                        'added_qty'=>$input['added_qty'],
                        'removed_qty'=>0,
                         'transfered_qty'=>0,
                        'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty  of '. $model['name'].' in '.$branch_t['name'].' stock','model_id'=>$input['model_id'],'branch_id'=>$input['transfered_branch_id']];
                    stockMovements::create($main_transction);
            }else{

                $input['total_entered_qty']=$input['added_qty'];
                $input['qty']=$input['added_qty'];
                $input['added_qty']=$input['added_qty'];
                $input['branch_id']=$input['transfered_branch_id'];
                $input['model_id']=$input['model_id'];
Log::info($input);
                Stocks::create($input);

                $branch_t=Branches::where('id',$input['transfered_branch_id'])->first();

                $main_transction=['currenty_qty'=>$input['qty'],
                'action'=>'Add',
                'reason'=>'Receive Transfered',
                 'added_qty'=>$input['added_qty'],
                'removed_qty'=>0,
               'transfered_qty'=>0,
               'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty  of '. $model['name'].' in '.$branch_t['name'].' stock','model_id'=>$input['model_id'],'branch_id'=>$input['transfered_branch_id']];
                stockMovements::create($main_transction);
            }

        }else{

            if($input['action']=='Add'){
                $sum_qty=$stocks->qty+$input['added_qty'];
                $sum_total=$stocks->total_entered_qty+$input['added_qty'];  
            }else{
                $sum_qty=$stocks->qty-$input['added_qty'];
                $sum_total=$stocks->total_entered_qty-$input['added_qty'];   
            }

            $stocks->total_entered_qty=$sum_total;
            $stocks->added_qty=$input['added_qty'];
            $stocks->qty=$sum_qty;
            $stocks->save();

            $branch=Branches::where('id',$input['branch_id'])->first();
            $model=Models::where('id',$input['model_id'])->first();

            $transction=['currenty_qty'=>$sum_qty,
            'action'=>$input['action'],
            'reason'=>$input['reason'],
            'added_qty'=>$input['action']=='Add'?$input['added_qty']:0,
            'removed_qty'=>$input['action']=='Remove'?$input['added_qty']:0,
            'transfered_qty'=>0,
            'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty  of '. $model['name'].' in '.$branch['name'].' stock','model_id'=>$input['model_id'],'branch_id'=>$input['branch_id']];
            
        stockMovements::create($transction);
        }
      
        Flash::success('Stocks updated successfully.');
        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stocks from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            Flash::error('Stocks not found');

            return redirect(route('stocks.index'));
        }

        $this->stocksRepository->delete($id);

        Flash::success('Stocks deleted successfully.');

        return redirect(route('stocks.index'));
    }
}
