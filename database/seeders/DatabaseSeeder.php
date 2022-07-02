<?php

namespace Database\Seeders;

use App\Models\Barber;
use App\Models\Holiday;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\WBreak;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the services.
     *
     * @return void
     */
    public function seedServices()
    {
        Service::create([
            'id'               => 1,
            'title'            => 'Men Haircut',
            'duration_minutes' => 10,
            'clean_up_minutes' => 5,
        ]);

        Service::create([
            'id'               => 2,
            'title'            => 'Woman Haircut',
            'duration_minutes' => 60,
            'clean_up_minutes' => 10,
        ]);
    }

    /**
     * Seed the breaks.
     *
     * @return void
     */
    public function seedBreaks()
    {
        WBreak::create([
            'id'        => 1,
            'title'     => 'Lunch break',
            'starts_at' => '12:00',
            'ends_at'   => '13:00',
        ]);

        WBreak::create([
            'id'        => 2,
            'title'     => 'Cleaning break',
            'starts_at' => '15:00',
            'ends_at'   => '16:00',
        ]);
    }

    /**
     * Seed the schedule.
     *
     * @return void
     */
    public function seedSchedule()
    {
        Schedule::create([
            'id'        => 1,
            'monday'    => '08:00-20:00',
            'tuesday'   => '08:00-20:00',
            'wednesday' => '08:00-20:00',
            'thursday'  => '08:00-20:00',
            'friday'    => '08:00-20:00',
            'saturday'  => '10:00-22:00',
            'sunday'    => null,
        ]);

        Schedule::create([
            'id'        => 2,
            'monday'    => '08:00-20:00',
            'tuesday'   => '08:00-20:00',
            'wednesday' => '08:00-20:00',
            'thursday'  => '08:00-20:00',
            'friday'    => '08:00-20:00',
            'saturday'  => '10:00-22:00',
            'sunday'    => null,
        ]);

        Schedule::create([
            'id'        => 3,
            'monday'    => '08:00-20:00',
            'tuesday'   => '08:00-20:00',
            'wednesday' => '08:00-20:00',
            'thursday'  => '08:00-20:00',
            'friday'    => '08:00-20:00',
            'saturday'  => '10:00-22:00',
            'sunday'    => null,
        ]);
    }

    /**
     * Seed the barbers.
     *
     * @return void
     */
    public function seedBarbers()
    {
        $barber1 = Barber::create([
            'id'                => 1,
            'name'              => 'Barber 1',
            'works_on_holidays' => false,
            'schedule_id'       => 1,
        ]);

        $barber2 = Barber::create([
            'id'                => 2,
            'name'              => 'Barber 2',
            'works_on_holidays' => false,
            'schedule_id'       => 1,
        ]);

        $barber3 = Barber::create([
            'id'                => 3,
            'name'              => 'Barber 3',
            'works_on_holidays' => false,
            'schedule_id'       => 1,
        ]);

        $barber1->services()->sync([1,2]);
        $barber2->services()->sync([1,2]);
        $barber3->services()->sync([1,2]);

        $barber1->breaks()->sync([1,2]);
        $barber2->breaks()->sync([1,2]);
        $barber3->breaks()->sync([1,2]);
    }

    /**
     * Seed the holidays.
     *
     * @return void
     */
    public function seedHolidays()
    {
        $date = (new Carbon())->addDays(3);

        Holiday::create([
            'id'    => 1,
            'title' => 'Public holiday',
            'date'  => $date->toDate()
        ]);
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function($table) {
            $this->seedServices();
            $this->seedBreaks();
            $this->seedSchedule();
            $this->seedBarbers();
            $this->seedHolidays();
        });
    }
}
