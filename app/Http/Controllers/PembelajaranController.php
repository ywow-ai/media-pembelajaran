<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use DB;
use Redirect;
use Validator;

class PembelajaranController extends Controller
{
    public function classical()
    {
        // dd(Cookie::get());
        $nama = Cookie::get('classical_nama');
        if ($nama === null) {
            return view('pembelajaran.classical_input_nama');
        }

        if (Cookie::get('classical_video') === null) {
            return view('pembelajaran.classical_video');
        }

        $current = Cookie::get('classical_navigate');
        $soal = DB::table('soal as a')
            ->leftJoin('jawaban as b', 'a.id', 'b.soal_id')
            ->where('a.kategori_soal', 'CLASSICAL')
            ->select(
                'a.*',
                'b.jawaban',
                'b.ragu_ragu',
            )
            ->get()
            ->map(function ($item, $key) use ($current) {
                $item->options = json_decode($item->options, true);
                $item->key = $key;
                $item->classes = join(' ', [
                    'btn w-100 border border-2 soal-navigate-to',
                    (int) $item->ragu_ragu === 1
                    ? ( /* kuning */
                        (int) $current === $item->id
                        ? 'btn-white text-warning border-warning'
                        : 'btn-warning text-white border-warning'
                    )
                    : (
                        $item->jawaban === null
                        ? ( /* abu abu */
                            (int) $current === $item->id
                            ? 'btn-white text-secondary border-secondary'
                            : 'btn-secondary text-white border-secondary'
                        )
                        : ( /* biru */
                            (int) $current === $item->id
                            ? 'btn-white text-primary border-primary'
                            : 'btn-primary text-white border-primary'
                        )
                    ),
                ]);
                return $item;
            });

        $current_soal = $soal
            ->filter(fn($f) => !isset ($current) || (int) $f->id === (int) $current)
            ->first();

        $has_next = $soal->get(isset($current_soal) ? $current_soal->key + 1 : -1);
        $has_prev = $soal->get(isset($current_soal) ? $current_soal->key - 2 : -1);
        return view('pembelajaran.classical', compact('soal', 'current', 'current_soal', 'has_next', 'has_prev', 'nama'))->with('title', 'CLASSICAL');
    }

    public function classical_navigate(Request $request)
    {
        if (isset($request->input_nama)) {
            Cookie::queue('classical_nama', $request->input_nama, 60);
        }

        if (isset($request->check_video)) {
            Cookie::queue('classical_video', $request->check_video, 60);
        }

        if (isset($request->back)) {
            Cookie::queue(Cookie::forget('classical_video'));
        }

        if (isset($request->navigate)) {
            Cookie::queue('classical_navigate', $request->navigate, 60);
        }

        if (isset($request->answer) || isset($request->ragu_ragu)) {
            $data = [
                'nama' => Cookie::get('classical_nama'),
                'soal_id' => $request->this_soal_id,
                'jawaban' => $request->answer,
                'ragu_ragu' => isset($request->ragu_ragu) && $request->ragu_ragu === 'on',
            ];
            DB::table('jawaban')
                ->upsert(
                    $data,
                    ['nama', 'soal_id'],
                    ['jawaban', 'ragu_ragu'],
                );
        }

        return redirect()->back();
    }

    public function classical_save(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'soal_id' => 'required|int',
                'jawaban' => 'required|string',
                'ragu_ragu' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(
                        [
                            'message' => 'Error: ' . $validator
                                ->errors()
                                ->first(),
                        ],
                        400,
                    );
            }

            DB::table('jawaban')->upsert(
                [
                    'nama' => Cookie::get('classical_nama'),
                    'soal_id' => $request->soal_id,
                    'jawaban' => $request->jawaban,
                    'ragu_ragu' => $request->ragu_ragu,
                ],
                ['nama', 'soal_id'],
                ['jawaban', 'ragu_ragu'],
            );

            return response()->json($request->all(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function kelompok()
    {
        return view('pembelajaran.kelompok')->with('title', 'KELOMPOK');
    }

    public function mandiri()
    {
        return view('pembelajaran.mandiri')->with('title', 'MANDIRI');
    }
}
