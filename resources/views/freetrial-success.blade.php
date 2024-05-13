@extends('layouts.master-front')

@section('content')
<section class="container-fluid aos-init aos-animate login-wrap">
    <div class="content sec-pad justify" style="margin-top: 70px">
      <div class="team-detail-wrap shape-wrap">
        <div class="container">
          <div class="membersingle-info team-detail-space">
            <div class="row align-items-start ">
              <div class="col-12 col-sm-12 col-md-12 col-lg-6 mrgn-b-2 mx-auto card py-5 px-4">
                <h2>Success</h2>
                  @if(session('success'))
                      <div class="alert alert-success">{!!session('success')!!}</div>
                  @endif
                  @php Request::session()->forget('success') @endphp
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@push('styles')
<style type="text/css">
.login-wrap {
    background-image: url('../public/images/background-login.jpg');
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    position: relative;
}
.login-wrap::after {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
    display: block;
    content: "";
    top: 0;
    left: 0;
    z-index: 1;
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
@include('layouts.analytics')