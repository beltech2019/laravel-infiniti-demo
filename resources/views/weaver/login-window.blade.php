<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Infiniti - Limitless Gaming</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
  <style>
    /* ===== RESET ===== */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Roboto', Arial, sans-serif;
      background: #fff;
      color: #333;
    }
    img { max-width: 100%; display: block; }

    /* ===== CONTAINER ===== */
    .container {
      width: 100%;
      margin: 0 auto;
    }

    /* ===== HEADER ===== */
    .site-header {
      background: #fff;
      border-bottom: 1px solid #eee;
      padding: 10px 0;
    }
    .header-flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .logo-container { display: flex; align-items: center; }
    .site-logo { height: 40px; }
    .logo-text {
      margin-left: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #212E52;
    }
    .nav-list {
      display: flex;
      list-style: none;
      gap: 18px;
      flex-wrap: wrap;
      margin-right: 10px;
    }
    .nav-list a {
      text-decoration: none;
      color: #212E52;
      font-weight: bold;
      transition: color 0.2s;
    }
    .nav-list a:hover { color: #E4105D; }
    .header-actions {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-left: auto;
    }
    .flag-icon { width: 26px; height: 20px; }
    .login-btn {
      background: #E4105D;
      border: none;
      color: #fff;
      padding: 8px 20px;
      border-radius: 18px;
      font-weight: bold;
      cursor: pointer;
    }

    /* ===== BANNER ===== */
    .banner {
      width: 100%;
      margin: 0;
      padding: 0;
      background: none;
    }

    .banner-content {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: auto;
      gap: 44px;
      flex-wrap: wrap;
    }
    .banner-img {
      display: block;
      width: 100%;
      height: auto;
    }
    .banner-text {
      min-width: 320px;
    }
    .banner-text h1 {
      font-size: 40px;
      color: #fff;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .banner-text p {
      font-size: 22px;
      color: #fff;
    }

    /* ===== CATEGORIES ===== */
    .categories {
      padding: 44px 0 24px 0;
      background: #fff;
    }
    .categories-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 30px;
      margin-left: 10px;
      margin-right: 10px;
    }
    .category-card {
      background: #fafafa;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(220, 220, 220, 0.14);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 26px 38px;
      width: 18%;
      transition: box-shadow 0.2s;
      cursor: pointer;
    }
    .category-card:hover { box-shadow: 0 4px 16px rgba(212, 25, 104, 0.13); }
    .category-card img {
      height: 48px;
      margin-bottom: 12px;
    }
    .category-card div {
      font-size: 18px;
      color: #212E52;
      font-weight: 500;
    }

    /* ===== FOOTER TOP ===== */
    .site-footer {
      background: #f7f7f7;
      padding: 40px 0 0 0;
    }
    .footer-flex {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 55px;
      margin-bottom: 30px;
    }
    .footer-about {
      flex: 1 1 270px;
      max-width: 400px;
    }
    .site-logo-footer { height: 32px; }
    .logo-text-footer {
      font-size: 16px;
      font-weight: bold;
      color: #212E52;
      margin-top: 6px;
    }
    .footer-links { flex: 1 1 180px; }
    .footer-links h4 {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 8px;
      color: #212E52;
    }
    .footer-links ul { list-style: none; margin-top: 4px; }
    .footer-links li { margin-bottom: 6px; }
    .footer-links a {
      color: #444;
      text-decoration: none;
      font-size: 15px;
      transition: color 0.2s;
    }
    .footer-links a:hover { color: #E4105D; }

    /* ===== FOOTER BAR ===== */
    .footer-bar {
      background: #293E69;
      color: #fff;
      padding: 16px 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      width: 100vw;
      margin-left: calc(-50vw + 50%);
      gap: 10px;
    }
    .payments, .footer-compliance, .footer-social, .footer-copyright {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
    }
    .payments img, .footer-social img {
      height: 28px;
      margin-right: 14px;
    }
    .footer-compliance img {
      height: 22px;
      margin-right: 6px;
    }
    .footer-compliance span { margin-right: 20px; font-size: 14px; }
    .footer-copyright {
      font-size: 13px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
      .header-flex, .footer-flex {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
      }
      .banner-content { flex-direction: column; gap: 20px; text-align: center; }
      .banner-img { max-width: 90vw; }
      .footer-bar {
        flex-direction: column;
        align-items: center;
        gap: 12px;
      }
    }
    @media (max-width: 600px) {
      .container { width: 98%; }
      .nav-list { flex-direction: column; gap: 10px; margin-top: 12px; }
      .category-card { width: 98px; padding: 18px 13px; }
    }
    .header-left {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 24px;
      margin-left: 15px; 
    }

    .header-flex {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-right: 10px;
    }

    /* MODAL */
    .modal {
      display: none; 
      position: fixed;
      z-index: 999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: #fff;
      border-radius: 10px;
      width: 300px;
      padding: 25px 30px;
      text-align: center;
      position: relative;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from { transform: translateY(-40px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .close-btn {
      position: absolute;
      top: 10px; right: 14px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      color: #888;
    }

    .form-group {
      text-align: left;
      margin-bottom: 15px;
    }

    .input-wrapper {
      display: flex;
      align-items: center;
      background: #f5f5f5;
      border-radius: 50px;
      padding: 8px 14px;
      margin-top: 5px;
    }

    .input-wrapper .icon {
      font-size: 16px;
      margin-right: 10px;
      color: #888;
    }

    .input-wrapper input {
      border: none;
      background: transparent;
      width: 100%;
      font-size: 14px;
      outline: none;
    }

    .login-submit {
      width: 100%;
      background: #E4105D;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 50px;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
    }

  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="site-header">
  <div class="container header-flex mainheaderdiv">

    <!-- LEFT SIDE: Logo + Navigation -->
    <div class="header-left">
      <div class="logo-container">
        <img src="{{ asset('images/infinity.png') }}" alt="Infiniti Logo" class="site-logo">
      </div>
      <nav>
        <ul class="nav-list">
          <li><a href="#">LOTTERY</a></li>
          <li><a href="#">SPORTSPOOL</a></li>
          <li><a href="#">BINGO</a></li>
          <li><a href="#">SPORTS BETTING</a></li>
          <li><a href="#">INSTANT GAMES</a></li>
          <li><a href="#">SLOT</a></li>
          <li><a href="#">CRAZY BILLIONS</a></li>
          <li><a href="#">GAME ART</a></li>
        </ul>
      </nav>
    </div>

    <!-- RIGHT SIDE: Language + Button -->
    <div class="header-actions">
      <div class="lang-select">
        <img src="media/mod_languages/images/en_gb.gif" alt="EN" class="flag-icon">
      </div>
      @if(session('user_id'))
        {{-- Authenticated user: show balance + user menu --}}
        <div id="user-info" style="display: inline-block; position: relative;">
          <button id="amount-button" style="background: none; border: none; font-weight: bold; font-size: 16px; cursor: pointer;">
            ₹<span id="amount-text">{{ number_format($balance) }}</span>
          </button>
          <div id="user-dropdown" style="display: none; position: absolute; top: 30px; right: 0; background: white; border: 1px solid #ccc; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
            <a href="#" style="display: block; padding: 8px 16px; text-decoration: none; color: #333;">Profile</a>
            <a href="/logout" style="display: block; padding: 8px 16px; text-decoration: none; color: #333;">Logout</a>
          </div>
        </div>
      @else
        {{-- Guest user: show login button --}}
        <button class="login-btn">Login/Signup</button>
      @endif
    </div>


  </div>
</header>


  <!-- BANNER -->
  <section class="banner">
    <div class="banner-content">
      <img src="{{ asset('images/homepage-banners/banner01.jpg')}}" alt="Games on Devices" class="banner-img">
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="categories">
    <div class="container categories-grid">
      <div class="category-card">
        <img src="{{ asset('images/game-icons/games-draw.png')}}" alt="Lottery">
        <div>Lottery</div>
      </div>
      <div class="category-card">
        <img src="{{ asset('images/game-icons/games-sportsLottery.png')}}" alt="Sportspool">
        <div>SportPool</div>
      </div>
      <div class="category-card">
        <img src="{{ asset('images/game-icons/games-instant.png')}}" alt="Instant Games">
        <div>Instant Games</div>
      </div>
      <div class="category-card">
        <img src="{{ asset('images/game-icons/game-bingo.png')}}" alt="Bingo">
        <div>Bingo</div>
      </div>
      <div class="category-card">
        <img src="{{ asset('images/game-icons/games-slot.png')}}" alt="Slot">
        <div>SLOT</div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="site-footer">
    <div class="container footer-flex">
      <div class="footer-about">
        <img src="{{ asset('images/infinity.png')}}" alt="Infiniti Logo" class="site-logo-footer">
        <div class="logo-text-footer">Limitless Gaming</div>
        <p>
          Skillrock’s 4th generation INFINITI platform is designed to meet the gaming requirements of any client anywhere in the world. It is a true online channel and online gaming platform.
        </p>
      </div>
      <div class="footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">Results</a></li>
          <li><a href="#">How To Play</a></li>
          <li><a href="#">Promotions</a></li>
          <li><a href="#">News</a></li>
          <li><a href="#">Our Retailer</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h4>More Links</h4>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Responsible Gaming</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Cookie Policy</a></li>
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bar">
      <div class="payments">
        <img src="{{ asset('images/payment-icons/visa.png')}}" alt="VISA">
        <img src="{{ asset('images/payment-icons/mastercard.png')}}" alt="MasterCard">
        <img src="{{ asset('images/payment-icons/paypal.png')}}" alt="PayPal">
        <img src="{{ asset('images/payment-icons/ecopayz.png')}}" alt="EcoPayz">
        <img src="{{ asset('images/payment-icons/neteller.png')}}" alt="Neteller">
      </div>
      <div class="footer-compliance">
        <span><img src="{{ asset('images/misc/18plusIcon_white.png')}}" alt="18+"> Play Responsibly</span>
        <span><img src="{{ asset('images/misc/secureIcon_white.png')}}" alt="Secure SSL"> SECURE SSL ENCRYPTION</span>
      </div>
      <div class="footer-social">
        <img src="{{ asset('images/social/fb.png')}}" alt="Facebook">
        <img src="{{ asset('images/social/twitter.png')}}" alt="Twitter">
        <img src="{{ asset('images/social/pinterest.png')}}" alt="Pinterest">
        <img src="{{ asset('images/social/youtube.png')}}" alt="YouTube">
      </div>
      <div class="footer-copyright">
        Copyright © 2025 | Skillrock Technologies Pvt. Ltd. All Rights Reserved.
      </div>
    </div>
  </footer>
  <!-- LOGIN MODAL -->
<div id="loginModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img src="{{ asset('images/infinity.png')}}" alt="Infiniti Logo" style="height: 60px; margin-bottom: 20px;">
    <h2 style="color:#888; margin-bottom: 15px;">Limitless Gaming</h2>
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
      <p style="color:red">{{ $error }}</p>
      <input type="hidden" name="callBackURL" id="callBackURL" value="{{ $callBackURL }}">
      <input type="hidden" name="isAjax" id="isAjax" value="false" />
      <input type="hidden" name="loginToken" id="loginToken" value="IGELOGIN" />
      <input type="hidden" name="encPwd" id="encPwd" value="" />
      <input type="hidden" name="submiturl" id="submiturl" value="{{ $callBackURL }}" />
      <div style="text-align:right; margin-bottom: 10px;">
        <a href="#forgot" style="color:#0056cc; font-size: 14px;">Forgot Password?</a>
      </div>
      <button type="submit" class="pms_button login-submit"  name="commit" value="Login">Log-in</button>
      <p style="margin-top: 12px; font-size: 14px; color: #999;">
        Don’t have an account? <a href="#" style="color: #0056cc;">Signup</a>
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
        Don’t have a account? <a href="#" style="color: #0056cc;">Signup</a>
      </p>
    </form>
  </div>
</div>
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
  debugger;
  fetch(loginUrl, {
    method: 'POST',
    headers: {
      'Accept': 'application/json'
    },
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    debugger;
    if (data.response.errorCode === 0 && data.response.playerLoginInfo) {
      const totalBalance = data.response.playerLoginInfo.walletBean?.totalBalance || 0;

      closeModal();
      document.querySelector('.login-btn').style.display = 'none';
      document.getElementById('user-info').style.display = 'inline-block';
      document.getElementById('amount-text').textContent = totalBalance;
    } else {
      document.querySelector('#login-form-ige p[style*="color:red"]').textContent = 'Invalid login credentials';
    }
  })
  .catch(err => {
    debugger;
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

</body>
</html>
