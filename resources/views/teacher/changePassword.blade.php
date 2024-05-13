@extends('teacher.layouts.master')
@section('title', 'Update Profile')
@section('style')
<style>
.btn-default {
	background: #D58100;
	border:none;
	color: #fff;
}

.btn-default:hover {
	background: #BF4E00;
	border:none;
	color: #fff;
}

.btn-success {
	background: #6F48A9;
	border:none;

}

.btn-success:hover {
	background: #5B3B99;
	border:none;
}

.parsley-error {
	    border-color: #ea553d !important;
	}

.parsley-errors-list.filled {
    display: block;
    padding: 0;
}

.parsley-errors-list > li {
    font-size: 12px;
    list-style: none;
    color: #ea553d;
}

</style>
@endsection

@section('content')
<?php   $user = Auth::user();?>
<div class="container">
    <div class="row align-items-start">
		<!-- side bar menu-->
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3 mrgn-b-2">
            <div>
                <h3 class="title-content text-center" style="margin-bottom: 20px;">Change Password</h3>
                <div class="clearfix"></div>
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
			<form method="post" action="{{ route('teacher.updatePassword') }}" enctype="multipart/form-data">
            @csrf
                <div class="form-group">    
					<label>Current Password</label>                           
					<input type="password" name="currentPassword" class="form-control" placeholder="CurrentPassword" required>
				</div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="newPassword" class="form-control" placeholder="New Password" id="newpass" data-parsley-minlength="6" required>
                </div>
                <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="password" name="confirmPassword" class="form-control" data-parsley-equalto="#newpass" data-parsley-minlength="6" required placeholder="Confirm Password">
                </div>

                <a href="{{route('teacher')}}" class="btn btn-default pull-right">Back To Home</a>
				<button type="submit" class="btn btn-success pull-right" style="margin-right: 20px;">Update Password</button>
			</form>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
@section('script-bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script>
$(document).ready(function() {
    $('form').parsley();
});
</script>
@endsection