<!DOCTYPE html>
<html>
<head>
  <meta name="msapplication-tap-highlight" content="no" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=no"/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
  <title>Login Form</title>

  <!-- Keep the same assets/IDs your existing JS expects -->
  <!-- <link rel="stylesheet" href="/templates/shaper_helix3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/templates/shaper_helix3/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/templates/shaper_helix3/css/legacy.css" />
  <link rel="stylesheet" href="/templates/shaper_helix3/css/template.css" />
  <link rel="stylesheet" href="/templates/shaper_helix3/css/presets/preset1.css" class="preset" />
  <link rel="stylesheet" href="/templates/shaper_helix3/css/custom/igeLogin.css" />

  <script src="/media/jui/js/jquery.min.js"></script>
  <script src="/media/jui/js/jquery-noconflict.js"></script>
  <script src="/media/jui/js/jquery-migrate.min.js"></script>
  <script src="/templates/shaper_helix3/js/bootstrap.min.js"></script>
  <script src="/media/system/js/core.js"></script>
  <script src="/templates/shaper_helix3/js/jquery.sticky.js"></script>
  <script src="/templates/shaper_helix3/js/main.js"></script> -->

  <!-- keep your legacy custom scripts as-is -->
  <!-- <script src="/templates/shaper_helix3/js/custom/email_mobile_verify.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/MD5.min.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/custom/forgotpassword.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/custom/login.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/custom/registration.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/jquery.validate.min.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/jquery.validate2.additional-methods.min.js?v=21.0"></script>
  <script src="/templates/shaper_helix3/js/custom/common.js?v=21.0"></script> -->

  <script>
    var myDeviceType = "PC";
    var loginToken = "IGELOGIN";
  </script>
</head>
<body>
  <div class="container afIWGgameOuterWrap">
    <div class="pmsHeader"><h3>Login</h3></div>
    <div class="contDiv">
      <form method="post"
            action="{{route('weaver.login')}}"
            id="login-form-ige"
            submit-type=""
            validation-style=""
            tooltip-mode="bootstrap">
        @csrf    
        <!-- If your legacy JS can't send CSRF, see step 6 -->
        <p><label>Username:</label><input type="text" name="userName_email" id="userName_email" autocomplete="off"></p>
        <p><label>Password:</label><input type="password" name="password" id="password" autocomplete="off"></p>
        <p style="color:red">{{ $error }}</p>

        <input type="hidden" name="callBackURL" id="callBackURL" value="{{ $callBackURL }}">
        <input type="hidden" name="isAjax" id="isAjax" value="false" />
        <input type="hidden" name="loginToken" id="loginToken" value="IGELOGIN" />
        <input type="hidden" name="encPwd" id="encPwd" value="" />
        <input type="hidden" name="submiturl" id="submiturl" value="{{ $callBackURL }}" />

        <p class="submit"><input type="submit" name="commit" value="Login" class="pms_button"></p>
      </form>
    </div>
  </div>
  @if(!empty($response))
    <pre>{{ print_r($response, true) }}</pre>
@endif
</body>
</html>
