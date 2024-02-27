<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- APP Name --}}
    <title>{{ config('app.name', 'Laranews') }}</title>

    {{-- Fonts --}}
    <link rel="dnsprefetch" href="//fonts.gstatic.com">

    {{-- Font Awsemoe --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    {{-- styles --}}
    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  </head>
<body>
  <div>
    @yield('header')
  </div>
  <div class="flex">
    <div class="w-1/6">
            @yield('sidebar')
    </div>
    <main class="w-full">
      @yield('content')
    </main>
  </div>
  <div>
        @yield('footer')
  </div>

</body>
</html>
