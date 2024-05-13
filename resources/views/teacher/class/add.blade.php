@extends('layouts.admin')
@php
    $page_name = $aRow ? "Edit Class" : "Add Class"
@endphp
@section('content')
<div class="x_title">
<h2>{{ $page_name }}<small></small></h2>
<div class="clearfix"></div>
</div>

<div class="x_content">
<div class="col-md-6 col-sm-6 col-xs-6">
@if($aRow)
<form method="POST"  action="{{ route('teacher.class.update',$aRow->id) }}" enctype="multipart/form-data">
@method('PUT')
@else
<form method="POST"  action="{{ route('teacher.class.store') }}" enctype="multipart/form-data">
@endif 

@csrf
<div class="form-group">    
	<label for="name">{{ __('Name') }}</label>                           
	<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Class Name">
	@if ($errors->has('name'))
		<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
	@endif
</div>

<div class="form-group">    
	<label for="name">{{ __('Subject') }}</label>                           
	{{ Form::select('subject_id', ['' =>'Please Select'] + $aSubjects,  $aRow ? $aRow->subject_id : old('subject_id') , ['class' => 'form-control', 'required' => 'required']) }}
</div>

<div class="form-group">    
	<label for="name">{{ __('Grade Level') }}</label>                           
	{{ Form::select('grade_level_id', ['' =>'Please Select'] + $aGradeLevels,  $aRow ? $aRow->grade_level_id : old('grade_level_id') , ['class' => 'form-control', 'required' => 'required']) }}
</div>



<button type="submit" class="btn btn-success">Save</button>
</form>
</div>
</div>
@endsection
