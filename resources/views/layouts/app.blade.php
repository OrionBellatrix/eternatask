<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Eterna Cafe App') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script>
            alert('Javascript ve Css dosyalarını build ediniz.')
        </script>
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body id="eterna-app">
    @auth
        <div class="container-fluid p-0 d-flex h-100" style="height: 100vh!important;">
            <x-navbar />
            <div class="bg-light flex-fill">
                <div class="p-2 d-md-none d-flex text-white bg-success">
                    <a href="#" class="text-white"
                       data-bs-toggle="offcanvas"
                       data-bs-target="#bdSidebar">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                    <span class="ms-3"><img src="{{ asset('images/eterna-whitelogo.webp') }}" style="width: 4rem" alt=""></span>
                </div>
                <div class="p-4">
                    <div class="row">
                        <div class="col">
                            @yield('content')
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="b-example-divider"></div>
    @else
        @yield('content')
    @endauth

@stack('js')
</body>
</html>
