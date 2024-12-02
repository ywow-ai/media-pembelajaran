<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use DB;
use Validator;

class PembelajaranController extends Controller
{
    private function check($kategori)
    {
        $list = ["classical" => true, "kelompok" => true, "mandiri" => true];
        if (!isset($list[$kategori])) {
            abort(404);
        }
    }

    public function index($kategori = null)
    {
        $this->check($kategori);

        $video_embeded_url = [
            "classical" => "https://www.youtube.com/embed/EhnlVO9zArU?si=wPxth_eEjOs4EBkG",
            "kelompok" => "https://www.youtube.com/embed/hpiUU-wSsAY?si=NjJljUHsH2y4JaPo",
            "mandiri" => "https://www.youtube.com/embed/esQeE59kj7U?si=2GsMviQLAMB3cWwz",
        ][$kategori];

        $finish = Cookie::get("{$kategori}_finish");
        if ($finish !== null) {
            return view("pembelajaran.finish", compact("kategori"));
        }

        $nama = Cookie::get("{$kategori}_nama");
        if ($nama === null) {
            return view("pembelajaran.input_nama", compact("kategori"));
        }

        if (Cookie::get("{$kategori}_video") === null) {
            return view("pembelajaran.video", compact("kategori"));
        }

        $current = Cookie::get("{$kategori}_navigate");
        $soal = DB::table("soal as a")
            ->leftJoin("jawaban as b", function ($join) use ($nama) {
                $join
                    ->on("a.id", "b.soal_id")
                    ->where("b.nama", $nama);
            })
            ->where("a.kategori_soal", strtoupper($kategori))
            ->select(
                "a.*",
                "b.jawaban",
                "b.ragu_ragu",
            )
            ->get()
            ->map(function ($item, $key) use ($current) {
                $item->options = json_decode($item->options, true);
                $item->key = $key;
                $item->classes = join(" ", [
                    "btn w-100 border border-2 soal-navigate-to",
                    (int) $item->ragu_ragu === 1
                    ? ( /* kuning */
                        (int) $current === $item->id
                        ? "btn-white text-warning border-warning"
                        : "btn-warning text-white border-warning"
                    )
                    : (
                        $item->jawaban === null
                        ? ( /* abu abu */
                            (int) $current === $item->id
                            ? "btn-white text-secondary border-secondary"
                            : "btn-secondary text-white border-secondary"
                        )
                        : ( /* biru */
                            (int) $current === $item->id
                            ? "btn-white text-primary border-primary"
                            : "btn-primary text-white border-primary"
                        )
                    ),
                ]);
                return $item;
            });

        if ($soal->count() === 0) {
            abort(404);
        }

        $current_soal = $soal
            ->filter(fn($f) => !isset ($current) || (int) $f->id === (int) $current)
            ->first();

        $has_next = $soal->get(isset($current_soal) ? $current_soal->key + 1 : -1);
        $has_prev = $soal->get(isset($current_soal) ? $current_soal->key - 2 : -1);
        return view("pembelajaran.index", compact("kategori", "soal", "current", "current_soal", "has_next", "has_prev", "nama"))->with("title", strtoupper($kategori));
    }

    public function navigate($kategori = null, Request $request)
    {
        $this->check($kategori);

        if (isset($request->input_nama)) {
            Cookie::queue("{$kategori}_nama", $request->input_nama, 60);
        }

        if (isset($request->check_video)) {
            Cookie::queue("{$kategori}_video", $request->check_video, 60);
        }

        if (isset($request->back)) {
            Cookie::queue(Cookie::forget("{$kategori}_video"));
        }

        if (isset($request->navigate)) {
            Cookie::queue("{$kategori}_navigate", $request->navigate, 60);
        }

        if (isset($request->answer) || isset($request->ragu_ragu)) {
            $data = [
                "nama" => Cookie::get("{$kategori}_nama"),
                "soal_id" => $request->this_soal_id,
                "jawaban" => $request->answer,
                "ragu_ragu" => isset($request->ragu_ragu) && $request->ragu_ragu === "on",
            ];
            DB::table("jawaban")
                ->upsert(
                    $data,
                    ["nama", "soal_id"],
                    ["jawaban", "ragu_ragu"],
                );
        }

        if (isset($request->finish)) {
            Cookie::queue(Cookie::forget("{$kategori}_nama"));
            Cookie::queue(Cookie::forget("{$kategori}_video"));
            Cookie::queue(Cookie::forget("{$kategori}_navigate"));
            Cookie::queue("{$kategori}_finish", true, 60);
        }

        if (isset($request->mulai_ulang)) {
            Cookie::queue(Cookie::forget("{$kategori}_finish"));
        }

        return redirect()->back();
    }

    public function save($kategori = null, Request $request)
    {
        $this->check($kategori);
        try {
            $validator = Validator::make($request->all(), [
                "soal_id" => "required|int",
                "jawaban" => "required|string",
                "ragu_ragu" => "required|boolean",
            ]);

            if ($validator->fails()) {
                return response()
                    ->json(
                        [
                            "message" => "Error: " . $validator
                                ->errors()
                                ->first(),
                        ],
                        400,
                    );
            }

            DB::table("jawaban")->upsert(
                [
                    "nama" => Cookie::get("{$kategori}_nama"),
                    "soal_id" => $request->soal_id,
                    "jawaban" => $request->jawaban,
                    "ragu_ragu" => $request->ragu_ragu,
                ],
                ["nama", "soal_id"],
                ["jawaban", "ragu_ragu"],
            );

            return response()->json($request->all(), 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
