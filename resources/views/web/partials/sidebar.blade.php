@if (Auth::user())
<div class="sidebar-header">
    <h4 class="mt-4" id="name-sidebar"><span>Halo,</span> {{Auth::user()->fullname}}
        <i class="bi bi-patch-check-fill"></i>
    </h4>
    <p>{{Auth::user()->role->name}}</p>
</div>
@endif
<div class="menu-sidebar mt-5">
<ul class="my-3">
    @if (Auth::user())
    <li><a href="{{route('profile.show',Auth::user()->id)}}"><img src="{{asset('images/ikon/husband.gif')}}" alt="" class="">Pengaturan Akun</a></li>
    @endif
    <li><a href="{{url('/absensi-siswa')}}"><img src="{{asset('images/ikon/fingerprint-scan.gif')}}" alt="" class="">Pelanggaran Siswa</a></li>
    <li><a href="{{url('/logbooks')}}"><img src="{{asset('images/ikon/book.gif')}}" alt="" class="">Lihat Master Sanksi</a></li>
    <li><a href="{{url('/pelanggaran')}}"><img src="{{asset('images/ikon/book.gif')}}" alt="" class="">Lihat Master Pelanggaran</a></li>
    <li><a href="{{url('/nilai-siswa')}}"><img src="{{asset('images/ikon/calendar.gif')}}" alt="" class="">Lihat Data Siswa</a></li>
</ul>
</div>