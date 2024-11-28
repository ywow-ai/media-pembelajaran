@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <div class="row p-2">
                <div class="col-12 col-lg-8 p-2 mx-auto">
                    <div class="card x-card">
                        <div class="card-body">
                            <form action="{{ route('pembelajaran.navigate', ['kategori' => $kategori]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form-control-lg mb-4" type="text"
                                        placeholder="ketikan nama" name="input_nama">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">Selanjutnya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
