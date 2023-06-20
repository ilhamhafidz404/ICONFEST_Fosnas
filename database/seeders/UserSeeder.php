<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // super admin
        User::create([
            "name" => "admin",
            "profile" => "avatar-1.png",
            "password" => bcrypt("admin"),
            "school_id" => 1,
            "email" => "admin@gmail.com"
        ])->assignRole('super admin');

        // admin sekolah
        User::create([
            "name" => "admin pertiwi",
            "profile" => "avatar-2.png",
            "password" => bcrypt("adminpertiwi"),
            "school_id" => 2,
            "email" => "adminpertiwi@gmail.com"
        ])->assignRole('admin sekolah');

        User::create([
            "name" => "admin scada",
            "profile" => "avatar-3.png",
            "password" => bcrypt("adminscada"),
            "school_id" => 3,
            "email" => "adminscada@gmail.com"
        ])->assignRole('admin sekolah');

        // pengurus osis
        User::create([
            "name" => "pengurus pertiwi",
            "profile" => "avatar-4.png",
            "password" => bcrypt("penguruspertiwi"),
            "school_id" => 2,
            "email" => "penguruspertiwi@gmail.com"
        ])->assignRole('pengurus osis');

        User::create([
            "name" => "pengurus scada",
            "profile" => "avatar-5.png",
            "password" => bcrypt("pengurusscada"),
            "school_id" => 3,
            "email" => "pengurusscada@gmail.com"
        ])->assignRole('pengurus osis');

        // anggota
        User::create([
            "name" => "Ilham",
            "profile" => "avatar-1.png",
            "password" => bcrypt("ilham123"),
            "school_id" => 2,
            "email" => "ilhammhafidzz@gmail.com"
        ])->assignRole('anggota');

        User::create([
            "name" => "Ira",
            "profile" => "avatar-2.png",
            "password" => bcrypt("ira123"),
            "school_id" => 3,
            "email" => "irairwanti@gmail.com"
        ])->assignRole('anggota');
    }
}
