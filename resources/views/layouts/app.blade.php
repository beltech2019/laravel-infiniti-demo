<html lang="en">

<head>
    <title>{{ __('message2.TITLE_INFINITI_DEMO') }}</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link class="rounded-circle" rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



@stack('style')       
</head>

<body class="@if(session('user_id'))post-login @endif">
@include('layouts.header')
 <div class="div">
@yield('content')
 </div>
@include('layouts.footer')
<button id="scrollToTopBtn" title="Go to top">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#b22234" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up" viewBox="3 0 24 28">
    <polyline points="18 15 12 9 6 15"></polyline>
  </svg>
</button>
<div id="loginModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img src="{{ asset('images/infinity.png')}}" alt="Infiniti Logo" style="width: 150px; margin-bottom: 20px;">
    <form method="post"
            action="{{route('weaver.login')}}"
            id="login-form-ige">
      @csrf      
      <div class="form-group">
        <label>{{ __('message2.MOBILE_NO') }}</label>
        <div class="input-wrapper">
          <span class="icon">⇨</span>
          <input type="text" placeholder="{{ __('message2.MOBILE_NO') }}" name="userName_email" id="userName_email" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label>{{ __('message2.PASSWORD') }}</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="{{ __('message2.PASSWORD') }}" name="password" id="password" autocomplete="off">
        </div>
      </div>
      <p style="color:red"></p>
      <input type="hidden" name="callBackURL" id="callBackURL" value="{{ callBackURL() }}">
      <input type="hidden" name="isAjax" id="isAjax" value="false" />
      <input type="hidden" name="loginToken" id="loginToken" value="IGELOGIN" />
      <input type="hidden" name="encPwd" id="encPwd" value="" />
      <input type="hidden" name="submiturl" id="submiturl" value="{{ callBackURL() }}" />
      <div style="text-align:right; margin-bottom: 10px;">
        <a href="#forgot" style="color:#0056cc; font-size: 14px;">{{ __('message2.FORGOT_PASSWORD') }}</a>
      </div>
      <button type="submit" class="pms_button login-submit"  name="commit" value="Login">{{ __('message2.LOGIN') }}</button>
      <p style="margin-top: 12px; font-size: 14px; color: #999;">
        {{ __('message2.DONT_HAVE_ACCOUNT') }} <a href="{{route('registerview')}}" style="color: #0056cc;">{{ __('message2.SIGNUP') }}</a>
      </p>
    </form>
  </div>
</div>
<!-- FORGOT PASSWORD MODAL -->
<div id="forgotPasswordModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeForgotModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">{{ __('message2.FORGOT_PASSWORD') }}?</h2>
    
    <form method="post" action="{{route('forget.password')}}">
      @csrf
      <div class="form-group">
        <div class="input-wrapper">
          <span class="icon">👤</span>
          <input type="text" placeholder="{{ __('message2.USERNAME_MOBILE') }}" name="forget_mobile">
        </div>
      </div>
      <p id="forgetpasserror" style="color:red"></p>
      <button type="submit" class="login-submit">{{ __('message2.BTN_SUBMIT') }}</button>
      <p style="margin-top: 12px; font-size: 14px; color: #999;">
        {{ __('message2.DONT_HAVE_ACCOUNT') }}? <a href="{{route('registerview')}}" style="color: #0056cc;">{{ __('message2.SIGNUP') }}</a>
      </p>
    </form>
  </div>
</div>

<div id="forgotPasswordOTPModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeResetForgotModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">{{ __('message2.FORGOT_PASSWORD') }}?</h2>
    
    <form method="post" action="{{route('resetPassword.Forgot')}}">
      @csrf
      <div class="form-group">
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="number" placeholder="{{ __('message2.OTP') }}" name="playerotp" id="playerotp">
        </div>
      </div>
      
      <div class="form-group">
        <label>{{ __('message2.NEW_PASSWORD') }}</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="{{ __('message2.NEW_PASSWORD') }}" name="newPassword" id="newPassword" autocomplete="off">
        </div>
      </div>
      
      <div class="form-group">
        <label>{{ __('message2.CONFIRM_PASSWORD') }}</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="{{ __('message2.CONFIRM_PASSWORD') }}" name="retypePassword" id="retypePassword" autocomplete="off">
        </div>
      </div>
      <p id="forgetpassotperror" style="color:red"></p>
      <button type="submit" class="login-submit">{{ __('message2.BTN_SUBMIT') }}</button>
    </form>
  </div>
</div> 
<div id="error_popup" class="modal">
  <div class="modal-content">
      <span class="close-btn" onclick="closeErrorModal()">&times;</span>
      <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">{{ __('message2.ERROR ') }}</h2>
      <div class="modal-body">
          <p class="msg">{{ __('message2.DEFAULT_ERROR_MESSAGE ') }}.</p>
      </div>
  </div>
</div>

<script>
  const langmsag = {
      noMessages: "{{ __('message2.NO_MESSAGES_FOUND') }}",
      readBtn: "{{ __('message2.BTN_READ') }}",
      deleteBtn: "{{ __('message2.BTN_DELETE') }}",
      errorLoading: "{{ __('message2.ERROR_LOADING_MESSAGES') }}",
      noContent: "{{ __('message2.NO_CONTENT_FOUND') }}",
      confirmDelete: "{{ __('message2.CONFIRM_DELETE_MESSAGE') }}",
      noBonus: "{{ __('message2.NO_BONUS_FOUND') }}",
      noTicket: "{{ __('message2.NO_TICKET_DETAILS') }}",
      noWager: "{{ __('message2.NO_WAGER_DATA') }}",
      noTransactionData: "{{ __('message2.NO_DATA_FOR_TRANSACTION') }}",
      noTransactionDetails: "{{ __('message2.NO_TRANSACTION_DETAILS') }}",
      selectMethodAmount: "{{ __('message2.SELECT_METHOD_AMOUNT') }}",
      depositSuccess: "{{ __('message2.DEPOSIT_SUCCESS') }}",
      withdrawalSuccess: "{{ __('message2.WITHDRAWAL_SUCCESS') }}",
      withdrawalCancelled: "{{ __('message2.WITHDRAWAL_CANCELLED') }}"
  };

</script>
<script>
$(document).ready(function() {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    @if(session('success'))
        toastr.success(@json(session('success')), 'Success');
    @endif

});
</script>  
   <script>
    // Shrink navbar on scroll
    window.addEventListener("scroll", function() {
      const navbar = document.querySelector(".navbar");
      if (window.scrollY > 50) {
        navbar.classList.add("shrink");
      } else {
        navbar.classList.remove("shrink");
      }
    });
  </script>
  <script>
  // Open modal
  document.querySelector('.login-btn').addEventListener('click', function () {
    document.getElementById('loginModal').style.display = 'flex';
  });

  // Close modal on click outside content
  window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Close modal function (used by close button)
  function closeModal() {
    document.getElementById('loginModal').style.display = 'none';
  }
</script>

<script>
  // Open forgot password modal
  document.querySelector('.modal-content a[href="#forgot"]').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('loginModal').style.display = 'none';
    document.getElementById('forgotPasswordModal').style.display = 'flex';
  });

  // Close forgot password modal
  function closeForgotModal() {
    document.getElementById('forgotPasswordModal').style.display = 'none';
  }

  // Close reset password modal
  function closeResetForgotModal() {
    document.getElementById('forgotPasswordOTPModal').style.display = 'none';
  }

  // Close forgot password modal
  function closeErrorModal() {
    document.getElementById('error_popup').style.display = 'none';
  }

  // Optional: close modal when clicking outside
  window.onclick = function(event) {
    const forgotModal = document.getElementById('forgotPasswordModal');
    if (event.target == forgotModal) {
      forgotModal.style.display = "none";
    }
  };
</script>
<script>
  const message = {
        mobileValidation: "{{ __('message2.MOBILE_NUMBER_VALIDATION') }}",
        passwordAlphaNum: "{{ __('message2.PASSWORD_ALPHANUMERIC') }}"
    };
  document.getElementById('login-form-ige').addEventListener('submit', function (e) {
  e.preventDefault();
    let mobile   = document.getElementById('userName_email').value.trim();
    let password = document.getElementById('password').value.trim();
    if(!/^[0-9]{10}$/.test(mobile)) {
        showError(message.mobileValidation);
        return;
    }

    if(!/^[a-zA-Z0-9]+$/.test(password)) {
        showError(message.passwordAlphaNum);
        return;
    }
  const form = this;
  const loginUrl = form.action;
  const formData = new FormData(form);
  fetch(loginUrl, {
    method: 'POST',
    headers: {
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.response.errorCode === 0 && data.response.playerLoginInfo) {
      closeModal();
      location.reload();
    } else {
      document.querySelector('#login-form-ige p[style*="color:red"]').textContent = data.response.respMsg;
    }
  })
  .catch(err => {
    console.error('Login error:', err);
    document.querySelector('#login-form-ige p[style*="color:red"]').textContent = 'Something went wrong';
  });
});

@if(session('user_id'))
  // Toggle dropdown on amount click
  // document.getElementById('amount-button').addEventListener('click', function () {
  //   const dropdown = document.getElementById('user-dropdown');
  //   dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  // });

  // // Close dropdown on outside click
  // document.addEventListener('click', function (e) {
  //   const button = document.getElementById('amount-button');
  //   const dropdown = document.getElementById('user-dropdown');

  //   if (!button.contains(e.target) && !dropdown.contains(e.target)) {
  //     dropdown.style.display = 'none';
  //   }
  // });
@endif  
</script>
<script>
    const scrollToTopBtn = document.getElementById("scrollToTopBtn");

window.addEventListener("scroll", () => {
  if (window.scrollY > 100) {
    scrollToTopBtn.classList.add("show");
  } else {
    scrollToTopBtn.classList.remove("show");
  }
});

scrollToTopBtn.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const forgotForm = document.querySelector("#forgotPasswordModal form");
    const resetForm = document.querySelector("#forgotPasswordOTPModal form");

    forgotForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const mobile = forgotForm.querySelector("input[name='forget_mobile']").value.trim();
        const errorBox = document.getElementById("forgetpasserror");
        const message = {
                mobileValidation: "{{ __('message2.MOBILE_NUMBER_VALIDATION') }}"
            };
        if (!/^[0-9]{10}$/.test(mobile)) {
            errorBox.textContent = message.mobileValidation;
            return;
        }
        errorBox.textContent = "";

        try {
            const res = await fetch("{{ route('forget.password') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    isAjax: true,
                    forget_mobile: mobile
                })
            });

            const data = await res.json();

            if (data.errorCode === 0) {
                document.getElementById("forgotPasswordModal").style.display = "none";
                document.getElementById("forgotPasswordOTPModal").style.display = "flex";

                document.getElementById("forgotPasswordOTPModal").dataset.mobile = mobile;
            } else {
                errorBox.textContent = data.respMsg;
            }

        } catch (err) {
            errorBox.textContent = "Something went wrong, please try again.";
        }
    });
    const message = {
        passwordMismatch: "{{ __('message2.PASSWORD_MISMATCH') }}",
        passwordAlphaNum: "{{ __('message2.PASSWORD_ALPHANUMERIC') }}",
        wentWrong: "{{ __('message2.SOMETHING_WENT_WRONG') }}"
    };
    resetForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const otp = document.getElementById("playerotp").value.trim();
        const password = document.getElementById("newPassword").value.trim();
        const confirm = document.getElementById("retypePassword").value.trim();
        const mobile = document.getElementById("forgotPasswordOTPModal").dataset.mobile;
        const errorBox = document.getElementById("forgetpassotperror");
        if (!/^[a-zA-Z0-9]+$/.test(password)) {
            errorBox.textContent = message.passwordAlphaNum;
            return;
        }
        if (password !== confirm) {
            errorBox.textContent = message.passwordMismatch;
            return;
        }
        errorBox.textContent = "";

        try {
            const res = await fetch("{{ route('resetPassword.Forgot') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    isAjax: true,
                    playerotp: otp,
                    newPassword: password,
                    retypePassword: confirm,
                    forgot_mobile: mobile
                })
            });

            const data = await res.json();

            if (data.errorCode === 0) {
                errorBox.textContent = data.respMsg;
            } else {
                errorBox.textContent = data.respMsg;
            }

        } catch (err) {
            errorBox.textContent = message.wentWrong;
        }
    });

});
</script>
<script src="{{ asset('js/common.js') }}"></script>
<script>
  function checkSessionBeforeAjax(onSuccess) {
      $.ajax({
          url: '{{ route("sessionLogincheck") }}',
          type: 'GET',
          dataType: 'json',
          success: function(response) {
              if (response.loggedIn) {
                  onSuccess();
              } else {
                  window.location.href = '/';
              }
          },
          error: function() {
              window.location.href = '/';
          }
      });
  }
</script>
@stack('script')
</body>

</html>