<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalesItemsAPIRequest;
use App\Http\Requests\API\UpdateSalesItemsAPIRequest;
use App\Models\SalesItems;
use App\Repositories\SalesItemsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SalesItemsController
 * @package App\Http\Controllers\API
 */

class SalesItemsAPIController extends AppBaseController
{
    /** @var  SalesItemsRepository */
    private $salesItemsRepository;

    public function __construct(SalesItemsRepository $salesItemsRepo)
    {
        $this->salesItemsRepository = $salesItemsRepo;
    }

    /**
     * Display a listing of the SalesItems.
     * GET|HEAD /salesItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->salesItemsRepository->pushCriteria(new RequestCriteria($request));
        $this->salesItemsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $salesItems = $this->salesItemsRepository->all();

        return $this->sendResponse($salesItems->toArray(), 'Sales Items retrieved successfully');
    }

    /**
     * Store a newly created SalesItems in storage.
     * POST /salesItems
     *
     * @param CreateSalesItemsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSalesItemsAPIRequest $request)
    {
        $input = $request->all();

        $salesItems = $this->salesItemsRepository->create($input);

        return $this->sendResponse($salesItems->toArray(), 'Sales Items saved successfully');
    }

    /**
     * Display the specified SalesItems.
     * GET|HEAD /salesItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SalesItems $salesItems */
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            return $this->sendError('Sales Items not found');
        }

        return $this->sendResponse($salesItems->toArray(), 'Sales Items retrieved successfully');
    }

    /**
     * Update the specified SalesItems in storage.
     * PUT/PATCH /salesItems/{id}
     *
     * @param  int $id
     * @param UpdateSalesItemsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalesItemsAPIRequest $request)
    {
        $input = $request->all();

        /** @var SalesItems $salesItems */
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            return $this->sendError('Sales Items not found');
        }

        $salesItems = $this->salesItemsRepository->update($input, $id);

        return $this->sendResponse($salesItems->toArray(), 'SalesItems updated successfully');
    }

    /**
     * Remove the specified SalesItems from storage.
     * DELETE /salesItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SalesItems $salesItems */
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            return $this->sendError('Sales Items not found');
        }

        $salesItems->delete();

        return $this->sendResponse($id, 'Sales Items deleted successfully');
    }
}
