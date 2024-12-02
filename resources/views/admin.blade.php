@extends('app')

@section('content')
    <div class="row">
        <div class="col p-4">
            @foreach ($data as $kategori => $table)
                <div class="text-end">
                    <span class="h5 mb-2 d-block">{{ $kategori }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2" class="align-middle">No</th>
                                <th rowspan="2" class="align-middle">Nama</th>
                                <th colspan="{{ max(1, count($table->soal_ids)) }}">Soal</th>
                            </tr>
                            <tr>
                                @foreach ($table->soal_ids as $i => $_)
                                    <th>{{ $i + 1 }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($table->data as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    @foreach ($table->soal_ids as $i => $_)
                                        <td>{{ $item->jawaban->{$i} }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection
