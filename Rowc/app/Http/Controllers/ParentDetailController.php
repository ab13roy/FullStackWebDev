<?php

namespace App\Http\Controllers;

use App\DataTables\ParentDetailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateParentDetailRequest;
use App\Http\Requests\UpdateParentDetailRequest;
use App\Repositories\ParentDetailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ParentDetailController extends AppBaseController
{
    /** @var  ParentDetailRepository */
    private $parentDetailRepository;

    public function __construct(ParentDetailRepository $parentDetailRepo)
    {
        $this->parentDetailRepository = $parentDetailRepo;
    }

    /**
     * Display a listing of the ParentDetail.
     *
     * @param ParentDetailDataTable $parentDetailDataTable
     * @return Response
     */
    public function index(ParentDetailDataTable $parentDetailDataTable)
    {
        return $parentDetailDataTable->render('parent_details.index');
    }

    /**
     * Show the form for creating a new ParentDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('parent_details.create');
    }

    /**
     * Store a newly created ParentDetail in storage.
     *
     * @param CreateParentDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateParentDetailRequest $request)
    {
        $input = $request->all();

        $parentDetail = $this->parentDetailRepository->create($input);

        Flash::success('Parent Detail saved successfully.');

        return redirect(route('parentDetails.index'));
    }

    /**
     * Display the specified ParentDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            Flash::error('Parent Detail not found');

            return redirect(route('parentDetails.index'));
        }

        return view('parent_details.show')->with('parentDetail', $parentDetail);
    }

    /**
     * Show the form for editing the specified ParentDetail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            Flash::error('Parent Detail not found');

            return redirect(route('parentDetails.index'));
        }

        return view('parent_details.edit')->with('parentDetail', $parentDetail);
    }

    /**
     * Update the specified ParentDetail in storage.
     *
     * @param  int              $id
     * @param UpdateParentDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParentDetailRequest $request)
    {
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            Flash::error('Parent Detail not found');

            return redirect(route('parentDetails.index'));
        }

        $parentDetail = $this->parentDetailRepository->update($request->all(), $id);

        Flash::success('Parent Detail updated successfully.');

        return redirect(route('parentDetails.index'));
    }

    /**
     * Remove the specified ParentDetail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            Flash::error('Parent Detail not found');

            return redirect(route('parentDetails.index'));
        }

        $this->parentDetailRepository->delete($id);

        Flash::success('Parent Detail deleted successfully.');

        return redirect(route('parentDetails.index'));
    }
}
