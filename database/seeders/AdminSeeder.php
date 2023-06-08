<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@rentease.com',
            'password' => 'password',
        ]);
        $admin->assignRole('super_admin');

    }
}
