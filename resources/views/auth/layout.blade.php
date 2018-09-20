<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="language" content="{{ App::getLocale() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('dist/css/app.min.css') }}">
</head>
<body class="bg-light">
<div class="auth-content">
  <div class="container-fluid">
    @yield('content')
    <p class="text-center small mt-2">
      <a href="{{ route('home') }}" class="text-muted">Go Back To Movies Page</a>
    </p>
  </div>
</div>
</body>
</html>