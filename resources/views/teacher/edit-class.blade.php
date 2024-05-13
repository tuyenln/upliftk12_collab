@extends('teacher.layouts.master')
@section('title', 'Add Class')
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
</style>
@endsection
@section('content')
<?php   $user = Auth::user();?>
<div class="container">
    <div class="row align-items-start">
		<!-- side bar menu-->
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-lg-offset-3 mrgn-b-2">
            <div>
                <h3 class="title-content text-center" style="margin-bottom: 20px;">Update Class</h3>
                <div class="clearfix"></div>
			</div>
			<form method="post" action="{{ route('teacher.class.update', $aRow->id) }}" enctype="multipart/form-data">
            @method('PUT')
			@csrf
				<div class="form-group">    
					<label for="name">Name</label>                           
					<input type="text" name="name" class="form-control" required placeholder="Class Name" value="{{ $aRow ? $aRow->name : old('name') }}">
				</div>

				<div class="form-group">    
					<label for="name">Subject</label>                           
					{{ Form::select('subject_id', ['' =>'Please Select'] + $aSubjects,  $aRow ? $aRow->subject_id : old('subject_id') , ['class' => 'form-control', 'required' => 'required']) }}
				</div>

				<div class="form-group">    
					<label for="name">{{ __('Grade Level') }}</label>                           
					{{ Form::select('grade_level_id', ['' =>'Please Select'] + $aGradeLevels,  $aRow ? $aRow->grade_level_id : old('grade_level_id') , ['class' => 'form-control', 'required' => 'required']) }}
				</div>
				<a href="{{route('teacher.manageClass')}}" class="btn btn-default pull-right">Back</a>
				<button type="submit" class="btn btn-success pull-right" style="margin-right: 20px;">Update</button>
			</form>
        </div>
    </div>
</div>
@endsection