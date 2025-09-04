@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-3">
    <img src="{{ asset('images/misc/dummyLeftBanner.jpg') }}" alt="Infiniti Banner" class="img-fluid" style="width: 100%;">
  </div>

  <div class="col-md-9">
    <h3>{{ __('message2.REGISTER') }}</h3>
    <p><small><i>{{ __('message2.FIELDS_REQUIRED') }}</i></small></p>
    <div id="errorBox" class="alert alert-danger d-none"></div>

    <div class="basic-information">
      <h5>{{ __('message2.BASIC_INFORMATION') }}</h5>

      <form id="registerForm">
        @csrf
        <div class="mb-3">
          <label for="mobileNo">{{ __('message2.MOBILE_NO') }}</label>
          <input type="text" name="mobileNo" id="mobileNo" class="form-control" placeholder="{{ __('message2.MOBILE_NO') }}." required/>
        </div>

        <div class="mb-3">
          <label for="password">{{ __('message2.PASSWORD') }}</label>
          <input type="password" name="reg_password" id="password" class="form-control" placeholder="{{ __('message2.PASSWORD') }}" required/>
        </div>

        <div class="mb-3">
          <label for="confirmPassword">{{ __('message2.CONFIRM_PASSWORD') }}</label>
          <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="{{ __('message2.CONFIRM_PASSWORD') }}" required/>
          <input type="hidden" name="isAjax" value="true" />
          <input type="hidden" name="otp_enable" value="{{$otp_enable}}" />
        </div>

        <div class="mb-3">
          <label for="country">{{ __('message2.SELECT_COUNTRY') }}</label>
          <select id="country" name="countrycode" class="form-select" required>
            <option value="">{{ __('message2.SELECT_COUNTRY') }}</option>
            @foreach($countries->data as $country)
              <option value="{{$country->countryCode}}">{{$country->countryName}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="currency">{{ __('message2.SELECT_CURRENCY') }}</label>
          <select id="currency" name="currency" class="form-select" required>
            <option value="">{{ __('message2.SELECT_CURRENCY') }}</option>
            @foreach ($currency as $key => $value)
              <option value="{{$value['curCode']}}">{{$key . ' (' . $value['decSymbol'] . ')'}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="referCode">{{ __('message2.REFER_CODE') }}</label>
          <input type="text" name="refercode" id="referCode" class="form-control" placeholder="{{ __('message2.REFER_CODE') }}" />
        </div>

        <input type="hidden" name="registrationType" value="MINI"/>
        <div class="mb-3 form-check">
          <input type="checkbox" id="agree" name="agree" class="form-check-input" />
          <label for="agree" class="form-check-label">
            {{ __('message2.AGE_AGREEMENT') }} 
            <a href="">{{ __('message2.TERMS_CONDITIONS') }}</a>
          </label>
        </div>

        <button type="submit" class="btn btn-danger">{{ __('message2.BTN_CREATE_ACCOUNT') }}</button>
      </form>
    </div>
  </div>
</div>

{{-- OTP Modal --}}
<div id="verifyOTPModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeOtpModal()">&times;</span>
    <h2 style="color:#0a58ca; font-size: 20px; margin-bottom: 15px;">{{ __('message2.VERIFY_OTP') }}</h2>
    <form id="otpForm">
      @csrf
      <div class="form-group">
        <div class="input-wrapper">
          <input type="number" name="otp_confirm" id="otp_confirm" placeholder="OTP" class="form-control">
        </div>
      </div>
      <p id="showOTPerror" style="color:red"></p>
      <button type="submit" class="btn btn-primary mt-2">{{ __('message2.BTN_SUBMIT') }}</button>
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
    const messages = const messages = {
        mobileValidation: "{{ __('message2.MOBILE_NUMBER_VALIDATION') }}",
        passwordMismatch: "{{ __('message2.PASSWORD_MISMATCH') }}",
        countryRequired: "{{ __('message2.COUNTRY_REQUIRED') }}",
        currencyRequired: "{{ __('message2.CURRENCY_REQUIRED') }}",
        agreeRequired: "{{ __('message2.AGREE_REQUIRED') }}",
        passwordAlphaNum: "{{ __('message2.PASSWORD_ALPHANUMERIC') }}"
    };
    let mobile   = document.getElementById('mobileNo').value.trim();
    let password = document.getElementById('password').value.trim();
    let confirm  = document.getElementById('confirmPassword').value.trim();
    let country  = document.getElementById('country').value.trim();
    let currency = document.getElementById('currency').value.trim();
    let agree    = document.getElementById('agree').checked;

    // 🔹 Mobile validation: only 10 digits
    if(!/^[0-9]{10}$/.test(mobile)) {
        showError(messages.mobileValidation);
        return;
    }

    // 🔹 Password: only alphanumeric
    if(!/^[a-zA-Z0-9]+$/.test(password)) {
        showError(message.passwordAlphaNum);
        return;
    }

    // 🔹 Confirm password
    if(password !== confirm) {
        showError(message.passwordMismatch);
        return;
    }

    // 🔹 Country required
    if(country === "") {
        showError(message.countryRequired);
        return;
    }

    // 🔹 Currency required
    if(currency === "") {
        showError(message.currencyRequired);
        return;
    }

    // 🔹 Terms checkbox required
    if(!agree) {
        showError(message.agreeRequired);
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
