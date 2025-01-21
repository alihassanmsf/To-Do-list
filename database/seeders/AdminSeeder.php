<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create the Admin role
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');

        if (!$adminRoleId) {
            $adminRoleId = DB::table('roles')->insertGetId([
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create the Admin user
        DB::table('users')->insert([
            'name' => 'Ali',
            'email' => 'admin_ToDo2026@gmail.com',
            'password' => Hash::make('Admin'), // Use a secure password
            'role_id' => $adminRoleId, // Assuming the users table has a role_id column
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
