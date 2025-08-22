@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-3">
    <img src="{{ asset('images/misc/dummyLeftBanner.jpg') }}" alt="Infiniti Banner" class="img-fluid" style="width: 100%;">
  </div>

  <div class="col-md-9">
    <h3>Register</h3>
    <p><small><i>Fields marked with * are required</i></small></p>
    <div id="errorBox" class="alert alert-danger d-none"></div>

    <div class="basic-information">
      <h5>Basic Information</h5>

      <form id="registerForm">
        @csrf
        <div class="mb-3">
          <label for="mobileNo">Mobile No.*</label>
          <input type="text" name="mobileNo" id="mobileNo" class="form-control" placeholder="Mobile No.*" required/>
        </div>

        <div class="mb-3">
          <label for="password">Password*</label>
          <input type="password" name="reg_password" id="password" class="form-control" placeholder="Password*" required/>
        </div>

        <div class="mb-3">
          <label for="confirmPassword">Confirm Password*</label>
          <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm Password*" required/>
          <input type="hidden" name="isAjax" value="true" />
          <input type="hidden" name="otp_enable" value="{{$otp_enable}}" />
        </div>

        <div class="mb-3">
          <label for="country">Select Country*</label>
          <select id="country" name="countrycode" class="form-select" required>
            <option value="">Select Country*</option>
            @foreach($countries->data as $country)
              <option value="{{$country->countryCode}}">{{$country->countryName}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="currency">Select Currency*</label>
          <select id="currency" name="currency" class="form-select" required>
            <option value="">Select Currency*</option>
            @foreach ($currency as $key => $value)
              <option value="{{$value['curCode']}}">{{$key . ' (' . $value['decSymbol'] . ')'}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="referCode">Refer Code</label>
          <input type="text" name="refercode" id="referCode" class="form-control" placeholder="Refer Code" />
        </div>

        <input type="hidden" name="registrationType" value="MINI"/>
        <div class="mb-3 form-check">
          <input type="checkbox" id="agree" name="agree" class="form-check-input" />
          <label for="agree" class="form-check-label">
            I am at least 18 years old and have read and accepted the 
            <a href="">Terms and Conditions</a>
          </label>
        </div>

        <button type="submit" class="btn btn-danger">Create Account</button>
      </form>
    </div>
  </div>
</div>

{{-- OTP Modal --}}
<div id="verifyOTPModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeOtpModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">Verify OTP</h2>
    <form id="otpForm">
      @csrf
      <div class="form-group">
        <div class="input-wrapper">
          <input type="number" name="otp_confirm" id="otp_confirm" placeholder="OTP" class="form-control">
        </div>
      </div>
      <p id="showOTPerror" style="color:red"></p>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
  </div>
</div>
@endsection

@push('script')
<script>
function showError(msg) {
    let box = document.getElementById('errorBox');
    box.textContent = msg;
    box.classList.remove('d-none');
}

function closeOtpModal(){
    document.getElementById("verifyOTPModal").style.display = "none";
}

document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    let mobile   = document.getElementById('mobileNo').value.trim();
    let password = document.getElementById('password').value.trim();
    let confirm  = document.getElementById('confirmPassword').value.trim();
    let country  = document.getElementById('country').value.trim();
    let currency = document.getElementById('currency').value.trim();
    let agree    = document.getElementById('agree').checked;

    // 🔹 Mobile validation: only 10 digits
    if(!/^[0-9]{10}$/.test(mobile)) {
        showError("Mobile number must be exactly 10 digits.");
        return;
    }

    // 🔹 Password: only alphanumeric
    if(!/^[a-zA-Z0-9]+$/.test(password)) {
        showError("Password can only contain letters and numbers (no special characters).");
        return;
    }

    // 🔹 Confirm password
    if(password !== confirm) {
        showError("Password and Confirm Password do not match.");
        return;
    }

    // 🔹 Country required
    if(country === "") {
        showError("Please select a country.");
        return;
    }

    // 🔹 Currency required
    if(currency === "") {
        showError("Please select a currency.");
        return;
    }

    // 🔹 Terms checkbox required
    if(!agree) {
        showError("You must agree to the Terms and Conditions.");
        return;
    }

    // ✅ If all validations pass → continue with availability check
    let formData = new FormData(this);

    let res = await fetch("{{ route('check.availability') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value },
        body: formData
    });
    let data = await res.json();

    if(data.errorCode != 0){
        showError(data.respMsg);
        return;
    }

    // Step 2: registration.OTP
    let otpRes = await fetch("{{ route('registration.OTP') }}", {
        method: "POST",
        headers: { 
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({ isAjax: true })
    });
    let otpData = await otpRes.json();

    if(otpData.errorCode != 0){
        showError(otpData.respMsg);
        return;
    }

    // Step 3: show OTP modal
    document.getElementById("verifyOTPModal").style.display = "flex";
});


// OTP verification
document.getElementById('otpForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    let otpVal = document.getElementById('otp_confirm').value;

    let res = await fetch("{{ route('verify.otp') }}", {
        method: "POST",
        headers: { 
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({ otp_confirm: otpVal, isAjax: true })
    });
    let data = await res.json();

    if(data.errorCode != 0){
        document.getElementById('showOTPerror').textContent = data.errorMessage;
        return;
    }

    alert("Registration successful!");
    closeOtpModal();
});
function closeOtpModal() {
    document.getElementById('verifyOTPModal').style.display = 'none';
  }
</script>
@endpush
