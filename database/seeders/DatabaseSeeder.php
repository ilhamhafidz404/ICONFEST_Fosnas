<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Relation\UserTask;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SchoolSeeder::class,
            ArticleSeeder::class,
            TaskSeeder::class
        ]);
        User::factory()->count(30)->create();

        for ($i = 0; $i < 100; $i++) {
            UserTask::create([
                "task_id" => rand(1, 38),
                "user_id" => rand(1, 37),
            ]);
        };
    }
}
