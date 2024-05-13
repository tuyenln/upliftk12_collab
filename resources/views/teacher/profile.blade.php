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

.avatar-wrapper {
	 position: relative;
	 height: 200px;
	 width: 200px;
	 margin: 50px auto;
	 border-radius: 50%;
	 overflow: hidden;
	 box-shadow: 1px 1px 15px -5px black;
	 transition: all 0.3s ease;
}
 .avatar-wrapper:hover {
	 transform: scale(1.05);
	 cursor: pointer;
}
 .avatar-wrapper:hover .profile-pic {
	 opacity: 0.5;
}
 .avatar-wrapper .profile-pic {
	 height: 100%;
	 width: 100%;
	 transition: all 0.3s ease;
}
 .avatar-wrapper .profile-pic:after {
	 font-family: FontAwesome;
	 content: "\f007";
	 top: 0;
	 left: 0;
	 width: 100%;
	 height: 100%;
	 position: absolute;
	 font-size: 190px;
	 background: #ecf0f1;
	 color: #34495e;
	 text-align: center;
}
 .avatar-wrapper .upload-button {
	 position: absolute;
	 top: 0;
	 left: 0;
	 height: 100%;
	 width: 100%;
}
 .avatar-wrapper .upload-button .fa-arrow-circle-up {
	 position: absolute;
	 font-size: 234px;
	 top: -17px;
	 left: 0;
	 text-align: center;
	 opacity: 0;
	 transition: all 0.3s ease;
	 color: #34495e;
}
 .avatar-wrapper .upload-button:hover .fa-arrow-circle-up {
	 opacity: 0.9;
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
                <h3 class="title-content text-center" style="margin-bottom: 20px;">Update Profile</h3>
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
			<form method="post" action="{{ route('teacher.updateProfile') }}" enctype="multipart/form-data">
            @csrf
                <div class="avatar-wrapper">
                    <img class="profile-pic" src="" />
                    <div class="upload-button">
                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                    <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                </div>
				<div class="form-group">    
					<label>Name</label>                           
					<input type="text" name="name" class="form-control" required placeholder="Name" value="<?php echo ( (old('name') != null) ? old('name') : ($user->name)) ; ?>">
                </div><!--
                <div class="form-group">    
					<label>Current Password</label>                           
					<input type="password" name="cur_password" class="form-control" placeholder="CurrentPassword">
				</div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="password" name="re_password" class="form-control" placeholder="Confirm Password">
                </div>-->

                <a href="{{route('teacher')}}" class="btn btn-default pull-right">Back</a>
				<button type="submit" class="btn btn-success pull-right" style="margin-right: 20px;">Save</button>
				<a href="{{route('teacher.changePassword')}}" class="btn btn-success pull-right" style="margin-right: 20px;">Change Password</a>
			</form>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
@section('script-bottom')
<script>
$(document).ready(function() {
    @if ($user->avatar != '')
        $('.profile-pic').attr('src', "{{url($user->avatar)}}");
    @endif
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
</script>
@endsection