@extends('web.layout.page')
@section('content')

<div class="" id="change-password" class="mx-auto mb-5 d-flex">
    <h2>Ubah Password</h2>
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
<form method="POST" action="{{ route('change-password',$data->id) }}">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="current_password">Password Sekarang</label>
        <input class="form-control" id="current_password" type="password" name="current_password">
        @error('current_password')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password">Password Baru</label>
        <input class="form-control" id="password" type="password" name="password">
        @error('password')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation">Konfirmasi Password Baru</label>
        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
    </div>
    <p style="font-size: 12px;">Pastikan password baru anda mudah diingat.
        <br>Pastikan password baru anda terdiri dari minimal 8 karakter dan terdapat huruf kapital, karakter/simbol, maupun angka.
    </p>
    <button class="btn btn-primary" id="btn-changepassword" type="submit">Simpan</button>
</div>

@endsection