<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('soal')->insert([
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'PILIHAN GANDA',
                'value' => 'Paraga kang ana ing wacan dhuwur yaiku, kajaba ......',
                'options' => json_encode([
                    'Rama',
                    'Kidang Kencana',
                    'Sinta',
                    'Dasamuka',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'PILIHAN GANDA',
                'value' => 'Sapa Lesmana iku?',
                'options' => json_encode([
                    'adhine Rama',
                    'adhine Sinta',
                    'manuk garuda',
                    'kakange Sinta',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'PILIHAN GANDA',
                'value' => 'Ana ngendi Sinta weruh kidang?',
                'options' => json_encode([
                    'Alas Dandaka',
                    'Alengka',
                    'Ayodya',
                    'Argasoka',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'PILIHAN GANDA',
                'value' => 'Pitakonan kang jumbuh karo wacan ing dhuwur yaiku ....',
                'options' => json_encode([
                    'Sapa sing mburu playune Kidang Kencana?',
                    'Ana ing ngendi Sinta dilairake?',
                    'Kepiye carane Lesmana nulungi kakange?',
                    'Kena ngapa Sinta seneng karo Lesamana?',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'PILIHAN GANDA',
                'value' => 'Ukara ngisor iki kang ora trep karo isi crita Kidang Kencana yaiku...',
                'options' => json_encode([
                    'Prabu Rama ngumbara klawan garwane Dewi Sinta lan adhine Lesmana.',
                    'Jatayu kasil ngrebut Dewi Sinta saka Rahwana.',
                    'Prabu Rama ngakon Lesmana jaga garwane nalika ngoyak Kidang Kencana.',
                    'Dewi Sinta ngakon Lesmana nyusul Rama menyang alas.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'ESAY',
                'value' => 'Sapa Kalamarica iku?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'ESAY',
                'value' => 'Kepiye carane Rahwana nyolong Sinta?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'ESAY',
                'value' => 'Sapa kang aweh pitulung marang Sinta?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'ESAY',
                'value' => 'Sinta digawa Rahwana menyang ngendi?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'CLASSICAL',
                'type' => 'ESAY',
                'value' => 'Coba crita Patine Jatayu mau critakake nganggo basamu dhewe dirembug karo kelompoke!',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'PILIHAN GANDA',
                'value' => 'Sapa kang ditulungi Rama?',
                'options' => json_encode([
                    'Subali',
                    'Sugriwa',
                    'Anoman',
                    'Lesmana',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'PILIHAN GANDA',
                'value' => 'Apa jenenge pusakane Rama ?',
                'options' => json_encode([
                    'Argasoka',
                    'Pancawati',
                    'Gumawijawa',
                    'Pancasona',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'PILIHAN GANDA',
                'value' => 'Pitakonan kang trep kanggo wacan ing dhuwur yaiku?...',
                'options' => json_encode([
                    'Apa sing dadi panjaluke Sinta?',
                    'Subali anake sapa?',
                    'Sapa raja ing Guwakiskendha?',
                    'Kenapa Lesmana ninggalake Sinta?',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'PILIHAN GANDA',
                'value' => "Gatekna ukara ngisor iki!\n1. Rama lan Lesmana mburu kidang ing alas\n2. Anoman ngobong kraton Alengka\n3. Sinta diumpetake ing Taman Argasoka\n4. Sugriwa kalah karo Subali\nUkara kang trep karo isi cerita Kidang Kencana yaiku…",
                'options' => json_encode([
                    '1&2',
                    '2&3',
                    '3&4',
                    '4&1',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'PILIHAN GANDA',
                'value' => 'Ukara ngisor iki kang ora trep karo isi cerita Kidang Kencana yaiku...',
                'options' => json_encode([
                    'Prabu Rama ngumbara kalih garwane Dewi Sinta lan rayine Lesmana.',
                    'Jatayu kasil ngrebut Dewi Sinta saka Rahwana.',
                    'Prabu Rama dhawuhi Lesmana njaga garwane nalika ngoyak Kidang Kencana.',
                    'Dewi Sinta diumpetake ing Taman Argasoka.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'ESAY',
                'value' => 'Kena ngapa Sinta sesucen nganggo geni?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'ESAY',
                'value' => 'Kena ngapa Anoman ora ngobong Taman Argasoka?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'ESAY',
                'value' => 'Kena ngapa prajurit Sugriwa ngrewangi Rama?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'ESAY',
                'value' => 'Anoman iku awujud apa?',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_soal' => 'KELOMPOK',
                'type' => 'ESAY',
                'value' => 'Coba crita Kidang Kencana mau critakake nganggo basamu dhewe kanthi runtut!',
                'options' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
