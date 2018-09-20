@extends('auth.layout')

@section('content')
  <form style="min-height: 67vh" class="card bg-info text-white" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <h4 class="card-title text-center" style="margin-top:2em;">Welcome Back</h4>
    <div class="card-body" style="margin-top: 5rem;">
        
      <div class="form-group">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
               name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address" />
        @if ($errors->has('email'))
          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="password" class="form-control-label">Password</label>
        <input id="password" placeholder="Enter Your Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" required/>

        @if ($errors->has('password'))
          <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        @endif
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
          </label>
        </div>
      </div>

      <div class="form-group d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary px-4">
          Login
        </button>

        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
          Forgot Your Password?
        </a>
      </div>
        <a class="btn btn-link text-white" href="{{ route('register') }}">
          Or Don't Have an Account
        </a>
    </div>

  </form>
@endsection