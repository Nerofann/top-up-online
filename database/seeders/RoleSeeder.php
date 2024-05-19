<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert(
            [
                'desc' => "Administrator",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'desc' => "User",
                'created_at' => date("Y-m-d H:i:s")
            ]
        );
    }
}
