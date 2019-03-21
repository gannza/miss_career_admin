<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use Response;
use Log;
class AnauthorizedController
{
    /** @var  ClientTypesRepository */
    //private $clientTypesRepository;

    public function __construct()
    {
        // $this->clientTypesRepository = $clientTypesRepo;
    }

    /**
     * Display a listing of the ClientTypes.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        return view('anauthorized.index');
    }

    /**
     * Show the form for creating a new ClientTypes.
     *
     * @return Response
     */
    public function create()
    {
       // return view('anauthorized.create');
    }

    /**
     * Store a newly created ClientTypes in storage.
     *
     * @param CreateClientTypesRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();

        // $clientTypes = $this->clientTypesRepository->create($input);

        // Flash::success('Client Types saved successfully.');

        // return redirect(route('clientTypes.index'));
    }

    /**
     * Display the specified ClientTypes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        // if (empty($clientTypes)) {
        //     Flash::error('Client Types not found');

        //     return redirect(route('clientTypes.index'));
        // }

        // return view('clientTypes.show')->with('clientTypes', $clientTypes);
    }

    /**
     * Show the form for editing the specified ClientTypes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        // if (empty($clientTypes)) {
        //     Flash::error('Client Types not found');

        //     return redirect(route('clientTypes.index'));
        // }

        // return view('clientTypes.edit')->with('clientTypes', $clientTypes);
    }

    /**
     * Update the specified ClientTypes in storage.
     *
     * @param  int              $id
     * @param UpdateClientTypesRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        // if (empty($clientTypes)) {
        //     Flash::error('Client Types not found');

        //     return redirect(route('clientTypes.index'));
        // }

        // $clientTypes = $this->clientTypesRepository->update($request->all(), $id);

        // Flash::success('Client Types updated successfully.');

        // return redirect(route('clientTypes.index'));
    }

    /**
     * Remove the specified ClientTypes from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $clientTypes = $this->clientTypesRepository->findWithoutFail($id);

        // if (empty($clientTypes)) {
        //     Flash::error('Client Types not found');

        //     return redirect(route('clientTypes.index'));
        // }

        // $this->clientTypesRepository->delete($id);

        // Flash::success('Client Types deleted successfully.');

        // return redirect(route('clientTypes.index'));
    }
}
