@extends('layouts.app')

@section('content')
<style>
.navbar-area {
  display: none !important;
}
</style>
<section class="navbar-area1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="/">
                        <img src="{{ url('public/assets/img/logo2.png')}}" width="250">
                    </a>
                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>
<section id="trial" class="pt-100 pb-100" style="background-color: #f4f6f7;">
    <div class="container">
        <div class="content sec-pad justify">
            <div class="team-detail-wrap shape-wrap">
                <div class="container">
                    <div class="membersingle-info team-detail-space">
                        <div class="row align-items-start ">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2 mx-auto card py-5 px-4">
                                <h2 class="text-center">Start your 7 days free trial</h2><br/>
                                @if(session('success'))
                                    <div class="alert alert-success">{!!session('success')!!}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="free-trial" accept-charset="UTF-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Name" class="control-label">Name</label>
                                                <input class="form-control" name="name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email address" class="control-label">Email Address</label>
                                                <input class="form-control" name="email" type="email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="State Name" class="control-label">State Name</label>
                                                <input class="form-control" name="state_name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="District Name" class="control-label">District Name</label>
                                                <input class="form-control" name="district_name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="School Name" class="control-label">School Name</label>
                                                <input class="form-control" name="school_name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Phone Number" class="control-label">Phone Number</label>
                                                <input class="form-control" name="phone" type="number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Username" class="control-label">Username</label>
                                                <input class="form-control" name="username" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="control-label">Password</label>
                                                <input class="form-control" name="password" type="password" value="" id="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password Confirm" class="control-label">Password Confirm</label>
                                                <input class="form-control" name="confirm_password" type="password" value="" required>
                                            </div>

                                            @if(config('services.recaptcha.key'))
                                            <div class="g-recaptcha"
                                                data-sitekey="{{config('services.recaptcha.key')}}">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="term" class="checkbox-inline">
                                            <input id="term" class="mr-1" type="checkbox" name="agree" value="1" required>By accepting this trial, you agree to abide by <a href="https://www.upliftk12.com/term-of-use">Uplift K12's terms of service</a>.
                                        </label>
                                    </div>
                                    <div class="form-group text-center mb-0">
                                        <button class="main-btn rounded-one" type="submit">Request free trial</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection