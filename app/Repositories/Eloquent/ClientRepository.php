<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{

    /**
     * ClientRepository constructor.
     *
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    public function firstOrCreate(string $email, string $firstName, string $lastName)
    {
        return $this->model->query()->firstOrCreate(['email' => $email], ['first_name' => $firstName, 'last_name' => $lastName]);
    }
}
