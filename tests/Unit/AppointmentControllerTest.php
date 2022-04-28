<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateAppointment()
    {
        $response = $this->postJson('/api/clinics', ['name' => 'test']);

        $response->assertStatus(201)->assertJson(
            [
                'stored' => ['id' => 1]
            ]
        );

        $duration = 1;
        $start = (new \DateTime('now'));
        $end = (new \DateTime('now'))->add(new \DateInterval('PT' . $duration . 'H'));

        $response = $this->postJson('/api/appointments',
            [
                'name' => 'test',
                'clinic_id' => $response->decodeResponseJson()['stored']['id'],
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
                'duration' => $duration
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'stored' => ['name' => 'test', 'id' => 1]
            ]);
    }

    public function testCreateAppointmentShouldFailWhenOverlap() {
        $response = $this->postJson('/api/clinics', ['name' => 'test']);

        $response->assertStatus(201)->assertJson(
            [
                'stored' => ['id' => 2]
            ]
        );

        $duration = 1;
        $start = (new \DateTime('now'));
        $end = (new \DateTime('now'))->add(new \DateInterval('PT' . $duration . 'H'));

        $response = $this->postJson('/api/appointments',
            [
                'name' => 'test',
                'clinic_id' => $response->decodeResponseJson()['stored']['id'],
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
                'duration' => $duration
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'stored' => ['name' => 'test', 'id' => 2]
            ]);

        $response = $this->postJson('/api/appointments',
            [
                'name' => 'test',
                'clinic_id' => $response->decodeResponseJson()['stored']['id'],
                'start' => $start->format('Y-m-d H:i:s'),
                'end' => $end->format('Y-m-d H:i:s'),
                'duration' => $duration
            ]
        );

        $response
            ->assertStatus(409)
            ->assertJson(
                ['error' => 'Failed to create appointment. Time overlaps.']
            );
    }
}
