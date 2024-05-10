<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sitalang</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{asset('css/web/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/web/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/web/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/web/page.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body id="body">
    @include('web.partials.navbar')
    <div class="content-wrapper">
        <div id="page">
            <div class="row">
                <div class="col-sm-3" id="sidebar">
                    @include('web.partials.sidebar')
                </div>
                <div class="col-sm-9">
                    <section class="content">
                        @yield('content')
                    </section>
                </div>
            </div> 
        </div>       
    </div>
    @component('components.modal_lg')
        @include('components.modal_lg')
    @endcomponent
    @component('components.modal_md')
        @include('components.modal_md')
    @endcomponent
    @include('components.menu')
    <footer class="main-footer">
        @include('web.partials.footer')
    </footer>
    <script src="{{ asset('/js/auth.js') }}"></script>

    @stack('js')
  </body>
</html>