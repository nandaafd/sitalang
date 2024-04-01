<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="bi bi-list"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4">
        <h1><a href="index.html" class="logo">Dashboard <span>Sitalang SMKN 1 Labang</span></a></h1>
        <ul class="list-unstyled components mb-5">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{url('dashboard/')}}"><i class="bi bi-house mr-3"></i> Home</a>
            </li>
            <li class="">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-people mr-3"></i> User</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li class="{{ Request::is('dashboard/admin*') ? 'active' : '' }}">
                        <a href="{{route('admin.index')}}">Admin</a>
                    </li>
                    <li class="{{ Request::is('dashboard/guru*') ? 'active' : '' }}">
                        <a href="{{route('guru.index')}}">Guru</a>
                    </li>
                    <li class="{{ Request::is('dashboard/siswa*') ? 'active' : '' }}">
                        <a href="{{route('siswa.index')}}">Siswa</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('dashboard/pelanggaransiswa*') ? 'active' : '' }}">
                <a href="{{route('pelanggaransiswa.index')}}"><i class="bi bi-list-columns mr-3"></i> Pelanggaran Siswa</a>
            </li>
            <li class="{{ Request::is('dashboard/masterpelanggaran*') ? 'active' : '' }}">
                <a href="{{route('masterpelanggaran.index')}}"><i class="bi bi-exclamation-triangle mr-3"></i> Master Pelanggaran</a>
            </li>
            <li class="{{ Request::is('dashboard/kelas*') ? 'active' : '' }}">
                <a href="{{route('kelas.index')}}"><i class="bi bi-door-closed mr-3"></i> Kelas</a>
            </li>
            <li class="{{ Request::is('dashboard/sanksi*') ? 'active' : '' }}"> 
                <a href="{{route('sanksi.index')}}"><i class="bi bi-journal-medical mr-3"></i> Sanksi</a>
            </li>
        </ul>

        <div class="row my-3">
            <div class="col">
                @if (Auth::user())
                    <form action="{{url('/logout')}}" method="POST" class="">
                        @csrf
                        <button type="submit" class="btn btn-outline-light w-75" id="btn-logoutprofil" onclick="return confirm('are you sure?')"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        <a href="javascript:void" data-id="{{Auth::id()}}" class="btn btn-outline-light btnProfile"><i class="bi bi-person"></i></a>
                    </form>
                @else
                    <a href="{{url('/login')}}" class="w-100 btn btn-outline-light">Login</a>
                @endif
            </div>
        </div>
        <div class="footer">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>

      </div>
</nav>
<script>
    $(".btnProfile").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $('#modal-lg').modal("show");
        $('#modal-lg-label').text("Profil Admin");
        $('.modal-lg-body').load('/dashboard/admin/'+id)
    });
</script>