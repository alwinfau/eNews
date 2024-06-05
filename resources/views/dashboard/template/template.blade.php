<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('judul', 'eNews')</title>

    @include('dashboard.includes.style')
</head>

<body>
    <div id="app">
        {{-- perintah untuk membuat navbar --}}
        @include('dashboard.includes.navbar')

        {{-- perintah untuk membuat content di dalam main --}}
        <main class="py-4">
            @yield('content')

            @include('dashboard.includes.footer')
        </main>
    </div>

    {{-- perintah untuk membuat javascript --}}
    @include('dashboard.includes.script')
    @stack('modal' ?? '')
    @stack('script' ?? '')
</body>

</html>
