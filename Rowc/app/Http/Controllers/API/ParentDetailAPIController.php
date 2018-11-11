<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParentDetailAPIRequest;
use App\Http\Requests\API\UpdateParentDetailAPIRequest;
use App\Models\ParentDetail;
use App\Repositories\ParentDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ParentDetailController
 * @package App\Http\Controllers\API
 */

class ParentDetailAPIController extends AppBaseController
{
    /** @var  ParentDetailRepository */
    private $parentDetailRepository;

    public function __construct(ParentDetailRepository $parentDetailRepo)
    {
        $this->parentDetailRepository = $parentDetailRepo;
    }

    /**
     * Display a listing of the ParentDetail.
     * GET|HEAD /parentDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->parentDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->parentDetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        $parentDetails = $this->parentDetailRepository->all();

        return $this->sendResponse($parentDetails->toArray(), 'Parent Details retrieved successfully');
    }

    /**
     * Store a newly created ParentDetail in storage.
     * POST /parentDetails
     *
     * @param CreateParentDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateParentDetailAPIRequest $request)
    {
        $input = $request->all();

        $parentDetails = $this->parentDetailRepository->create($input);

        return $this->sendResponse($parentDetails->toArray(), 'Parent Detail saved successfully');
    }

    /**
     * Display the specified ParentDetail.
     * GET|HEAD /parentDetails/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ParentDetail $parentDetail */
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            return $this->sendError('Parent Detail not found');
        }

        return $this->sendResponse($parentDetail->toArray(), 'Parent Detail retrieved successfully');
    }

    /**
     * Update the specified ParentDetail in storage.
     * PUT/PATCH /parentDetails/{id}
     *
     * @param  int $id
     * @param UpdateParentDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParentDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var ParentDetail $parentDetail */
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            return $this->sendError('Parent Detail not found');
        }

        $parentDetail = $this->parentDetailRepository->update($input, $id);

        return $this->sendResponse($parentDetail->toArray(), 'ParentDetail updated successfully');
    }

    /**
     * Remove the specified ParentDetail from storage.
     * DELETE /parentDetails/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ParentDetail $parentDetail */
        $parentDetail = $this->parentDetailRepository->findWithoutFail($id);

        if (empty($parentDetail)) {
            return $this->sendError('Parent Detail not found');
        }

        $parentDetail->delete();

        return $this->sendResponse($id, 'Parent Detail deleted successfully');
    }
}
