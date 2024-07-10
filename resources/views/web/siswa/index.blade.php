@extends('web.layout.page')
@section('content')
<div class="row">
    <div class="col" id="sitalang-header">
        <div class="row">
          <div class="col-9">
            <div style="font-weight: 600;" class="headerQuote"> "Jika <span style="color:#FF6B00;">keadilan</span> 
                binasa, kehidupan <span style="color:#FF6B00;">manusia</span>  
                  di bumi telah kehilangan maknanya"
            </div>
            <div class="container">
                {{ Breadcrumbs::render() }}
            </div>
          </div>
          <div class="col-3">
            <img id="vector2" class="img-fluid" src="{{asset('images/assets/vector3.png')}}" alt="" srcset="">
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="masterpelanggaran-page" class="">
            <div class="mb-3 pageTittle">Data Siswa</div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('err'))
                <div class="alert alert-danger">
                    {{ session('err') }}
                </div>
            @endif
            @if(session('messageWarning'))
                <div class="col text-center mt-5">
                    {{ session('messageWarning') }}
                </div>  
            @endif
            
            <div class="row mb-3">
                <div class="col-10">
                    <button class="btn btn-outline-primary btnFilterModal" data-bs-toggle="modal" data-bs-target="#modalFilter"><i class="bi bi-funnel"></i></button>
                    <form action="" id="frmFilter" class="frmFilter" method="get">
                        <ul id="filterField">
                            <li class="me-2">
                                <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama siswa..">
                            </li>
                            <li class="me-2">
                                <select name="kelas_id" id="filter_kelas" class="form-select form-select-sm">
                                    <option value="">--pilih kelas--</option>
                                    @forelse ($kelas as $item)
                                        <option value="{{$item->id}}" {{$filkelas == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                    @empty
                                    <option value="">--no data--</option>
                                    @endforelse
                                </select>
                            </li>
                            <li class="me-2">
                                <button class="btn btn-primary btn-sm" type="submit">Cari</a>
                            </li>
                            <li class="me-2">
                                <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="col-2 text-end">
                    {{-- <a class="btn btn-primary" href="{{route('siswa.create')}}" title="Tambah data siswa"><i class="bi bi-plus"></i></a> --}}
                </div>
            </div>
            
            <div class="">
                <div class="table-responsive">
                    @isset($siswa)
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th>No</th>
                                <th class="">Nama</th>
                                <th class="">Email</th>
                                <th class="">Kelas</th>
                                <th class="">No Telpon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="javascript:void" class="btn-detail" data-id="{{$data->id}}">{{$data->user->fullname}}</a></td>
                                    <td>{{$data->user->email}}</td>
                                    <td>{{$data->kelas->name}}</td>
                                    <td>{{$data->no_telp}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">--Tidak ada data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $siswa->links() ?? '' }}
                    @endisset
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" id="frmFilter" method="get">
                <ul id="filterField">
                    <li class="me-2">
                        <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama siswa..">
                    </li>
                    <li class="me-2">
                        <select name="kelas_id" id="filter_kelas" class="form-select form-select-sm">
                            <option value="">--pilih kelas--</option>
                            @forelse ($kelas as $item)
                                <option value="{{$item->id}}" {{$filkelas == $item->id ? 'selected':''}}>{{$item->name}}</option>
                            @empty
                            <option value="">--no data--</option>
                            @endforelse
                        </select>
                    </li>
                    <li class="me-2">
                        <button class="btn btn-primary btn-sm" type="submit">Cari</a>
                    </li>
                    <li class="me-2">
                        <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                    </li>
                </ul>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(".btn-detail").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $('#modal-lg').modal("show");
        $('#modal-lg-label').text("Profil Siswa");
        $('.modal-lg-body').load('/data-siswa/'+id)
    });
    $(document).ready(function(e) {
        $('#btnReset').click(function (e) {
            e.preventDefault();
            $('#filterKategori').val('')
            $('#filterName').val('')
            setTimeout(function() {
                $("#frmFilter").off("submit").submit();
            }, 300);
        })
    })
</script>
@endsection