<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestockMovementsAPIRequest;
use App\Http\Requests\API\UpdatestockMovementsAPIRequest;
use App\Models\stockMovements;
use App\Repositories\stockMovementsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class stockMovementsController
 * @package App\Http\Controllers\API
 */

class stockMovementsAPIController extends AppBaseController
{
    /** @var  stockMovementsRepository */
    private $stockMovementsRepository;

    public function __construct(stockMovementsRepository $stockMovementsRepo)
    {
        $this->stockMovementsRepository = $stockMovementsRepo;
    }

    /**
     * Display a listing of the stockMovements.
     * GET|HEAD /stockMovements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stockMovementsRepository->pushCriteria(new RequestCriteria($request));
        $this->stockMovementsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stockMovements = $this->stockMovementsRepository->all();

        return $this->sendResponse($stockMovements->toArray(), 'Stock Movements retrieved successfully');
    }

    /**
     * Store a newly created stockMovements in storage.
     * POST /stockMovements
     *
     * @param CreatestockMovementsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestockMovementsAPIRequest $request)
    {
        $input = $request->all();

        $stockMovements = $this->stockMovementsRepository->create($input);

        return $this->sendResponse($stockMovements->toArray(), 'Stock Movements saved successfully');
    }

    /**
     * Display the specified stockMovements.
     * GET|HEAD /stockMovements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var stockMovements $stockMovements */
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            return $this->sendError('Stock Movements not found');
        }

        return $this->sendResponse($stockMovements->toArray(), 'Stock Movements retrieved successfully');
    }

    /**
     * Update the specified stockMovements in storage.
     * PUT/PATCH /stockMovements/{id}
     *
     * @param  int $id
     * @param UpdatestockMovementsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockMovementsAPIRequest $request)
    {
        $input = $request->all();

        /** @var stockMovements $stockMovements */
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            return $this->sendError('Stock Movements not found');
        }

        $stockMovements = $this->stockMovementsRepository->update($input, $id);

        return $this->sendResponse($stockMovements->toArray(), 'stockMovements updated successfully');
    }

    /**
     * Remove the specified stockMovements from storage.
     * DELETE /stockMovements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var stockMovements $stockMovements */
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            return $this->sendError('Stock Movements not found');
        }

        $stockMovements->delete();

        return $this->sendResponse($id, 'Stock Movements deleted successfully');
    }
}
