<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="{{url('public/assets/vendor/jquery/jquery.min.js')}}"></script>
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
<!-- begin olark code -->
<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('8255-204-10-2600');</script>
<!-- end olark code -->
</body>
</html>
