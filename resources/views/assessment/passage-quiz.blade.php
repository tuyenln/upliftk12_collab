@extends('assessment.master-asm')
@section('content-asm')
	<h3>{{$passage['name']}}</h3>
	<div class="item col-12 text-center">
		<p>To begin the activity first test your microphone. When we can here sound from your microphone a start button will appear. After you press start button, a reading passage will appear. Read the passage alout and clearly as you can</p>
		<p class="passage_content">{{$passage['content']}}</p>
		<div>
			<canvas class="js-volume" width="20" height="140"></canvas>
		</div>
		<a class="btn btn-success record" href="javascript:;"><i class="fa fa-3x fa-microphone"></i></a>
		<a class="btn btn-success record_stop hidden" href="javascript:;"><i class="fa fa-3x fa-stop-circle"></i></a>
		<audio class="hidden" controls id="audio"></audio>
		<p class="output py-3"></p>
		{{-- <a class="btn btn-info finish disabled" href="{{route('assessment.sections', $assessment->id)}}">Finish</a> --}}
	</div>
	<input type="hidden" name="text" value="{{$passage['content']}}">
	<input type="hidden" name="ajax_url" value="{{route('assessment.sections.ajaxspeech', [$placement_test->id])}}">
@endsection
@push('styles')
<style type="text/css">
	h3 {
	    text-align: center;
	    width: 100%;
	}
	.passage_content {
	    font-family: times new roman;
	    font-size: 22px;
	    text-align: justify;
	    border: 2px solid #412A7F;
	    padding: 10px 15px;
	}
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

				//stop after 40s
				setTimeout(function(){
					stopBtnRecord();
			   	}, 40000);
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
			$('.record').addClass('disabled');
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
					$('.record').removeClass('disabled');
					$('.output').html("Error: " + res.messsage);
				}else {
					$('.next,.finish').removeClass('disabled');
					$('.output').html("Success.");

					//redirect
					setTimeout(function(){
						window.location.href = res.url;
				   	}, 1000);
				}
			}
			});
		}

	});
</script>
@endpush
