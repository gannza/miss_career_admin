<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMainStockRequest;
use App\Http\Requests\UpdateMainStockRequest;
use App\Repositories\MainStockRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;
class MainStockController extends AppBaseController
{
    /** @var  MainStockRepository */
    private $mainStockRepository;

    public function __construct(MainStockRepository $mainStockRepo)
    {
        $this->mainStockRepository = $mainStockRepo;
    }

    /**
     * Display a listing of the MainStock.
     *
     * @param Request $request
     * @return Response
     */

    public function index(Request $request)
    {
        $mainStocks=[];
        $_mainStocks = $this->mainStockRepository->all();
         foreach($_mainStocks as $mainStock){
            $mainStocks[]=$this->transform($mainStock);
        }
        return !$this->authorized()?view('anauthorized.index'): view('main_stocks.index')
                    ->with('main_stocks', $mainStocks);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first();
        return $model;
    }

    /**
     * Show the form for creating a new MainStock.
     *
     * @return Response
     */
    public function create()
    {
        return view('main_stocks.create');
    }

    /**
     * Store a newly created MainStock in storage.
     *
     * @param CreateMainStockRequest $request
     *
     * @return Response
     */
    public function store(CreateMainStockRequest $request)
    {
        $input = $request->all();

        $mainStock = $this->mainStockRepository->create($input);

        Flash::success('Main Stock saved successfully.');

        return redirect(route('mainStocks.index'));
    }

    /**
     * Display the specified MainStock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        return view('main_stocks.show')->with('mainStock', $mainStock);
    }

    /**
     * Show the form for editing the specified MainStock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        return view('main_stocks.edit')->with('mainStock', $mainStock);
    }

    /**
     * Update the specified MainStock in storage.
     *
     * @param  int              $id
     * @param UpdateMainStockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainStockRequest $request)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        $mainStock = $this->mainStockRepository->update($request->all(), $id);

        Flash::success('Main Stock updated successfully.');

        return redirect(route('mainStocks.index'));
    }

    /**
     * Remove the specified MainStock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mainStock = $this->mainStockRepository->findWithoutFail($id);

        if (empty($mainStock)) {
            Flash::error('Main Stock not found');

            return redirect(route('mainStocks.index'));
        }

        $this->mainStockRepository->delete($id);

        Flash::success('Main Stock deleted successfully.');

        return redirect(route('mainStocks.index'));
    }
}
