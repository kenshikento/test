<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organisation' => $this->faker->company(),
            'property_type' => $this->faker->randomElement(Property::PROPERTYTYPE),
            'parent_property_id' => null,
            'uprn' => $this->faker->text(10),
            'address' => $this->faker->address(),
            'town' => $this->faker->name(),
            'postcode' => $this->faker->postcode(),
            'live' => $this->faker->boolean(),
        ];
    }
}
