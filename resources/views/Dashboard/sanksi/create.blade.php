@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="h3">
        Tambah Data Sanksi
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
        <form action="{{route('sanksi.store')}}" method="post">
            @method('post')
            @csrf
            <div class="mb-3">
                <label for="range_poin" class="form-label">Pada Poin</label>
                <input type="number" class="form-control @error('range_poin') is-invalid @enderror" value="{{old('range_poin')}}" name="range_poin" placeholder="Tuliskan range poin maksimal..">
                @error('range_poin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sanksi" class="form-label">Sanksi</label>
                <input type="text" class="form-control @error('sanksi') is-invalid @enderror" value="{{old('sanksi')}}" name="sanksi" placeholder="Tuliskan sanksi disini..">
                @error('sanksi')
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