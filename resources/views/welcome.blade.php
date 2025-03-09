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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        h1, h2, h3 {
            font-weight: 700;
        }

        p {
            font-weight: 400;
        }

    </style>
</head>
<body id="eterna-app" class="bg-body-tertiary">
<main>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-center w-100">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/eterna-darklogo.webp') }}" style="width: 100px" alt="">
                </a>
            </div>
        </div>
    </nav>


</main>
</body>
</html>
