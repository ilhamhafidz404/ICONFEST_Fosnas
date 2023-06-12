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
            "password" => bcrypt("admin"),
            "school_id" => 1,
            "email" => "admin@gmail.com"
        ])->assignRole('super admin');

        // admin sekolah
        User::create([
            "name" => "admin pertiwi",
            "password" => bcrypt("adminpertiwi"),
            "school_id" => 2,
            "email" => "adminpertiwi@gmail.com"
        ])->assignRole('admin sekolah');

        User::create([
            "name" => "admin scada",
            "password" => bcrypt("adminscada"),
            "school_id" => 4,
            "email" => "adminscada@gmail.com"
        ])->assignRole('admin sekolah');

        // pengurus osis
        User::create([
            "name" => "pengurus pertiwi",
            "password" => bcrypt("penguruspertiwi"),
            "school_id" => 2,
            "email" => "penguruspertiwi@gmail.com"
        ])->assignRole('pengurus osis');

        User::create([
            "name" => "pengurus scada",
            "password" => bcrypt("pengurusscada"),
            "school_id" => 4,
            "email" => "pengurusscada@gmail.com"
        ])->assignRole('pengurus osis');

        // anggota
        User::create([
            "name" => "Ilham",
            "password" => bcrypt("ilham123"),
            "school_id" => 2,
            "email" => "ilhammhafidzz@gmail.com"
        ])->assignRole('anggota');

        User::create([
            "name" => "Ira",
            "password" => bcrypt("ira123"),
            "school_id" => 4,
            "email" => "irairwanti@gmail.com"
        ])->assignRole('anggota');

        User::create([
            "name" => "Hafidz",
            "password" => bcrypt("apid123"),
            "school_id" => 3,
            "email" => "imamhafidz@gmail.com"
        ])->assignRole('anggota');

        User::create([
            "name" => "Septi",
            "password" => bcrypt("septi123"),
            "school_id" => 2,
            "email" => "sepiomel@gmail.com"
        ])->assignRole('anggota');
    }
}
