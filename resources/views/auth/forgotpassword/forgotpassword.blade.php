@extends('auth.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6" id="left">
            {{-- <img class="my-4 mx-4" src="{{asset('images/logo1.png')}}" alt=""> --}}
            <h1 class="mx-4 mt-5" id="tittleAuth">Sitalang</h1>
            <h3 class="mx-4">Lupa password</h3>
            <h5 id="text" class="mx-4 mb-5">Masukkan email anda untuk mereset password</h5>
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
            <form action="{{route('sendMail')}}" method="POST" class="mx-4">
                @method('post')
                @csrf
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn btn-lg btn-primary" id="btn_forgotpass" type="submit">Kirim Email</button>
            </form>
        </div>
        <div class="col-sm-6 d-flex justify-content-center align-items-center" id="right" style="height: 100vh">
            <img id="img-left" class="img-fluid" src="{{asset('images/assets/vectorstudent.png')}}" alt="">
        </div>
    </div>
@endsection
