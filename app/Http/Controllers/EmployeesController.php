<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Repositories\EmployeesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Branches;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Log;
use Maatwebsite\Excel\Excel;
class EmployeesController extends AppBaseController
{
    /** @var  EmployeesRepository */
    private $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepo,Excel $excel)
    {
        $this->employeesRepository = $employeesRepo;
        $this->excel=$excel;
    }

    /**
     * Display a listing of the Employees.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $eplys=[];
        $this->employeesRepository->pushCriteria(new RequestCriteria($request));
        $employees = $this->employeesRepository->all();
        foreach($employees as $e){
            $eplys[]=$this->transform($e);
        }
        return !$this->authorized()?view('anauthorized.index'):view('employees.index')
            ->with('employees', $eplys);
    }

    public function employeesTypeExport($type="xls"){
        $employees = Employees::select('name as Name' ,'email as Email','phone as Phone','gender as Gender','branch_id as Branch','role as Role','created_at as Created_at')->get()->toArray();
        
         return $this->excel->create('employees-'.time(), function($excels) use ($employees) {
             $excels->sheet('Employees Details', function($sheet) use ($employees)
             {
                 $sheet->fromArray($this->updateBranchAndRole($employees));
             });
         })->download($type);
         return redirect(route('employees.index'));
    
     }

     function updateBranchAndRole($employees){
        $all=[];
        foreach($employees as $c){
            $ct=Branches::where('id',$c['Branch'])->first();
            if($ct){
                $c['Branch']=$ct->name;
            }else{
                $c['Branch']='';
            }
            if ($c['Role'] == 0){
                $c['Role']= 'Admin';
            }else  if ($c['Role'] == 1){
                $c['Role']= 'Branch Manager';
            }else  if ($c['Role'] == 2){
                $c['Role']= 'Tail';
            }
            if ($c['Gender'] == 'M'){
                $c['Gender']= 'Male';
            }else   if ($c['Gender'] == 'F'){
                $c['Gender']= 'Female';
            }
            $all[]=$c;
        }
        return $all;

    }

     function transform(Employees $e){
        $e['branch']=Branches::where('id',$e->branch_id)->first();
        return $e;
     }
    
    /**
     * Show the form for creating a new Employees.
     *
     * @return Response
     */
    public function create()
    {
        return view('employees.create')->with('branches', Branches::pluck('name','id'))->with('roles', ['1'=>'Branch Manager','2'=>'Tailer'])->with('gender', ['M'=>'Male','F'=>'Female'])
        ->with('activated',['0'=>'No','1'=>'Yes']);
    }

    /**
     * Store a newly created Employees in storage.
     *
     * @param CreateEmployeesRequest $request
     *
     * @return Response
     */
    public function store(CreateEmployeesRequest $request)
    {
        $data = $request->all();
       // $employees = $this->employeesRepository->create($input);
       $employees = Employees::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role' => $data['role']?$data['role']:2,
        'phone' => $data['phone'],
        'gender' => $data['gender'],
        'branch_id' => $data['branch_id']?$data['branch_id']:null,
        'password' => bcrypt('12345'),
    ]);

        Flash::success('Employees saved successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Display the specified Employees.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $employees = $this->employeesRepository->findWithoutFail($id);

        if (empty($employees)) {
            Flash::error('Employees not found');

            return redirect(route('employees.index'));
        }

        return view('employees.show')->with('employees', $employees);
    }

    /**
     * Show the form for editing the specified Employees.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $employees = $this->employeesRepository->findWithoutFail($id);

        if (empty($employees)) {
            Flash::error('Employees not found');

            return redirect(route('employees.index'));
        }

        return view('employees.edit')->with('employees', $employees)->with('branches', Branches::pluck('name','id'))->with('roles', ['1'=>'Branch Manager','2'=>'Tailer'])->with('gender', ['M'=>'Male','F'=>'Female'])->with('activated',['0'=>'No','1'=>'Yes']);;
    }

    /**
     * Update the specified Employees in storage.
     *
     * @param  int              $id
     * @param UpdateEmployeesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmployeesRequest $request)
    {
        $employees = $this->employeesRepository->findWithoutFail($id);

        if (empty($employees)) {
            Flash::error('Employees not found');

            return redirect(route('employees.index'));
        }

        $employees = $this->employeesRepository->update($request->all(), $id);

        Flash::success('Employees updated successfully.');

        return redirect(route('employees.index'));
    }

    /**
     * Remove the specified Employees from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $employees = $this->employeesRepository->findWithoutFail($id);

        if (empty($employees)) {
            Flash::error('Employees not found');

            return redirect(route('employees.index'));
        }

        $this->employeesRepository->delete($id);

        Flash::success('Employees deleted successfully.');

        return redirect(route('employees.index'));
    }
}
