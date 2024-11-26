<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelajaranController extends Controller
{
    public function classical()
    {
        return view('pembelajaran.classical')->with('title', 'CLASSICAL');
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
