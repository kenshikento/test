<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Note;
use App\Models\Property;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = Property::inRandomOrder()->first();
        $propertyId = $property->id;

        Note::factory()->count(5)->create(['model_id' => $propertyId, 'model_type' => Property::PROPERTY]);

        $certificate = Certificate::inRandomOrder()->first();
        $ceritifcateId = $certificate->id;

        Note::factory()->count(5)->create(['model_id' => $ceritifcateId, 'model_type' => Certificate::CERTIFICATE]);

        Note::factory()->count(10)->create();        
    }
}
