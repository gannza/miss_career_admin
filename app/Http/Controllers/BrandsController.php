<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBrandsRequest;
use App\Http\Requests\UpdateBrandsRequest;
use App\Repositories\BrandsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BrandsController extends AppBaseController
{
    /** @var  BrandsRepository */
    private $brandsRepository;

    public function __construct(BrandsRepository $brandsRepo)
    {
        $this->brandsRepository = $brandsRepo;
    }

    /**
     * Display a listing of the Brands.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->brandsRepository->pushCriteria(new RequestCriteria($request));
        $brands = $this->brandsRepository->all();

        return !$this->authorized()?view('anauthorized.index'):view('brands.index')
            ->with('brands', $brands);
    }

    /**
     * Show the form for creating a new Brands.
     *
     * @return Response
     */
    public function create()
    {
        return view('brands.create');
        
    }

    /**
     * Store a newly created Brands in storage.
     *
     * @param CreateBrandsRequest $request
     *
     * @return Response
     */
    public function store(CreateBrandsRequest $request)
    {
        $input = $request->all();

        $brands = $this->brandsRepository->create($input);

        Flash::success('Brands saved successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Display the specified Brands.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            Flash::error('Brands not found');

            return redirect(route('brands.index'));
        }

        return view('brands.show')->with('brands', $brands);
    }

    /**
     * Show the form for editing the specified Brands.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            Flash::error('Brands not found');

            return redirect(route('brands.index'));
        }

        return view('brands.edit')->with('brands', $brands);
    }

    /**
     * Update the specified Brands in storage.
     *
     * @param  int              $id
     * @param UpdateBrandsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrandsRequest $request)
    {
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            Flash::error('Brands not found');

            return redirect(route('brands.index'));
        }

        $brands = $this->brandsRepository->update($request->all(), $id);

        Flash::success('Brands updated successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brands from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $brands = $this->brandsRepository->findWithoutFail($id);

        if (empty($brands)) {
            Flash::error('Brands not found');

            return redirect(route('brands.index'));
        }

        $this->brandsRepository->delete($id);

        Flash::success('Brands deleted successfully.');

        return redirect(route('brands.index'));
    }
}
