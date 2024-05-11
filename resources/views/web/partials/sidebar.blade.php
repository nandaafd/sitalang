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
    <li><a href="{{route('profile.show',Auth::user()->id)}}"><img src="{{asset('images/assets/icons/management-consulting.gif')}}" alt="" class="">Pengaturan Akun</a></li>
    @endif
    <li><a href="{{url('/pelanggaransiswa')}}"><img src="{{asset('images/assets/icons/prisoner.gif')}}" alt="" class="">Pelanggaran Siswa</a></li>
    <li><a href="{{url('/sanksi')}}"><img src="{{asset('images/assets/icons/curriculum.gif')}}" alt="" class="">Lihat Master Sanksi</a></li>
    <li><a href="{{url('/pelanggaran')}}"><img src="{{asset('images/assets/icons/folder.gif')}}" alt="" class="">Lihat Master Pelanggaran</a></li>
    @can('guru')
        <li><a href="{{url('/siswa')}}"><img src="{{asset('images/assets/icons/groom.gif')}}" alt="" class="">Lihat Data Siswa</a></li>
    @endcan
</ul>
</div>