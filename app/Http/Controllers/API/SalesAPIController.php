<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSalesAPIRequest;
use App\Http\Requests\API\UpdateSalesAPIRequest;
use App\Models\Sales;
use App\Repositories\SalesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SalesController
 * @package App\Http\Controllers\API
 */

class SalesAPIController extends AppBaseController
{
    /** @var  SalesRepository */
    private $salesRepository;

    public function __construct(SalesRepository $salesRepo)
    {
        $this->salesRepository = $salesRepo;
    }

    /**
     * Display a listing of the Sales.
     * GET|HEAD /sales
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->salesRepository->pushCriteria(new RequestCriteria($request));
        $this->salesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sales = $this->salesRepository->all();

        return $this->sendResponse($sales->toArray(), 'Sales retrieved successfully');
    }

    /**
     * Store a newly created Sales in storage.
     * POST /sales
     *
     * @param CreateSalesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSalesAPIRequest $request)
    {
        $input = $request->all();

        $sales = $this->salesRepository->create($input);

        return $this->sendResponse($sales->toArray(), 'Sales saved successfully');
    }

    /**
     * Display the specified Sales.
     * GET|HEAD /sales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sales $sales */
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            return $this->sendError('Sales not found');
        }

        return $this->sendResponse($sales->toArray(), 'Sales retrieved successfully');
    }

    /**
     * Update the specified Sales in storage.
     * PUT/PATCH /sales/{id}
     *
     * @param  int $id
     * @param UpdateSalesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sales $sales */
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            return $this->sendError('Sales not found');
        }

        $sales = $this->salesRepository->update($input, $id);

        return $this->sendResponse($sales->toArray(), 'Sales updated successfully');
    }

    /**
     * Remove the specified Sales from storage.
     * DELETE /sales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sales $sales */
        $sales = $this->salesRepository->findWithoutFail($id);

        if (empty($sales)) {
            return $this->sendError('Sales not found');
        }

        $sales->delete();

        return $this->sendResponse($id, 'Sales deleted successfully');
    }
}
