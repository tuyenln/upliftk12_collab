@extends('assessment.master-asm')
@section('content-asm')
	@include('layouts/frontsidebar')
	<div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
		<div class="team-detail-content nopaddingtop">
			<div class="clearfix header-section-content breacum-layout">
	            <h3 class="title-content"><a href="#">Reading</a><a href="#" class="trigleicon">Intro Video</a><a href="#" class="trigleicon" >Sections</a><strong class="trigleicon">{{$section['name']}}</strong></h3>
	        </div>
	        <div class="fw-ct">
	        	<!-- content  -->
	        	@php 
					$words = explode(',', $section['words']);
					$total_words = count($words);
					$position = 0;$current_key = 0;$current_word = $words[0];
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
					<h2>{{$current_word ?? ''}}</h2>
					<div>
						<canvas class="js-volume" width="20" height="140"></canvas>
					</div>
					<a class="btn btn-success record coloriconrecord" href="javascript:;"><i class="fa fa-3x fa-microphone"></i></a>
					<a class="btn btn-success record_stop coloriconrecord hidden" href="javascript:;"><i class="fa fa-3x fa-stop-circle"></i></a>
					<audio class="hidden" controls id="audio"></audio>
					<p class="output py-3 textsuccess"></p>
					<a class="btn btn-primary next disabled {{ $current_key+1 == $total_words ? 'hidden' : '' }}" href="javascript:;">Next</a>
					<a class="btn btn-primary finish disabled {{ $current_key+1 == $total_words ? '' : 'hidden' }}" href="{{route('assessment.sections', $assessment->id)}}">Finish</a>
				</div>
				<input type="hidden" name="text" value="{{$current_word ?? ''}}">
				<input type="hidden" name="position" value="{{$current_key}}">
				<input type="hidden" name="ajax_url" value="{{route('assessment.sections.ajaxspeech', [$placement_test->id])}}">

	        </div>
	    </div>
	</div>

	

@endsection
@push('styles')
<style type="text/css">
	.hidden {
		display: none !important;
	}
</style>
@endpush
@push('scripts')
<script src="/public/js/Mp3LameEncoder.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		window.URL = window.URL || window.webkitURL;
		/** 
		 * Detecte the correct AudioContext for the browser 
		 * */
		window.AudioContext = window.AudioContext || window.webkitAudioContext;
		navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
		var recorder = new RecordVoiceAudios();
		let startBtn = document.querySelector('.record');
		let stopBtn = document.querySelector('.record_stop');
		startBtn.onclick = recorder.startRecord;
		stopBtn.onclick = recorder.stopRecord;

		function addClass(el, className)
		{
		    if (el.classList)
		        el.classList.add(className)
		    else if (!hasClass(el, className))
		        el.className += " " + className;
		}

		function removeClass(el, className)
		{
		    if (el.classList)
		        el.classList.remove(className)
		    else if (hasClass(el, className))
		    {
		        var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
		        el.className = el.className.replace(reg, ' ');
		    }
		}

		function RecordVoiceAudios() {
			let elementVolume = document.querySelector('.js-volume');
			let ctx = elementVolume.getContext('2d');
			let codeBtn = document.querySelector('.js-code');
			let pre = document.querySelector('pre');
			let downloadLink = document.getElementById('download');
			let audioElement = document.querySelector('audio');
			let encoder = null;
			let microphone;
			let isRecording = false;
			var audioContext;
			let processor;
			let config = {
				bufferLen: 4096,
				numChannels: 2,
				mimeType: 'audio/mpeg'
			};

			this.startRecord = function() {
				audioContext = new AudioContext();
				/** 
				* Create a ScriptProcessorNode with a bufferSize of 
				* 4096 and two input and output channel 
				* */
				if (audioContext.createJavaScriptNode) {
					processor = audioContext.createJavaScriptNode(config.bufferLen, config.numChannels, config.numChannels);
				} else if (audioContext.createScriptProcessor) {
					processor = audioContext.createScriptProcessor(config.bufferLen, config.numChannels, config.numChannels);
				} else {
					console.log('WebAudio API has no support on this browser.');
				}

				processor.connect(audioContext.destination);
				/**
				*  ask permission of the user for use microphone or camera  
				* */
				navigator.mediaDevices.getUserMedia({ audio: true, video: false })
				.then(gotStreamMethod)
				.catch(logError);
				addClass(startBtn,'hidden');
				removeClass(stopBtn,'hidden');
			};

			let getBuffers = (event) => {
				var buffers = [];
				for (var ch = 0; ch < 2; ++ch)
					buffers[ch] = event.inputBuffer.getChannelData(ch);
				return buffers;
			}

			let gotStreamMethod = (stream) => {
				startBtn.setAttribute('disabled', true);
				stopBtn.removeAttribute('disabled');
				audioElement.src = "";
				config = {
					bufferLen: 4096,
					numChannels: 2,
					mimeType: 'audio/mpeg'
				};
				isRecording = true;

				let tracks = stream.getTracks();
				/** 
				* Create a MediaStreamAudioSourceNode for the microphone 
				* */
				microphone = audioContext.createMediaStreamSource(stream);
				/** 
				* connect the AudioBufferSourceNode to the gainNode 
				* */
				microphone.connect(processor);
				encoder = new Mp3LameEncoder(audioContext.sampleRate, 160);
				/** 
				* Give the node a function to process audio events 
				*/
				processor.onaudioprocess = function(event) {
					encoder.encode(getBuffers(event));
				};

				stopBtnRecord = () => {
					console.log('stopBtnRecord');
					isRecording = false;
					startBtn.removeAttribute('disabled');
					stopBtn.setAttribute('disabled', true);
					audioContext.close();
					processor.disconnect();
					tracks.forEach(track => track.stop());

					let blob = encoder.finish();
					let url = URL.createObjectURL(blob)
					audioElement.src = url;

					addClass(stopBtn,'hidden');
					removeClass(startBtn,'hidden');
					callAjax(blob);
				};

				analizer(audioContext);
			}

			this.stopRecord = function() {
				stopBtnRecord();
			};

			let analizer = (context) => {
				let listener = context.createAnalyser();
				microphone.connect(listener);
				listener.fftSize = 256;
				var bufferLength = listener.frequencyBinCount;
				let analyserData = new Uint8Array(bufferLength);

				let getVolume = () => {
					let volumeSum = 0;
					let volumeMax = 0;
		
					listener.getByteFrequencyData(analyserData);
		
					for (let i = 0; i < bufferLength; i++) {
						volumeSum += analyserData[i];
					}
		
					let volume = volumeSum / bufferLength;

					if (volume > volumeMax)
						volumeMax = volume;
		
					drawAudio(volume / 5);
					/**
					* Call getVolume several time for catch the level until it stop the record
					*/
					return setTimeout(()=>{
						if (isRecording)
							getVolume();
						else
							drawAudio(0);
					}, 10);
				}

				getVolume();
			}

			let drawAudio = (volume) => {
				ctx.save();
				ctx.translate(0, 120);

				for (var i = 0; i < 14; i++) {
					fillStyle = '#ffcbcd';
					if (i < volume)
						fillStyle = '#ff2c77';

					ctx.fillStyle = fillStyle;
					ctx.beginPath();
					ctx.arc(10, 2, 17, 0, Math.PI * 2);
					ctx.closePath();
					ctx.fill();
					ctx.translate(0, -7);
				}

				ctx.restore();
			}

			let logError = (error) => {
				alert(error);
				console.log(error);
			}

			drawAudio(0);
		}
		function callAjax(blob) {
			var formData = new FormData();
			formData.append('audio_data', blob);
			var text = $('input[name=text]').val();
			formData.append('text', text);
			var url = $('input[name=ajax_url]').val();
			$('.output').html('<i class="fa fa-spin fa-spinner"></i>');
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
					$('.next').removeClass('disabled');
					if(!$('.finish').hasClass('hidden')){
						$('.finish').removeClass('disabled');
					}
					$('.output').html("Success.");
					// alert("Success. Your score: " + res.data.overall_score);
				}
			}
			});
		}

		$(document).on('click', '.next', function() {
			var _this = $(this);
			// $(this).closest('.item').addClass('hidden').next().removeClass('hidden');
			var url = "{{url()->current()}}";
			position = $('input[name=position]').val();
			var heading = $('.item h2');
			$('.output').html('<i class="fa fa-spin fa-spinner"></i>');
			$.ajax({
				headers: {
				    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: url,
				type: 'POST',
				data: 'position='+position,
				success: function(res) {
					if(res.status == "success"){
						$('.output').html("");
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
	});
</script>
@endpush