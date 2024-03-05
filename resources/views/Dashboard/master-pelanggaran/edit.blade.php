@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Edit Master Pelanggaran
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

        <form action="{{route('masterpelanggaran.update',$pelanggaran->id)}}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="range_poin" class="form-label">Nama Pelanggaran</label>
                <input type="text" class="form-control @error('nama_pelanggaran') is-invalid @enderror" value="{{$pelanggaran->nama_pelanggaran}}" name="nama_pelanggaran" placeholder="Tuliskan range poin maksimal..">
                @error('nama_pelanggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Poin</label>
                <input type="number" class="form-control @error('name') is-invalid @enderror" value="{{$pelanggaran->poin}}" name="poin" placeholder="Tuliskan sanksi disini..">
                @error('poin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori_id" id="" class="form-select @error('kategori_id') is-invalid @enderror">
                    @foreach ($kategori as $data)
                        <option {{$pelanggaran->kategori_id == $data->id ? 'selected' : ''}} value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Tambah</button>
        </form>
    </div>
</div>
@endsection