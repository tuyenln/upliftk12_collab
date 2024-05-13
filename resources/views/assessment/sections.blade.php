@extends('assessment.master-asm')
@section('content-asm')
	@include('layouts/frontsidebar')
	<div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
		<div class="team-detail-content nopaddingtop">
			<div class="clearfix header-section-content breacum-layout">
            	<h3 class="title-content"><a href="#">Reading</a><a href="#" class="trigleicon">Intro Video</a><strong class="trigleicon" >Sections</strong></h3>
        	</div>
        <div class="fw-ct">
        	@if($assessment->sections)
				@foreach($assessment->sections as $key=>$sec)
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left sections-layout pb-6">
						<h6>{{$sec['name']}}</h6>
						@php 
							$txt = "start";
							$cl = "btn-primary";
							if($assessment->doingQuiz($key+1)){
								$txt = "Continue";
								$cl = "btn-warning";
								if($assessment->finishedQuiz($key+1)){
									$txt = "Finished";
									$cl = "btn-success";
								}
							}
						@endphp
						<a class="btn {{$cl}}" href="{{route('assessment.sections.step', [$assessment->id, $key+1])}}">{{$txt}}</a>
					</div>
				@endforeach
				@endif

				@if($assessment->passages)
				@foreach($assessment->passages as $key=>$passage)
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 float-left sections-layout  pb-6">
						<h6>{{$passage['name']}}</h6>
						@php 
							$txt = "start";
							$cl = "btn-primary";
							if($assessment->donePassage($key+1)){
									$txt = "Finished";
									$cl = "btn-success";
							}
						@endphp
						<a class="btn {{$cl}}" href="{{route('assessment.passage.step', [$assessment->id, $key+1])}}">{{$txt}}</a>
					</div>
				@endforeach
			@endif
        </div>
	</div>
@endsection