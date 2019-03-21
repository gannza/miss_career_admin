<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateModelsAPIRequest;
use App\Http\Requests\API\UpdateModelsAPIRequest;
use App\Models\Models;
use App\Repositories\ModelsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ModelsController
 * @package App\Http\Controllers\API
 */

class ModelsAPIController extends AppBaseController
{
    /** @var  ModelsRepository */
    private $modelsRepository;

    public function __construct(ModelsRepository $modelsRepo)
    {
        $this->modelsRepository = $modelsRepo;
    }

    /**
     * Display a listing of the Models.
     * GET|HEAD /models
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->modelsRepository->pushCriteria(new RequestCriteria($request));
        $this->modelsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $models = $this->modelsRepository->all();

        return $this->sendResponse($models->toArray(), 'Models retrieved successfully');
    }

    /**
     * Store a newly created Models in storage.
     * POST /models
     *
     * @param CreateModelsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateModelsAPIRequest $request)
    {
        $input = $request->all();

        $models = $this->modelsRepository->create($input);

        return $this->sendResponse($models->toArray(), 'Models saved successfully');
    }

    /**
     * Display the specified Models.
     * GET|HEAD /models/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Models $models */
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            return $this->sendError('Models not found');
        }

        return $this->sendResponse($models->toArray(), 'Models retrieved successfully');
    }

    /**
     * Update the specified Models in storage.
     * PUT/PATCH /models/{id}
     *
     * @param  int $id
     * @param UpdateModelsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModelsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Models $models */
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            return $this->sendError('Models not found');
        }

        $models = $this->modelsRepository->update($input, $id);

        return $this->sendResponse($models->toArray(), 'Models updated successfully');
    }

    /**
     * Remove the specified Models from storage.
     * DELETE /models/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Models $models */
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            return $this->sendError('Models not found');
        }

        $models->delete();

        return $this->sendResponse($id, 'Models deleted successfully');
    }
}
