<?php

namespace App\Repositories\Eloquent;

use App\Models\Holiday;
use App\Repositories\HolidayRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class HolidayRepository extends BaseRepository implements HolidayRepositoryInterface
{

    /**
     * HolidayRepository constructor.
     *
     * @param Holiday $model
     */
    public function __construct(Holiday $model)
    {
        parent::__construct($model);
    }

    public function exists(string $date): int
    {
        return $this->model->query()->where('date',$date)->count();
    }
}
