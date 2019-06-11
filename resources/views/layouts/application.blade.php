<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
      Poppest :: The Most Popular Repositories in GitHub
    </title>
    @section('styles')
      <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
      <link rel="stylesheet" href="{{ asset('css/libs.css') }}" />
      <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    @show
  </head>
  <body>

    @hasSection ('body')
      @yield('body')
    @endif

    @section('scripts')
      <script src="{{ asset('js/libs.js') }}"></script>
      <script src="{{ asset('js/scripts.js') }}"></script>
    @show
  </body>
</html>
