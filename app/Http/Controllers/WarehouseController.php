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

    public function warehouseExport($type="xls"){
        // $employees = Employees::select('name as Name' ,'email as Email','phone as Phone','gender as Gender','branch_id as Branch','role as Role','created_at as Created_at')->get()->toArray();
        
        //  return $this->excel->create('employees-'.time(), function($excels) use ($employees) {
        //      $excels->sheet('Employees Details', function($sheet) use ($employees)
        //      {
        //          $sheet->fromArray($this->updateBranchAndRole($employees));
        //      });
        //  })->download($type);
         return redirect(route('warehouses.index'));
    
     }

    /**
     * Show the form for creating a new Warehouse.
     *
     * @return Response
     */
    public function create()
    {   $warehouse=[];
        $warehouse['transfer']=false;
        $warehouse['add']=true;
        return view('warehouses.create')
        ->with('models', Models::pluck('name','id'))
        ->with('warehouses', $warehouse);
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
            $this->warehouseRepository->create($input);
    
        }
       $transction=['currenty_qty'=>$sum_qty,
       'action'=>$input['action'],
       'reason'=>$input['reason'],
       'added_qty'=>$input['added_qty'],
       'removed_qty'=>0,
       'transfered_qty'=>0,
       'messages'=>$input['action']. ' '. $input['reason'].' '. $input['added_qty'].' qty in warehouse stock','model_id'=>$input['model_id']];
    
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
        $warehouse['edit']=true;
        $warehouse['add']=false;
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
       
        $sum_qty=$warehouse->qty-$input['added_qty'];
        $sum_total=$warehouse->total_entered_qty-$input['added_qty'];
        $warehouse->total_entered_qty=$sum_total;
        $warehouse->added_qty=$input['added_qty'];
        $warehouse->qty=$sum_qty;
        $warehouse->save();


        $transction=['currenty_qty'=>$sum_qty,
        'action'=>$input['action'],
         'reason'=>$input['reason'],
        'added_qty'=>0,
         'removed_qty'=>0,
        'transfered_qty'=>$input['added_qty'],
        'messages'=>'Transfer '.$input['added_qty']. ' qty from Warehouse to Main stock',
        'model_id'=>$input['model_id']];
        
        WarehouseTransction::create($transction);

         $main_stock=MainStock::where('model_id',$input['model_id'])->first();
            if($main_stock){
            // add qty to main stock if exists
                $sum_qty=$main_stock->qty+$input['added_qty'];
                $sum_total=$main_stock->total_entered_qty+$input['added_qty'];
                $main_stock->total_entered_qty=$sum_total;
                $main_stock->added_qty=$input['added_qty'];
                $main_stock->qty=$sum_qty;
                $main_stock->save();

                $main_transction=['currenty_qty'=> $sum_qty,
                'action'=>'Add',
                'reason'=>'Receive Transfered',
                 'added_qty'=>$input['added_qty'],
                'removed_qty'=>0,
               'transfered_qty'=>0
                ,'messages'=>'Received '.$input['added_qty'].' qty from Warehouse to Main stock',
                'model_id'=>$input['model_id']];

            }else{
                $input['total_entered_qty']=$input['added_qty'];
                $input['qty']=$input['added_qty'];
                $input['added_qty']=$input['added_qty'];
                MainStock::create($input);

                $main_transction=['currenty_qty'=>$input['qty'],
                'action'=>'Add',
                'reason'=>'Receive Transfered',
                 'added_qty'=>$input['added_qty'],
                'removed_qty'=>0,
               'transfered_qty'=>0
                ,'messages'=>'Received '.$input['added_qty'].' qty from Warehouse to Main stock',
                'model_id'=>$input['model_id']];
            }
   
    MainStockTransctions::create($main_transction);

    Flash::success($input['reason'].' Warehouse Stock successfully.');

}else{
    if($input['action']=='Add'){
        $sum_qty=$warehouse->qty+$input['added_qty'];
        $sum_total=$warehouse->total_entered_qty+$input['added_qty'];  
    }else{
        $sum_qty=$warehouse->qty-$input['added_qty'];
        $sum_total=$warehouse->total_entered_qty-$input['added_qty'];   
    }

    $warehouse->total_entered_qty=$sum_total;
    $warehouse->added_qty=$input['added_qty'];
    $warehouse->qty=$sum_qty;
    $warehouse->save();

    $transction=['currenty_qty'=>$sum_qty,
    'action'=>$input['action'],
    'reason'=>$input['reason'],
    'added_qty'=>$input['action']=='Add'?$input['added_qty']:0,
    'removed_qty'=>$input['action']=='Remove'?$input['added_qty']:0,
    'transfered_qty'=>0
    ,'messages'=>$input['action'].' '.$input['reason'].' '.$input['added_qty'].' qty in warehouse stock',
    'model_id'=>$input['model_id']];
  
    
    WarehouseTransction::create($transction);
    Flash::success($input['reason'].' Warehouse Stock successfully.');
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