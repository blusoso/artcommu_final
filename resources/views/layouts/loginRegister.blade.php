<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body id = "page-login-register">
    <a href="#" class="btn btn-danger m-5">Login</a>
    <div class="container">
      <div class="card">
        <div class="card-body p-5">
          @yield('login-register')
        </div>
      </div>
    </div>
  </body>

  <script src="{{asset('js/app.js')}}"></script>
</html>
