<html lang="en">

<head>
    <title>Infiniti Demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link class="rounded-circle" rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

@stack('style')       
</head>

<body>
@include('layouts.header')
 <div class="div">
@yield('content')
 </div>
@include('layouts.footer')
<button id="scrollToTopBtn" title="Go to top">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#b22234" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up" viewBox="0 0 24 24">
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
        <label>Mobile</label>
        <div class="input-wrapper">
          <span class="icon">⇨</span>
          <input type="text" placeholder="Mobile" name="userName_email" id="userName_email" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="Password" name="password" id="password" autocomplete="off">
        </div>
      </div>
      <p style="color:red"></p>
      <input type="hidden" name="callBackURL" id="callBackURL" value="{{ callBackURL() }}">
      <input type="hidden" name="isAjax" id="isAjax" value="false" />
      <input type="hidden" name="loginToken" id="loginToken" value="IGELOGIN" />
      <input type="hidden" name="encPwd" id="encPwd" value="" />
      <input type="hidden" name="submiturl" id="submiturl" value="{{ callBackURL() }}" />
      <div style="text-align:right; margin-bottom: 10px;">
        <a href="#forgot" style="color:#0056cc; font-size: 14px;">Forgot Password?</a>
      </div>
      <button type="submit" class="pms_button login-submit"  name="commit" value="Login">Log-in</button>
      <p style="margin-top: 12px; font-size: 14px; color: #999;">
        Don’t have an account? <a href="{{route('registerview')}}" style="color: #0056cc;">Signup</a>
      </p>
    </form>
  </div>
</div>
<!-- FORGOT PASSWORD MODAL -->
<div id="forgotPasswordModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeForgotModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">Forget Password?</h2>
    
    <form>
      <div class="form-group">
        <div class="input-wrapper">
          <span class="icon">👤</span>
          <input type="text" placeholder="Username/mobile">
        </div>
      </div>
      <button type="submit" class="login-submit">Submit</button>
      <p style="margin-top: 12px; font-size: 14px; color: #999;">
        Don’t have a account? <a href="{{route('registerview')}}" style="color: #0056cc;">Signup</a>
      </p>
    </form>
  </div>
</div>

<div id="verifyOTPModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeForgotModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">Verify OTP</h2>
    
    <form>
       @csrf 
      <div class="form-group">
        <div class="input-wrapper">
          <span class="icon">👤</span>
          <input type="number" placeholder="OTP">
        </div>
      </div>
      <button type="submit" class="login-submit">Submit</button>
    </form>
  </div>
</div>
<div id="forgotPasswordOTPModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeForgotModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">Forget Password?</h2>
    
    <form>
      <div class="form-group">
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="number" placeholder="OTP">
        </div>
      </div>
      
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="Password" name="password" id="password" autocomplete="off">
        </div>
      </div>
      
      <div class="form-group">
        <label>Confirm Password</label>
        <div class="input-wrapper">
          <span class="icon">🔒</span>
          <input type="password" placeholder="Confirm Password" name="confirm_password" id="password" autocomplete="off">
        </div>
      </div>
      <button type="submit" class="login-submit">Submit</button>
    </form>
  </div>
</div>    
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

  // Optional: close modal when clicking outside
  window.onclick = function(event) {
    const forgotModal = document.getElementById('forgotPasswordModal');
    if (event.target == forgotModal) {
      forgotModal.style.display = "none";
    }
  };
</script>
<script>
  document.getElementById('login-form-ige').addEventListener('submit', function (e) {
  e.preventDefault();

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
    //   window.location.href = window.location.href;
    } else {
      document.querySelector('#login-form-ige p[style*="color:red"]').textContent = data.response.respMsg;
    }
  })
  .catch(err => {
    console.error('Login error:', err);
    document.querySelector('#login-form-ige p[style*="color:red"]').textContent = 'Something went wrong';
  });
});


  // Toggle dropdown on amount click
  document.getElementById('amount-button').addEventListener('click', function () {
    const dropdown = document.getElementById('user-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  });

  // Close dropdown on outside click
  document.addEventListener('click', function (e) {
    const button = document.getElementById('amount-button');
    const dropdown = document.getElementById('user-dropdown');

    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.style.display = 'none';
    }
  });
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
@stack('style')
</body>

</html>