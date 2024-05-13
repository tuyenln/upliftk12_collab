@extends('layouts.new-master-front')

@section('content')
   <div class="wrapper">
      <div class="content py-0">
         <div class="session-wrap login-wrap shape-wrap d-flex align-items-center justify-content-center justify-content-lg-end">

            <div class="session-content contact-form-wrap text-center card shadow-box">
               <div class="social-widget mb-5">
                  <h2  class="text-capitalize font-2x mb-4">Sign In</h2>
               </div>
               <div>
                 <form method="POST" action="{{ url('login') }}">
                        @csrf
                         <div class="form-group text-left">
                        <select name="user_type" class="form-control ">
                          <option value="principle">Principal</option>
                          <option value="teacher">Teacher</option>
                          <option value="student">Student</option>

                        </select>
                     </div>

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
