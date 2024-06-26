@extends('auth.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6" id="left">
            {{-- <img class="my-4 mx-4" src="{{asset('images/logo1.png')}}" alt=""> --}}
            <h1 class="mx-4 mt-5" id="tittleAuth">Sitalang</h1>
            <h3 class="mx-4">Halo, Selamat Datang Kembali</h3>
            <h5 id="text" class="mx-4 mb-5">Ayo masuk ke Sitalang sekarang juga!</h5>
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
                    <input type="password" class="form-control mx-4 mb-2" id="password-login" name="password" placeholder="Password" required>
                    <label for="password-login" class="mx-4">Password</label>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{url('forgot-password')}}" class="text-primary mx-4">Lupa password</a>
                </div>
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show mx-2" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <button class="btn btn-lg btn-primary mx-4" id="btn-login" type="submit">Login</button>
                <p id="login-btn" class="text-center my-2">Belum punya akun? <a href="{{url('/register')}}">Buat akun</a></p>
                </form>
        </div>
        <div class="col-sm-6 d-flex justify-content-center align-items-center" id="right" style="height: 100vh">
            <img id="img-left" class="img-fluid" src="{{asset('images/assets/vectorstudent.png')}}" alt="">
        </div>
    </div>
@endsection
