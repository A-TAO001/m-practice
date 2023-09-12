<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>