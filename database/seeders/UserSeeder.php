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
        User::insert([
            [
                "name" => "Ilham",
                "password" => "ilhamkun",
                "school_id" => 1,
                "email" => "ilhammhafidzz@gmail.com"
            ],
            [
                "name" => "Ira",
                "password" => "irachan",
                "school_id" => 3,
                "email" => "irairwanti@gmail.com"
            ],
            [
                "name" => "Hafidz",
                "password" => "hafidzsan",
                "school_id" => 4,
                "email" => "imamhafidz@gmail.com"
            ],
            [
                "name" => "Septi",
                "password" => "sepiputra",
                "school_id" => 1,
                "email" => "sepiomel@gmail.com"
            ],
        ]);
    }
}
