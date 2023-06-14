<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::insert([
            [
                "title" => "SMK PERTIWI MENGADAKAN MAKRAB",
                'slug' => Str::slug("SMK PERTIWI MENGADAKAN MAKRAB"),
                "image" => "-",
                "body" =>
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae fugiat cumque eligendi quasi officia provident ducimus doloribus totam deleniti sapiente? Quasi quia ratione vel deleniti delectus recusandae. Adipisci, repudiandae cumque.",
                "school_id" => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "title" => "SMKN 2 KUNINGAN MENGADAKAN MAKRAB",
                'slug' => Str::slug("SMKN 2 KUNINGAN MENGADAKAN MAKRAB"),
                "image" => "-",
                "body" =>
                "Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae fugiat cumque eligendi quasi officia provident ducimus doloribus totam deleniti sapiente? Quasi quia ratione vel deleniti delectus recusandae. Adipisci, repudiandae cumque.",
                "school_id" => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
