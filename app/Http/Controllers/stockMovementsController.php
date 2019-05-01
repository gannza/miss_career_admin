<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestockMovementsRequest;
use App\Http\Requests\UpdatestockMovementsRequest;
use App\Repositories\stockMovementsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Models;
use App\Models\Branches;
use Auth;
use Log;

class stockMovementsController extends AppBaseController
{
    /** @var  stockMovementsRepository */
    private $stockMovementsRepository;

    public function __construct(stockMovementsRepository $stockMovementsRepo)
    {
        $this->stockMovementsRepository = $stockMovementsRepo;
    }

    /**
     * Display a listing of the stockMovements.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
    $stockMovements=[];

      $this->stockMovementsRepository->pushCriteria(new RequestCriteria($request));
       
        if(Auth::user()->role==0){
            $stockMovementss = $this->stockMovementsRepository->all();
        }else{
            $stockMovementss = $this->stockMovementsRepository->findByField('branch_id', Auth::user()->branch_id);
        }

         foreach($stockMovementss as $stockMovement){
            $stockMovements[]=$this->transform($stockMovement);
        }
        return !$this->authorized()?view('anauthorized.index'): view('stock_movements.index')
                    ->with('stockMovements', $stockMovements);
        }
    function transform($model){
        $model['model']=Models::where('id',$model->model_id)->first(); 
        $model['branch']=Branches::where('id',$model->branch_id)->first();
        return $model;
    }

    /**
     * Show the form for creating a new stockMovements.
     *
     * @return Response
     */
    public function create()
    {
        return view('stock_movements.create');
    }

    /**
     * Store a newly created stockMovements in storage.
     *
     * @param CreatestockMovementsRequest $request
     *
     * @return Response
     */
    public function store(CreatestockMovementsRequest $request)
    {
        $input = $request->all();

        $stockMovements = $this->stockMovementsRepository->create($input);

        Flash::success('Stock Movements saved successfully.');

        return redirect(route('stockMovements.index'));
    }

    /**
     * Display the specified stockMovements.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            Flash::error('Stock Movements not found');

            return redirect(route('stockMovements.index'));
        }

        return view('stock_movements.show')->with('stockMovements', $stockMovements);
    }

    /**
     * Show the form for editing the specified stockMovements.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            Flash::error('Stock Movements not found');

            return redirect(route('stockMovements.index'));
        }

        return view('stock_movements.edit')->with('stockMovements', $stockMovements);
    }

    /**
     * Update the specified stockMovements in storage.
     *
     * @param  int              $id
     * @param UpdatestockMovementsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockMovementsRequest $request)
    {
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            Flash::error('Stock Movements not found');

            return redirect(route('stockMovements.index'));
        }

        $stockMovements = $this->stockMovementsRepository->update($request->all(), $id);

        Flash::success('Stock Movements updated successfully.');

        return redirect(route('stockMovements.index'));
    }

    /**
     * Remove the specified stockMovements from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockMovements = $this->stockMovementsRepository->findWithoutFail($id);

        if (empty($stockMovements)) {
            Flash::error('Stock Movements not found');

            return redirect(route('stockMovements.index'));
        }

        $this->stockMovementsRepository->delete($id);

        Flash::success('Stock Movements deleted successfully.');

        return redirect(route('stockMovements.index'));
    }
}
