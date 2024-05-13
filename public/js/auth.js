function openTab(evt, tabName) {
    // Hide all tab content
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Remove the "active" class from all tab buttons
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the selected tab content and set the button as active
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  const inputs = document.querySelectorAll(".otp-field input");

inputs.forEach((input, index) => {
    input.dataset.index = index;
    input.addEventListener("keyup", handleOtp);
    input.addEventListener("paste", handleOnPasteOtp);
});

function handleOtp(e) {
    /**
     * <input type="text" 👉 maxlength="1" />
     * 👉 NOTE: On mobile devices `maxlength` property isn't supported,
     * So we to write our own logic to make it work. 🙂
     */
    const input = e.target;
    let value = input.value;
    let isValidInput = value.match(/[0-9]/gi);
    input.value = "";
    input.value = isValidInput ? value[0] : "";

    let fieldIndex = input.dataset.index;
    if (fieldIndex < inputs.length - 1 && isValidInput) {
        input.nextElementSibling.focus();
    }

    if (e.key === "Backspace" && fieldIndex > 0) {
        input.previousElementSibling.focus();
    }

    if (fieldIndex == inputs.length - 1 && isValidInput) {
        submit();
    }
}

function handleOnPasteOtp(e) {
    const data = e.clipboardData.getData("text");
    const value = data.split("");
    if (value.length === inputs.length) {
        inputs.forEach((input, index) => (input.value = value[index]));
        submit();
    }
}



//--timer otp--
$("#resendOtp").click(function () {
    var time = 60; // Waktu tunggu dalam detik
    var resendButton = $('#resendOtp');
    var timerElement = $('#timer');

    // Fungsi untuk memperbarui waktu pada timer
    var updateTimer = function (seconds) {
        var minutes = Math.floor(seconds / 60);
        var seconds = seconds % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timerElement.text(minutes + ":" + seconds);
    };

    // Fungsi untuk mengatur ulang dan memulai timer
    var startTimer = function (duration) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function () {
            updateTimer(timer);

            if (--timer < 0) {
                clearInterval(interval);
                resendButton.removeClass("disabled")
                timerElement.text("");
            }
        }, 1000);
    };

    // Mengaktifkan timer ketika halaman dimuat
    startTimer(time);

    // Event handler untuk tombol kirim ulang
    resendButton.click(function () {
        resendButton.addClass("disabled");
        startTimer(time); // Memulai timer
    });
    ajaxData();
});

let timerOtp = false;
$(".btnSubmitRegister").click(function () {
    if (timerOtp) {
        // Jika OTP sudah dikirim, hanya lakukan aksi lain (misal buka modal lain)
        return;
    }
    timerOtp = true;
    var time = 60; // Waktu tunggu dalam detik
    var resendButton = $('#resendOtp');
    var timerElement = $('#timer');

    // Fungsi untuk memperbarui waktu pada timer
    var updateTimer = function (seconds) {
        var minutes = Math.floor(seconds / 60);
        var seconds = seconds % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timerElement.text(minutes + ":" + seconds);
    };

    // Fungsi untuk mengatur ulang dan memulai timer
    var startTimer = function (duration) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function () {
            updateTimer(timer);

            if (--timer < 0) {
                clearInterval(interval);
                resendButton.removeClass("disabled")
                timerElement.text("");
            }
        }, 1000);
    };

    // Mengaktifkan timer ketika halaman dimuat
    startTimer(time);

    // Event handler untuk tombol kirim ulang
    resendButton.click(function () {
        resendButton.addClass("disabled")
        startTimer(time); // Memulai timer
    });
});

  