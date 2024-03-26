@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Data Siswa
                </div>
                <div class="h5 ms-3">
                    SMKN 1 Labang Bangkalan
                </div>
                <div class="container">
                    {{ Breadcrumbs::render() }}
                </div>
            </div>
            <div class="col-3">
                <img src="{{asset('/images/assets/vector1.png')}}" alt="" srcset="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container bg-light py-3 rounded px-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('err'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-10">
                <form action="" id="frmFilter" method="get">
                    <ul id="filterField">
                        <li class="mr-2">
                            <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama admin..">
                        </li>
                        <li class="mr-2">
                            <button class="btn btn-primary btn-sm" type="submit">Cari</a>
                        </li>
                        <li class="mr-2">
                            <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('siswa.create')}}" title="Tambah data pelanggaran siswa"><i class="bi bi-plus"></i></a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($guru as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->user->fullname}}</td>
                                <td>{{$data->user->email}}</td>
                                <td>{{$data->nip}}</td>
                                <td>
                                    <div class="dropdown" id="dropdownMore">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <form action="{{ route('guru.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill mr-2"></i> Hapus</button>
                                              </form>
                                          </li>
                                          <li><a href="{{route('guru.edit', $data->id)}}" class="dropdown-item text-success" title="edit"><i class="bi bi-pencil mr-2"></i> Edit</a></li>
                                          <li><a href="{{route('guru.show', $data->id)}}" class="dropdown-item text-primary" title="detail"><i class="bi bi-card-list mr-2"></i> Lihat Detail</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">--Tidak ada data--</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $guru->links() ?? '' }}
                @endisset
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('#btnReset').click(function (e) {
            e.preventDefault();
            $('#filterKategori').val('')
            $('#filterPelanggaran').val('')
            $('#filterName').val('')
            setTimeout(function() {
                $("#frmFilter").off("submit").submit();
            }, 300);
        })
    })
</script>
@endsection