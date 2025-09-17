@extends('layouts.app')
@section('content')
<style>
     body {
      font-family: Arial, sans-serif;
      background: #fff;
      margin: 0;
      padding: 0;
    }

    .contact-container {
      max-width: 900px;
      margin: 40px auto;
      padding: 20px;
    }

    h2 {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    h3 {
      font-size: 22px;
      font-weight: bold;
      margin: 10px 0;
    }

    p {
      color: #444;
      margin-bottom: 20px;
    }

    form {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 5px;
      background: #fff;
    }

    .form-group {
      position: relative;
      margin-bottom: 15px;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 12px 40px 12px 40px;
      border: 1px solid #ccc;
      border-radius: 20px;
      font-size: 14px;
      outline: none;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
      border-radius: 10px;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      font-size: 16px;
      color: #777;
    }

    button {
      background: #d50000;
      color: #fff;
      border: none;
      padding: 10px 25px;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background: #a00000;
    }
</style>
    <div class="contact-container">
        <h2>{{ __('message2.CONTACT_US') }}</h2>
        <h3>{{ __('message2.CONTACT_US_HEADING') }}</h3>
        <p>{{ __('message2.CONTACT_US_DESCRIPTION') }}</p>

        <form method="post" action="{{ route('articals.contactUsSubmit') }}">
            @csrf    

            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" name="fname" placeholder="{{ __('message2.FIRST_NAME') }}" value="{{ old('fname') }}" required>
                @error('fname') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" name="lname" placeholder="{{ __('message2.LAST_NAME') }}" value="{{ old('lname') }}" required>
                @error('lname') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" placeholder="{{ __('message2.EMAIL_ADDRESS') }}" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <i class="fa fa-envelope"></i>
                <input type="text" name="subject" placeholder="{{ __('message2.SUBJECT') }}*" value="{{ old('subject') }}" required>
                @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <textarea name="message" placeholder="{{ __('message2.YOUR_MESSAGE') }}*" required>{{ old('message') }}</textarea>
                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit">{{ __('message2.BTN_SUBMIT') }}</button>
        </form>

    </div>

@endsection

@push('script')

@endpush
