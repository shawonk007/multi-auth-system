<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admins = [
            [ 'name' => 'Shawon Khan', 'email' => 'shawonk007@gmail.com', 'password' => Hash::make('Dhaka1216') ],
            [ 'name' => 'Mohona Akter', 'email' => 'mohona@gmail.com', 'password' => Hash::make('admin') ],
            [ 'name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => Hash::make('secret') ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
