<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrandsAPIRequest;
use App\Http\Requests\API\UpdateBrandsAPIRequest;
use App\Models\Brands;
use App\Repositories\BrandsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BrandsController
 * @package App\Http\Controllers\API
 */

class BrandsAPIController extends AppBaseController
{
    /** @var  BrandsRepository */
    private $brandsRepository;

    public function __construct(BrandsRepository $brandsRepo)
    {
        $this->brandsRepository = $brandsRepo;
    }

    /**
     * Display a listing of the Brands.
     * GET|HEAD /brands
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->brandsRepository->pushCriteria(new RequestCriteria($request));
        $this->brandsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $brands = $this->brandsRepository->all();

        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully');
    }

    /**
     * Store a newly created Brands in storage.
     * POST /brands
     *
     * @param CreateBrandsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandsAPIRequest $request)
    {
        $input = $request->all();

        $brands = $this->brandsRepository->create($input);

        return $this->sendResponse($brands->toArray(), 'Brands saved successfully');
    }

    /**
     * Display the specified Brands.
     * GET|HEAD /brands/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Brands $brands */
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            return $this->sendError('Brands not found');
        }

        return $this->sendResponse($brands->toArray(), 'Brands retrieved successfully');
    }

    /**
     * Update the specified Brands in storage.
     * PUT/PATCH /brands/{id}
     *
     * @param  int $id
     * @param UpdateBrandsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Brands $brands */
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            return $this->sendError('Brands not found');
        }

        $brands = $this->brandsRepository->update($input, $id);

        return $this->sendResponse($brands->toArray(), 'Brands updated successfully');
    }

    /**
     * Remove the specified Brands from storage.
     * DELETE /brands/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Brands $brands */
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            return $this->sendError('Brands not found');
        }

        $brands->delete();

        return $this->sendResponse($id, 'Brands deleted successfully');
    }
}
