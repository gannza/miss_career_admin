<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMainStockAPIRequest;
use App\Http\Requests\API\UpdateMainStockAPIRequest;
use App\Models\MainStock;
use App\Repositories\MainStockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MainStockController
 * @package App\Http\Controllers\API
 */

class MainStockAPIController extends AppBaseController
{
    /** @var  MainStockRepository */
    private $mainStockRepository;

    public function __construct(MainStockRepository $mainStockRepo)
    {
        $this->mainStockRepository = $mainStockRepo;
    }

    /**
     * Display a listing of the MainStock.
     * GET|HEAD /mainStocks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->mainStockRepository->pushCriteria(new RequestCriteria($request));
        $this->mainStockRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mainStocks = $this->mainStockRepository->all();

        return $this->sendResponse($mainStocks->toArray(), 'Main Stocks retrieved successfully');
    }

    /**
     * Store a newly created MainStock in storage.
     * POST /mainStocks
     *
     * @param CreateMainStockAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMainStockAPIRequest $request)
    {
        $input = $request->all();

        $mainStocks = $this->mainStockRepository->create($input);

        return $this->sendResponse($mainStocks->toArray(), 'Main Stock saved successfully');
    }

    /**
     * Display the specified MainStock.
     * GET|HEAD /mainStocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MainStock $mainStock */
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            return $this->sendError('Main Stock not found');
        }

        return $this->sendResponse($mainStock->toArray(), 'Main Stock retrieved successfully');
    }

    /**
     * Update the specified MainStock in storage.
     * PUT/PATCH /mainStocks/{id}
     *
     * @param  int $id
     * @param UpdateMainStockAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainStockAPIRequest $request)
    {
        $input = $request->all();

        /** @var MainStock $mainStock */
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            return $this->sendError('Main Stock not found');
        }

        $mainStock = $this->mainStockRepository->update($input, $id);

        return $this->sendResponse($mainStock->toArray(), 'MainStock updated successfully');
    }

    /**
     * Remove the specified MainStock from storage.
     * DELETE /mainStocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MainStock $mainStock */
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            return $this->sendError('Main Stock not found');
        }

        $mainStock->delete();

        return $this->sendResponse($id, 'Main Stock deleted successfully');
    }
}
