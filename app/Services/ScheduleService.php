<?php

namespace App\Services;

use App\Repositories\Eloquent\ScheduleRepository;
use App\Repositories\Eloquent\ServiceRepository;
use Carbon\Carbon;

class ScheduleService
{
    /**
     * @var ScheduleRepository
     */
    private $scheduleRepository;

    /**
     * @var ServiceRepository
     */
    private $servicesRepository;

    /**
     * @param ScheduleRepository $scheduleRepository
     * @param ServiceRepository $servicesRepository
     */
    public function __construct(
        ScheduleRepository $scheduleRepository,
        ServiceRepository $servicesRepository
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->servicesRepository = $servicesRepository;
    }

    /**
     * @param string $date
     * @param int $serviceId
     * @return array
     */
    public function getServiceSlots(string $date, int $serviceId): array
    {
        $slots = [];
        $date = Carbon::parse($date);
        $weekDay = strtolower($date->format('l'));

        $service = $this->servicesRepository->find($serviceId);
        $serviceDuration = $service->duration_minutes;
        $serviceCleaning = $service->clean_up_minutes;

        $schedule = $this->scheduleRepository->getByWeekDay($weekDay);
        foreach ($schedule as $item) {
            if(!$item->$weekDay) {
                continue;
            }

            $hours = explode('-', $item->$weekDay);
            $slotHour = Carbon::create($hours[0]);
            $endTime = Carbon::create($hours[1]);
            while($endTime->gt($slotHour)) {
                $slot = $slotHour->format('H:i');
                $slotHour->addMinutes($serviceDuration);
                $slot .= '-'.$slotHour->format('H:i');

                $slots[$slot] = 'available';
                $slotHour->addMinutes($serviceCleaning);
            }
        }

        return $slots;
    }
}
