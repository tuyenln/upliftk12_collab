
@extends('layouts.new-master-front')

@section('content')
<div class="wrapper">
  <div id="loading" class="page-loader-wrap">
   <div id="preloader">
    <span></span>
  </div>
</div>
<div class="content py-0">
 <div class="session-wrap login-wrap shape-wrap d-flex align-items-center justify-content-center justify-content-lg-end">

  <div class="session-content contact-form-wrap text-center card shadow-box">
   <div class="social-widget mb-5">
    <h2  class="text-capitalize font-2x mb-4">Sign In123</h2>
    <ul class="list-inline mb-0">
     <li class="d-inline-block list-inline-item">
      <a class="text-white rounded square-50 bg-facebook" href="javascript:void(0)">
       <i class="fab fa-facebook-f"></i>
     </a>
   </li>
   <li class="d-inline-block list-inline-item">
    <a class="text-white rounded square-50 bg-twitter" href="javascript:void(0)">
     <i class="fab fa-twitter"></i>
   </a>
 </li>
 <li class="d-inline-block list-inline-item">
  <a class="text-white rounded square-50 bg-linkedin" href="javascript:void(0)"><i class="fab fa-linkedin-in"></i>
  </a>
</li>
</ul>
</div>
<div>
 <form method="POST" action="{{ route('login') }}">
  @csrf

  <div class="form-group text-left">
    <input name="login" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{ old('username') ?: old('email') }}" placeholder="Username Or Email " required autocomplete="email" autofocus>
    @if ($errors->has('username') || $errors->has('email'))
    <span class="invalid-feedback" style="display:block" role="alert">
      <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group text-left">
    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" value="{{ old('password') }}" placeholder="password" required autocomplete="current-password">
    @error('password')
    <span class="invalid-feedback" role="alert" style="display: block;">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group mrgn-b-2">
    <input type="submit" class="btn btn-warning d-block" value="Log In" />
    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
    </a>
    @endif
  </div>
  <div class="form-group text-center mb-0">
    <p class="mb-0">Have no account ? Click to
      <a class="text-warning" href="">Register</a></p>
    </div>
  </form>
</div>
</div>
</div>
<!-- Login Wrap Close -->
</div>
</div>
@endsection
