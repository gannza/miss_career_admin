<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMainStockTransctionsRequest;
use App\Http\Requests\UpdateMainStockTransctionsRequest;
use App\Repositories\MainStockTransctionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;

class MainStockTransctionsController extends AppBaseController
{
    /** @var  MainStockTransctionsRepository */
    private $mainStockTransctionsRepository;

    public function __construct(MainStockTransctionsRepository $mainStockTransctionsRepo)
    {
        $this->mainStockTransctionsRepository = $mainStockTransctionsRepo;
    }

    /**
     * Display a listing of the MainStockTransctions.
     *
     * @param Request $request
     * @return Response
     */


    public function index(Request $request)
    {
        $mainStockTransctions=[];
        $_mainStockTransctions = $this->mainStockTransctionsRepository->all();
         foreach($_mainStockTransctions as $mainStockTransction){
            $mainStockTransctions[]=$this->transform($mainStockTransction);
        }
        return !$this->authorized()?view('anauthorized.index'): view('main_stock_transctions.index')
                    ->with('mainStockTransctions', $mainStockTransctions);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        return $model;
    }

    /**
     * Show the form for creating a new MainStockTransctions.
     *
     * @return Response
     */
    public function create()
    {
        return view('main_stock_transctions.create');
    }

    /**
     * Store a newly created MainStockTransctions in storage.
     *
     * @param CreateMainStockTransctionsRequest $request
     *
     * @return Response
     */
    public function store(CreateMainStockTransctionsRequest $request)
    {
        $input = $request->all();

        $mainStockTransctions = $this->mainStockTransctionsRepository->create($input);

        Flash::success('Main Stock Transctions saved successfully.');

        return redirect(route('mainStockTransctions.index'));
    }

    /**
     * Display the specified MainStockTransctions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            Flash::error('Main Stock Transctions not found');

            return redirect(route('mainStockTransctions.index'));
        }

        return view('main_stock_transctions.show')->with('mainStockTransctions', $mainStockTransctions);
    }

    /**
     * Show the form for editing the specified MainStockTransctions.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            Flash::error('Main Stock Transctions not found');

            return redirect(route('mainStockTransctions.index'));
        }

        return view('main_stock_transctions.edit')->with('mainStockTransctions', $mainStockTransctions);
    }

    /**
     * Update the specified MainStockTransctions in storage.
     *
     * @param  int              $id
     * @param UpdateMainStockTransctionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainStockTransctionsRequest $request)
    {
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            Flash::error('Main Stock Transctions not found');

            return redirect(route('mainStockTransctions.index'));
        }

        $mainStockTransctions = $this->mainStockTransctionsRepository->update($request->all(), $id);

        Flash::success('Main Stock Transctions updated successfully.');

        return redirect(route('mainStockTransctions.index'));
    }

    /**
     * Remove the specified MainStockTransctions from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mainStockTransctions = $this->mainStockTransctionsRepository->findWithoutFail($id);

        if (empty($mainStockTransctions)) {
            Flash::error('Main Stock Transctions not found');

            return redirect(route('mainStockTransctions.index'));
        }

        $this->mainStockTransctionsRepository->delete($id);

        Flash::success('Main Stock Transctions deleted successfully.');

        return redirect(route('mainStockTransctions.index'));
    }
}
