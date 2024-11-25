<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelajaranController extends Controller
{
    private function soal()
    {
        return [
            // soal 1
            [
                (object) [
                    'type' => 'pg',
                    'soal' => 'Paraga kang ana ing wacan dhuwur yaiku, kajaba ......',
                    'options' => [
                        'Rama',
                        'Kidang Kencana',
                        'Sinta',
                        'Dasamuka',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Sapa Lesmana iku?',
                    'options' => [
                        'adhine Rama',
                        'adhine Sinta',
                        'manuk garuda',
                        'kakange Sinta',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Ana ngendi Sinta weruh kidang?',
                    'options' => [
                        'Alas Dandaka',
                        'Alengka',
                        'Ayodya',
                        'Argasoka',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Pitakonan kang jumbuh karo wacan ing dhuwur yaiku ....',
                    'options' => [
                        'Sapa sing mburu playune Kidang Kencana?',
                        'Ana ing ngendi Sinta dilairake?',
                        'Kepiye carane Lesmana nulungi kakange?',
                        'Kena ngapa Sinta seneng karo Lesamana?',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Ukara ngisor iki kang ora trep karo isi crita Kidang Kencana yaiku...',
                    'options' => [
                        'Prabu Rama ngumbara klawan garwane Dewi Sinta lan adhine Lesmana.',
                        'Jatayu kasil ngrebut Dewi Sinta saka Rahwana.',
                        'Prabu Rama ngakon Lesmana jaga garwane nalika ngoyak Kidang Kencana.',
                        'Dewi Sinta ngakon Lesmana nyusul Rama menyang alas.',
                    ],
                ],
            ],

            // soal 2 esay
            [
                (object) [
                    'type' => 'esay',
                    'soal' => 'Sapa Kalamarica iku?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Kepiye carane Rahwana nyolong Sinta?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Sapa kang aweh pitulung marang Sinta?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Sinta digawa Rahwana menyang ngendi?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Coba crita Patine Jatayu mau critakake nganggo basamu dhewe dirembug karo kelompoke!',
                ],
            ],

            // soal 3
            [
                (object) [
                    'type' => 'pg',
                    'soal' => 'Sapa kang ditulungi Rama?',
                    'options' => [
                        'Subali',
                        'Sugriwa',
                        'Anoman',
                        'Lesmana',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Apa jenenge pusakane Rama ?',
                    'options' => [
                        'Argasoka',
                        'Pancawati',
                        'Gumawijawa',
                        'Pancasona',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Pitakonan kang trep kanggo wacan ing dhuwur yaiku?...',
                    'options' => [
                        'Apa sing dadi panjaluke Sinta?',
                        'Subali anake sapa?',
                        'Sapa raja ing Guwakiskendha?',
                        'Kenapa Lesmana ninggalake Sinta?',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => "Gatekna ukara ngisor iki!\n1. Rama lan Lesmana mburu kidang ing alas\n2. Anoman ngobong kraton Alengka\n3. Sinta diumpetake ing Taman Argasoka\n4. Sugriwa kalah karo Subali\nUkara kang trep karo isi cerita Kidang Kencana yaiku…",
                    'options' => [
                        '1&2',
                        '2&3',
                        '3&4',
                        '4&1',
                    ],
                ],
                (object) [
                    'type' => 'pg',
                    'soal' => 'Ukara ngisor iki kang ora trep karo isi cerita Kidang Kencana yaiku...',
                    'options' => [
                        'Prabu Rama ngumbara kalih garwane Dewi Sinta lan rayine Lesmana.',
                        'Jatayu kasil ngrebut Dewi Sinta saka Rahwana.',
                        'Prabu Rama dhawuhi Lesmana njaga garwane nalika ngoyak Kidang Kencana.',
                        'Dewi Sinta diumpetake ing Taman Argasoka.',
                    ],
                ],
            ],

            // soal 4 esay
            [
                (object) [
                    'type' => 'esay',
                    'soal' => 'Kena ngapa Sinta sesucen nganggo geni?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Kena ngapa Anoman ora ngobong Taman Argasoka?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Kena ngapa prajurit Sugriwa ngrewangi Rama?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Anoman iku awujud apa?',
                ],
                (object) [
                    'type' => 'esay',
                    'soal' => 'Coba crita Kidang Kencana mau critakake nganggo basamu dhewe kanthi runtut!',
                ],
            ],
        ];
    }

    public function classical()
    {
        $soal = $this->soal()[0];
        return view('pembelajaran.classical', compact('soal'))->with('title', 'CLASSICAL');
    }

    public function kelompok()
    {
        return view('pembelajaran.kelompok')->with('title', 'KELOMPOK');
    }

    public function mandiri()
    {
        return view('pembelajaran.mandiri')->with('title', 'MANDIRI');
    }

    public function partial(string $part)
    {
        try {
            return response()->view("pembelajaran.partial.{$part}");
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
