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
class ClientsController extends AppBaseController
{
    /** @var  ClientsRepository */
    private $clientsRepository;

    public function __construct(ClientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
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
    public function index(Request $request)
    {
        $clients=[];
       // $this->clientsRepository->pushCriteria(new RequestCriteria($request));
        $clients = $this->clientsRepository->all();
         foreach($clients as $client){
            
            $clients[]=$this->transform($client);
        }
//Log::info($clients);
        return !$this->authorized()?view('anauthorized.index'): view('clients.index')
                    ->with('clients', $clients);
            }
    function transform(Clients $client){
        $client['customer_type']=ClientTypes::where('id',$client->client_type_id)->first();
      // $client->clientTypes=$client->clientTypes->name;
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
        $clients = $this->clientsRepository->findWithoutFail($id);

        if (empty($clients)) {
            Flash::error('Clients not found');

            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($request->all(), $id);

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
