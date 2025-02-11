<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);

        $managerRole = Role::where('name', 'Manager')->first();
        $manager->assignRole($managerRole);

        $managerRole->givePermissionTo([
            'create tasks', 'edit tasks', 'assign tasks', 'view all tasks'
        ]);
    }
}