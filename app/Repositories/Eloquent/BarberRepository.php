<?php

namespace App\Repositories\Eloquent;

use App\Models\Barber;
use App\Repositories\BarberRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class BarberRepository extends BaseRepository implements BarberRepositoryInterface
{

    /**
     * BarberRepository constructor.
     *
     * @param Barber $model
     */
    public function __construct(Barber $model)
    {
        parent::__construct($model);
    }
}
