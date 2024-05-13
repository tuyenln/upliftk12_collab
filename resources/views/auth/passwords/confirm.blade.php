@extends('layouts.loginmaster')

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
                  <h2  class="text-capitalize font-2x mb-4">{{ __('Confirm Password') }}</h2>
                   {{ __('Please confirm your password before continuing.') }}
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
                   
                 <form method="POST" action="{{route('password.confirm') }}">
                        @csrf
                         
                     
                     <div class="form-group text-left">
                        <input name="password" class="form-control @error('password') is-invalid @enderror" type="text" value="{{  old('password') }}" placeholder="Email " required autocomplete="password" autofocus>
                         @if ( $errors->has('password'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
                     </div>
                    
                     
                     
                     <div class="form-group mrgn-b-2">
                        <input type="submit" class="btn btn-warning d-block" value="{{ __('Confirm Password') }}" />
                     </div>
                     @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                  </form>
               </div>   
            </div>
         </div>
         <!-- Login Wrap Close -->   
      </div>
   </div>   
   @endsection
 
