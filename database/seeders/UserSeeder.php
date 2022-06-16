<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        User::create([
            'name' => 'Dyan Rose Sagun',
            'email' => 'dyansagun@gmail.com',
            'password' => bcrypt('dyan1234')
        ]);
        User::create([
            'name' => 'E-Jhay Bumacod',
            'email' => 'bumacodejhay@gmail.com',
            'password' => bcrypt('ejhay0426')
        ]);
    }
}
