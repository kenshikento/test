<?php

namespace Database\Factories;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stream_name' => $this->faker->name(),
            'property_id' => $this->faker->numberBetween(1, Property::count()),
            'issue_date'  => Carbon::now(),
            'next_due_date' =>  now(),
        ];
    }
}
