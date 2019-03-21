<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBranchesAPIRequest;
use App\Http\Requests\API\UpdateBranchesAPIRequest;
use App\Models\Branches;
use App\Repositories\BranchesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BranchesController
 * @package App\Http\Controllers\API
 */

class BranchesAPIController extends AppBaseController
{
    /** @var  BranchesRepository */
    private $branchesRepository;

    public function __construct(BranchesRepository $branchesRepo)
    {
        $this->branchesRepository = $branchesRepo;
    }

    /**
     * Display a listing of the Branches.
     * GET|HEAD /branches
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->branchesRepository->pushCriteria(new RequestCriteria($request));
        $this->branchesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $branches = $this->branchesRepository->all();

        return $this->sendResponse($branches->toArray(), 'Branches retrieved successfully');
    }

    /**
     * Store a newly created Branches in storage.
     * POST /branches
     *
     * @param CreateBranchesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBranchesAPIRequest $request)
    {
        $input = $request->all();

        $branches = $this->branchesRepository->create($input);

        return $this->sendResponse($branches->toArray(), 'Branches saved successfully');
    }

    /**
     * Display the specified Branches.
     * GET|HEAD /branches/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Branches $branches */
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            return $this->sendError('Branches not found');
        }

        return $this->sendResponse($branches->toArray(), 'Branches retrieved successfully');
    }

    /**
     * Update the specified Branches in storage.
     * PUT/PATCH /branches/{id}
     *
     * @param  int $id
     * @param UpdateBranchesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBranchesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Branches $branches */
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            return $this->sendError('Branches not found');
        }

        $branches = $this->branchesRepository->update($input, $id);

        return $this->sendResponse($branches->toArray(), 'Branches updated successfully');
    }

    /**
     * Remove the specified Branches from storage.
     * DELETE /branches/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Branches $branches */
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            return $this->sendError('Branches not found');
        }

        $branches->delete();

        return $this->sendResponse($id, 'Branches deleted successfully');
    }
}
