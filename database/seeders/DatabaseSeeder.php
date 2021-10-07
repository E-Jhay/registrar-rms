<?php

namespace Database\Seeders;

use App\Models\DocumentType;
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
        $this->call(DocumentTypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
