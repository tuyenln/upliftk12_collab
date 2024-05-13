
@extends('layouts.new-master-front')

@section('content')
<div class="wrapper">
  <section class="container-fluid aos-init aos-animate mb-5">
    <div class="justify">
      <div class="row align-items-start">
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 offset-lg-3 mx-auto mt-5">
          <div class="session-content contact-form-wrap text-center card shadow-box p-4">
            <div class="social-widget mb-5">
              <h2  class="text-capitalize font-2x mb-4">Change Password</h2>
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
            <form method="post" action="{{ url('password_reset') }}" enctype="multipart/form-data">
            @csrf
                
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="token" value="{{$token}}">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="newPassword" class="form-control" placeholder="New Password" id="newpass" data-parsley-minlength="6" required>
                </div>
                <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="password" name="password_confirmation" class="form-control" data-parsley-equalto="#newpass" data-parsley-minlength="6" required placeholder="Confirm Password">
                </div>

              
				<button type="submit" class="btn btn-success pull-right" style="margin-right: 20px;">Update Password</button>
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
