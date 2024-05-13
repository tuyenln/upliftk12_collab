@extends('teacher.layouts.master')
@section('title', 'Teacher')
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
							  $page_name = $aRow ? "Edit Student" : "Add New Student"
						  @endphp
						  <h3 class="title-content">{{ $page_name }}<small></small></h3>
					  </div>

					  <div class="sec-content fw-ct">
						  <div class="row">
							  <div class="col-sm-12">

								  @if($aRow)
									  <form method="POST"  action="{{ route('teacher.student.update',$aRow->id) }}" enctype="multipart/form-data">
										  @method('PUT')
										  @else
											  <form method="POST"  action="{{ route('teacher.student.store') }}" enctype="multipart/form-data">
												  @endif

												  @csrf
												  <div class="form-group">
													  <label for="name">{{ __('First Name') }}</label>
													  <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="First Name">
													  @if ($errors->has('name'))
														  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
													  @endif
												  </div>

												  <div class="form-group">
													  <label for="name">{{ __('Middle Name') }}</label>
													  <input type="text" name="mname" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->mname : old('mname') }}" placeholder="Middle Name">
													  @if ($errors->has('mname'))
														  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mname') }}</strong></span>
													  @endif
												  </div>

												  <div class="form-group">
													  <label for="name">{{ __('Last Name') }}</label>
													  <input type="text" name="lname" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->lname : old('lname') }}" required placeholder="Last Name">
													  @if ($errors->has('lname'))
														  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('lname') }}</strong></span>
													  @endif
												  </div>

												  <div class="form-group">
													  <label for="name">{{ __('Student Id') }}</label>
													  <input type="text" name="student_id" id="student_id" class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->student_id : old('student_id') }}" required placeholder="Student Id">
													  @if ($errors->has('student_id'))
														  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('student_id') }}</strong></span>
													  @endif
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
