<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
}
