<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::insert([
            [
                "name" => "Casperday",
                "description" => "Ulang tahun SMK PERTIWI KUNINGAN",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-01-20 13:31:08",
                "updated_at" => "2023-01-20 13:31:08"
            ],
            [
                "name" => "Scada Day",
                "description" => "Ulang tahun SMKN 2 Kuningan",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-01-20 13:31:08",
                "updated_at" => "2023-01-20 13:31:08"
            ],
            [
                "name" => "Membentuk ekstrakurikuler keagamaan",
                "description" => "Membentuk ekstrakurikuler keagamaan",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Acara peringatan hari raya Idul Fitri",
                "description" => "Perayaan Hari Raya Idul Fitri",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Penggalangan Dana",
                "description" => "Penggalangan Dana Bantu Korban Banjir",
                "status" => "cancel",
                "school_id" => 2,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Bakti Sosial",
                "description" => "Bakti Sosial bantu bersihkan lingkungan",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Razia Rutin",
                "description" => "Razia siswa SMK Pertiwi Kuningan menuju siswa disiplin",
                "status" => "cancel",
                "school_id" => 2,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Sosialisasi Budi Pekerti",
                "description" => "-",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Upacara Rutin",
                "description" => "-",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Perawatan Bendera Merah Putih",
                "description" => "-",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Lomba Acara Agustusan",
                "description" => "Memeriahkan hari kemerdekaan indonesia",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Pentas Seni Siswa",
                "description" => "-",
                "status" => "cancel",
                "school_id" => 2,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Kerja Bakti Berkala",
                "description" => "Kerja bakti secara berkala untuk membersihkan lingkungan sekolah",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Budaya Perpustakaan",
                "description" => "Menjadikan perpustakaan tempat belajar",
                "status" => "cancel",
                "school_id" => 2,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Casper Berolahraga",
                "description" => "-",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Lomba Sparing Antar Kelas",
                "description" => "-",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Bimtal",
                "description" => "Bimbingan Mental",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Casper Membaca",
                "description" => "-",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Lomba Mengaji",
                "description" => "-",
                "status" => "progress",
                "school_id" => 2,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Membuat Kelompok Belajar",
                "description" => "-",
                "status" => "success",
                "school_id" => 2,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Membentuk ekstrakurikuler keagamaan",
                "description" => "Membentuk ekstrakurikuler keagamaan",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Acara peringatan hari raya Idul Fitri",
                "description" => "Perayaan Hari Raya Idul Fitri",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Penggalangan Dana",
                "description" => "Penggalangan Dana Bantu Korban Banjir",
                "status" => "cancel",
                "school_id" => 3,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Bakti Sosial",
                "description" => "Bakti Sosial bantu bersihkan lingkungan",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-02-20 13:31:08",
                "updated_at" => "2023-02-20 13:31:08"
            ],
            [
                "name" => "Razia Rutin",
                "description" => "Razia siswa SMK Pertiwi Kuningan menuju siswa disiplin",
                "status" => "cancel",
                "school_id" => 3,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Sosialisasi Budi Pekerti",
                "description" => "-",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Upacara Rutin",
                "description" => "-",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-03-20 13:31:08",
                "updated_at" => "2023-03-20 13:31:08"
            ],
            [
                "name" => "Perawatan Bendera Merah Putih",
                "description" => "-",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Lomba Acara Agustusan",
                "description" => "Memeriahkan hari kemerdekaan indonesia",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Pentas Seni Siswa",
                "description" => "-",
                "status" => "cancel",
                "school_id" => 3,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Kerja Bakti Berkala",
                "description" => "Kerja bakti secara berkala untuk membersihkan lingkungan sekolah",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-04-20 13:31:08",
                "updated_at" => "2023-04-20 13:31:08"
            ],
            [
                "name" => "Budaya Perpustakaan",
                "description" => "Menjadikan perpustakaan tempat belajar",
                "status" => "cancel",
                "school_id" => 3,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Casper Berolahraga",
                "description" => "-",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Lomba Sparing Antar Kelas",
                "description" => "-",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-05-20 13:31:08",
                "updated_at" => "2023-05-20 13:31:08"
            ],
            [
                "name" => "Bimtal",
                "description" => "Bimbingan Mental",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Casper Membaca",
                "description" => "-",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Lomba Mengaji",
                "description" => "-",
                "status" => "progress",
                "school_id" => 3,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
            [
                "name" => "Membuat Kelompok Belajar",
                "description" => "-",
                "status" => "success",
                "school_id" => 3,
                "created_at" => "2023-06-20 13:31:08",
                "updated_at" => "2023-06-20 13:31:08"
            ],
        ]);
    }
}
