<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMainStockTransctionsAPIRequest;
use App\Http\Requests\API\UpdateMainStockTransctionsAPIRequest;
use App\Models\MainStockTransctions;
use App\Repositories\MainStockTransctionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MainStockTransctionsController
 * @package App\Http\Controllers\API
 */

class MainStockTransctionsAPIController extends AppBaseController
{
    /** @var  MainStockTransctionsRepository */
    private $mainStockTransctionsRepository;

    public function __construct(MainStockTransctionsRepository $mainStockTransctionsRepo)
    {
        $this->mainStockTransctionsRepository = $mainStockTransctionsRepo;
    }

    /**
     * Display a listing of the MainStockTransctions.
     * GET|HEAD /mainStockTransctions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->mainStockTransctionsRepository->pushCriteria(new RequestCriteria($request));
        $this->mainStockTransctionsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mainStockTransctions = $this->mainStockTransctionsRepository->all();

        return $this->sendResponse($mainStockTransctions->toArray(), 'Main Stock Transctions retrieved successfully');
    }

    /**
     * Store a newly created MainStockTransctions in storage.
     * POST /mainStockTransctions
     *
     * @param CreateMainStockTransctionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMainStockTransctionsAPIRequest $request)
    {
        $input = $request->all();

        $mainStockTransctions = $this->mainStockTransctionsRepository->create($input);

        return $this->sendResponse($mainStockTransctions->toArray(), 'Main Stock Transctions saved successfully');
    }

    /**
     * Display the specified MainStockTransctions.
     * GET|HEAD /mainStockTransctions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MainStockTransctions $mainStockTransctions */
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            return $this->sendError('Main Stock Transctions not found');
        }

        return $this->sendResponse($mainStockTransctions->toArray(), 'Main Stock Transctions retrieved successfully');
    }

    /**
     * Update the specified MainStockTransctions in storage.
     * PUT/PATCH /mainStockTransctions/{id}
     *
     * @param  int $id
     * @param UpdateMainStockTransctionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainStockTransctionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var MainStockTransctions $mainStockTransctions */
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            return $this->sendError('Main Stock Transctions not found');
        }

        $mainStockTransctions = $this->mainStockTransctionsRepository->update($input, $id);

        return $this->sendResponse($mainStockTransctions->toArray(), 'MainStockTransctions updated successfully');
    }

    /**
     * Remove the specified MainStockTransctions from storage.
     * DELETE /mainStockTransctions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MainStockTransctions $mainStockTransctions */
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            return $this->sendError('Main Stock Transctions not found');
        }

        $mainStockTransctions->delete();

        return $this->sendResponse($id, 'Main Stock Transctions deleted successfully');
    }
}
