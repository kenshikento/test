<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyApiEndPointTest extends TestCase
{
    public function test_user_gets_a_validation_error_if_limit_is_empty_for_property_index()
    {
        $response = $this->json('GET', '/api/property');
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

    public function test_user_gets_a_succesful_message_if_limit_is_add_for_property_index()
    {
        $response = $this->json('GET', '/api/property',['limit' => 10]);
        $response
            ->assertStatus(200);
    } 

    public function test_user_gets_a_validation_error_if_query_is_wrong_for_property_show()
    {
        $response = $this->json('GET', '/api/property/null');
        $response
            ->assertStatus(404);
    }

    public function test_user_gets_a_succesful_message_if_query_is_exists_for_property_show()
    {
        $response = $this->json('GET', '/api/property/2');
        $response
            ->assertStatus(200);
    }

    public function test_user_gets_a_validation_error_if_query_is_empty_for_property_store()
    {
        $response = $this->json('POST', '/api/property/',[]);
        $response
            ->assertStatus(422)            
            ->assertJsonStructure([
                'message',
                'errors'
            ])
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    "organisation" => [
                        "The organisation field is required."
                    ],
                    "property_type" => [
                        "The property type field is required."
                    ],
                    "parent_property_id" => [
                        "The parent property id field is required."
                    ],
                    "uprn" => [
                        "The uprn field is required."
                    ],
                    "address" => [
                        "The address field is required."
                    ],
                    "town" => [
                        "The town field is required."
                    ],    
                    "postcode" => [
                        "The postcode field is required."
                    ],    
                    "live" => [
                        "The live field is required."
                    ],                        
                ]
            ]);
    }

    public function test_user_gets_a_succesful_params_if_query_is_exists_for_property_store()
    {
        $input = [
            'organisation' => 'test',
            'property_type' => 'Resident',
            'parent_property_id' => 1,
            'uprn' => '12345',
            'address' => 'test homes',
            'town' => 'london',
            'postcode' => 'e1 e54',
            'live' => 1
        ];

        $response = $this->json('POST', '/api/property/',$input);
        $response
            ->assertStatus(200);
    }

    public function test_user_gets_a_validation_error_is_empty_for_property_update()
    {   
        $input = [
            '_method' => 'PATCH',
            'parent_property_id' => 500
        ]; 

        $response = $this->json('POST', '/api/property/2', $input);
        $response
            ->assertStatus(422);
    }

    public function test_user_gets_a_succesful_params_is_exists_for_property_update()
    {
        $input = [
            '_method' => 'PATCH',
            'parent_property_id' => 3,
        ];

        $response = $this->json('POST', '/api/property/2',$input);
        $response
            ->assertStatus(200);
    }

    public function test_user_gets_a_succesful_property_delete()
    {
        $id = Property::all()->last()->id;

        $response = $this->json('delete', '/api/property/'. $id);
        $response
            ->assertStatus(200);
    }    

    public function test_user_gets_a_missing_property_delete()
    {
        $id = 1000;

        $response = $this->json('delete', '/api/property/'. $id);
        $response
            ->assertStatus(404);
    }         
}
