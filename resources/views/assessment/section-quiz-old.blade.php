@extends('assessment.master-asm')
@section('content-asm')
	
	<h3>{{$section['name']}}</h3>
	@php 
		$words = explode(',', $section['words']);
		$position = 0;
	@endphp

	@foreach($words as $key=>$word)
		@if(!$placement_test->check($word))
			@php
				$current_word = $word;
				$current_key = $key;
			@endphp
			@break
		@endif
	@endforeach
	<div class="item col-12 text-center">
		<h2>{{$current_word}}</h2>
		<a class="btn btn-success record" href="javascript:;"><i class="fa fa-3x fa-microphone"></i></a>
		<a class="btn btn-success record_stop hidden" href="javascript:;"><i class="fa fa-3x fa-stop-circle"></i></a>
		<audio class="hidden" controls id="audio"></audio>
		<p class="output py-3"></p>
		<a class="btn btn-info next disabled" href="javascript:;">Next</a>
		<a class="btn btn-info finish disabled hidden" href="{{route('assessment.sections', $assessment->id)}}">Finish</a>
	</div>
	<input type="hidden" name="text" value="{{$current_word}}">
	<input type="hidden" name="position" value="{{$current_key}}">
	<input type="hidden" name="ajax_url" value="{{route('assessment.sections.ajaxspeech', [$assessment->id, $step])}}">
@endsection
@push('styles')
<style type="text/css">
	.hidden {
		display: none !important;
	}
</style>
@endpush
@push('scripts')
<script src="/public/js/recorder.js"></script>
<script src="/public/js/Fr.voice.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$(document).on('click', '.prev', function() {
			// $(this).closest('.item').addClass('hidden').prev().removeClass('hidden');
		});
		$(document).on('click', '.next', function() {
			var _this = $(this);
			// $(this).closest('.item').addClass('hidden').next().removeClass('hidden');
			var url = "{{url()->current()}}";
			position = $('input[name=position]').val();
			var heading = $('.item h2');
			$.ajax({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: url,
				type: 'POST',
				data: 'position='+position,
				// contentType: false,
				// processData: false,
				success: function(res) {
					if(res.status == "success"){
			    		heading.html(res.word);
			    		$('input[name=text]').val(res.word);
			    		$('input[name=position]').val(function(i, val) { return +val+1 });
			    		_this.addClass('disabled');
						if(res.end){
							_this.addClass('hidden').next().removeClass('hidden');
						}
			    	}
				}
			});
		});

		$(document).on("click", ".record", function(){
	      	text = $(this).closest('.item').find('h2').text();
			$('input[name=text]').val(text);
			$(this).addClass('hidden').siblings('.record_stop').removeClass('hidden');
		    Fr.voice.record();
		});

		$(document).on("click", ".record_stop", function(){
			$(this).addClass('hidden').siblings('.record').removeClass('hidden');
		    Fr.voice.export(upload, "blob");
		 	Fr.voice.stop();
		});
		function upload(blob){
	      var formData = new FormData();
	      formData.append('audio_data', blob);
	      var text = $('input[name=text]').val();
	      formData.append('text', text);
	      var url = $('input[name=ajax_url]').val();
	      $.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
	        url: url,
	        type: 'POST',
	        data: formData,
	        contentType: false,
	        processData: false,
	        success: function(res) {
		    	console.log(res);
		    	if(res.status == "error"){
		    		$('.output').html("Error: " + res.messsage);
		    		// alert("Error: " + res.messsage);
		    	}else {
		    		$('.next,.finish').removeClass('disabled');
		    		$('.output').html("Success. Your score: " + res.data.overall_score);
		    		// alert("Success. Your score: " + res.data.overall_score);
		    	}
	        }
	      });
	    }
	});
</script>
@endpush