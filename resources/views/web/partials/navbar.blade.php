

<nav class="navbar navbar-expand-lg position-fixed top-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/home')}}"><img src="{{asset('images/logo1.png')}}" alt="" srcset=""></a>
    <button class="navbar-toggler"  id="toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"  id="btn-toggler"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0" id="nav-menu">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#footer">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://smkihyaululumdukun.sch.id" target="blank">Tentang</a>
        </li>
      </ul>
      <div class="btn-group mx-2" id="bahasa">
      <button id="btn-idn" type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{asset('images/indonesia.png')}}" alt="" srcset="">
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Bahasa Indonesia</a></li> 
      </ul>
      </div>
       @if (Auth::user())
          <a href="{{route('profil.show',Auth::user()->id)}}" class="btn btn-primary"  id="btn-profil-nav">Profil</a>
        @else
          <a href="{{url('/login')}}" class="btn btn-primary" id="btn-login-nav">Login</a> 
       @endif
    </div>
  </div>
</nav>
@push('js')

@endpush