<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyCertificateEndPointTest extends TestCase
{
    public function test_user_gets_a_validation_error_if_limit_is_empty_for_property_note_index()
    {   
        $id = Property::whereHas('certificate')->first()->certificate()->first()->id;

        $response = $this->json('GET', '/api/property/'. $id . '/certificate');
        $response
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ])
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    "limit" => [
                        "The limit field is required."
                    ],
                ]
            ]);
    }

    public function test_user_gets_a_succesful_message_if_limit_is_add_for_property_note_index()
    {
        $id = Property::whereHas('certificate')->first()->certificate()->first()->id;

        $response = $this->json('GET', '/api/property/'. $id . '/certificate',['limit' => 10]);
        $response
            ->assertStatus(200);
    } 
}
