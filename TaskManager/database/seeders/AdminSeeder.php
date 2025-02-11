<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $admin->assignRole($adminRole);

        $adminRole->givePermissionTo([
            'create tasks', 'edit tasks', 'delete tasks', 'assign tasks', 'view all tasks'
        ]);
    }
}
