<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyNoteEndPointTest extends TestCase
{
    public function test_user_gets_a_validation_error_if_limit_is_empty_for_property_note_index()
    {   
        $id = Property::whereHas('notes')->first()->id;

        $response = $this->json('GET', '/api/property/'. $id . '/note');
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
        $id = Property::whereHas('notes')->first()->id;

        $response = $this->json('GET', '/api/property/'. $id . '/note',['limit' => 10]);
        $response
            ->assertStatus(200);
    } 

    public function test_user_gets_a_validation_error_if_query_is_empty_for_property_note_store()
    {
        $id = Property::whereHas('notes')->first()->id;

        $input = [
            'note' => null
        ];

        $response = $this->json('POST', '/api/property/'. $id . '/note', $input);

        $response
            ->assertStatus(422)            
            ->assertJsonStructure([
                'message',
                'errors'
            ])
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    "note" => [
                        "The note field is required."
                    ],                        
                ]
            ]);
    }

    public function test_user_gets_a_succesful_params_if_query_is_exists_for_property_note_store()
    {
        $input = [
            'note' => 'test'
        ];

        $id = Property::whereHas('notes')->first()->id;

        $response = $this->json('POST', '/api/property/' . $id . '/note',$input);
        $response
            ->assertStatus(200);
    }
}
