<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animated Signup Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea, #764ba2);
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    .signup-box {
      width: 420px;
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0px 10px 25px rgba(0,0,0,0.2);
      animation: zoomIn 0.8s ease;
      position: relative;
      z-index: 2;
    }

    @keyframes zoomIn {
      from {
        transform: scale(0.7);
        opacity: 0;
      }
      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    .signup-box h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }

    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 10px rgba(102, 126, 234, 0.4);
    }

    .btn-signup {
      width: 100%;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border: none;
      padding: 12px;
      border-radius: 30px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-signup:hover {
      transform: translateY(-3px);
      box-shadow: 0px 8px 20px rgba(0,0,0,0.2);
    }

    /* Background floating shapes */
    .shapes {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .shape {
      position: absolute;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      animation: float 15s infinite ease-in-out;
    }

    @keyframes float {
      from { transform: translateY(0) rotate(0deg); }
      to { transform: translateY(-1000px) rotate(360deg); }
    }
  </style>
</head>
<body>

  <!-- Background Shapes -->
  <div class="shapes">
    <div class="shape" style="left:10%; width:80px; height:80px; animation-duration: 12s;"></div>
    <div class="shape" style="left:30%; width:50px; height:50px; animation-duration: 18s;"></div>
    <div class="shape" style="left:60%; width:100px; height:100px; animation-duration: 20s;"></div>
    <div class="shape" style="left:85%; width:60px; height:60px; animation-duration: 14s;"></div>
  </div>

  <!-- Signup Form -->
  <div class="signup-box">
    <h2>Admin Signup</h2>
    <form onsubmit="handleSignup(event)">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="fullname" placeholder="Full Name" required>
        <label for="fullname">Full Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <div class="form-floating mb-3">
        <input type="tel" class="form-control" id="phone" placeholder="Phone Number" required>
        <label for="phone">Phone Number</label>
      </div>
      <button type="submit" class="btn btn-signup">Sign Up</button>
    </form>
  </div>

  <script>
    function handleSignup(e) {
      e.preventDefault();
      alert("Signup Successful! 🎉");
    }
  </script>
</body>
</html>
