<?php

namespace App\Repositories\Eloquent;

use App\Models\WBreak;
use App\Repositories\BreakRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class BreakRepository extends BaseRepository implements BreakRepositoryInterface
{

    /**
     * BreakRepository constructor.
     *
     * @param WBreak $model
     */
    public function __construct(WBreak $model)
    {
        parent::__construct($model);
    }
}
