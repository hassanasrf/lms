<?php

namespace App\Repository\Eloquent;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\BookingResource;
use App\Repository\Contracts\BookingRepositoryInterface;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    /**
     * BookingRepository constructor.
     *
     * @param Booking $model
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
        $this->resource = BookingResource::class;
    }

}
