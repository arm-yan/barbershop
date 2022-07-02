<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicesCollectionResource;
use App\Repositories\Eloquent\ServiceRepository;

class ServicesController extends Controller
{
    /**
     * @param ServiceRepository $serviceRepository
     * @return ServicesCollectionResource
     */
    public function index(ServiceRepository $serviceRepository): ServicesCollectionResource
    {
        return new ServicesCollectionResource($serviceRepository->all());
    }
}
