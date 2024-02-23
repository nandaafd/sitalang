@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="h3">
        Master Data Sanksi
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
                <form action="" method="get">
                    <div class="row">
                        <div class="input-group w-50">
                            <input type="text" name="filter" class="form-control form-control-sm" value="{{$filter}}" id="" placeholder="Cari sanksi..">
                            <button class="btn btn-primary btn-sm mr-1" type="submit"><i class="bi bi-search"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('sanksi.create')}}" title="Tambah data sanksi"><i class="bi bi-plus"></i></a>
            </div>
        </div>
        <div class="">
            @isset($sanksi)
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th>No</th>
                        <th class="">Range Poin</th>
                        <th class="w-50">Sanksi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sanksi as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->range_poin}}</td>
                            <td>{{$data->sanksi}}</td>
                            <td>
                                <div class="btn-group">
                                    <form action="{{ route('sanksi.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                      </form>  
                                      <a href="{{route('sanksi.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
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
            {{ $sanksi->links() ?? '' }}
            @endisset
        </div>
    </div>
</div>
@endsection