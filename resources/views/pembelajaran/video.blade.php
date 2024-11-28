@extends('app')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
            <div class="row p-2">
                <div class="col-12 col-lg-10 p-2 mx-auto">
                    <div class="card x-card" style="min-height: 70vh;">
                        <div class="card-body">
                            <iframe width="100%" height="auto" style="aspect-ratio: 16 / 9;"
                                src="https://www.youtube.com/embed/EhnlVO9zArU?si=wPxth_eEjOs4EBkG"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"></iframe>

                            <div class="form-inline d-flex justify-content-end mt-4">
                                <form action="{{ route('pembelajaran.navigate', ['kategori' => $kategori]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" name="check_video" value="true"
                                        class="btn btn-primary text-white">Selanjutnya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
