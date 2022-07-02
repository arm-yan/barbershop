<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableSlotsRequest;
use App\Repositories\Eloquent\ScheduleRepository;
use App\Services\BarberService;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleService
     */
    private $scheduleService;

    /**
     * @var BarberService
     */
    private $barberService;

    public function __construct()
    {
        /**
         * @var ScheduleService $scheduleService
         */
        $scheduleService = app('schedule-service');
        $this->scheduleService = $scheduleService;

        /**
         * @var BarberService $barberService
         */
        $barberService = app('barber-service');
        $this->barberService = $barberService;

    }

    /**
     * @param AvailableSlotsRequest $request
     * @param ScheduleRepository $scheduleRepository
     * @return array
     */
    public function availableSlots(AvailableSlotsRequest $request, ScheduleRepository $scheduleRepository): array
    {
        $date = $request->get('date');
        $service = $request->get('service');

        $slots = $this->scheduleService->getServiceSlots($date, $service);

        foreach ($slots as $range=>$slot) {
            $hours = explode('-', $range);

            $count = $this->barberService->getAvailableBarbers($date, $hours[0], $hours[1])->count();
            $slots[$range] = $count;
        }

        return $slots;
    }
}
