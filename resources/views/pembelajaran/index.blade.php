@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto" style="font-family: 'Times New Roman', Times, serif; font-size: 12px;">
            <form class="row p-2" action="{{ route('pembelajaran.navigate', ['kategori' => $kategori]) }}" method="post"
                style="background-color: #a0c4e5;">
                @csrf
                <input type="hidden" name="this_soal_id" value="{{ $current_soal->id }}">
                <div class="col-12 col-lg-8 p-2">
                    <div class="card x-card position-relative" style="min-height: 70vh;">
                        <div class="card-body d-flex flex-column justify-content-between"
                            style="background-color: #ebf6ff;">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="h5 text-primary m-0 me-2">{{ __('SOAL NO') }}</span>
                                    <span class="d-inline-block bg-primary text-white rounded-circle text-center fw-bold"
                                        style="width: 35px; height: 35px; line-height: 35px;">{{ isset($current_soal) ? $current_soal->key + 1 : '0' }}</span>
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
                                    <button type="submit" name="navigate" value="{{ (int) $has_prev->id }}"
                                        class="btn btn-primary text-white">Sebelumnya</button>
                                @endif
                                <label for="check-ragu-ragu" class="btn btn-warning text-white d-flex align-items-center"
                                    role="button">
                                    <input type="checkbox" class="form-check-input x-check m-0" name="ragu_ragu"
                                        id="check-ragu-ragu" {{ (int) $current_soal->ragu_ragu === 1 ? 'checked' : '' }}>
                                    <span class="ms-2">Ragu-ragu</span>
                                </label>
                                @if ($has_next === null)
                                    <button type="submit" name="finish" value="true"
                                        class="btn btn-primary text-white">Selesai Ujian</button>
                                @else
                                    <button type="submit" name="navigate" value="{{ (int) $has_next->id }}"
                                        class="btn btn-primary text-white">Selanjutnya</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 p-2">
                    <div class="card x-card">
                        <div class="card-body px-4">
                            <span class="h5 text-primary">Navigasi Soal {{ $kategori }}</span>
                            <div class="mb-4"></div>
                            <div class="row" id="soal-nav">
                                @foreach ($soal as $item)
                                    <div class="col-3 p-2">
                                        <div class="w-100">
                                            <button type="submit" name="navigate" value="{{ $item->id }}"
                                                class="{{ $item->classes }}">{{ str_pad($item->key + 1, 2, '0', STR_PAD_LEFT) }}</button>
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
                const throtle = 12 /*10*/ ;
                let processedAutoSave = null;

                const cancelAutoSave = () => {
                    clearTimeout(processedAutoSave);
                };

                const updateColor = () => {
                    const soal_id = @json($current_soal->id);
                    const jawaban_null = ($('input[name="answer"][type="radio"]:checked').val() ?? $(
                        'textarea[name="answer"]').val().trim()) === '';
                    const ragu_ragu = $('#check-ragu-ragu').is(':checked');

                    $(`.soal-navigate-to[value="${soal_id}"]`)
                        .toggleClass('text-warning border-warning', ragu_ragu)
                        .toggleClass('text-secondary border-secondary', jawaban_null && !ragu_ragu)
                        .toggleClass('text-primary border-primary', !jawaban_null && !ragu_ragu);
                };

                const autosave = () => {
                    cancelAutoSave();

                    processedAutoSave = setTimeout(async () => {
                        await fetch(`/pembelajaran/${@json($kategori)}/save`, {
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
                        updateColor();
                    });

                $('input[name="answer"][type="radio"]')
                    .on('change', () => {
                        autosave();
                        updateColor();
                    });

                $('textarea[name="answer"]')
                    .on('input', () => {
                        autosave();
                        updateColor();
                    });

                $('button[name="navigate"][type="submit"]')
                    .on('click', () => {
                        cancelAutoSave()
                    });

                $('button[type="submit"][name="finish"]')
                    .on('click', e => {
                        e.preventDefault();
                        if (confirm('Selesai ujian?')) {
                            $(e.currentTarget).closest('form[method="post"]').append($(
                                '<input>', {
                                    name: 'finish',
                                    value: true,
                                }));
                            $(e.currentTarget).closest('form[method="post"]').submit();
                        }
                    });
            });
    </script>
@endsection
