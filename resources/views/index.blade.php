@extends('app')

@section('content')
    <div class="row">
        <div class="col p-0" >
            <img src="{{ asset('content/1. Cerita Wayang.png') }}" alt="1. Cerita Wayang.png" class="w-100 h-auto">
        </div>
    </div>
    <div style="display: flex; align-items: center; justify-content: center; margin: 5px 0;">
    <hr style="border: 15px solid #ddb486; width: 100%; margin: 0;">
    </div>
    <div class="row">
        <div class="col p-0">
            <img src="{{ asset('content/sugengrawuh.png') }}" alt="2content/2. sugeng-rawuh .png" class="w-100 h-auto">
        </div>
    </div>
    <div class="row p-2 justify-content-center" style="background-color: #7fa48e; ">
        <div class="col-9 col-lg-4 p-2 position-relative">
            <a href="/pembelajaran/classical">
                <img src="{{ asset('content/1.png') }}" alt="3. button-1.png" class="w-100 h-auto rounded-4">
            </a>
        </div>
        <div class="col-9 col-lg-4 p-2 position-relative">
            <a href="/pembelajaran/kelompok">
                <img src="{{ asset('content/3.png') }}" alt="3. button-1.png" class="w-100 h-auto rounded-4">
            </a>
        </div>
        <div class="col-9 col-lg-4 p-2 position-relative">
            <a href="/pembelajaran/mandiri">
                <img src="{{ asset('content/2.png') }}" alt="3. button-1.png" class="w-100 h-auto rounded-4">
            </a>
        </div>
    </div>
    <div style="display: flex; align-items: center; justify-content: center; margin: 20px 0;">
    <hr style="border: 1cm solid green; width: 100%; margin: 0;">
    <span style="position: absolute; padding: 0 10px; font-size: 1.5rem; color: green; font-weight: bold;">Kompetensi Diri</span>
</div>
    <div class="row">
        <div class="col p-0">
            <img src="{{ asset('content/4. kompetensi dasar.png') }}" alt="4content/4. kompetensi dasar.png"
                class="w-100 h-auto">
        </div>
    </div>
    
@endsection
