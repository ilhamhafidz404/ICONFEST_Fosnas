<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::insert([
            [

                "name" => "SMK PERTIWI KUNINGAN",
                "images" => "-",
                "address" => "-",
                "map" => "-",
                "description" => "-",
            ],
            [
                "name" => "SMKN 1 KUNINGAN",
                "images" => "-",
                "address" => "-",
                "map" => "-",
                "description" => "-",
            ],
            [
                "name" => "SMKN 2 KUNINGAN",
                "images" => "-",
                "address" => "-",
                "map" => "-",
                "description" => "-",
            ],
            [
                "name" => "SMKN 3 KUNINGAN",
                "images" => "-",
                "address" => "-",
                "map" => "-",
                "description" => "-",
            ],

        ]);
    }
}
