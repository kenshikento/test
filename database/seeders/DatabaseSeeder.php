<?php

namespace Database\Seeders;

use Database\Seeders\CertificateSeeder;
use Database\Seeders\NoteSeeder;
use Database\Seeders\PropertySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // 
        $this->call(
        [
            PropertySeeder::class,
            CertificateSeeder::class,
            NoteSeeder::class
        ]);
    }
}
