<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @stack('preloader_css')
        @stack('preloader_js')
        @yield('adminlte_css')
        {{-- Base Meta Tags --}}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Title --}}
        <title>
            @yield('title', config('adminlte.title', 'Invoke Vendas'))
        </title>

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">

        @include('adminlte::plugins', ['type' => 'css'])

    </head>
    <body style="overflow: hidden;" class="@yield('classes_body')" @yield('body_data')>

        {{-- Body Content --}}
        @yield('body')
        {{-- Base Scripts --}}
        @if(!config('adminlte.enabled_laravel_mix'))
            <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
            <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
            <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
        @else
            <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
        @endif

        {{-- Extra Configured Plugins Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])


        {{-- Custom Scripts --}}
        @yield('adminlte_js')

    </body>

</html>
