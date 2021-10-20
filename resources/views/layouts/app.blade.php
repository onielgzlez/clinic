<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{
    Metronic::printClasses('html') }}>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title Section --}}
    <x-title>@yield('title', $title ?? '')</x-title>    

    {{-- Meta Data --}}
    <meta name="description" content="@yield('title', $title ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Fonts -->
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet"
        type="text/css" />
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet"
        type="text/css" />
    @endforeach

    {{-- Includable CSS --}}
    @yield('styles')
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>
    @if (config('layout.page-loader.type') != '')
        @include('layouts.partials._page-loader')
    @endif
    <div class="min-h-screen bg-gray-100">       
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        var HOST_URL = "/";
    </script>

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
    </script>

    {{-- Global Theme JS Bundle (used by all pages) --}}
    @foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Includable JS --}}
    @yield('scripts')
</body>

</html>