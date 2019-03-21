<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWarehouseTransctionRequest;
use App\Http\Requests\UpdateWarehouseTransctionRequest;
use App\Repositories\WarehouseTransctionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;

class WarehouseTransctionController extends AppBaseController
{
    /** @var  WarehouseTransctionRepository */
    private $warehouseTransctionRepository;

    public function __construct(WarehouseTransctionRepository $warehouseTransctionRepo)
    {
        $this->warehouseTransctionRepository = $warehouseTransctionRepo;
    }

    /**
     * Display a listing of the WarehouseTransction.
     *
     * @param Request $request
     * @return Response
     */
   
    public function index(Request $request)
    {
        $warehouses=[];
        $_warehouses = $this->warehouseTransctionRepository->all();
         foreach($_warehouses as $warehouse){
            $warehouses[]=$this->transform($warehouse);
        }
        return !$this->authorized()?view('anauthorized.index'): view('warehouse_transctions.index')
                    ->with('warehouseTransctions', $warehouses);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        return $model;
    }
    /**
     * Show the form for creating a new WarehouseTransction.
     *
     * @return Response
     */
    public function create()
    {
        return view('warehouse_transctions.create');
    }

    /**
     * Store a newly created WarehouseTransction in storage.
     *
     * @param CreateWarehouseTransctionRequest $request
     *
     * @return Response
     */
    public function store(CreateWarehouseTransctionRequest $request)
    {
        $input = $request->all();

        $warehouseTransction = $this->warehouseTransctionRepository->create($input);
        Flash::success('Warehouse Transction saved successfully.');

        return redirect(route('warehouseTransctions.index'));
    }

    /**
     * Display the specified WarehouseTransction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            Flash::error('Warehouse Transction not found');

            return redirect(route('warehouseTransctions.index'));
        }

        return view('warehouse_transctions.show')->with('warehouseTransction', $warehouseTransction);
    }

    /**
     * Show the form for editing the specified WarehouseTransction.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            Flash::error('Warehouse Transction not found');

            return redirect(route('warehouseTransctions.index'));
        }

        return view('warehouse_transctions.edit')->with('warehouseTransction', $warehouseTransction);
    }

    /**
     * Update the specified WarehouseTransction in storage.
     *
     * @param  int              $id
     * @param UpdateWarehouseTransctionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWarehouseTransctionRequest $request)
    {
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            Flash::error('Warehouse Transction not found');

            return redirect(route('warehouseTransctions.index'));
        }

        $warehouseTransction = $this->warehouseTransctionRepository->update($request->all(), $id);

        Flash::success('Warehouse Transction updated successfully.');

        return redirect(route('warehouseTransctions.index'));
    }

    /**
     * Remove the specified WarehouseTransction from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            Flash::error('Warehouse Transction not found');

            return redirect(route('warehouseTransctions.index'));
        }

        $this->warehouseTransctionRepository->delete($id);

        Flash::success('Warehouse Transction deleted successfully.');

        return redirect(route('warehouseTransctions.index'));
    }
}
