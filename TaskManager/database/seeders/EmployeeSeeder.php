<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // List of employee names
        $employees = ['Ayush', 'Umesh', 'Krishna', 'Amrit'];

        foreach ($employees as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name) . '@gmail.com', // Ensuring lowercase email
                'password' => Hash::make('11111' . $index), // Hashed password for security
            ]);
        }
    }
}
