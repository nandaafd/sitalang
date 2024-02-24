@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="h3">
        Tambah Data Pelanggaran Siswa
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
        <form action="{{route('pelanggaransiswa.store')}}" method="post">
            @method('post')
            @csrf
            <input type="hidden" name="user_id" value="1">
            <div class="mb-3">
                <label for="siswa_id" class="form-label">Nama Siswa</label>
                <select name="siswa_id" id="" class="form-select @error('siswa_id') is-invalid @enderror">
                    <option value="">Pilih siswa</option>
                    @foreach($siswa as $key => $value)
                        <option value="{{$value->id}}">{{$value->user->fullname}}</option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal')}}" name="tanggal">
                @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pelanggaran_id" class="form-label">Pelanggaran</label>
                <select name="pelanggaran_id" id="" class="form-select @error('pelanggaran_id') is-invalid @enderror">
                    <option value="">Pilih Pelanggaran</option>
                    @foreach ($pelanggaran as $data)
                        <option value="{{$data->id}}">{{$data->nama_pelanggaran}}</option>
                    @endforeach
                </select>
                @error('pelanggaran_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sanksi_id" class="form-label">Sanksi</label>
                <select name="sanksi_id" id="" class="form-select @error('sanksi_id') is-invalid @enderror">
                    <option value="">Pilih Sanksi</option>
                    @foreach ($sanksi as $data)
                        <option value="{{$data->id}}">{{$data->sanksi}}</option>
                    @endforeach
                </select>
                @error('sanksi_id')
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