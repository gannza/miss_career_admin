<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\ClientTypes;
use Log;
use App\Models\Clients;
use Maatwebsite\Excel\Excel;
use App\Exports\ClientsExport;

class ClientsController extends AppBaseController
{
    /** @var  ClientsRepository */
    private $clientsRepository;

    public function __construct(ClientsRepository $clientsRepo,Excel $excel)
    {
        $this->clientsRepository = $clientsRepo;
        $this->excel=$excel;
    }
//   @if (count($records) === 1)
//     I have one record!
// @elseif (count($records) > 1)
//     I have multiple records!
// @else    
//     I don't have any records!
// @endif
    /**
     * Display a listing of the Clients.
     *
     * @param Request $request
     * @return Response
     */

    public function clientsExport($type="xls"){
       $clients = Clients::select('first_name as First_Name' ,'last_name as Last_Name','phone_number as Phone','email as Email','client_type_id as Client_Type')->get()->toArray();
       
        return $this->excel->create('Clients', function($excels) use ($clients) {
            $excels->sheet('Client Details', function($sheet) use ($clients)
            {
                $sheet->fromArray($this->updateClientType($clients));
            });
        })->download($type);
        return redirect(route('clients.index'));

    }
    function updateClientType($clients){
        $all=[];
        foreach($clients as $c){
            $ct=ClientTypes::where('id',$c['Client_Type'])->first();
            if($ct){
                $c['Client_Type']=$ct->name;
            }else{
                $c['Client_Type']='';
            }
            $all[]=$c;
        }
        return $all;

    }

    public function index(Request $request)
    {
        $clients=[];
       $this->clientsRepository->pushCriteria(new RequestCriteria($request));
        $clientss = $this->clientsRepository->all();
         foreach($clientss as $client){
            
            $clients[]=$this->transform($client);
        }
        
        return !$this->authorized()?view('anauthorized.index'): view('clients.index')
                    ->with('clients', $clients);
            }
    function transform(Clients $client){
        $client['customer_type']=ClientTypes::where('id',$client->client_type_id)->first();
        return $client;
    }

    /**
     * Show the form for creating a new Clients.
     *
     * @return Response
     */
    public function create()
    {
        return view('clients.create')->with('clientsTypes', ClientTypes::pluck('name','id'));
    }

    /**
     * Store a newly created Clients in storage.
     *
     * @param CreateClientsRequest $request
     *
     * @return Response
     */
    public function store(CreateClientsRequest $request)
    {
        $input = $request->all();
        $input['name']=$input['first_name'].' '.$input['last_name'];
        $clients = $this->clientsRepository->create($input);

        Flash::success('Clients saved successfully.');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified Clients.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified Clients.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('clients', $clients)->with('clientsTypes', ClientTypes::pluck('name','id'));;
    }

    /**
     * Update the specified Clients in storage.
     *
     * @param  int              $id
     * @param UpdateClientsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientsRequest $request)
    {
        $input = $request->all();
        $input['name']=$input['first_name'].' '.$input['last_name'];
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($input, $id);

        Flash::success('Clients updated successfully.');

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified Clients from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);

        Flash::success('Clients deleted successfully.');

        return redirect(route('clients.index'));
    }
}
