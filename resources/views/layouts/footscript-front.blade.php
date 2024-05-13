<script src="{{url('public/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
<script src="{{url('public/assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{url('public/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{url('public/assets/vendor/counterup/counterup.min.js')}}"></script>
<script src="{{url('public/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{url('public/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{url('public/assets/vendor/venobox/venobox.min.js')}}"></script>
<script src="{{url('public/assets/vendor/aos/aos.js')}}"></script>
<script src="{{url('public/assets/js/main-front.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		$(document).on('submit', '#fom-newsletter', function(e) {
			e.preventDefault();
			//disable the submit button
      $("input[type=submit]").attr("disabled", true);
			var formData = $(this).serialize()
			var output = $(this).siblings('.output_response')
			output.html('<i class="fa fa-spin fa-spinner fa-2x"></i>')
			$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'newsletter',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(res) {
					if(res.status == 'error') {
						output.html('<div class="alert alert-danger">'+res.message+'</div>')
					}else {
						output.html('<div class="alert alert-success">'+res.message+'</div>')
					}
        }
      }).then(function() {
	      $("input[type=submit]").attr("disabled", false);
			});
		})
	});
</script>
@stack('styles')
@stack('scripts')
</body>
</html>