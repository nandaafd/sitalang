@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="h3">
        Tambah Data Master Pelanggaran
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
        <form action="{{route('masterpelanggaran.store')}}" method="post">
            @method('post')
            @csrf
            <div class="mb-3">
                <label for="range_poin" class="form-label">Nama Pelanggaran</label>
                <input type="text" class="form-control @error('nama_pelanggaran') is-invalid @enderror" value="{{old('nama_pelanggaran')}}" name="nama_pelanggaran" placeholder="Tuliskan nama pelanggaran..">
                @error('nama_pelanggaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Poin</label>
                <input type="number" class="form-control @error('poin') is-invalid @enderror" value="{{old('poin')}}" name="poin" placeholder="Tuliskan poin disini..">
                @error('poin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori_id" id="" class="form-select @error('kategori_id') is-invalid @enderror">
                    <option value="">--Pilih Kategori--</option>
                    @foreach ($kategori as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
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