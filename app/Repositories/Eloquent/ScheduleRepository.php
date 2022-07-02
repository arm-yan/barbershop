<?php

namespace App\Repositories\Eloquent;

use App\Models\Schedule;
use App\Repositories\ScheduleRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{

    /**
     * ScheduleRepository constructor.
     *
     * @param Schedule $model
     */
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }

    public function getByWeekDay(string $weekDay)
    {
        return $this->model->query()->select($weekDay)->get();
    }
}
