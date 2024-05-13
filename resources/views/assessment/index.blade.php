@extends('assessment.master-asm')
@section('content-asm')
	<!-- side bar menu-->
		@include('layouts/frontsidebar')
		<div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
			<div class="team-detail-content nopaddingtop">
				<div class="clearfix header-section-content breacum-layout">
                <h3 class="title-content"><a href="#">Reading</a><strong  class="trigleicon">Intro Video</strong></h3>
            </div>
				<div class="fw-ct">
					<div class="col-12 text-center">
					   <iframe src="https://player.vimeo.com/video/347119375?color=ef2200&byline=0&portrait=0&autoplay=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
					</div>
					<a href="{{route('assessment.sections', $assessment->id)}}" class="btn btn-primary actionnext">Next</a>
					<div class="clear"></div>
				</div>
			</div>
		</div>

@endsection