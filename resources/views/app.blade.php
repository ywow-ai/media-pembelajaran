@php
    $nav = [
        (object) [
            'name' => 'HOME',
            'route' => route('index'),
            'child' => null,
        ],
        (object) [
            'name' => 'PEMBELAJARAN',
            'route' => route('index'),
            'child' => [
                (object) [
                    'name' => 'CLASSICAL',
                    'route' => '/pembelajaran/classical',
                ],
                (object) [
                    'name' => 'KELOMPOK',
                    'route' => '/pembelajaran/kelompok',
                ],
                (object) [
                    'name' => 'MANDIRI',
                    'route' => '/pembelajaran/mandiri',
                ],
            ],
        ],
        (object) [
            'name' => 'ADMIN',
            'route' => route('admin'),
            'child' => null,
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? "MEDIA PEMBELAJARAN | $title" : 'MEDIA PEMBELAJARAN' }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons.min.css') }}">
    <style>
        .x-none {
            border: 0 !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .x-nav {
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.1);
        }

        .x-card {
            border: 0 !important;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.1);
        }

        .x-radio {
            box-shadow: none !important;
            width: 25px;
            height: 25px;
            margin-bottom: 4px;
        }

        .x-check {
            box-shadow: none !important;
            border: none !important;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white fixed-top x-nav">
        <div class="container-fluid">
            <div class="d-flex w-100">
                <div class="d-flex">
                    <button class="navbar-toggler d-block d-lg-none x-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft" aria-expanded="false"
                        aria-label="Toggle Canvas">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand navbar-logo d-flex justify-content-center align-items-center"
                        href="{{ route('index') }}">
                        <img src="https://via.placeholder.com/35x35.png?text=Logo" alt="Logo" class="ms-2 ms-lg-0">
                        <span class="ms-2 d-none d-lg-block">MEDIA PEMBELAJARAN</span>
                    </a>
                </div>
                <div class="d-none d-lg-flex ms-auto d-flex justify-content-center align-items-center">
                    <ul class="navbar-nav ms-auto">
                        @foreach ($nav as $key => $item)
                            @if ($item->child)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __($item->name) }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($item->child as $sub)
                                            <li><a class="dropdown-item py-2"
                                                    href="{{ $sub->route }}">{{ __($sub->name) }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $item->route }}">{{ __($item->name) }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}

            {{-- <div class="collapse navbar-collapse" id="navbarNav">
                <p>Konten Lain Disini</p>
            </div> --}}
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasLeftLabel">Menu</h5>
            <button type="button" class="btn-close text-reset x-none" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                @foreach ($nav as $key => $item)
                    <li class="nav-item">
                        @if ($item->child)
                            <a class="nav-link collapsed" href="#{{ strtolower($item->name) . 'Collapse' }}"
                                data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="{{ strtolower($item->name) . 'Collapse' }}">
                                <span class="d-flex justify-content-center align-items-center">
                                    {{ __($item->name) }}
                                    <i class="bi bi-chevron-down ms-auto"></i>
                                </span>
                            </a>
                            <div class="collapse" id="{{ strtolower($item->name) . 'Collapse' }}">
                                <ul class="navbar-nav ms-3">
                                    @foreach ($item->child as $sub)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $sub->route }}">{{ __($sub->name) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <a class="nav-link" href="{{ $item->route }}">{{ __($item->name) }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="container-fluid">
        <div style="margin-top: 61px;"></div>
        @yield('content')
    </div>
    <script src="{{ asset('bootstrap.js') }}"></script>
    <script src="{{ asset('jquery.min.js') }}"></script>

    @yield('js')
</body>

</html>
