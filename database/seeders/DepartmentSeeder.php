<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'AGRI']);
        Department::create(['name' => 'BEED']);
        Department::create(['name' => 'BSBA']);
        Department::create(['name' => 'BSE']);
        Department::create(['name' => 'BSHM']);
        Department::create(['name' => 'BSIT']);
    }
}
