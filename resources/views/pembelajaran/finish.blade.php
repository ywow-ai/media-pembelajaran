@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <div class="row p-2">
                <div class="col-12 col-lg-8 p-2 mx-auto">
                    <div class="card x-card" style="min-height: 70vh;">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <form action="{{ route('pembelajaran.navigate', ['kategori' => $kategori]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <span class="h4">Anda telah menyelesaikan ujian</span>
                                </div>
                                <div class="form-group d-flex justify-content-center mt-5">
                                    <button name="mulai_ulang" value="true" type="submit" class="btn btn-primary">Mulai
                                        ulang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
