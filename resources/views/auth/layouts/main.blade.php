<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sitalang</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
    <link rel="shortcut icon" href="{{asset('images/logo/logobtx.png')}}" type="image/x-icon">  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('js/alert.js')}}"></script>
</head>
<body>
<div class="cursor-1"></div>
<div class="cursor-2"></div>
<div id="menu-bars" class="fas fa-bars"></div>
    
<header>
</header>

<section class="service" id="service"> 
@yield('content')
</section>

<footer>
    {{-- @include('footer.footer') --}}
</footer>

    <script src="{{ asset('/js/auth.js') }}"></script>
    <script>
        function btnConfirmLogout() {
          let text = "Are you sure?";
          if (confirm(text) == true) {
            return true;
          } else {
            return false;
          }
          document.getElementById("demo").innerHTML = text;
        }
        function showPassword() {
          var x = document.getElementById("password");
          var y = document.getElementById("password_confirmation");
          var z = document.getElementById("current_password");
          if (x.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
          } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
          }
        }
  
        function showPassword() {
          var x = document.getElementById("password");
          var y = document.getElementById("password_confirmation");
          var z = document.getElementById("current_password");
          if (x.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
          } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
          }
        }
        </script>
@stack('js')
</body>
</html>