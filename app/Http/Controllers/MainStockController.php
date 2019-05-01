<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMainStockRequest;
use App\Http\Requests\UpdateMainStockRequest;
use App\Repositories\MainStockRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;
use App\Models\MainStock;
use App\Models\MainStockTransctions;
use App\Models\stockMovements;
use App\Models\Branches;
use App\Models\Stocks;
use Log;
class MainStockController extends AppBaseController
{
    /** @var  MainStockRepository */
    private $mainStockRepository;

    public function __construct(MainStockRepository $mainStockRepo)
    {
        $this->mainStockRepository = $mainStockRepo;
    }

    /**
     * Display a listing of the MainStock.
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $mainStocks=[];
        $_mainStocks = $this->mainStockRepository->all();
         foreach($_mainStocks as $mainStock){
            $mainStocks[]=$this->transform($mainStock);
        }
        return !$this->authorized()?view('anauthorized.index'): view('main_stocks.index')
                    ->with('main_stocks', $mainStocks);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        return $model;
    }

    /**
     * Show the form for creating a new MainStock.
     *
     * @return Response
     */
    public function create()
    {
        $main_stocks=[];
        $main_stocks['transfer']=false;
        return view('main_stocks.create')
        ->with('mainStock', $main_stocks);;
    }

    /**
     * Store a newly created MainStock in storage.
     *
     * @param CreateMainStockRequest $request
     *
     * @return Response
     */
    public function store(CreateMainStockRequest $request)
    {
        $input = $request->all();

        $mainStock = $this->mainStockRepository->create($input);

        Flash::success('Main Stock saved successfully.');

        return redirect(route('mainStocks.index'));
    }

    /**
     * Display the specified MainStock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        return view('main_stocks.show')->with('mainStock', $mainStock);
    }

    /**
     * Show the form for editing the specified MainStock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,Request $req)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);
        $mainStock['transfer']=$req['transfer'];
        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        return view('main_stocks.edit')->with('mainStock', $mainStock)->with('models', Models::pluck('name','id')) ->with('branchs', Branches::pluck('name','id'));
    }

    /**
     * Update the specified MainStock in storage.
     *
     * @param  int              $id
     * @param UpdateMainStockRequest $request
     *
     * @return Response
     */
  
    public function update($id, UpdateMainStockRequest $request)
    {
       
        $mainstock = $this->mainStockRepository->findWithoutFail($id);
      

                if (empty($mainstock)) {
                    Flash::error('Mainstock not found');

                    return redirect(route('mainStocks.index'));
                }
                $input=$request->all();
  
                $model=Models::where('id',$input['model_id'])->first();
                if (empty($model)) {
                    Flash::error('Model not found');
                    return redirect(route('mainStocks.index'));
                }

                    if($input['transfer']){
                        $branch=Branches::where('id',$input['branch_id'])->first();
                        if (empty($branch)) {
                            Flash::error('Branch not found');
                            return redirect(route('mainStocks.index'));
                        }

                        $sum_qty=$mainstock->qty-$input['added_qty'];
                        $sum_total=$mainstock->total_entered_qty-$input['added_qty'];
                        $mainstock->total_entered_qty=$sum_total;
                        $mainstock->added_qty=$input['added_qty'];
                        $mainstock->qty=$sum_qty;
                        $mainstock->save();

                        $transction=['currenty_qty'=>$sum_qty,
                        'action'=>$input['action'],
                        'reason'=>$input['reason'],
                        'added_qty'=>0,
                        'removed_qty'=>0,
                        'transfered_qty'=>$input['added_qty']
                        ,'messages'=>'Transfer '.$input['added_qty'].' qty of '.$model['name'].' model from  Main stock to '.$branch['name'].' stock',
                        'model_id'=>$input['model_id']];
                    
                    MainStockTransctions::create($transction);

                    $stock=Stocks::where('model_id',$input['model_id'])->where('branch_id',$input['branch_id'])->first();
                    if($stock){
                       
                        $sum_qty=$stock->qty+$input['added_qty'];
                        $sum_total=$stock->total_entered_qty+$input['added_qty'];
                        $stock->total_entered_qty=$sum_total;
                        $stock->added_qty=$input['added_qty'];
                        $stock->qty=$sum_qty;
                        $stock->save();

                        $stock_transction=['currenty_qty'=> $sum_qty,
                        'action'=>'Add',
                        'reason'=>'Receive Transfered',
                        'added_qty'=>$input['added_qty'],
                        'removed_qty'=>0,
                        'transfered_qty'=>0
                        ,'messages'=>'Received '.$input['added_qty'].' qty of '.$model['name'].' model from Main stock to '.$branch['name'].' stock',
                        'model_id'=>$input['model_id'],'branch_id'=>$input['branch_id']];

                    }else{
                        $input['total_entered_qty']=$input['added_qty'];
                        $input['qty']=$input['added_qty'];
                        $input['added_qty']=$input['added_qty'];

                        Stocks::create($input);
                        
                        $stock_transction=['currenty_qty'=>$input['added_qty'],
                        'action'=>'Add',
                        'reason'=>'Receive Transfered',
                        'added_qty'=>$input['added_qty'],
                        'removed_qty'=>0,
                        'transfered_qty'=>0
                        ,'messages'=>'Received '.$input['added_qty'].' qty of '.$model['name'].' model from Main stock to '.$branch['name'].' stock',
                        'model_id'=>$input['model_id'],'branch_id'=>$input['branch_id']];
                    }
                  
                    stockMovements::create($stock_transction);
                    Flash::success('Main stock tranfered successfully.');
                }else{

                    if($input['action']=='Add'){
                        $sum_qty=$mainstock->qty+$input['added_qty'];
                        $sum_total=$mainstock->total_entered_qty+$input['added_qty'];  
                    }else{
                        $sum_qty=$mainstock->qty-$input['added_qty'];
                        $sum_total=$mainstock->total_entered_qty-$input['added_qty'];   
                    }
                
                    $mainstock->total_entered_qty=$sum_total;
                    $mainstock->added_qty=$input['added_qty'];
                    $mainstock->qty=$sum_qty;
                    $mainstock->save();
                
                        $transction=['currenty_qty'=>$sum_qty,
                        'action'=>$input['action'],
                        'reason'=>$input['reason'],
                        'added_qty'=>$input['action']=='Add'?$input['added_qty']:0,
                        'removed_qty'=>$input['action']=='Remove'?$input['added_qty']:0,
                        'transfered_qty'=>0
                        ,'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty  in Main stock stock',
                        'model_id'=>$input['model_id']];
                        
                        MainStockTransctions::create($transction);
                        Flash::success('Main stock updated successfully.');
        }
        return redirect(route('mainStocks.index'));
    }
    /**
     * Remove the specified MainStock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        $this->mainStockRepository->delete($id);

        Flash::success('Main Stock deleted successfully.');

        return redirect(route('mainStocks.index'));
    }
}