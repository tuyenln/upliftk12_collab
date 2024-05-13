@extends('principal.layouts.master')
@section('title', 'Principal')
@section('content')
<style>
	.hover-end{
		width: 150px;padding:0;margin:0;font-size:75%;text-align:center;
		position: absolute; z-index: 101; background: white; opacity: 0.8;color:black;
	}
	.hover-end img {
		width: 100%;
	}
</style>
  <div class="tab-data">
	  <div class="container-fluid">
		  <div class="container">
			  <div class="row">
				  <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px;">
					  <div class="team-detail-content nopaddingtop">
						  <div class="clearfix header-section-content">
							  @php
								  $page_name = "Upload Csv"
							  @endphp
							  <h3 class="title-content">{{ $page_name }}<small></small></h3>
						  </div>
						  <div class="sec-content fw-ct">
							  <div class="row">
								  <div class="col-sm-12">
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
						  </div>

					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>
  @if(Session::get('lesson_name'))
	  <div class="notification">
		  <p>All invites have been cleared for [{{Session::get('lesson_name')}}]</p>
	  </div>
  @endif
@endsection
@push('scripts')
<script type="text/javascript">
	setTimeout(function(){
		$(".notification").hide();
	}, 2000);

  $('.invitation .dropdown h3').click(function(){
    $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
  });

  function check_uncheck_checkbox(isChecked) {
    if(isChecked) {
      $('input[name="user"]').each(function() { 
        this.checked = true; 
      });
    } else {
      $('input[name="user"]').each(function() {
        this.checked = false;
      });
    }
  }
  $('.dot-dropdown li a#cbutton').click(function(){
	  $('#lesson_id').val($(this).find('.lesson_id').val());
	  $('#clear-invite').addClass("active");
  });
  $('.invitation table tbody tr td .fa-minus-circle').click(function(){
	  $('#lesson_id2').val($(this).closest('.table-data').find('.lesson_id').val());
	  $('#student_id').val($(this).find('.student_id').val());
	  $('#remove-invite').addClass("active");
  });
  $('.cancel-button').click(function(){
	  $('.clear-invite').removeClass("active");
  });

  $("#search").keyup(function () {
	  var filter = jQuery(this).val();
	  jQuery(".library-data .library-box").each(function () {
		  if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
			  jQuery(this).hide();
		  } else {
			  jQuery(this).show()
		  }
	  });
  });

</script>
@endpush