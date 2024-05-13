@extends('assessment.master-asm')
@section('content-asm')

	<div class="col-sm-12 text-center">
		<h3>Congratulation!</h3>
		<p>You've just completed passage. <a href="{{route('assessment.sections', $assessment->id)}}">Click here</a> to return assessment page.</p>
	</div>

@endsection