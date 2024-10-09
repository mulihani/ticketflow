<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //--------------------------------
        // Add an administrator user
        //--------------------------------
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'is_admin' => 1,
            'type' => 'admin',
            'is_active' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //--------------------------------
        // Add a staff user
        //--------------------------------
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Staff',
            'email' => 'staff@staff.com',
            'is_admin' => 0,
            'type' => 'staff',
            'is_active' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //--------------------------------
        // Add a public user
        //--------------------------------
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'User',
            'email' => 'user@user.com',
            'is_admin' => 0,
            'type' => 'user',
            'is_active' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        //--------------------------------
        // Add categories
        //--------------------------------
        DB::table('categories')->insert([
            'name' => 'Printers',
            'description' => 'Issues related to printer problems',
            'active' =>1,
            'position' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => 'Desktop Computer',
            'description' => 'Desktop Computer Malfunctions Issues',
            'active' =>1,
            'position' => 2,
        ]);
        DB::table('categories')->insert([
            'name' => 'Laptop',
            'description' => 'Laptop Malfunction Issues',
            'active' =>1,
            'position' => 3,
        ]);
        DB::table('categories')->insert([
            'name' => 'Network',
            'description' => 'Network Failure Issues',
            'active' =>1,
            'position' => 4,
        ]);
        DB::table('categories')->insert([
            'name' => 'Internet',
            'description' => 'Internet malfunction issues',
            'active' =>1,
            'position' => 5,
        ]);

        //--------------------------------
        // Add sections
        //--------------------------------
        DB::table('sections')->insert([
            'name' => 'Sales',
            'description' => 'Issues related to Sales department',
            'active' =>1,
            'position' => 1,
        ]);
        DB::table('sections')->insert([
            'name' => 'Customer Service',
            'description' => 'Issues related to Customer Service department',
            'active' =>1,
            'position' => 2,
        ]);
        DB::table('sections')->insert([
            'name' => 'Human Resources',
            'description' => 'Issues related to Human Resources prodepartmentblems',
            'active' =>1,
            'position' => 3,
        ]);

        //--------------------------------
        // Add Tickets
        //--------------------------------
        DB::table('tickets')->insert([
            'author_name' => 'Open ticket',
            'author_ip' => '127.0.0.1',
            'author_id' => '12345',
            'author_ext' => '363',
            'user_id' => 3,
            'staff_id' => 2,
            'category_id' =>1,
            'section_id' =>1,
            'content' => 'Additional information about the problem',
            'note' => 'Technician notes about the problem',
            'status' => 'open',
            'created_at' => now(),
        ]);

        DB::table('tickets')->insert([
            'author_name' => 'Processing ticket',
            'author_ip' => '127.0.0.1',
            'author_id' => '67890',
            'author_ext' => '636',
            'user_id' => 3,
            'staff_id' => 2,
            'category_id' =>2,
            'section_id' =>2,
            'content' => 'Additional information about the problem',
            'note' => 'Technician notes about the problem',
            'status' => 'processing',
            'created_at' => now(),
        ]);

        DB::table('tickets')->insert([
            'author_name' => 'Closed ticket',
            'author_ip' => '127.0.0.1',
            'author_id' => '34567',
            'author_ext' => '336',
            'user_id' => 3,
            'staff_id' => 1,
            'category_id' =>3,
            'section_id' =>3,
            'content' => 'Additional information about the problem',
            'note' => 'Technician notes about the problem',
            'status' => 'closed',
            'created_at' => now(),
        ]);

        //-----------------------------
        //Add system setings
        //-----------------------------
        DB::table('settings')->insert([
            'site_name' => 'Ticket Flow',
            'site_email' => 'your@email.com',
            'site_status' => 1,
            'site_close_massage' => 'Closed for maintenance. Please try again later.',
            'it_support_number' => '123',
            'support_info_page' => 'This page should contain information about the technical support team. e.g. team member contact information.',
            'support_info_page_status' => 1,
            'ticket_search_status' => 1,
            'site_activation_hours_massage' => 'The system is currently out of official working hours. Please come back later during business hours.',
            'closed_days' => '[]',
        ]);

    }
}
