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
        <form action="{{route('guru.store')}}" method="post" id="formAddGuru">
            @method('post')
            @csrf
            <div class="mb-3">
                <label for="range_poin" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" value="{{old('fullname')}}" name="fullname" placeholder="Tuliskan nama lengkap..">
                @error('fullname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Nickname</label>
                <input type="text" class="form-control @error('nickname') is-invalid @enderror" value="{{old('nickname')}}" name="nickname" placeholder="Tuliskan nickname disini..">
                @error('nickname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">NIP</label>
                <input type="number" class="form-control @error('nip') is-invalid @enderror" value="{{old('nip')}}" name="nip" placeholder="Tuliskan nip disini..">
                @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}" name="alamat" placeholder="Tuliskan alamat disini..">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">No Telpon</label>
                <input type="number" class="form-control @error('no_telp') is-invalid @enderror" value="{{old('no_telp')}}" name="no_telp" placeholder="Tuliskan no telp disini..">
                @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Email</label>
                <input type="email" class="form-control email @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" placeholder="Tuliskan email disini..">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Password</label>
                <input type="password" id="password1" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}" name="password" placeholder="Tuliskan password disini..">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="poin" class="form-label">Ulangi Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" value="{{old('confirm_password')}}" name="confirm_password" placeholder="Ulangi password disini..">
                @error('confirm_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btnAddGuru btnSubmitRegister"><i class="bi bi-save"></i> Buat Akun</button>
        </form>
    </div>
</div>
<script>
    $("#formAddGuru").validate({ 
        errorClass: "text-danger is-invalid",
        rules: {
            fullname :{required:true, minlength:3},
            nickname :{required:true, minlength:3},
            nip :{required:true, minlength:3},
            alamat :{required:true, minlength:3},
            no_telp :{required:true, minlength:3},
            email:{email:true, required:true},
            password:{required:true, strongPassword:true},
            confirm_password:{required:true, equalTo:"#password1"}
        },
        messages: {
            fullname :{required:"nama lengkap wajib diisi", minlength:"panjang karakter minimal 3"},
            nickname :{required:"nama panggilan wajib diisi", minlength:"panjang karakter minimal 3"},
            nip :{required:"nip wajib diisi", minlength:"panjang karakter minimal 3"},
            alamat :{required:"alamat wajib diisi", minlength:"panjang karakter minimal 3"},
            no_telp :{required:"no telpon wajib diisi", minlength:"panjang karakter minimal 3"},
            email:{email:"email harus valid", required:"email wajib diisi"},
            password:{required:"password wajib diisi"},
            confirm_password:{required:"confirm password wajib diisi", equalTo:"password tidak sama"}
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

    let email;
    var form;
    var token;
    $(".btnAddGuru").click(function(e){
        e.preventDefault();
        form = $(this).closest('form');
        if ($("#formAddGuru").valid()) {
            ajaxData();
            $("#modalOtp").modal("show");
        }
    })

    //fungsi ajax
    function ajaxData() {
        email = form.find('.email').val();
        token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url:"/send-otp/"+email,
            type:'post',
            data:{_token: token},
            success:function (response) {

                if (response.success) {
                    alert("Kode OTP berhasil terkirim","success","#alertPlaceholder");
                } else {
                    alert("Gagal mengirim kode OTP","danger","#alertPlaceholder");
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while sending email verification code',"danger","#alertPlaceholder");
            }
        })
    }

    $("#btnVerify").click(function(e){
        e.preventDefault()
        submit();
    })

    function submit() {
        // 👇 Entered OTP
        // debugger;
        console.log("msuk");
        let otp = "";
        var token = $('meta[name="csrf-token"]').attr('content');
        inputs.forEach((input) => {
            otp += input.value;
            input.classList.add("disabled");
        });
        $.ajax({
            url:"/verif-otp/"+otp+"/"+email,
            type:'post',
            data:{_token: token},
            dataType:'json',
            success:function (response) {
                if (response.success) {
                    $("#formAddGuru").submit();
                    swal("Good job!", "Verifikasi kode otp berhasil", "success");
                }
                else{
                    alert(response.message,"danger","#alertPlaceholder");
                    inputs.forEach((input) => {
                        input.classList.remove("disabled");
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while sending email verification code');
            }
        });
    }
</script>
@endsection