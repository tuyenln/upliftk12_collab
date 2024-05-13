
@extends('layouts.new-master-front')

@section('content')
<div class="wrapper">
  <section class="container-fluid aos-init aos-animate mb-5">
    <div class="justify">
      <div class="row align-items-start">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-3 mx-auto mt-5">
          <div class="session-content contact-form-wrap text-center card shadow-box p-4">
            <div class="social-widget mb-5">
              <h2  class="text-capitalize font-2x mb-4">Password Reset</h2>
            </div>
            @if (count( $errors ) > 0)
                <div class="alert alert-danger" style="width: 100%;">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>        
                    @endforeach
                </div>
            @endif
            @if (Session::has('msg'))
            <div class="alert alert-success" style="width: 100%;">
                {{Session::get('msg')}}
            </div>
            @endif
            <div>
              <form method="POST" action="{{ url('forget_link') }}">
                @csrf
               

                <div class="form-group text-left">
                  <input name="email" class="form-control {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{ old('username') ?: old('email') }}" placeholder="Email " required autocomplete="email" autofocus>
                  @if ($errors->has('username') || $errors->has('email'))
                  <span class="invalid-feedback" style="display:block" role="alert">
                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
                
                <div class="form-group mrgn-b-2">
                  @if (session('error'))
                  <span class="invalid-feedback" style="display:block" role="alert">
                    <strong>{{ session('error') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group mrgn-b-2">
                  <input type="submit" class="btn btn-submit" value="Send" />
                </div>
              </form>
            </div>
          
          </div>
        </div>
        
        <!-- Login Wrap Close -->
      </div>
    </div>
  </section>
</div>
@endsection
@push('styles')
<style type="text/css">
.login-wrap {
  background : #412A7F;
}
#footer {
  padding-bottom: 100px;
}
#footer .footer-top {
  display: none;
}
.justify {
  position: relative;
  z-index: 2;
}
.btn-submit {
  font-family: "Poppins", sans-serif;
    font-weight: 500;
    font-size: 16px;
    letter-spacing: 1px;
    display: inline-block;
    padding: 10px 15px;
    border-radius: 5px;
    transition: 0.5s;
    color: #fff;
    background: #6f48a9;
    position: relative;
}
</style>
@endpush
