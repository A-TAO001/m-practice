<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <!-- <style>
    *{
      outline:1px solid #ff0000; }
  </style> -->
</head>
<body>
  <header>
  </header>
  <main>
    <div class="box">
  @yield('content')
    </div>
  </main>
</body>
@yield('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
</html>