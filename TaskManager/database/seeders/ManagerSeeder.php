<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Iush',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'),
             'role' => 'manager'
        ]);
    }
}
