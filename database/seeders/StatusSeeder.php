<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'Pending']);
        Status::create(['name' => 'Claimable']);
        Status::create(['name' => 'Released']);
        Status::create(['name' => 'Expired']);
    }
}
