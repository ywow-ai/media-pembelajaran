<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $raw = DB::table('soal as a')
            ->leftJoin('jawaban as b', 'a.id', 'b.soal_id')
            ->select('a.*', 'b.nama', 'b.jawaban')
            ->get();

        $data = $raw
            ->groupBy('kategori_soal')
            ->map(function ($item, $kategori) {
                $soal_ids = $item->pluck('id')->unique()->sort()->values();
                return (object) [
                    'soal_ids' => $soal_ids,
                    'data' => $item
                        ->groupBy('nama')
                        ->map(function ($item, $nama) use ($soal_ids) {
                            // dd($item);
                            $result = (object) [];
                            $result->nama = $nama;
                            $result->jawaban = (object) [];
                            foreach ($soal_ids as $i => $id) {
                                $raw = $item->where('id', $id)->first();
                                if (isset($raw)) {
                                    if ($raw->type === 'PILIHAN GANDA') {
                                        $result->jawaban->{$i} = ['A', 'B', 'C', 'D', 'E', 'F', 'G'][array_search($raw->jawaban, json_decode($raw->options, true))] ?? null;
                                    } else {
                                        $result->jawaban->{$i} = $raw->jawaban;
                                    }
                                } else {
                                    $result->jawaban->{$i} = null;
                                }
                            }
                            return $result;
                        })
                        ->filter(fn($_, $index) => $index !== '')
                        ->values()
                ];
            });

        return view('admin', compact('data'))->with('title', 'ADMIN');
    }
}
