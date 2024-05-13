@extends('teacher.layouts.master')
<link href="{{ url('public/css/LineIcons.css') }}" rel="stylesheet" type="text/css" />
<style>
.btn-success {
	background: #6F48A9 !important;
	border:none !important;

}

.btn-success:hover {
	background: #5B3B99 !important;
	border:none !important;

}
</style>
@section('content')
<?php   $user = Auth::user();?>
<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          <!-- side bar menu-->
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">

                <div class="sec-content fw-ct">
                  <div class="row" style="margin-top: 30px;">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <div class="clearfix header-section-content">
                        <h3 class="title-content"> Add Student</h3>
                      </div>
						<form method="POST"  action="{{ route('teacher.class.manage.poststudent',$aClassId) }}" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							<label for="name">{{ __('Select Student') }}</label>
							{{--<select  class="js-example-basic-multiple-limit form-control" multiple name="student_list[]" style="height: 150px;">
								@foreach($aStudents as $aStudent)
								<option value="{{$aStudent->id}}">{{$aStudent->name}} ( {{$aStudent->student_id}} )</option>
                                <input type="checkbox" name="student_list[]" value="{{$aStudent->id}}">{{$aStudent->name}} ( {{$aStudent->student_id}} )
								@endforeach
							</select>--}}
                            <div class="table-data" style="overflow-x:auto;">
                                <table>
                                    <tr>
                                        <th class="cbox"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"><span class="checkbox-mark"></span></th>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name <i class="fa fa-arrow-down" aria-hidden="true"></i></th>

                                    </tr>
                                    @foreach($aStudents as $aStudent)
                                    <tr class="search-tr">
                                        <td class="cbox"><input type="checkbox" name="student_list[]" value="{{$aStudent->id}}"><span class="checkbox-mark"></span></td>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$aStudent->name}}</td>
                                        <td>({{$aStudent->student_id}})</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
							</div>
                            <a href="/teacher/manageClass" class="btn btn-primary" style="float: right; margin-left: 20px;">Back</a>
                            <button type="submit" class="btn btn-success" style="float: right;">Save</button>
                            <div class="clearfix"></div>
						</form>
                        {{--@if($aClass->subject && $aClass->subject->id == 4 && count($aStudentLists) != 0)
                          <h6>Total Students sync: {{$aStudentLists->where('mdl_UserID', '!=', null)->count()}}</h6>
                          Class Grade Level: {{$aClass->grade_level->name ?? ''}}<br>
                          <div class="list_courses"></div>
                          <select class="custom_select select_course">
                            <option value="" disabled>Select Course</option>
                          </select>
                          <button type="button" class="enrol_students">Enroll all students</button>
                          <input type="hidden" name="student_list" value="{{$aStudentLists->where('mdl_UserID', '!=', null)->pluck('mdl_UserID')->toJson()}}">
                          <span class="loading_ajax hidden"><i class="fa fa-spin fa-spinner"></i></span>
                        @endif--}}
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="x_content">
                            <div class="clearfix">
                              <h3 class="title-content">Student of {{ $aClass->name }}<small></small></h3>
                            </div>
                            @if(count($aStudentLists))
                              <div class="table-scroll">
                                <table class="table table-bordered table-striped customtable1 actionlistform actionlistform-1">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @php $i = 1 @endphp
                                    @foreach($aStudentLists as $aKey => $aStudentList)
                                    <tr>
                                      <th scope="row">{{ $i }}</th>
                                      <td>{{$aStudentList->name}} ( {{$aStudentList->student_id}} )</td>
                                      <td>
                                        <a class="delete" onclick="return confirm('Are you sure to delete?');" href="{{ route('teacher.class.delete.student',[$aClassId,$aStudentList->id]) }}"><i class="lni lni-trash"></i></a>
                                      </td>
                                    </tr>
                                    @php $i++ @endphp
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            @else
                            No data found
                            @endif
                            <div class="action-bottom">
                                <a href="{{ route('teacher.class.printroster', ['pdf',$aClassId] ) }}" class="btn btn-primary pull-right button-header-content">Print pdf</a>
                                <a href="{{ route('teacher.class.printroster', ['csv',$aClassId] ) }}" class="btn btn-success pull-right button-header-content" style="margin-right: 20px;">Print csv</a>
                              </div>
                          </div>
					  </div>
				  </div>
				  <div class="clearfix"></div>

                </div>
              </div>
          </div>
        </div>
      </div>
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
<script type="text/javascript">
  /*$(".js-example-basic-multiple-limit").select2({
    tags: true,
    allowClear: true,
    placeholder: 'Select Student',
  });*/
  let current_grade  = 0;
  let rest_url = 'https://upliftk12.com/assessments/webservice/rest/server.php';
  let student_list = $.parseJSON($('input[name=student_list]').val())
  select_grade = $(".select_course");
  let list_courses = []
    $.ajax({
        url: rest_url,
        type: 'POST',
        data: {
          wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
          moodlewsrestformat: 'json',
          wsfunction: 'core_course_get_courses_by_field',
          field: 'category',
          value: 3
        },
        dataType: 'json',
        success: function(res) {
          if(res.courses){
            select_grade.find('option').not(':first').remove();
            $.each(res.courses, function(key, item){
            	list_courses.push({id: item.id, name: item.displayname})
              // select_quiz.append('<option value"'+item.id+'">'+item.name+'</option>')
              /*if(item.id===current_grade){
                select_grade.append($("<option/>",
                {
                  selected: 'selected',
                  value: item.id,
                  html: item.displayname
                }));
              }else {
                select_grade.append($("<option/>",
                {
                  value: item.id,
                  html: item.displayname
                }));
              }*/
            })
          }
          outputCourses()
        }
      }).then(function() {
        // code here
  	});
    html_courses = $('.list_courses')
    function outputCourses(){
	    // console.log(list_courses)
	    let st_courses = []
	    $.each(list_courses, function(key,item){
	    	$.ajax({
		        url: rest_url,
		        type: 'POST',
		        data: {
		          wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
		          moodlewsrestformat: 'json',
		          wsfunction: 'core_enrol_get_enrolled_users',
		          courseid: item.id
		        },
		        dataType: 'json',
		        success: function(res) {
		          if(res.length){
                let st_id = res.map(a => a.id);
                let intersection = st_id.filter(x => student_list.includes(x));
                // console.log(intersection,st_id,student_list)
		          	// st_courses.push(res.length)
		            html_courses.append('<li>'+item.name+': '+intersection.length+'/'+student_list.length+' students enrolled</li>')
                if(intersection.length < student_list.length){
                  if(item.id===current_grade){
                    select_grade.append($("<option/>",
                    {
                      selected: 'selected',
                      value: item.id,
                      html: item.name
                    }));
                  }else {
                    select_grade.append($("<option/>",
                    {
                      value: item.id,
                      html: item.name
                    }));
                  }
                }
		          }
		        }
		    }).then(function() {
		        // code here
		  	});
	    })
	    // console.log(st_courses)
    }

  $(document).on('click', '.enrol_students', function(){
    let val = $(".select_course").val();

    // console.log(student_list)
    let enrolments = []
    $.each(student_list, function(i, item) {
      enrolment = {
              roleid: 5,
              userid: item,
              courseid: val
            }
      enrolments.push(enrolment)
    });
    // console.log(enrolments)
    var loading_ajax = $('.loading_ajax')
    loading_ajax.removeClass('hidden')
    $.ajax({
        url: rest_url,
        type: 'POST',
        data: {
          wstoken: '388eb23ecf831b5a120afea2eccda465',
          moodlewsrestformat: 'json',
          wsfunction: 'enrol_manual_enrol_users',
          enrolments: enrolments
        },
        dataType: 'json',
        success: function(res) {
          console.log(res)
          if(res){
            alert("Success")
          }
        }
      }).then(function() {
    	loading_ajax.addClass('hidden')
        alert("Success")
      })
  })


</script>
@endpush
