<?php

namespace App\Repository\Eloquent;

use App\Models\Booking;
use Illuminate\Support\Arr;
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

    public function createBooking(array $data): BookingResource
    {
        $voyage = $this->create(Arr::except($data, ['service_type_ids']));
        $voyage->serviceTypes()->attach(@$data['service_type_ids']);

        return $this->resource::make($voyage);
    }

    public function updateBooking(Model $model, array $data): bool
    {
        if (isset($data['service_type_ids'])) {
            $model->serviceTypes()->sync($data['service_type_ids']);
        }

        $model->update(Arr::except($data, ['service_type_ids']));
        return true;
    }

}
