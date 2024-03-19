@extends('auth.layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-6" id="left">
            <h1 class="mx-4 mt-5" id="tittleAuth">Sitalang</h1>
            <h2 class="mx-4">Halo, Selamat Datang</h2>
            <h5 id="text" class="mx-4 mb-5">Ayo buat akunmu sekarang juga!</h5>
            <h4 class="mx-4 mb-2">Register</h4>
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
            <p id="text2" class="mx-4 ">Pilih sebagai siapa anda mendaftar</p>
            <div class="nav tab mx-4 btn-group">
                <button class="nav-link tablinks btn btn-outline-primary" onclick="openTab(event, 'tab1')">Guru</button>
                <button class="nav-link tablinks btn btn-outline-primary" onclick="openTab(event, 'tab2')">Siswa</button>
              </div>
              
              <div id="tab1" class="tabcontent">
                <p>Anda mendaftar sebagai guru</p>
                <form action="{{route('register-store')}}" method="post" id="formGuru" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="text" hidden name="role" id="role" value="2">
                    <input type="text" hidden name="guru" value="guru">
                    <div class="mb-3 row">
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('fullname') is-invalid @enderror" id="fullname" placeholder="Nama lengkap" name="fullname" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('nickname') is-invalid @enderror" id="nickname" placeholder="Nama Panggilan" name="nickname" value="">
                              </div>
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('nip') is-invalid @enderror" id="nip" placeholder="NIP" name="nip" value="">
                              </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="No Telp" name="no_telp" value="">
                              </div>
                        </div>
                      </div>
                      <div class="mb-3">
                          <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="" placeholder="Alamat" name="alamat" value="">
                    </div>

                      <div class="mb-3">
                          <input type="email" class="form-control @error('email') is-invalid @enderror email" id="email" placeholder="Email" name="email" value="">
                      </div>
                      <div class="mb-3">
                          <input type="password" class="form-control password @error('password') is-invalid @enderror" id="password1" placeholder="Password" name="password" value="">
                      </div>
                      <div class="mb-3">
                          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirm Password" name="confirm_password" value="">
                      </div>

                      @if(session('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                      @endif    
                      <button class="btn btn-primary mt-3 btnSubmitRegister" style="" data-name="guru">Daftar</button>
                  </form>
                  <p id="login-btn" class="text-center my-2">Sudah punya akun? <a href="{{url('/login')}}">Login</a></p>
              </div>
              
              {{-- SISWA --}}
              <div id="tab2" class="tabcontent">
                <p>Anda mendaftar sebagai siswa</p>
                <form action="{{route('register-store')}}" id="formSiswa" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <input type="text" hidden name="role" id="role" value="4">
                    <input type="text" hidden name="siswa" value="siswa">
                    <div class="mb-3">
                        <input type="text" placeholder="Nama Lengkap" class="form-control  @error('fullname') is-invalid @enderror" id="" name="fullname" value="">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control  @error('nickname') is-invalid @enderror" placeholder="Nama Panggilan" id="nama_panggilan" name="nickname" value="">
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
                        <input type="text" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" name="alamat" value="">
                      </div>
                      <div class="mb-3 row">
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Tempat lahir" name="tempat_lahir" value="">
                              </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" placeholder="Tanggal lahir" name="tanggal_lahir" value="">
                              </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <input type="number" class="form-control  @error('no_telpon') is-invalid @enderror" id="no_telpon" placeholder="No Telpon" name="no_telp" value="">
                      </div>
                      <div class="mb-3 row">
                        <div class="col">
                            <div class="">
                                <input type="text" class="form-control  @error('nama_ortu') is-invalid @enderror" id="tempat_lahir" placeholder="Nama ortu" name="nama_ortu" value="">
                              </div>
                        </div>
                        <div class="col">
                            <div class="">
                                <input type="number" class="form-control  @error('telp_ortu') is-invalid @enderror" id="telp_ortu" placeholder="Telp Ortu" name="telp_ortu" value="">
                              </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror email" id="email" placeholder="Email" name="email" value="">
                      </div>
                      <div class="mb-3">
                        <input type="password" class="form-control password @error('password') is-invalid @enderror" id="password2" placeholder="Password" name="password" value="">
                      </div>
                      <div class="mb-3">
                        <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirm Password" name="confirm_password" value="">
                      </div>

                      @if(session('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                      @endif    
                      <button class="btn btn-primary btnSubmitRegister mt-3" data-name="siswa" style="">Daftar</button>
                  </form>
                  <p id="login-btn" class="text-center my-2">Sudah punya akun? <a href="{{url('/login')}}">Login</a></p>
              </div>

        </div>
        <div class="col-sm-6 d-flex justify-content-center align-items-center" id="right" style="height: 100vh">
            <img id="img-left" class="img-fluid" src="{{asset('images/assets/vectorstudent.png')}}" alt="">
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="modalOtp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Email</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center ">
            <div id="alertPlaceholder"></div>
            <div class="img-fluid">
                <img src="{{asset('images/assets/password.jpg')}}" class="img-fluid" style="max-width: 400px" alt="" srcset="">
            </div>
            <div class="mb-3 fw-bold">
                Masukkan kode OTP yang dikirimkan ke email anda
            </div>
            <div class="otp-field d-flex justify-content-center mb-3">
                <input type="text" class="form-control" maxlength="1" />
                <input type="text" class="form-control" maxlength="1" />
                <input type="text" class="form-control" maxlength="1" />
                <input type="text" class="form-control" maxlength="1" />
                <input type="text" class="form-control" maxlength="1" />
                <input type="text" class="form-control" maxlength="1" />
            </div>
            <div class="d-flex justify-content-center">
                <a id="resendOtp" class="btn btnSendOtp disabled" style="border: none">Kirim ulang kode OTP <span id="timer"></span></a>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnVerify" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    //validasi
    $("#formSiswa").validate({ 
        errorClass: "text-danger",
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
    $("#formGuru").validate({ 
        errorClass: "text-danger",
        rules: {
            fullname :{required:true, minlength:3},
            nickname :{required:true, minlength:3},
            nip:"required",
            alamat:"required",
            no_telp:"required",
            email:{email:true, required:true},
            password:{required:true, strongPassword:true},
            confirm_password:{required:true, equalTo:"#password1"}
        },
        messages: {
            fullname :{required:"nama lengkap wajib diisi", minlength:"panjang karakter minimal 3"},
            nickname :{required:"nama panggilan wajib diisi", minlength:"panjang karakter minimal 3"},
            nip:"nip wajib diisi",
            alamat:"alamat wajib diisi",
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

    var jenis;
    let email;
    var form;
    var token;
    $(".btnSubmitRegister").click(function(e){
        e.preventDefault();
        jenis = $(this).data("name");
        form = $(this).closest('form');
        if (jenis == "siswa") {
            if ($("#formSiswa").valid()) {
                ajaxData();
                $("#modalOtp").modal("show");
            }
        }
        else if(jenis == "guru"){
            if ($("#formGuru").valid()) {
                ajaxData();
                $("#modalOtp").modal("show");
            }
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
                    
                    if (jenis == "siswa") {
                    $("#formSiswa").submit();
                    }
                    else if(jenis == "guru"){
                        $("#formGuru").submit();
                    }
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
    $(".nav-link").click(function(){
        $("#right").removeAttr("style")
    })
    //validation

  </script>
@endsection