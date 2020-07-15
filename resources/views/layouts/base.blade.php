<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap の イン ポート-->
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
</head>
<body>
  @section('main')
    <p>既定のコンテンツです。</p>
  @show

  <hr/><p>Copyright(c)1998-2019, All Right Reserved.</p>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>