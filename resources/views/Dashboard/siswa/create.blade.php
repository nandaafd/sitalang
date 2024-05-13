@extends('dashboard.layout.main')
@section('content') 
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Tambah Data Siswa
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
        <form action="{{route('siswa.store')}}" method="post" id="formAddSiswa">
            @method('post')
            @csrf
            <div class="mb-3">
                <input type="text" placeholder="Nama Lengkap" class="form-control  @error('fullname') is-invalid @enderror" id="" name="fullname" value="{{old('fullname')}}">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control  @error('nickname') is-invalid @enderror" placeholder="Nama Panggilan" id="nama_panggilan" name="nickname" value="{{old('nickname')}}">
              </div>
              <div class="mb-3 row">
                <div class="col-6">
                    <div class="radio-item text-center">
                        <input name="jenis_kelamin" id="radio1" type="radio" value="pria">
                        <label for="radio1"><img src="{{asset('images/assets/male.png')}}" alt="" srcset="" style="max-width: 50px;"><br> Pria</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="radio-item text-center">
                        <input name="jenis_kelamin" id="radio2" type="radio" value="wanita">
                        <label for="radio2"><img src="{{asset('images/assets/female.png')}}" alt="" srcset="" style="max-width: 50px;"><br> Wanita</label>
                    </div>
                </div>
              </div>
              <div class="mb-3">
                <select class="form-control form-control-lg @error('kelas_id') is-invalid @enderror" id="" aria-label="Default select example" name="kelas_id" style="font-size: 17px">
                    <option value="">Pilih kelas..</option>
                    @foreach ($kelas as $kls)
                        <option value="{{$kls->id}}">{{$kls->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="mb-3">
                <input type="text" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" name="alamat" value="{{old('alamat')}}">
              </div>
              <div class="mb-3 row">
                <div class="col">
                    <div class="">
                        <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="{{old('tempat_lahir')}}">
                      </div>
                </div>
                <div class="col">
                    <div class="">
                        <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Tanggal lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}">
                      </div>
                </div>
              </div>
              <div class="mb-3">
                <input type="number" class="form-control  @error('no_telpon') is-invalid @enderror" id="no_telpon" placeholder="No Telpon" name="no_telp" value="{{old('no_telp')}}">
              </div>
              <div class="mb-3 row">
                <div class="col">
                    <div class="">
                        <input type="text" class="form-control  @error('nama_ortu') is-invalid @enderror" id="tempat_lahir" placeholder="Nama ortu" name="nama_ortu" value="{{old('nama_ortu')}}">
                      </div>
                </div>
                <div class="col">
                    <div class="">
                        <input type="number" class="form-control  @error('telp_ortu') is-invalid @enderror" id="telp_ortu" placeholder="Telp Ortu" name="telp_ortu" value="{{old('telp_ortu')}}">
                      </div>
                </div>
              </div>
              <div class="mb-3">
                <input type="email" class="form-control  @error('email') is-invalid @enderror email" id="email" placeholder="Email" name="email" value="{{old('email')}}">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control password @error('password') is-invalid @enderror" id="password2" placeholder="Password" name="password" value="">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirm Password" name="confirm_password" value="">
              </div>
            <button type="submit" class="btn btn-primary btnAddSiswa btnSubmitRegister"><i class="bi bi-save"></i> Buat Akun</button>
        </form>
    </div>
</div>
<script>
    $("#formAddSiswa").validate({ 
        errorClass: "text-danger is-invalid",
        rules: {
            fullname :{required:true, minlength:3},
            nickname :{required:true, minlength:3},
            kelas_id:"required",
            alamat:"required",
            tempat_lahir:"required",
            tanggal_lahir:"required",
            no_telp:"required",
            email:{email:true, required:true},
            password:{required:true, strongPassword:true},
            confirm_password:{required:true, equalTo:"#password2"}
        },
        messages: {
            fullname :{required:"nama lengkap wajib diisi", minlength:"panjang karakter minimal 3"},
            nickname :{required:"nama panggilan wajib diisi", minlength:"panjang karakter minimal 3"},
            kelas_id:"kelas wajib diisi",
            alamat:"alamat wajib diisi",
            tempat_lahir:"tempat lahir wajib diisi",
            tanggal_lahir:"tanggal lahir wajib diisi",
            no_telp:"no telp wajib diisi",
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
    $(".btnAddSiswa").click(function(e){
        e.preventDefault();
        form = $(this).closest('form');
        if ($("#formAddSiswa").valid()) {
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
                    $("#formAddSiswa").submit();
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