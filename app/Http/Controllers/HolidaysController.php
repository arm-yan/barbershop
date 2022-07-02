<?php

namespace App\Http\Controllers;

use App\Http\Resources\HolidayCollectionResource;
use App\Repositories\Eloquent\HolidayRepository;

class HolidaysController extends Controller
{
    /**
     * @param HolidayRepository $holidayRepository
     * @return HolidayCollectionResource
     */
    public function index(HolidayRepository $holidayRepository): HolidayCollectionResource
    {
        return new HolidayCollectionResource($holidayRepository->all());
    }
}
