<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClientTypesAPIRequest;
use App\Http\Requests\API\UpdateClientTypesAPIRequest;
use App\Models\ClientTypes;
use App\Repositories\ClientTypesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ClientTypesController
 * @package App\Http\Controllers\API
 */

class ClientTypesAPIController extends AppBaseController
{
    /** @var  ClientTypesRepository */
    private $clientTypesRepository;

    public function __construct(ClientTypesRepository $clientTypesRepo)
    {
        $this->clientTypesRepository = $clientTypesRepo;
    }

    /**
     * Display a listing of the ClientTypes.
     * GET|HEAD /clientTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clientTypesRepository->pushCriteria(new RequestCriteria($request));
        $this->clientTypesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $clientTypes = $this->clientTypesRepository->all();

        return $this->sendResponse($clientTypes->toArray(), 'Client Types retrieved successfully');
    }

    /**
     * Store a newly created ClientTypes in storage.
     * POST /clientTypes
     *
     * @param CreateClientTypesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClientTypesAPIRequest $request)
    {
        $input = $request->all();

        $clientTypes = $this->clientTypesRepository->create($input);

        return $this->sendResponse($clientTypes->toArray(), 'Client Types saved successfully');
    }

    /**
     * Display the specified ClientTypes.
     * GET|HEAD /clientTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ClientTypes $clientTypes */
        $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        if (empty($clientTypes)) {
            return $this->sendError('Client Types not found');
        }

        return $this->sendResponse($clientTypes->toArray(), 'Client Types retrieved successfully');
    }

    /**
     * Update the specified ClientTypes in storage.
     * PUT/PATCH /clientTypes/{id}
     *
     * @param  int $id
     * @param UpdateClientTypesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientTypesAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClientTypes $clientTypes */
        $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        if (empty($clientTypes)) {
            return $this->sendError('Client Types not found');
        }

        $clientTypes = $this->clientTypesRepository->update($input, $id);

        return $this->sendResponse($clientTypes->toArray(), 'ClientTypes updated successfully');
    }

    /**
     * Remove the specified ClientTypes from storage.
     * DELETE /clientTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ClientTypes $clientTypes */
        $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        if (empty($clientTypes)) {
            return $this->sendError('Client Types not found');
        }

        $clientTypes->delete();

        return $this->sendResponse($id, 'Client Types deleted successfully');
    }
}
