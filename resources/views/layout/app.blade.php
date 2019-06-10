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
    <link rel="stylesheet" href="{{ asset('./css/app.css') }}" />
    @hasSection ('styles')
      @yield('styles')
    @endif
  </head>
  <body>
    @hasSection ('body')
      @yield('body')
    @endif

    <script src="{{ asset('./js/app.js') }}"></script>
    @hasSection ('scripts')
      @yield('scripts')
    @endif
  </body>
</html>
