@extends('teacher.layout')
@section('title', 'Invite Student')
@section('content')
	<form method="POST" id="invite_form">
	@csrf
    <input value="{{Session::get('selectedClass')->id}}" name="class_id" hidden>
	<div class="s-box">
		<div class="container">
			<div class="student-invite-box" style="margin-bottom: 13px;">
				<div class="title">
					<h3>
						Manage Assignments
					</h3>
				</div>
				<div class="action-btn">
					<button type="button" class="cancel" onclick="window.location.href='/teacher'">Cancel</button>
					<button type="button" onclick="onInviteClick()" class="invite">Assign</button>
				</div>
			</div>
		</div>
	</div>
	<div class="s-box two">
		<div class="container">
			<div class="cal">
				<div class="title">
					<p>Lesson</p>
					<h3>
						{{$lesson->name}}
					</h3>
				</div>
				<div class="custom-date">
					<div id="datepicker" class="input-group date">
						<span class="mydate">Date</span>
						<input class="form-control" id="currentStart" value="{{ $lesson->getDate($lesson->id) }}" name="date" />
						<span class="input-group-addon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
					</div>
					<p class="p-text">Date student can access the lesson</p>
				</div>
			</div>
            <div class="search">
				<form action="#">
				  <input type="text" id="search" placeholder="Search Student" name="search">
				  <button type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<div class="table-data" style="overflow-x:auto;">
				<table>
					<tr>
					  <th class="cbox"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"><span class="checkbox-mark"></span></th>
					  <th>Id</th>
					  <th>First Name</th>
					  <th>Last Name <i class="fa fa-arrow-down" aria-hidden="true"></i></th>

					</tr>
					@foreach($students as $student)
					@php
					// var_dump($invite_id);
						// var_dump($lesson->getStudentArray($invite_id));
					@endphp
					<tr class="search-tr">
						<td class="cbox"><input type="checkbox" name="students[]" value="{{$student->id}}" @if(in_array($student->id, $lesson->getStudentArray($invite_id)?$lesson->getStudentArray($invite_id):[])) checked @endif><span class="checkbox-mark"></span></td>
					  	<td>{{$loop->index + 1}}</td>
					  	<td>{{$student->name}}</td>
					  	<td>{{$student->lname}}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
    </div>
	</form>
@endsection
@push('scripts')
<script>
   $('.invitation .dropdown h3').click(function(){
    $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
   });

//    $(document).on('ready', function() {
// 		$("#datepicker").datepicker({
// 		   format: 'mm-dd-yyyy',
// 		   todayHighlight: true
// 	   }).datepicker('update', new Date());
//    });
	$(document).on('ready', function() {
		$currentDate = $("#currentStart").val();

		if ($currentDate == null) {
			$("#datepicker").datepicker({
		   		format: 'mm-dd-yyyy',
		   		todayHighlight: true
	   		}).datepicker('update', new Date());
		} else {
			$("#datepicker").datepicker({
		   		format: 'mm-dd-yyyy',
		   		todayHighlight: true
	   		}).datepicker('update', new Date($currentDate));
		}
   });
   function check_uncheck_checkbox(isChecked) {
    // if(isChecked) {
    //   $('input[name="students"]').each(function() {
    //     this.checked = true;
    //   });
    // } else {
    //   $('input[name="students"]').each(function() {
    //     this.checked = false;
    //   });
    // }
	// $("#checkall").click(function(){
	// 	$('input:checkbox').not(this).prop('checked', this.checked);
	// });

	$('#checkall').change(function() {
		var checkboxes = $(this).closest('form').find(':checkbox').not($(this));
		checkboxes.prop('checked', $(this).is(':checked'));
	});
  }
   $("#search").keyup(function () {
	   var filter = jQuery(this).val();
	   jQuery("table .search-tr").each(function () {
		   if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
			   jQuery(this).hide();
		   } else {
			   jQuery(this).show()
		   }
	   });
   });
   function onInviteClick() {
       $('#invite_form').submit();
   };
</script>
@endpush
