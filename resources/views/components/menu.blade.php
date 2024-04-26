<div class="modal fade" id="modal-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal-lg-label">Menu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-menu-body">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                      <div class="mx-auto py-1">
                        <a href="{{url('/daftar-prakerin')}}" id="menu-ikon" class="text-center mx-auto">
                            <img src="{{asset('images/assets/icons/prisoner.gif')}}" alt="" class="ikon-daftar">
                            <p>Pelanggaran Siswa</p>
                        </a>
                    </div>
                    </div>
                    <div class="col">
                      <div class="mx-auto py-1">
                        <a href="{{url('/pelanggaran')}}" id="menu-ikon" class="text-center mx-auto">
                            <img src="{{asset('images/assets/icons/folder.gif')}}" alt="" class="ikon-daftar">
                            <p>Master Pelanggaran</p>
                        </a>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mx-auto py-1">
                        <a href="{{url('/absensi-siswa')}}" id="menu-ikon" class="text-center mx-auto">
                            <img src="{{asset('images/assets/icons/curriculum.gif')}}" alt="" class="ikon-daftar">
                            <p>Master Sanksi</p>
                        </a>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mx-auto py-1">
                        <a href="{{url('/berita')}}" id="menu-ikon" class="text-center mx-auto">
                            <img src="{{asset('images/assets/icons/contacts.gif')}}" alt="" class="ikon-daftar ">
                            <p>Kontak</p>
                        </a>
                      </div>
                    </div>
                    <div class="col">
                      <div class="mx-auto py-1">
                        <a href="{{url('/mitra')}}" id="menu-ikon" class="text-center mx-auto">
                            <img src="{{asset('images/assets/icons/information.gif')}}" alt="" class="ikon-daftar ">
                            <p>Informasi</p>
                        </a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>

