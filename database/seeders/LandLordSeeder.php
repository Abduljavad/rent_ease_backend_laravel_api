<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandLordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $landLoard = User::create([
            'name' => 'SuperAdmin',
            'email' => 'landlord@rentease.com',
            'password' => 'password',
        ]);
        $landLoard->assignRole('land_lord');
    }
}
