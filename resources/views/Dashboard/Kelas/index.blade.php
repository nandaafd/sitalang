@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Data Kelas
                </div>
                <div class="h5 ms-3">
                    SMKN 1 Labang Bangkalan
                </div>
                <div class="container">
                    {{ Breadcrumbs::render() }}
                </div>
            </div>
            <div class="col-3">
                <img src="{{asset('/images/assets/vector5.jpg')}}" alt="" srcset="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container bg-light py-4 rounded px-4">
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
                <form action="" method="get" id="frmFilter">
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li class="mr-2">
                                    <select name="jurusan" class="form-select form-select-sm" id="filterJurusan">
                                        <option id="default" value="">Pilih jurusan..</option>
                                        <option {{$jurusan=='TKJ' ? 'selected' : ''}} value="TKJ">TKJ / Teknik Komputer Jaringan</option>
                                        <option {{$jurusan=='TEI' ? 'selected' : ''}} value="TEI">TEI / Teknik Elektronika Industri</option>
                                        <option {{$jurusan=='RPL' ? 'selected' : ''}} value="RPL">RPL / Rekayasa Perangkat Lunak</option>
                                        <option {{$jurusan=='AK' ? 'selected' : ''}} value="AK">AK / Akuntansi</option>
                                        <option {{$jurusan=='TBSM' ? 'selected' : ''}} value="TBSM">TBSM / Teknik Bisnis Sepeda Motor</option>
                                        <option {{$jurusan=='TKR' ? 'selected' : ''}} value="TKR">TKR / Teknik Kendaraan Ringan</option>
                                    </select>
                                </li>
                                <li class="mr-2">
                                    <select name="kelas" class="form-select form-select-sm" id="filterKelas">
                                        <option value="">Pilih kelas..</option>
                                        <option {{$kls=='x' ? 'selected' : ''}} value="x">X / Sepuluh</option>
                                        <option {{$kls=='xi' ? 'selected' : ''}} value="xi">XI / Sebelas</option>
                                        <option {{$kls=='xii' ? 'selected' : ''}} value="xii">XII / Dua Belas</option>
                                    </select>
                                </li>
                                <li class="mr-2">
                                    <button class="btn btn-primary btn-sm mr-1" type="submit">Cari</a>
                                        <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('kelas.create')}}" title="Tambah data kelas"><i class="bi bi-plus"></i></a>
            </div>
        </div>
        <div class="">
            @isset($kelas)
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th>No</th>
                        <th class="w-75">Nama Kelas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelas as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->name}}</td>
                            <td>
                                <div class="">
                                    <form action="{{ route('kelas.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                        <a href="{{route('kelas.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
                                    </form>  
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">--Tidak ada data--</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$kelas->links() ?? ''}}
            @endisset
        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('#btnReset').click(function (e) {
            e.preventDefault();
            $('#filterJurusan').val('')
            $('#filterKelas').val('')
            setTimeout(function() {
                $("#frmFilter").off("submit").submit();
            }, 300);
        })
    })
    
</script>
@endsection