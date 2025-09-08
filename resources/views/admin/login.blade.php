<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animated Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    .login-box {
      width: 380px;
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
      animation: slideIn 0.8s ease;
      position: relative;
    }

    @keyframes slideIn {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }

    .form-floating label {
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #4facfe;
      box-shadow: 0 0 10px rgba(79, 172, 254, 0.4);
    }

    .btn-login {
      width: 100%;
      background: linear-gradient(135deg, #4facfe, #00f2fe);
      border: none;
      padding: 12px;
      border-radius: 30px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
    }

    /* Background animation */
    .bubbles {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: -1;
      top: 0;
      left: 0;
    }

    .bubble {
      position: absolute;
      bottom: -100px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      animation: rise 15s infinite ease-in;
    }

    @keyframes rise {
      from { transform: translateY(0) scale(1); opacity: 1; }
      to { transform: translateY(-1200px) scale(1.5); opacity: 0; }
    }
  </style>
</head>
<body>

  <div class="bubbles">
    <div class="bubble" style="left:10%; width:40px; height:40px; animation-duration: 10s;"></div>
    <div class="bubble" style="left:30%; width:25px; height:25px; animation-duration: 12s;"></div>
    <div class="bubble" style="left:50%; width:50px; height:50px; animation-duration: 14s;"></div>
    <div class="bubble" style="left:70%; width:20px; height:20px; animation-duration: 8s;"></div>
    <div class="bubble" style="left:90%; width:35px; height:35px; animation-duration: 16s;"></div>
  </div>
 {{-- Flash Messages --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  {{-- Validation Errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="login-box">
    <h2>Login</h2>
    <form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
        <label for="email">Email address</label>
        @error('email')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
        @error('password')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-login">Login</button>
    </form>
  </div>

</body>
</html>
