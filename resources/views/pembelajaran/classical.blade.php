@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto" id="wrapper-main"></div>
    </div>
@endsection

@section('js')
    <script>
        $(document)
            .ready(() => {
                const soals = @json($soal);
                class Main {
                    storage_nama = 'classical_nama';
                    storage_video = 'classical_video';
                    storage_soal = 'classical_soal';
                    storage_soal_current = 'classical_soal_current';
                    storage_soal_answers = 'classical_soal_answers';
                    wrapper = $('#wrapper-main');

                    nama() {
                        const nama = localStorage.getItem(this.storage_nama);
                        if (['', null, undefined, false].includes(nama)) {
                            (async () => {
                                try {
                                    const res = await fetch('/pembelajaran/partial/input_nama');
                                    if (!res.ok) {
                                        throw res;
                                    }
                                    this.wrapper.html(await res.text());
                                } catch (error) {
                                    console.log(error);
                                }
                            })();

                            return null;
                        } else {
                            return nama;
                        }
                    }

                    video() {
                        const video = localStorage.getItem(this.storage_video);
                        if (['', null, undefined, false].includes(video)) {
                            (async () => {
                                try {
                                    const res = await fetch('/pembelajaran/partial/video');
                                    if (!res.ok) {
                                        throw res;
                                    }
                                    this.wrapper.html(await res.text());
                                } catch (error) {
                                    console.log(error);
                                }
                            })();

                            return false;
                        } else {
                            return true;
                        }
                    }

                    soal() {
                        const soal = localStorage.getItem(this.storage_soal);
                        if (['', null, undefined, false].includes(soal)) {
                            (async () => {
                                try {
                                    const res = await fetch('/pembelajaran/partial/soal');
                                    if (!res.ok) {
                                        throw res;
                                    }
                                    const current = localStorage.getItem(this.storage_soal_current) ?? '0';
                                    const current_saved_soal = (() => {
                                        try {
                                            return JSON.parse(localStorage.getItem(this.storage_soal_answers)) ?? {};
                                        } catch (error) {
                                            return {};
                                        }
                                    })()[current];
                                    const soal = soals[current];
                                    console.log(soal);
                                    const htmls = $(await res.text());
                                    htmls.find('#soal-num-head').text((Number(current) + 1).toString().padStart(2, '0'));
                                    htmls.find('#soal-value').html(soal.soal);
                                    htmls.find('#answers').html(soal.type === 'esay' ? $('<textarea>', {name: 'optx', class: 'form-control'}) : $('<ul>', {class: 'list-unstyled'}).html(soal.options.map((o, i) => $('<li>', {class: 'mb-2'}).html($('<div>', {class: 'form-check'}).html($('<label>', {for: `opsx-${i}`, class: 'form-check-label w-100 p-2 d-flex align-items-center', style: 'cursor: pointer;'}).html([$('<input>', {checked: i === current_saved_soal.v, name: 'optx', type: 'radio', id: `opsx-${i}`, class: 'form-check-input x-radio me-2'}), $('<span>').text(o)]))))));
                                    this.wrapper.html(htmls);
                                } catch (error) {
                                    console.log(error);
                                }
                            })();

                            return false;
                        } else {
                            return true;
                        }
                    }

                    soalAnswer(index) {
                        const current = localStorage.getItem(this.storage_soal_current) ?? '0';
                        const prev_soal = (() => {
                            try {
                                return JSON.parse(localStorage.getItem(this.storage_soal_answers)) ?? {};
                            } catch (error) {
                                return {};
                            }
                        })();

                        localStorage.setItem(this.storage_soal_answers, JSON.stringify({
                            ...prev_soal,
                            [current]: {
                                v: index,
                                r: $('#check-ragu-ragu').is(':checked'),
                            }
                        }));
                    }

                    soalNavigate(index) {
                        localStorage.setItem(this.storage_soal_current, Number(index));
                    }

                    soalRagu(index) {}

                    soalFinish() {}

                    check() {
                        if (!this.nama()) {
                            return;
                        }
                        if (!this.video()) {
                            return;
                        }
                        if (!this.soal()) {
                            return;
                        }
                    }
                }

                const main = new Main();

                main.check();

                $(document).on('click', '#submit-nama', () => {
                    localStorage.setItem(main.storage_nama, $('#input-nama').val());
                    main.check();
                });

                $(document).on('click', '#submit-video', () => {
                    localStorage.setItem(main.storage_video, true);
                    main.check();
                });
            });
    </script>
@endsection
