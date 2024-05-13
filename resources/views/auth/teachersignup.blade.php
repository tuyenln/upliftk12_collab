@extends('layouts.new-master-front')

@section('content')
   <div class="wrapper">
      <div class="content py-0">
         <div class="session-wrap login-wrap shape-wrap d-flex align-items-center justify-content-center" style="padding: 50px;">

            <div class="session-content contact-form-wrap text-center card shadow-box" style="padding: 30px;">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="mb-2 col-md-4 card text-dark" style="border: 2px solid #412A7F; border-radius: 30px; padding: 5px 5px; background: #EDEDED; font-weight: 800; font-size: 17px;">
                        Create an Account
                    </div>
                    <div class="mb-2 ml-2 col-md-4 card text-dark" style="border: 1px solid darkgrey; border-radius: 30px; padding: 5px 5px; font-weight: 800; font-size: 17px;">
                        Subscribe
                    </div>
                    <div class="col-md-2"></div>
                </div>
               <div class="social-widget mb-2">
                  <h2  class="text-capitalize font-2x font-weight-bold mb-3">Educator Plan Subscription</h2>
                   <h5 class="text-left">Step 1: Create an Account</h5>
               </div>
               <div>
                <form method="POST" action="{{ route('teacher.postsignup') }}">
                  @csrf

                  @if(session()->has('message'))
                     <div class="mt-3"><div class="alert alert-success">{{ session()->get('message') }}</div></div>
                  @endif

                  <div class="form-group text-left">
                    <input name="fname" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" type="text" value="{{ old('fname') }}" placeholder="First Name" required autofocus>
                    @if ($errors->has('fname'))
                    <span class="invalid-feedback" style="display:block" role="alert">
                    <strong>{{ $errors->first('fname') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group text-left">
                    <input name="lname" class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}" type="text" value="{{ old('lname') }}" placeholder="Last Name" required autofocus>
                    @if ($errors->has('lname'))
                    <span class="invalid-feedback" style="display:block" role="alert">
                    <strong>{{ $errors->first('lname') }}</strong>
                    </span>
                    @endif
                  </div>

                  <div class="form-group text-left">
                    <input name="email" class="form-control {{  $errors->has('email') ? ' is-invalid' : '' }}" type="text" value="{{  old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                    @if ( $errors->has('email'))
                    <span class="invalid-feedback" style="display:block" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group text-left">
                    <select class="form-control @error('district_name') is-invalid @enderror" required="" name="district_name" id="dist">
                          <option value="">--Select District Name--</option>
                          @foreach($districts as $districts)
                              <option value="{{$districts->id}}">{{$districts->name}}</option>
                          @endforeach
                    </select>
                  </div>

                  <div class="form-group text-left">
                    <select class="form-control @error('school_name') is-invalid @enderror" required="" name="school_name" id="school_name">
                          <option value="">--Select School Name--</option>
                    </select>
                  </div>



                  <div class="form-group text-left">
                    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" value="" placeholder="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group text-left">
                    <input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" value="" placeholder="confirm password" required >
                    @error('password')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @enderror
                  </div>


                  <div class="form-group mrgn-b-2">
                    <input type="submit" class="btn btn-primary d-block" value="Review Your Order" />
                  </div>

                  <div class="form-group text-center mb-0">
                    <p class="mb-0">Already have a free trial account ?<br>
                        Click <a class="text-warning" style="text-decoration: underline;" href="{{ route('login')}}">here</a> to login. When you login, click on 'Subscribe' in the top-right menu.
                    </p>
                  </div>

                </form>
               </div>
            </div>
         </div>
         <!-- Login Wrap Close -->
      </div>
   </div>
   @endsection

@push('styles')
    <style type="text/css">
  .signup-2-wrap, .login-wrap {
    width: 100%;
    background-attachment: fixed!important;
    overflow: auto;
    height: 100%;
}
</style>
@endpush
@include('layouts.analytics')
@push('scripts')
<script type="text/javascript">
    $(document).on("change", '#dist', function(e) {
        var department = $(this).val();
        var url="{{url('get_school_dist')}}";
        $.ajax({
            type: "POST",
            data: {department: department,"_token": "{{ csrf_token() }}"},
            url: url,
            success: function(json) {
                $('#school_name').html(json);
            }
        });
    });
</script>
@endpush
