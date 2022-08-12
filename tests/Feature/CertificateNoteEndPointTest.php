<?php

namespace Tests\Feature;

use App\Models\Certificate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CertificateNoteEndPointTest extends TestCase
{
    public function test_user_gets_a_validation_error_if_limit_is_empty_for_certificate_note_index()
    {   
        $id = Certificate::whereHas('notes')->first()->notes()->first()->id;

        $response = $this->json('GET', '/api/certificate/'. $id . '/note');
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

    public function test_user_gets_a_succesful_message_if_limit_is_add_for_certificate_note_index()
    {
        $id = Certificate::whereHas('notes')->first()->notes()->first()->id;

        $response = $this->json('GET', '/api/certificate/'. $id . '/note',['limit' => 10]);
        $response
            ->assertStatus(200);
    } 

    public function test_user_gets_a_validation_error_if_query_is_empty_for_certificate_note_store()
    {
        $id = Certificate::whereHas('notes')->first()->notes()->first()->id;

        $input = [
            'note' => null
        ];

        $response = $this->json('POST', '/api/certificate/'. $id . '/note', $input);

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

    public function test_user_gets_a_succesful_params_if_query_is_exists_for_certificate_note_store()
    {
        $input = [
            'note' => 'test'
        ];

        $id = Certificate::whereHas('notes')->first()->notes()->first()->id;

        $response = $this->json('POST', '/api/certificate/' . $id . '/note',$input);
        $response
            ->assertStatus(200);
    }
}
