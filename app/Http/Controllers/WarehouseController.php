<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Repositories\WarehouseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;
use App\Models\Warehouse;
use App\Models\MainStock;
use App\Models\MainStockTransctions;
use Log;
use App\Models\WarehouseTransction;


class WarehouseController extends AppBaseController
{
    /** @var  WarehouseRepository */
    private $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepo)
    {
        $this->warehouseRepository = $warehouseRepo;
    }

    /**
     * Display a listing of the Warehouse.
     *
     * @param Request $request
     * @return Response
     */


    public function index(Request $request)
    {
        $warehouses=[];
        $_warehouses = $this->warehouseRepository->all();
         foreach($_warehouses as $warehouse){
            $warehouses[]=$this->transform($warehouse);
        }
        return !$this->authorized()?view('anauthorized.index'): view('warehouses.index')
                    ->with('warehouses', $warehouses);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        return $model;
    }


    /**
     * Show the form for creating a new Warehouse.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouses.create')->with('models', Models::pluck('name','id'));
    }

    /**
     * Store a newly created Warehouse in storage.
     *
     * @param CreateWarehouseRequest $request
     *
     * @return Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        $input = $request->all();
        $w=Warehouse::where('model_id',$input['model_id'])->first();
        if($w){
            $input['total_entered_qty']=$input['added_qty']+$w->total_entered_qty;
            $input['added_qty']=$input['added_qty'];
            $input['qty']=$w->qty+$input['added_qty'];
            $warehouse = $this->warehouseRepository->update($input, $w->id);
        }else{
            $input['total_entered_qty']= $input['added_qty'];
            $input['added_qty']=$input['added_qty'];
            $input['qty']=$input['added_qty'];
            $warehouse = $this->warehouseRepository->create($input);
    
        }
       $transction=['currenty_qty'=>$input['qty'],'action'=>'New Stock','added_qty'=>$input['added_qty']
    ,'messages'=>'Add '. $input['added_qty'].' qty in warehouse stock','model_id'=>$input['model_id']];
    
        WarehouseTransction::create($transction);
        Flash::success('Warehouse saved successfully.');

        return redirect(route('warehouses.index'));
    }

    /**
     * Display the specified Warehouse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $warehouse = $this->warehouseRepository->findWithoutFail($id);

        if (empty($warehouse)) {
            Flash::error('Warehouse not found');

            return redirect(route('warehouses.index'));
        }

        return view('warehouses.show')->with('warehouse', $warehouse);
    }

    /**
     * Show the form for editing the specified Warehouse.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,Request $req)
    {
        $warehouse = $this->warehouseRepository->findWithoutFail($id);
        $warehouse['transfer']=$req['transfer'];
        if (empty($warehouse)) {
            Flash::error('Warehouse not found');

            return redirect(route('warehouses.index'));
        }
        return view('warehouses.edit')->with('warehouses', $warehouse)->with('models', Models::pluck('name','id'));;
    }

    /**
     * Update the specified Warehouse in storage.
     *
     * @param  int              $id
     * @param UpdateWarehouseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWarehouseRequest $request)
    {
       
        $warehouse = $this->warehouseRepository->findWithoutFail($id);

        if (empty($warehouse)) {
            Flash::error('Warehouse not found');

            return redirect(route('warehouses.index'));
        }
        $input=$request->all();
    if($input['transfer']){
        $input['qty']=$warehouse->qty-$input['added_qty'];
        $input['added_qty']=$input['added_qty'];
        $warehouse = $this->warehouseRepository->update($input, $id);

    $transction=['currenty_qty'=>$input['qty'],
    'action'=>'Transfer Stock',
    'added_qty'=>$input['added_qty']
    ,'messages'=>'Transfer from Warehouse to Main stock',
    'model_id'=>$input['model_id']];
    
    WarehouseTransction::create($transction);

    $main_stock=MainStock::where('model_id',$input['model_id'])->first();
    if($main_stock){
        $input['total_entered_qty']= $main_stock->total_entered_qty+$input['added_qty'];
        $input['qty']=$main_stock->total_entered_qty+$input['added_qty'];
        $main_stock->update($input);
    }else{
        $input['total_entered_qty']=$input['added_qty'];
        $input['qty']=$input['added_qty'];
        MainStock::create($input);
    }
    $main_transction=['currenty_qty'=>$input['qty'],
    'action'=>'Received Stock',
    'added_qty'=>$input['added_qty']
    ,'messages'=>'Received from Warehouse to Main stock',
    'model_id'=>$input['model_id']];
    MainStockTransctions::create($main_transction);
    Flash::success('Warehouse tranfered successfully.');
}else{
    $currenty_qty=$warehouse->added_qty;
    if($warehouse->added_qty > $input['added_qty']){
        $q=($warehouse->added_qty-$input['added_qty']);
        $input['total_entered_qty']= $warehouse->total_entered_qty-$q;
        $input['qty']=$warehouse->qty-$q;
    }else{
        $input['total_entered_qty']= $warehouse->total_entered_qty+($input['added_qty']-$warehouse->added_qty);
        $input['qty']=$warehouse->qty+($input['added_qty']-$warehouse->added_qty);
    }
    $input['added_qty']=$input['added_qty'];
    $warehouse = $this->warehouseRepository->update($input, $id);

    $transction=['currenty_qty'=>$input['qty'],
    'action'=>'Modify Stock',
    'added_qty'=>$input['added_qty']
    ,'messages'=>'Modify from '.$currenty_qty.' to '. $input['added_qty'].' qty in warehouse stock',
    'model_id'=>$input['model_id']];
    
    WarehouseTransction::create($transction);
    Flash::success('Warehouse updated successfully.');
}
 return redirect(route('warehouses.index'));
    }

    /**
     * Remove the specified Warehouse from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $warehouse = $this->warehouseRepository->findWithoutFail($id);

        if (empty($warehouse)) {
            Flash::error('Warehouse not found');

            return redirect(route('warehouses.index'));
        }

        $this->warehouseRepository->delete($id);

        Flash::success('Warehouse deleted successfully.');

        return redirect(route('warehouses.index'));
    }
}
