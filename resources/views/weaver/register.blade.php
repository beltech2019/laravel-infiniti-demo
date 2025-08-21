@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-3">
    <img src="{{ asset('images/misc/dummyLeftBanner.jpg') }}" alt="Infiniti Banner" class="img-fluid" style="width: 100%;">
  </div>

  <div class="col-md-9">
    <h3>Register</h3>
    <p><small><i>Fields marked with * are required</i></small></p>
    <div class="basic-information">
      <h5>'Basic Information'</h5>

      <form method="POST" action="{{ route('player.registration') }}">
        @csrf

        <div class="mb-3">
          <label for="mobileNo">Mobile No.</label>
          <input type="text" name="mobileNo" id="mobileNo" class="form-control" placeholder="Mobile No." />
        </div>

        <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" name="reg_password" id="password" class="form-control" placeholder="Password" />
        </div>

        <div class="mb-3">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm Password" />
        </div>

        <div class="mb-3">
          <label for="country">Select Country*</label>
          <select id="country" name="countrycode" class="form-select">
            @foreach($countries->data as $country)
            <option value="{{$country->countryCode}}">{{$country->countryName}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="currency">Select Currency</label>
          <select id="currency" name="currency" class="form-select">
            @foreach ($currency as $key => $value)
            <option value="{{$value['curCode']}}">{{$key . ' (' . $value['decSymbol'] . ')'}}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="referCode">Refer Code</label>
          <input type="text" name="refercode" id="referCode" class="form-control" placeholder="Refer Code" />
        </div>

        <div class="mb-3">
          {{-- Insert your reCAPTCHA integration here --}}
          {{-- Example: {!! NoCaptcha::display() !!} --}}
        </div>

        <input type="hidden" name="registrationType" id="registrationType" value="MINI"/>
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
@endsection 