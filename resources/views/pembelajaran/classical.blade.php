@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <form class="row p-2" action="{{ route('pembelajaran.classical_navigate') }}" method="post">
                @csrf
                <div class="col-12 col-lg-8 p-2">
                    <div class="card x-card position-relative" style="min-height: 70vh;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="h5 text-primary m-0 me-2">{{ __('SOAL NO') }}</span>
                                    <span class="d-inline-block bg-primary text-white rounded-circle text-center fw-bold"
                                        style="width: 35px; height: 35px; line-height: 35px;">{{ $current_soal->key ?? '0' }}</span>
                                </div>
                                <div class="mt-4">
                                    <p class="fw-bold">{!! $current_soal->value !!}</p>
                                    <ul class="list-unstyled">
                                        @if (count($current_soal->options) === 0)
                                            <textarea class="form-control" name="answer" placeholder="ketik disini..." rows="10">{!! $current_soal->jawaban !!}</textarea>
                                        @else
                                            @foreach ($current_soal->options as $i => $opts)
                                                <li class="mb-2">
                                                    <div class="form-check">
                                                        <label for="opts-{{ $i }}"
                                                            class="form-check-label w-100 p-2 d-flex align-items-center"
                                                            style="cursor: pointer">
                                                            <input type="radio" name="answer"
                                                                id="opts-{{ $i }}" value="{{ $opts }}"
                                                                {{ $current_soal->jawaban === $opts ? 'checked' : '' }}
                                                                class="form-check-input x-radio me-2">
                                                            {{ __($opts) }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="form-inline d-flex justify-content-between">
                                @if ($has_prev === null)
                                    <button type="submit" name="back" value="true"
                                        class="btn btn-primary text-white">Kembali</button>
                                @else
                                    <button type="submit" name="navigate" value="{{ (int) $current - 1 }}"
                                        class="btn btn-primary text-white">Sebelumnya</button>
                                @endif
                                <label for="check-ragu-ragu" class="btn btn-warning text-white d-flex align-items-center"
                                    role="button">
                                    <input type="checkbox" class="form-check-input x-check m-0" id="check-ragu-ragu">
                                    <span class="ms-2">Ragu-ragu</span>
                                </label>
                                @if ($has_next === null)
                                    <button type="submit" name="finish" value="true"
                                        class="btn btn-primary text-white">Selesai Ujian</button>
                                @else
                                    <button type="submit" name="navigate" value="{{ (int) $current + 1 }}"
                                        class="btn btn-primary text-white">Selanjutnya</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 p-2">
                    <div class="card x-card">
                        <div class="card-body px-4">
                            <span class="h5 text-primary">Navigasi Soal</span>
                            <div class="mb-4"></div>
                            <div class="row" id="soal-nav">
                                @foreach ($soal as $item)
                                    <div class="col-3 p-2">
                                        <div class="w-100">
                                            <button type="submit" name="navigate" value="{{ $item->id }}"
                                                class="btn {{ (int) $current === $item->id ? 'btn-white text-secondary' : 'btn-secondary text-white' }} w-100 border border-2 border-secondary">{{ str_pad($item->key, 2, '0', STR_PAD_LEFT) }}</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document)
            .ready(() => {
                const token = @json(csrf_token());
                const throtle = 2 /*10*/ ;
                let processedAutoSave = null;

                const cancelAutoSave = () => {
                    clearTimeout(processedAutoSave);
                };

                const autosave = () => {
                    cancelAutoSave();

                    processedAutoSave = setTimeout(async () => {
                        await fetch('/pembelajaran/classical_save', {
                            method: 'post',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'content-type': 'application/json',
                            },
                            body: JSON.stringify({
                                nama: @json($nama),
                                soal_id: @json($current_soal->id),
                                jawaban: $('input[name="answer"][type="radio"]:checked')
                                    .val() ?? $('textarea[name="answer"]').val().trim(),
                                ragu_ragu: $('#check-ragu-ragu').is(':checked'),
                            }),
                        });
                    }, throtle * 1000);
                };

                const soal_id = @json($current_soal->id);

                $('#check-ragu-ragu')
                    .on('change', () => {
                        autosave();
                    });

                $('input[name="answer"][type="radio"]')
                    .on('change', () => {
                        autosave();
                    });

                $('textarea[name="answer"]')
                    .on('input', () => {
                        autosave();
                    });
            });
    </script>
@endsection
