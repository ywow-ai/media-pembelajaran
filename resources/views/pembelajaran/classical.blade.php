@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto" id="wrapper-main">
            {{-- <div class="row p-2">
                <div class="col-12 col-lg-8 p-2">
                    <div class="card x-card position-relative" style="min-height: 70vh;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="h5 text-primary m-0 me-2">SOAL NO</span>
                                    <span class="d-inline-block bg-primary text-white rounded-circle text-center fw-bold"
                                        style="width: 35px; height: 35px; line-height: 35px;">
                                        1
                                    </span>
                                </div>
                                <div class="mt-4">
                                    <p class="fw-bold">{!! $soal[0]->soal !!}</p>
                                    <ul class="list-unstyled">
                                        @foreach ($soal[0]->options as $key => $ops)
                                            <li class="mb-2">
                                                <div class="form-check">
                                                    <label for="soal1-p{{ $key }}"
                                                        class="form-check-label w-100 p-2 d-flex align-items-center"
                                                        style="cursor: pointer">
                                                        <input type="radio" name="soal1" id="soal1-p{{ $key }}"
                                                            class="form-check-input x-radio me-2">
                                                        {{ $ops }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="form-inline d-flex justify-content-between">
                                <button type="button" class="btn btn-primary text-white">Sebelumnya</button>
                                <label for="check-ragu-ragu" class="btn btn-warning text-white d-flex align-items-center"
                                    role="button">
                                    <input type="checkbox" class="form-check-input x-check m-0" id="check-ragu-ragu">
                                    <span class="ms-2">Ragu-ragu</span>
                                </label>
                                <button type="button" class="btn btn-primary text-white">Selanjutnya</button>
                            </div>
                        </div>

                        <div class="w-100 h-100 position-absolute d-none"
                            style="border-radius: inherit; background-color: rgba(0, 0, 0, 0.5);" data-x-loading>
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 p-2">
                    <div class="card x-card">
                        <div class="card-body px-4">
                            <span class="h5 text-primary">Navigasi Soal</span>
                            <div class="mb-4"></div>
                            <div class="row">
                                @foreach ($soal as $i => $item)
                                    <div class="col-3 p-2">
                                        <div class="w-100">
                                            <button type="button"
                                                class="btn btn-secondary w-100">{{ sprintf('%02d', $i + 1) }}</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(async () => {
            const prefix = 'classical';
            const checks = [
                async () => {
                    try {
                        const storage_name = `${prefix}_nama`;
                        const nama = localStorage.getItem(storage_name);
                        if (nama === null || nama === undefined || nama === '') {
                            const response = await fetch('/pembelajaran/partial/input_nama');
                            if (!response.ok) {
                                throw response;
                            }
                            $('#wrapper-main').html(await response.text());
                        }
                        return {
                            key: 'nama',
                            value: nama
                        };
                    } catch (e) {
                        return {
                            key: 'nama',
                            value: null,
                            e,
                        };
                    }
                },
            ];

            $(document).on('click', '#submit-nama', () => {
                await Promise.all(checks.map(prom => prom()));
            });
        });
    </script>
@endsection
