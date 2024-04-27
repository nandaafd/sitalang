

<nav class="navbar navbar-expand-lg position-fixed top-0">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{url('/home')}}">
      <img src="{{asset('images/assets/sitalang_biru.png')}}" alt="" srcset="" id="navbar-logo" class="img-fluid logo_biru">
      <img src="{{asset('images/assets/sitalang_putih.png')}}" alt="" srcset="" id="navbar-logo" class="img-fluid logo_putih d-none">
    </a>
    <button class="navbar-toggler"  id="toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"  id="btn-toggler"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0" id="nav-menu">
        <li class="nav-item">
          <a class="nav-link nav-menu" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-menu" id="btn-menu" href="javascript:void">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-menu" href="https://smkihyaululumdukun.sch.id" target="blank">Tentang</a>
        </li>
      </ul>
      
       @if (Auth::user())
          <a href="{{route('profile.show',Auth::user()->id)}}" class="btn btn-primary"  id="btn-profil-nav">Profil</a>
        @else
          <a href="{{url('/login')}}" class="btn btn-primary" id="btn-login-nav">Login</a> 
       @endif
    </div>
  </div>
</nav>
<script>
  $('#btn-menu').click(function(){
    $("#modal-menu").modal("show");
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 50) { // Jika posisi scroll lebih dari 50px dari atas
        $(".navbar").css("background-color", "#0064D3");
        $(".nav-menu").css("color", "white");
        $(".logo_putih").removeClass("d-none");
        $(".logo_biru").addClass("d-none");
    } else {
        $(".navbar").css("background-color", ""); // Kembalikan ke warna aslinya
        $(".nav-menu").css("color", "black");
        $(".logo_putih").addClass("d-none");
        $(".logo_biru").removeClass("d-none");
    }
});
</script>
@push('js')

@endpush