<?php

namespace App\Services;

use App\Repositories\Eloquent\BarberRepository;
use App\Repositories\Eloquent\HolidayRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BarberService
{
    /**
     * @var BarberRepository
     */
    private $barberRepository;

    /**
     * @var HolidayRepository
     */
    private $holidayRepository;

    /**
     * @param BarberRepository $barberRepository
     * @param HolidayRepository $holidayRepository
     */
    public function __construct(
        BarberRepository $barberRepository,
        HolidayRepository $holidayRepository
    ) {
        $this->barberRepository = $barberRepository;
        $this->holidayRepository = $holidayRepository;
    }

    /**
     * @param string $date
     * @param string $start
     * @param string $end
     * @return Collection
     */
    public function getAvailableBarbers(string $date, string $start, string $end): Collection
    {
        $barbers = $this->barberRepository->all();
        $checkDate = Carbon::create($date);
        $checkStartDateTime = Carbon::create($date.' '.$start);
        $checkEndDateTime = Carbon::create($date.' '.$end);
        $is_holiday = $this->holidayRepository->exists($checkDate->format('Y-m-d'));

        foreach ($barbers as $key=>$barber) {
            $weekDay = strtolower($checkDate->format('l'));

            if(!$barber->schedule->$weekDay) {
                $barbers->forget($key);
                continue;
            }

            $workingHours = explode('-', $barber->schedule->$weekDay);

            $startWorkingHour = Carbon::create($workingHours[0]);
            $endWorkingHour = Carbon::create($workingHours[1]);
            $checkStartTime = Carbon::create($start);
            $checkEndTime = Carbon::create($end);

            if(!$checkStartTime->betweenIncluded($startWorkingHour, $endWorkingHour)) {
                $barbers->forget($key);
                continue;
            }

            if(!$checkEndTime->betweenIncluded($startWorkingHour, $endWorkingHour)) {
                $barbers->forget($key);
                continue;
            }

            if(!$barber->works_on_holidays && $is_holiday) {
                $barbers->forget($key);
                continue;
            }

            $breaks = $barber->breaks;
            foreach ($breaks as $break) {
                $startDate = Carbon::create($break->starts_at);
                $endDate = Carbon::create($break->ends_at);
                if($checkStartDateTime->betweenExcluded($startDate, $endDate)) {
                    $barbers->forget($key);
                    continue(2);
                }

                if($checkEndDateTime->betweenExcluded($startDate, $endDate)) {
                    $barbers->forget($key);
                    continue(2);
                }
            }

            if($appointments = $barber->appointments) {
                foreach ($appointments as $appointment) {
                    $startDate = Carbon::create($appointment->starts_at);
                    $endDate = Carbon::create($appointment->ends_at);

                    if($checkStartDateTime->betweenIncluded($startDate, $endDate)) {
                        $barbers->forget($key);
                        continue(2);
                    }

                    if($checkEndDateTime->betweenIncluded($startDate, $endDate)) {
                        $barbers->forget($key);
                        continue(2);
                    }
                }
            }
        }

        return $barbers;
    }
}
