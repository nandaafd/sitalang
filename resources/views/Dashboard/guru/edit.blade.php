@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Tambah Data Guru
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
        <form action="{{route('guru.update',$data->id)}}" method="post" id="formAddGuru">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="range_poin" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" value="{{$data->user->fullname}}" name="fullname" placeholder="Tuliskan nama lengkap..">
                @error('fullname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Nickname</label>
                <input type="text" class="form-control @error('nickname') is-invalid @enderror" value="{{$data->user->nickname}}" name="nickname" placeholder="Tuliskan nickname disini..">
                @error('nickname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">NIP</label>
                <input type="number" class="form-control @error('nip') is-invalid @enderror" value="{{$data->nip}}" name="nip" placeholder="Tuliskan nip disini..">
                @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{$data->alamat}}" name="alamat" placeholder="Tuliskan alamat disini..">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">No Telpon</label>
                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" value="{{$data->no_telp}}" name="no_telp" placeholder="Tuliskan no telp disini..">
                @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary btnAddGuru"><i class="bi bi-save"></i> Simpan</button>
        </form>
    </div>
</div>

@endsection