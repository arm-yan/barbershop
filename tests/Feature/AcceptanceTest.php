<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AcceptanceTest extends TestCase
{
    public function testServicesList()
    {
        $response = $this->get('/api/services');
        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonPath('0.title', 'Men Haircut')
            ->assertJsonPath('1.title', 'Woman Haircut');
    }

    public function testHolidaysList()
    {
        $response = $this->get('/api/holidays');
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonPath('0.title', 'Public holiday')
            ->assertJsonPath('0.date', '2022-07-05');
    }

    public function testScheduleListWithoutRequiredParameters()
    {
        $response = $this->get('/api/schedule');
        $response->assertStatus(422);
    }

    public function testScheduleListWithRequiredParameters()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->get('/api/schedule?date='.$date->toDateString().'&service=1');
        $response->assertStatus(200);
    }

    public function testBookAppointmentWithoutRequiredParameterDate()
    {
        $response = $this->post('/api/appointment', [
            'slot' => '11:00-11:40',
            'email' => 'test@barbershop.com',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['date' => ['The date field is required.']]);
    }

    public function testBookAppointmentWithoutRequiredParameterSlot()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'email' => 'test@barbershop.com',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['slot' => ['The slot field is required.']]);
    }

    public function testBookAppointmentWithoutRequiredParameterEmail()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['email' => ['The email field is required.']]);
    }

    public function testBookAppointmentWithWrongRequiredParameterEmail()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'email' => 'non_correct_email',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['email' => ['The email must be a valid email address.']]);
    }

    public function testBookAppointmentWithoutRequiredParameterFirstName()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'email' => 'test@barbershop.com',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['first_name' => ['The first name field is required.']]);
    }

    public function testBookAppointmentWithoutRequiredParameterLastName()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'email' => 'test@barbershop.com',
            'first_name' => 'John',
            'service' => 1
            ]);

        $response->assertStatus(422)->assertSimilarJson(['last_name' => ['The last name field is required.']]);
    }

    public function testBookAppointmentWithoutRequiredParameterService()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'email' => 'test@barbershop.com',
            'first_name' => 'John',
            'last_name' => 'Smith'
            ]);

        $response->assertStatus(422)->assertSimilarJson(['service' => ['The service field is required.']]);
    }

    public function testBookAppointmentWithRequiredParameter()
    {
        $date = (new Carbon())->nextWeekday();

        $response = $this->post('/api/appointment', [
            'date' => $date->toDateString(),
            'slot' => '11:00-11:40',
            'email' => 'test@barbershop.com',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'service' => 1
            ]);

        $response->assertStatus(200)->assertSimilarJson(['status' => true]);
    }


}
