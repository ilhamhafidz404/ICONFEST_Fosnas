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
        Role::insert([
            [
                "guard_name" => "web",
                "name" => "super admin"
            ],
            [
                "guard_name" => "web",
                "name" => "admin sekolah"
            ],
            [
                "guard_name" => "web",
                "name" => "pengurus osis"
            ],
            [
                "guard_name" => "web",
                "name" => "anggota"
            ],
        ]);
    }
}
