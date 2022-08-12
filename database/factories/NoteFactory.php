<?php

namespace Database\Factories;

use App\Models\Certificate;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $random = collect(['App\Models\Property', 'App\Models\Certificate'])->random(1)->first();
        $model = $random::inRandomOrder()->first();
        $id = $model->id;

        if($random === 'App\Models\Certificate') {
            $type = $random::CERTIFICATE;
        }

        if($random === 'App\Models\Property') {
            $type = $random::PROPERTY;
        }

        return [
            'model_type' => $type,
            'model_id' => $id,
            'note' => $this->faker->sentence()
        ];
    }
}
