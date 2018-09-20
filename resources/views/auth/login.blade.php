@extends('auth.layout')

@section('content')
  <form class="card" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="card-body">
      <h4 class="card-title">Login Films App</h4>

      <div class="form-group">
        <label for="email" class="form-control-label">E-Mail Address</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
               name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
          <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="password" class="form-control-label">Password</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
               name="password" required>

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

        <a class="btn btn-link" href="{{ route('password.request') }}">
          Forgot Your Password?
        </a>
      </div>
    </div>

  </form>
@endsection