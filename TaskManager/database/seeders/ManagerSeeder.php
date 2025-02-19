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
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'),
        ]);

        $managerRole = Role::where('name', 'Manager')->first();
        $manager->assignRole($managerRole);

        $managerRole->givePermissionTo([
            'update assigned tasks', 'view all tasks'
        ]);
    }
}