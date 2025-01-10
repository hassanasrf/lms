<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Booking;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Http\Controllers\BaseController;
use App\Repository\Contracts\BookingRepositoryInterface;

class BookingController extends BaseController
{
    public function __construct(
        public readonly BookingRepositoryInterface $repo)
    {
        if (!auth()->guard('admin')->check()) {
            $this->middleware('permission:booking-read', ['only' => ['index','show']]);
            $this->middleware('permission:booking-create', ['only' => 'store']);
            $this->middleware('permission:booking-update', ['only' => 'update']);
            $this->middleware('permission:booking-delete', ['only' => 'destroy']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $paginate = $request->boolean('paginate', true);
            $perPage = (int) $request->get('perPage', 10);
            $response = $this->repo->all(paginate: $paginate, perPage: $perPage);

            return successResponse($response, Constant::MESSAGE_FETCHED, $paginate);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        try {
            $response = $this->repo->create($request->validated());

            return successResponse($response, Constant::MESSAGE_CREATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        try {
            $response = $this->repo->showModel($booking);
            
            return successResponse($response, Constant::MESSAGE_FETCHED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        try {
            $data = $request->validated();
            $response = $this->repo->updateModel($booking, $data);

            return successResponse($response, Constant::MESSAGE_UPDATED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try {
            $this->repo->deleteByModel($booking);

            return successResponse(true, Constant::MESSAGE_DELETED);
        } catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }
}
