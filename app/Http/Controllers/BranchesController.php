<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBranchesRequest;
use App\Http\Requests\UpdateBranchesRequest;
use App\Repositories\BranchesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BranchesController extends AppBaseController
{
    /** @var  BranchesRepository */
    private $branchesRepository;

    public function __construct(BranchesRepository $branchesRepo)
    {
        $this->branchesRepository = $branchesRepo;
    }

    /**
     * Display a listing of the Branches.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->branchesRepository->pushCriteria(new RequestCriteria($request));
        $branches = $this->branchesRepository->all();
        return !$this->authorized()?view('anauthorized.index'):view('branches.index')
            ->with('branches', $branches);
    }

    /**
     * Show the form for creating a new Branches.
     *
     * @return Response
     */
    public function create()
    {
        return view('branches.create')->with('branchType',['Main_branch'=>'Main_branch','Main_branch'=>'Main_branch','Warehouse'=>'Warehouse','Warehouse'=>'Warehouse','Branch'=>'Branch','Branch'=>'Branch']);
    }

    /**
     * Store a newly created Branches in storage.
     *
     * @param CreateBranchesRequest $request
     *
     * @return Response
     */
    public function store(CreateBranchesRequest $request)
    {
        $input = $request->all();

        $branches = $this->branchesRepository->create($input);

        Flash::success('Branches saved successfully.');

        return redirect(route('branches.index'));
    }

    /**
     * Display the specified Branches.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            Flash::error('Branches not found');

            return redirect(route('branches.index'));
        }

        return view('branches.show')->with('branches', $branches);
    }

    /**
     * Show the form for editing the specified Branches.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            Flash::error('Branches not found');

            return redirect(route('branches.index'));
        }

        return view('branches.edit')->with('branches', $branches)->with('branchType',['Main_branch'=>'Main_branch','Main_branch'=>'Main_branch','Warehouse'=>'Warehouse','Warehouse'=>'Warehouse','Branch'=>'Branch','Branch'=>'Branch']);
    }

    /**
     * Update the specified Branches in storage.
     *
     * @param  int              $id
     * @param UpdateBranchesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBranchesRequest $request)
    {
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            Flash::error('Branches not found');

            return redirect(route('branches.index'));
        }

        $branches = $this->branchesRepository->update($request->all(), $id);

        Flash::success('Branches updated successfully.');

        return redirect(route('branches.index'));
    }

    /**
     * Remove the specified Branches from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $branches = $this->branchesRepository->findWithoutFail($id);

        if (empty($branches)) {
            Flash::error('Branches not found');

            return redirect(route('branches.index'));
        }

        $this->branchesRepository->delete($id);

        Flash::success('Branches deleted successfully.');

        return redirect(route('branches.index'));
    }
}
