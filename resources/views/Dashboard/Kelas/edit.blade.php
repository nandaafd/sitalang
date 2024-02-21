@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="h3">
        Edit Data Kelas
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
        <form action="{{route('kelas.update',$data->id)}}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
                <input type="hidden" name="id" value="{{$data->id}}" id="">
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$data->name}}" name="name" placeholder="X-TKJ-1">
                @error('name')
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