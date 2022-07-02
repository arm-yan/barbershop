<?php

namespace App\Providers;

use App\Repositories\Eloquent\AppointmentRepository;
use App\Repositories\Eloquent\BarberRepository;
use App\Repositories\Eloquent\ClientRepository;
use App\Repositories\Eloquent\HolidayRepository;
use App\Repositories\Eloquent\ScheduleRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Services\AppointmentService;
use App\Services\BarberService;
use App\Services\ScheduleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScheduleService::class, function ($app) {
            return new ScheduleService(
                $app->make(ScheduleRepository::class),
                $app->make(ServiceRepository::class)
            );
        });

        $this->app->alias(ScheduleService::class, 'schedule-service');

        $this->app->bind(BarberService::class, function ($app) {
            return new BarberService(
                $app->make(BarberRepository::class),
                $app->make(HolidayRepository::class)
            );
        });

        $this->app->alias(BarberService::class, 'barber-service');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
