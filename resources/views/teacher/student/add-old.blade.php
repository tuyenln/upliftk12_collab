@extends('layouts.admin')
@php
    $page_name = $aRow ? "Edit Subject" : "Add Subject"
@endphp
@section('content')
<div class="x_title">
<h2>{{ $page_name }}<small></small></h2>
<div class="clearfix"></div>
</div>

<div class="x_content">
<div class="col-md-6 col-sm-6 col-xs-6">
@if($aRow)
<form method="POST"  action="{{ route('principal.student.update',$aRow->id) }}" enctype="multipart/form-data">
@method('PUT')
@else
<form method="POST"  action="{{ route('principal.student.store') }}" enctype="multipart/form-data">
@endif 

@csrf
<div class="form-group">    
	<label for="name">{{ __('First Name') }}</label>                           
	<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="First Name">
	@if ($errors->has('name'))
		<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
	@endif
</div>

<div class="form-group">    
	<label for="name">{{ __('Middle Name') }}</label>                           
	<input type="text" name="mname" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->mname : old('mname') }}" required placeholder="Middle Name">
	@if ($errors->has('mname'))
		<span class="invalid-feedback" role="alert"><strong>{{ $errors->Middle('mname') }}</strong></span>
	@endif
</div>

<div class="form-group">    
	<label for="name">{{ __('Last Name') }}</label>                           
	<input type="text" name="lname" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->lname : old('lname') }}" required placeholder="Last Name">
	@if ($errors->has('lname'))
		<span class="invalid-feedback" role="alert"><strong>{{ $errors->Middle('lname') }}</strong></span>
	@endif
</div>

<div class="form-group">    
	<label for="name">{{ __('Student Id') }}</label>                           
	<input type="text" name="student_id" id="student_id" class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->student_id : old('student_id') }}" required placeholder="Student Id">
	@if ($errors->has('student_id'))
		<span class="invalid-feedback" role="alert"><strong>{{ $errors->Middle('student_id') }}</strong></span>
	@endif
</div>

<button type="submit" class="btn btn-success">Save</button>
</form>
</div>
</div>
@endsection
