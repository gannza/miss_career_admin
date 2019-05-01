<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalesItemsRequest;
use App\Http\Requests\UpdateSalesItemsRequest;
use App\Repositories\SalesItemsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SalesItemsController extends AppBaseController
{
    /** @var  SalesItemsRepository */
    private $salesItemsRepository;

    public function __construct(SalesItemsRepository $salesItemsRepo)
    {
        $this->salesItemsRepository = $salesItemsRepo;
    }

    /**
     * Display a listing of the SalesItems.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->salesItemsRepository->pushCriteria(new RequestCriteria($request));
        $salesItems = $this->salesItemsRepository->all();

        return view('sales_items.index')
            ->with('salesItems', $salesItems);
    }

    /**
     * Show the form for creating a new SalesItems.
     *
     * @return Response
     */
    public function create()
    {
        return view('sales_items.create');
    }

    /**
     * Store a newly created SalesItems in storage.
     *
     * @param CreateSalesItemsRequest $request
     *
     * @return Response
     */
    public function store(CreateSalesItemsRequest $request)
    {
        $input = $request->all();

        $salesItems = $this->salesItemsRepository->create($input);

        Flash::success('Sales Items saved successfully.');

        return redirect(route('salesItems.index'));
    }

    /**
     * Display the specified SalesItems.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            Flash::error('Sales Items not found');

            return redirect(route('salesItems.index'));
        }

        return view('sales_items.show')->with('salesItems', $salesItems);
    }

    /**
     * Show the form for editing the specified SalesItems.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            Flash::error('Sales Items not found');

            return redirect(route('salesItems.index'));
        }

        return view('sales_items.edit')->with('salesItems', $salesItems);
    }

    /**
     * Update the specified SalesItems in storage.
     *
     * @param  int              $id
     * @param UpdateSalesItemsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSalesItemsRequest $request)
    {
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            Flash::error('Sales Items not found');

            return redirect(route('salesItems.index'));
        }

        $salesItems = $this->salesItemsRepository->update($request->all(), $id);

        Flash::success('Sales Items updated successfully.');

        return redirect(route('salesItems.index'));
    }

    /**
     * Remove the specified SalesItems from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $salesItems = $this->salesItemsRepository->findWithoutFail($id);

        if (empty($salesItems)) {
            Flash::error('Sales Items not found');

            return redirect(route('salesItems.index'));
        }

        $this->salesItemsRepository->delete($id);

        Flash::success('Sales Items deleted successfully.');

        return redirect(route('salesItems.index'));
    }
}
