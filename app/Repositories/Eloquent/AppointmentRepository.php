<?php

namespace App\Repositories\Eloquent;

use App\Models\Appointment;
use App\Repositories\AppointmentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class AppointmentRepository extends BaseRepository implements AppointmentRepositoryInterface
{

    /**
     * AppointmentRepository constructor.
     *
     * @param Appointment $model
     */
    public function __construct(Appointment $model)
    {
        parent::__construct($model);
    }

    public function create($starts_at, $ends_at, $clientId, $serviceId, $barberId)
    {
        $model = new $this->model;
        $model->starts_at = $starts_at;
        $model->ends_at = $ends_at;
        $model->client_id = $clientId;
        $model->barber_id = $barberId;
        $model->service_id = $serviceId;

        return $model->save();
    }
}
