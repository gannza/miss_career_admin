<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWarehouseTransctionAPIRequest;
use App\Http\Requests\API\UpdateWarehouseTransctionAPIRequest;
use App\Models\WarehouseTransction;
use App\Repositories\WarehouseTransctionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class WarehouseTransctionController
 * @package App\Http\Controllers\API
 */

class WarehouseTransctionAPIController extends AppBaseController
{
    /** @var  WarehouseTransctionRepository */
    private $warehouseTransctionRepository;

    public function __construct(WarehouseTransctionRepository $warehouseTransctionRepo)
    {
        $this->warehouseTransctionRepository = $warehouseTransctionRepo;
    }

    /**
     * Display a listing of the WarehouseTransction.
     * GET|HEAD /warehouseTransctions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->warehouseTransctionRepository->pushCriteria(new RequestCriteria($request));
        $this->warehouseTransctionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $warehouseTransctions = $this->warehouseTransctionRepository->all();

        return $this->sendResponse($warehouseTransctions->toArray(), 'Warehouse Transctions retrieved successfully');
    }

    /**
     * Store a newly created WarehouseTransction in storage.
     * POST /warehouseTransctions
     *
     * @param CreateWarehouseTransctionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateWarehouseTransctionAPIRequest $request)
    {
        $input = $request->all();

        $warehouseTransctions = $this->warehouseTransctionRepository->create($input);

        return $this->sendResponse($warehouseTransctions->toArray(), 'Warehouse Transction saved successfully');
    }

    /**
     * Display the specified WarehouseTransction.
     * GET|HEAD /warehouseTransctions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var WarehouseTransction $warehouseTransction */
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            return $this->sendError('Warehouse Transction not found');
        }

        return $this->sendResponse($warehouseTransction->toArray(), 'Warehouse Transction retrieved successfully');
    }

    /**
     * Update the specified WarehouseTransction in storage.
     * PUT/PATCH /warehouseTransctions/{id}
     *
     * @param  int $id
     * @param UpdateWarehouseTransctionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWarehouseTransctionAPIRequest $request)
    {
        $input = $request->all();

        /** @var WarehouseTransction $warehouseTransction */
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            return $this->sendError('Warehouse Transction not found');
        }

        $warehouseTransction = $this->warehouseTransctionRepository->update($input, $id);

        return $this->sendResponse($warehouseTransction->toArray(), 'WarehouseTransction updated successfully');
    }

    /**
     * Remove the specified WarehouseTransction from storage.
     * DELETE /warehouseTransctions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var WarehouseTransction $warehouseTransction */
        $warehouseTransction = $this->warehouseTransctionRepository->findWithoutFail($id);

        if (empty($warehouseTransction)) {
            return $this->sendError('Warehouse Transction not found');
        }

        $warehouseTransction->delete();

        return $this->sendResponse($id, 'Warehouse Transction deleted successfully');
    }
}
