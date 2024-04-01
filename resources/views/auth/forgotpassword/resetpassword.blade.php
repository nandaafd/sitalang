@extends('auth.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6" id="left">
            {{-- <img class="my-4 mx-4" src="{{asset('images/logo1.png')}}" alt=""> --}}
            <h1 class="mx-4 mt-5" id="tittleAuth">Sitalang</h1>
            <h3 class="mx-4">Reset password</h3>
            <h5 id="text" class="mx-4 mb-5">Masukkan password baru anda!</h5>
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
            <form action="{{route('ForgotPassword',$id)}}" method="POST" class="mx-3" id="formResetPassword">
                @method('put')
                @csrf
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
                <button class="btn btn-lg btn-primary" id="btnResetPassword" type="submit">Konfirmasi</button>
            </form>
        </div>
        <div class="col-sm-6 d-flex justify-content-center align-items-center" id="right" style="height: 100vh">
            <img id="img-left" class="img-fluid" src="{{asset('images/assets/vectorstudent.png')}}" alt="">
        </div>
    </div>
    <script>
        $("#formResetPassword").validate({ 
        errorClass: "text-danger is-invalid",
        rules: {
            password:{required:true, strongPassword:true},
            password_confirmation:{required:true, equalTo:"#password"}
        },
        messages: {
            password:{required:"password wajib diisi"},
            password_confirmation:{required:"confirm password wajib diisi", equalTo:"password tidak sama"}
        }
    });
    //validate password
    $.validator.addMethod("strongPassword",
        function (value, el) {
            return (/^(?=.*\d)(?=.*[!@@#$%^&*])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/.test(value));
        },
        function (checkRes, el) {
            let pass = $(el).val();
            let txtAlert = "";
            if (!(/^(?=.*[A-Z])/.test(pass))) {
                txtAlert += "password setidaknya harus mengandung satu huruf besar<br>";
            }
            if (!(/^(?=.*[a-z])/.test(pass))) {
                txtAlert += "password setidaknya harus mengandung satu huruf kecil<br>";
            }
            if (!(/^(?=.*[0-9])/.test(pass))) {
                txtAlert += "password setidaknya harus mengandung satu angka<br>";
            }
            if (!(/^(?=.*[!@@#$%^&*])/.test(pass))) {
                txtAlert += "password setidaknya harus mengandung satu karakter spesial<br>";
            }
            if (!(/^(?=.{8,20})/.test(pass))) {
                txtAlert += "password harus terdiri dari 8-20 karakter<br>";
            }

            if (txtAlert == "") {
                return false;
            }
            else {
                return txtAlert;
            }
        }
    );

    $("#btnResetPassword").click(function (e) {
        e.preventDefault();
        if ($("#formResetPassword").valid()) {
            $("#formResetPassword").submit();
        }
    });
    </script>
@endsection
