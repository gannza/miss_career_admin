<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModelsRequest;
use App\Http\Requests\UpdateModelsRequest;
use App\Repositories\ModelsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Stocks;
use Maatwebsite\Excel\Excel;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Log;
class ModelsController extends AppBaseController
{
    /** @var  ModelsRepository */
    private $modelsRepository;

    public function __construct(ModelsRepository $modelsRepo,Excel $excel)
    {
        $this->modelsRepository = $modelsRepo;
        $this->excel=$excel;
    }

    /**
     * Display a listing of the Models.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->modelsRepository->pushCriteria(new RequestCriteria($request));
        $models = $this->modelsRepository->all();

        return !$this->authorized()?view('anauthorized.index'):view('models.index')
            ->with('models', $models);
    }
//export_model
public function modelsExport($type="xls"){
    $models = Models::select('name as Name' ,'cost_price as Cost Price','sale_price as Sales Price','description as Description','created_at as Created_at')->get()->toArray();
    
     return $this->excel->create('models-'.time(), function($excels) use ($models) {
         $excels->sheet('Models Details', function($sheet) use ($models)
         {
             $sheet->fromArray($models);
         });
     })->download($type);
     return redirect(route('models.index'));

 }
    /**
     * Show the form for creating a new Models.
     *
     * @return Response
     */
    public function create()
    {
        return view('models.create');
    }
    function getModelByBranch($branch_id){
        $arrs=[];
         foreach(Stocks::where('branch_id',$branch_id)->get() as $arr){
            $arr['model']=Models::where('id',$arr->model_id)->first();
            $arrs[]=$arr;
         }
         return $arrs;
    }

    /**
     * Store a newly created Models in storage.
     *
     * @param CreateModelsRequest $request
     *
     * @return Response
     */
    public function store(CreateModelsRequest $request)
    {
        $input = $request->all();

        $models = $this->modelsRepository->create($input);

        Flash::success('Models saved successfully.');

        return redirect(route('models.index'));
    }

    /**
     * Display the specified Models.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            Flash::error('Models not found');

            return redirect(route('models.index'));
        }

        return view('models.show')->with('models', $models);
    }

    /**
     * Show the form for editing the specified Models.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            Flash::error('Models not found');

            return redirect(route('models.index'));
        }

        return view('models.edit')->with('models', $models);
    }

    /**
     * Update the specified Models in storage.
     *
     * @param  int              $id
     * @param UpdateModelsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModelsRequest $request)
    {
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            Flash::error('Models not found');

            return redirect(route('models.index'));
        }

        $models = $this->modelsRepository->update($request->all(), $id);

        Flash::success('Models updated successfully.');

        return redirect(route('models.index'));
    }

    /**
     * Remove the specified Models from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $models = $this->modelsRepository->findWithoutFail($id);

        if (empty($models)) {
            Flash::error('Models not found');

            return redirect(route('models.index'));
        }

        $this->modelsRepository->delete($id);

        Flash::success('Models deleted successfully.');

        return redirect(route('models.index'));
    }
}
