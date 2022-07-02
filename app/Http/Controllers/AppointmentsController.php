<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPostRequest;
use App\Repositories\Eloquent\AppointmentRepository;
use App\Repositories\Eloquent\ClientRepository;
use App\Services\BarberService;
use Carbon\Carbon;

class AppointmentsController extends Controller
{

    /**
     * @var BarberService
     */
    private $barberService;

    /**
     * @var AppointmentRepository
     */
    private $appointmentRepository;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @param ClientRepository $clientRepository
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(
        ClientRepository $clientRepository,
        AppointmentRepository $appointmentRepository
    ) {
        /**
         * @var BarberService $barberService
         */
        $barberService = app('barber-service');
        $this->barberService = $barberService;

        $this->appointmentRepository = $appointmentRepository;
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param AppointmentPostRequest $request
     * @return array|string[]
     */
    public function book(AppointmentPostRequest $request): array
    {
        $slot = $request->get('slot');
        $date = $request->get('date');
        $email = $request->get('email');
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $service = $request->get('service');
        $hours = explode('-', $slot);

        $barbers = $this->barberService->getAvailableBarbers($date, $hours[0], $hours[1]);

        if($barbers->count()) {
            $barber_id = $barbers->first()->id;
            $client = $this->clientRepository->firstOrCreate($email, $firstName, $lastName);
            $client_id = $client->id;
            $starts_at = Carbon::create($date.' '.$hours[0]);
            $ends_at = Carbon::create($date.' '.$hours[1]);

            return ['status' => $this->appointmentRepository->create($starts_at, $ends_at, $client_id, $service, $barber_id)];
        }

        return ['status' => 'Not available'];
    }
}
