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
            <li class="">
                <a href="#"><i class="bi bi-house mr-3"></i> Home</a>
            </li>
            <li class="">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bi bi-people mr-3"></i> User</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Admin</a>
                    </li>
                    <li>
                        <a href="#">Guru</a>
                    </li>
                    <li>
                        <a href="#">Siswa</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="bi bi-list-columns mr-3"></i> Pelanggaran Siswa</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-exclamation-triangle mr-3"></i> Master Pelanggaran</a>
            </li>
            <li>
                <a href="{{url('/dashboard/kelas')}}"><i class="bi bi-door-closed mr-3"></i> Kelas</a>
            </li>
            <li>
                <a href="{{url('/dashboard/kelas')}}"><i class="bi bi-journal-medical mr-3"></i> Sanksi</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-person-workspace mr-3"></i> Role</a>
            </li>
        </ul>

        <div class="row my-3">
            <div class="col">
                <a href="" class="w-100 btn btn-outline-light">Login</a>
            </div>
        </div>
        <div class="footer">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>

      </div>
</nav>