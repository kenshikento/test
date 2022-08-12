<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Property;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Certificate::factory()->count(5)->create(['property_id' => Property::all()->first()->id]);
        Certificate::factory()->count(5)->create(['property_id' => Property::inRandomOrder()->first()->id]);
        Certificate::factory()->count(20)->create();
    }
}
