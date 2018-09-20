<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="language" content="{{ App::getLocale() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ $title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('/dist/css/app.min.css') }}">
</head>
<body class="bg-light">
<main>
  <div id="wrapper">
    @include('partials.header')
    <div class="container">
      @yield('content')
    </div>
  </div>
</main>
</body>
<script src="{{ asset('dist/js/app.js') }}"></script>
</html>