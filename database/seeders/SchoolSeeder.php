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
                "name" => "FOSNAS ADMIN",
                "images" => "-",
                "address" => "-",
                "map" => "-",
                "description" => "-",
            ],
            [
                "name" => "SMK PERTIWI KUNINGAN",
                "images" => "-",
                "address" => "Jl. Siliwangi No.26A, Kasturi, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45521",
                "map" => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126721.3757082339!2d108.37095760728283!3d-7.0042206185777305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f169b24ddd6fb%3A0x2bb329e91548bf39!2sSMK%20Pertiwi%20Kuningan!5e0!3m2!1sid!2sid!4v1687268179842!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                "description" => "SMK Pertiwi Kuningan merupakan STM pertama yang berdiri di Kabupaten Kuningan sejak tahun 1979 Dengan luas tanah ± 20.000 m² . Telah meluluskan lebih dari 11.000 orang lulusan yang telah bekerja di dunia industri maupun di instansi pemerintah/swasta, Kuliah di perguruan tinggi Negeri dan Swasta  dan membuka wirausaha, karena dididik untuk mempunyai keahlian disertai disiplin, mandiri, kompetitif dan siap kerja.",
            ],
            // [
            //     "name" => "SMKN 1 KUNINGAN",
            //     "images" => "-",
            //     "address" => "-",
            //     "map" => "-",
            //     "description" => "-",
            // ],
            [
                "name" => "SMKN 2 KUNINGAN",
                "images" => "-",
                "address" => "Jl. Cigugur Sukamulya No.77, Sukamulya, Kec. Cigugur, Kabupaten Kuningan, Jawa Barat 45552",
                "map" => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.248185958397!2d108.4586884751358!3d-6.9800142930207905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f15d835804117%3A0xe06ca6e3e0f233dc!2sSMK%20Negeri%202%20Kuningan!5e0!3m2!1sid!2sid!4v1687268216935!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                "description" => "SMK Negeri 2 Kuningan merupakan salah satu Sekolah Menengah Kejuruan Negeri yang berlokasi di Provinsi Jawa Barat, Indonesia. Sama dengan SMK pada umumnya di Indonesia, masa pendidikan sekolah di SMKN 2 Kuningan ditempuh dalam waktu tiga tahun pelajaran, mulai dari Kelas X sampai Kelas XII.",
            ],
            // [
            //     "name" => "SMKN 3 KUNINGAN",
            //     "images" => "-",
            //     "address" => "-",
            //     "map" => "-",
            //     "description" => "-",
            // ],
        ]);
    }
}
