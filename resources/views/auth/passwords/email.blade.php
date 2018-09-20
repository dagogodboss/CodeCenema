@extends('auth.layout')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @else
    <form class="card" method="POST" action="{{ route('password.email') }}">
      {{ csrf_field() }}

      <div class="card-body">

        <h4 class="card-title">Reset Password</h4>

        <div class="form-group">
          <label for="email" class="form-control-label">E-Mail Address</label>
          <input id="email" type="email"
                 class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                 name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
          @endif
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">
            Send Password Reset Link
          </button>
        </div>

      </div>

    </form>
  @endif
@endsection