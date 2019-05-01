<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStocksAPIRequest;
use App\Http\Requests\API\UpdateStocksAPIRequest;
use App\Models\Stocks;
use App\Repositories\StocksRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class StocksController
 * @package App\Http\Controllers\API
 */

class StocksAPIController extends AppBaseController
{
    /** @var  StocksRepository */
    private $stocksRepository;

    public function __construct(StocksRepository $stocksRepo)
    {
        $this->stocksRepository = $stocksRepo;
    }

    /**
     * Display a listing of the Stocks.
     * GET|HEAD /stocks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stocksRepository->pushCriteria(new RequestCriteria($request));
        $this->stocksRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stocks = $this->stocksRepository->all();

        return $this->sendResponse($stocks->toArray(), 'Stocks retrieved successfully');
    }

    /**
     * Store a newly created Stocks in storage.
     * POST /stocks
     *
     * @param CreateStocksAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStocksAPIRequest $request)
    {
        $input = $request->all();

        $stocks = $this->stocksRepository->create($input);

        return $this->sendResponse($stocks->toArray(), 'Stocks saved successfully');
    }

    /**
     * Display the specified Stocks.
     * GET|HEAD /stocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Stocks $stocks */
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            return $this->sendError('Stocks not found');
        }

        return $this->sendResponse($stocks->toArray(), 'Stocks retrieved successfully');
    }

    /**
     * Update the specified Stocks in storage.
     * PUT/PATCH /stocks/{id}
     *
     * @param  int $id
     * @param UpdateStocksAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStocksAPIRequest $request)
    {
        $input = $request->all();

        /** @var Stocks $stocks */
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            return $this->sendError('Stocks not found');
        }

        $stocks = $this->stocksRepository->update($input, $id);

        return $this->sendResponse($stocks->toArray(), 'Stocks updated successfully');
    }

    /**
     * Remove the specified Stocks from storage.
     * DELETE /stocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Stocks $stocks */
        $stocks = $this->stocksRepository->findWithoutFail($id);

        if (empty($stocks)) {
            return $this->sendError('Stocks not found');
        }

        $stocks->delete();

        return $this->sendResponse($id, 'Stocks deleted successfully');
    }
}
