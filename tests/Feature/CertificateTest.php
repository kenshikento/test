<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CertificateTest extends TestCase
{
    public function test_user_gets_a_validation_error_if_limit_is_empty_for_certificate_index()
    {
        $response = $this->json('GET', '/api/certificate');
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

    public function test_user_gets_a_succesful_message_if_limit_is_add_for_certificate_index()
    {
        $response = $this->json('GET', '/api/certificate',['limit' => 10]);
        $response
            ->assertStatus(200);
    } 

    public function test_user_gets_a_validation_error_if_query_is_wrong_for_certificate_show()
    {
        $response = $this->json('GET', '/api/certificate/null');
        $response
            ->assertStatus(404);
    }

    public function test_user_gets_a_succesful_message_if_query_is_exists_for_certificate_show()
    {
        $response = $this->json('GET', '/api/certificate/1');
        $response
            ->assertStatus(200);
    }

    public function test_user_gets_a_validation_error_if_query_is_exists_for_certificate_store()
    {
        $response = $this->json('POST', '/api/certificate/',[]);
        $response
            ->assertStatus(422)            
            ->assertJsonStructure([
                'message',
                'errors'
            ])
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    "stream_name" => [
                        "The stream name field is required."
                    ],
                    "property_id" => [
                        "The property id field is required."
                    ],
                    "issue_date" => [
                        "The issue date field is required."
                    ],
                    "next_due_date" => [
                        "The next due date field is required."
                    ],                                                            
                ]
            ]);
    }

    public function test_user_gets_a_succesful_params_is_exists_for_certificate_store()
    {
        $input = [
            'stream_name' => 'test',
            'property_id' => 1,
            'issue_date' => now(),
            'next_due_date' => now()
        ];

        $response = $this->json('POST', '/api/certificate/',$input);
        $response
            ->assertStatus(200);
    }
}
