@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="h3">
        Master Data Kelas
    </div>
    <div class="container bg-light py-3 py-5 rounded px-4">
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
        <div class="row mb-3">
            <div class="col-10">
                <form action="" method="post">
                    @method('post')
                    <div class="row">
                        <div class="col">
                            <input class="form-control form-control-sm" placeholder="cari nama kelas.." type="text" name="name" id="filterName" value="">
                        </div>
                        <div class="col">
                            <select name="jurusan" class="form-select form-select-sm" id="filterJurusan">
                                <option value="">Pilih jurusan</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col">
                            <select name="kelas" class="form-select form-select-sm" id="filterKelas">
                                <option value="">Pilih kelas</option>
                            </select>
                        </div>
                        <div class="col">
                            <a class="btn btn-primary btn-sm" href="">Cari</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('kelas.create')}}" title="Tambah data kelas"><i class="bi bi-plus"></i></a>
            </div>
        </div>
        <div class="">
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
                                <div class="btn-group">
                                    <form action="{{ route('kelas.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                      </form>  
                                      <a href="{{route('kelas.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
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
        </div>
    </div>
</div>
@endsection