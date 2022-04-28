<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClinicControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateClinic()
    {
        $response = $this->postJson('/api/clinics', ['name' => 'test']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'stored' => ['name' => 'test']
            ]);
    }

    /*public function testCreateClinicShouldFailNameExists()
    {
        $response = $this->postJson('/api/clinics', ['name' => 'test']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'The name has already been taken.',
            ]);
    }*/

    public function testCreateClinicShouldFailNameEmpty()
    {
        $response = $this->postJson('/api/clinics', ['name' => '']);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The name field is required.',
            ]);
    }

    public function testCreateClinicShouldFailNameTooLong()
    {
        $string = 'ohajtxbeomtdkshyimndfzqmpdggmgwnohubjbfzbzrpwptkddlufiiqutgolygcosuftzqsdgbsnkbhzbomluplbsavmkrkuigdfrewbbumzsnhcsyxxntjoeulgpolnjrcybbcfmbbktoqlluplfcxhmosgchwpcusmlnyqaatektlxnrgmsqhrcwmwzagnlxujhics
';

        $response = $this->postJson('/api/clinics', ['name' => $string]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The name must not be greater than 200 characters.',
            ]);
    }
}
