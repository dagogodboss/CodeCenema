@extends('auth.layout')

@section('title', __("Register"))

@section('content')
  <form class="card bg-info text-white" method="post" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="card-body">
      <h4 class="card-title">Register on Films App</h4>

      <div class="form-group">
        <label for="name" class="form-control-label">Name</label>
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
               name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
      </div>

      <div class="form-group">
        <label for="email" class="form-control-label">E-Mail Address</label>
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
               name="email" value="{{ old('email') }}" required>
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
        <label for="password-confirm" class=" form-control-label">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
      </div>

      <div class="form-group d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary px-4">
          Register
        </button>
        <a href="{{ route('login') }}" class="text-white">Have an account?</a>
      </div>
    </div>
  </form>
@endsection