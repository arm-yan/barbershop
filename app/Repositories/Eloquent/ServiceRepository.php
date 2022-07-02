<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\ServiceRepositoryInterface;
use Illuminate\Support\Collection;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{

    /**
     * ServiceRepository constructor.
     *
     * @param Service $model
     */
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
