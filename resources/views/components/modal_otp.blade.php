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