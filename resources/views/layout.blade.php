<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

  <a href="{{ route('logout') }}" class="logout">logout</a>
  </header>
  <main>
    <div class="box">
  @yield('content')
  <!-- <button data-route="{{ route('top') }}" class="auth_btn orange top-button">topへ</button> -->
    </div>
  </main>
</body>
@yield('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
</html>