@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="h3">
        Master Data Pelanggaran
    </div>
    <div class="container bg-light py-3 py-5 rounded px-4">
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
                    <div class="row">
                        <div class="col">
                            <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari sanksi..">
                        </div>
                        <div class="col">
                            <select name="kategori_id" id="filterKategori" class="form-control form-control-sm">
                                <option value="">--pilih kategori--</option>
                                @foreach ($kategori as $item)
                                    <option {{$kat == $item->id ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary btn-sm mr-1" type="submit">Cari</a>
                            <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('masterpelanggaran.create')}}" title="Tambah data sanksi"><i class="bi bi-plus"></i></a>
            </div>
        </div>
        <div class="">
            @isset($pelanggaran)
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th>No</th>
                        <th class="w-50">Nama Pelanggaran</th>
                        <th class="">Poin</th>
                        <th class="">Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggaran as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama_pelanggaran}}</td>
                            <td>{{$data->poin}}</td>
                            <td>{{$data->Kategori->name}}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('masterpelanggaran.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                      </form>  
                                      <a href="{{route('masterpelanggaran.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">--Tidak ada data--</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $pelanggaran->links() ?? '' }}
            @endisset
        </div>
    </div>
</div>
<script>
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