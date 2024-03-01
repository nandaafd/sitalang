@extends('auth.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6" id="left">
            <img class="my-4 mx-4" src="{{asset('images/logo1.png')}}" alt="">
            <h2 class="mx-4">Halo, Selamat Datang Kembali</h2>
            <h5 id="text" class="mx-4 mb-5">Ayo masuk ke siprakerin sekarang juga!</h5>
           <h3 class="mx-4 mb-2">Login</h3>
            <form action="/login" method="POST">
                @csrf
                <div class="form-floating">
                    <input type="email" class="form-control mx-4 @error('email')
                        is-invalid
                    @enderror" placeholder="Email" name="email" id="email-login" autofocus required value="{{ old('email') }}">
                    <label for="email-login" class="mx-4">Username/Email</label>
                </div>
                <div class="form-floating mt-2">
                    <input type="password" class="form-control mx-4" id="password-login" name="password" placeholder="Password" required>
                    <label for="password-login" class="mx-4">Password</label>
                    {{-- <input class="my-3 mb-4" type="checkbox" onclick="showPassword()" id="show-password"> Show Password --}}
                </div>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <button class="btn btn-lg btn-primary mx-4" id="btn-login" type="submit">Login</button>
                <p id="login-btn" class="text-center my-2">Belum punya akun? <a href="{{url('/register')}}">Buat akun</a></p>
                </form>
        </div>
        <div class="col-sm-6" id="right">
            <img id="img-left" class="start-0" src="{{asset('images/kanan1.png')}}" alt="">
        </div>
    </div>
@endsection
