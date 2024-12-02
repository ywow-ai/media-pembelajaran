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
                            $result = (object) [];
                            $result->nama = $nama;
                            $result->jawaban = (object) [];
                            foreach ($soal_ids as $i => $id) {
                                $result->jawaban->{$i} = $item->where('id', $id)->first()?->jawaban;
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
