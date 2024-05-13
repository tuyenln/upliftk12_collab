@extends('layouts.admin')
@php
    $page_name = "Upload Csv"
@endphp
@section('content')
<div class="x_title">
<h2>{{ $page_name }}<small></small></h2>
<div class="clearfix"></div>
</div>

<div class="x_content">
<div class="col-md-6 col-sm-6 col-xs-6">
<form method="POST" enctype='multipart/form-data' action="{{ route('principal.student.postcsv') }}" enctype="multipart/form-data">
@csrf
<div class="form-group">    
	<label for="name">{{ __('Upload File') }}</label>                           
	<input type="file" name="uploadcsv" class="form-control" required="">	
</div>

<button type="submit" class="btn btn-success">Save</button>
</form>
</div>
</div>
@endsection
