@extends('layouts.master')
@section('content')
<?php $user = Auth::user();?>
<div class="banner-sec-wrap banner-bg banner-teacher">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 col-sm-12 col-md-12 col-lg-10 mx-auto">
        <div class="sec-title">
          <h4 class="banner-title1">Welcome, {{$user->name}}</h4>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          <!-- side bar menu-->
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">
              <div class="clearfix header-section-content">
                <h3 class="title-content">Reports</h3>
              </div>
              <form method="get" accept="" class="form-inline fw-ct">
                <div class="fwrow">
                  <div class="form-group wfw">
                    <select class="form-control select_grade" name="grade" onchange="changeGrade($(this))">
                      <option value="">Select Course</option>
                    </select>
                    <select class="form-control select_quiz" name="quiz" onchange="changeQuizZ($(this))">
                      <option value="">Select Quiz</option>
                    </select>
                  </div>
                  <div class="form-group w20">
                    <button class="btn btn-primary" type="submit">Apply Filter</button>
                  </div>
                </div>
              </form>
              @if($quiz_questions)
              <div class="clearfix header-section-content">
                <h3 class="title-content">Reports data</h3>
              </div>
              <div class="clearfix"></div>
                  <div class="table-scroll">
                    <table class="output1 table table-bordered table-striped">
                      <thead>
                        <th>Student</th>
                        @foreach($quiz_questions->groupBy('case_data') as $key=>$q)
                          <th>{{strtoupper(substr($key, -3))}}({{$q->count()}})</th>
                        @endforeach
                      </thead>
                      <tbody>
                        @foreach($data->groupBy('userid') as $key=>$data_user)
                          <tr>
                            <td data-id="{{$key}}">{{$data_user[0]->firstname.' '.$data_user[0]->lastname}}</td>
                            @foreach($data_user->groupBy('case_data') as $key=>$q)
                              <td>{{number_format($q->sum('fraction')/$q->count()*100)}}%</td>
                            @endforeach
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              @endif
              @if($attempt_students)
              <div class="clearfix header-section-content">
                <h3 class="title-content">Students</h3>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-sm-3">
                  @foreach($attempt_students as $student)
                    <div class="form-check">
                      <input class="form-check-input" id="{{$student->id}}" type="checkbox" name="students" value="{{$student->id}}">
                      <label class="form-check-label" for="{{$student->id}}">{{$student->firstname}} {{$student->lastname}}</label>
                    </div>
                  @endforeach
                  <button class="btn btn-primary filter_students" type="button">Apply</button>
                </div>
                <div class="output_filter col-sm-9">
                </div>
              </div>
              @endif

              @if($quiz_questions)
              <div class="clearfix header-section-content">
                <h3 class="title-content">Objective</h3>
              </div>
              <div class="row">
                <div class="col-sm-3">
                  <label >Objective</label>
                  <select class="custom-select" name="objective">
                    <option value="">Select objective</option>
                    @foreach($quiz_questions->groupBy('case_data') as $key=>$case_data)
                      <option value="{{$key}}">{{strtoupper(substr($key, -3))}}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-primary filter_objective" type="button">Apply</button>
                </div>
                <div class="output_objective col-sm-9">
                </div>
              </div>
              @endif

            <div class="fw-ct">

            </div>
            <input type="hidden" name="grade" value="{{$_GET['grade'] ?? ''}}">
            <input type="hidden" name="quiz" value="{{$_GET['quiz'] ?? ''}}">
              <!-- end fw-ct -->
              <!-- end content -->
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
  .speech_words span {
    border: 1px solid #412A7F;
    padding: 0 5px;
  }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript">
  let rest_url = 'https://upliftk12.com/assessments/webservice/rest/server.php';

  let report = new Object();

      /*$.getJSON( rest_url, {
        wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
        moodlewsrestformat: 'json',
        wsfunction: 'mod_quiz_get_quizzes_by_courses',
        courseids: [3]
      }).done(function( data ) {
            console.log(data, data.quizzes)
      });*/
    let current_grade = parseInt($('input[name="grade"]').val());
    select_grade = $(".select_grade");
    $.ajax({
        /*headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },*/
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
              // select_quiz.append('<option value"'+item.id+'">'+item.name+'</option>')
              if(item.id===current_grade){
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
              }
            })
          }
        }
      }).then(function() {
        // code here
      });
    let current_quiz = parseInt($('input[name="quiz"]').val());
    if($.isNumeric(current_quiz)){
      select_quiz = $(".select_quiz");
      $.ajax({
          url: rest_url,
          type: 'POST',
          data: {
            wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
            moodlewsrestformat: 'json',
            wsfunction: 'mod_quiz_get_quizzes_by_courses',
            courseids: [current_grade]
          },
          dataType: 'json',
          success: function(res) {
            if(res.quizzes){
              select_quiz.find('option').not(':first').remove();;
              $.each(res.quizzes, function(key, item){
                // select_quiz.append('<option value"'+item.id+'">'+item.name+'</option>')
                if(item.id===current_quiz){
                  select_quiz.append($("<option/>", { selected: 'selected', value: item.id, html: item.name }));
                }else{
                  select_quiz.append($("<option/>", { value: item.id, html: item.name }));
                }
              })
              select_quiz.focus();
            }
          }
        })
    }

    function changeGrade(el){
      val = $.trim(el.val());
      select_quiz = $(".select_quiz");
      if(val){
        $.ajax({
          /*headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },*/
          url: rest_url,
          type: 'POST',
          data: {
            wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
            moodlewsrestformat: 'json',
            wsfunction: 'mod_quiz_get_quizzes_by_courses',
            courseids: [val]
          },
          dataType: 'json',
          success: function(res) {
            if(res.quizzes){
              select_quiz.find('option').not(':first').remove();;
              $.each(res.quizzes, function(key, item){
                // select_quiz.append('<option value"'+item.id+'">'+item.name+'</option>')
                select_quiz.append($("<option/>", { value: item.id, html: item.name }));
              })
              select_quiz.focus();
            }
          }
        }).then(function() {
          // code here
        });
        var div = $('.output tbody');
        $.ajax({
          /*headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },*/
          url: rest_url,
          type: 'POST',
          data: {
            wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
            moodlewsrestformat: 'json',
            wsfunction: 'core_enrol_get_enrolled_users',
            courseid: val
          },
          dataType: 'json',
          success: function(res) {
            let students = {}
            if(res){
              div.html("")
              $.each(res, function(key, item){
                div.append('<tr data-id="'+item.id+'"><td>'+item.fullname+'</td></td')
                // div.append($("<tr/>", { 'data-id': item.id, html: item.fullname }));
                let id = item.id
                let student = {}
                student.id = item.id
                student.fullname = item.fullname

                students[id] = student
              })
            }
            report.students = students
            // console.log(report)
          }
        }).then(function() {
          // code here
        });

      }
    }

    $(document).on('click', '.filter_students', function(){
      var students = $('input[name="students"]:checked').map(function(_, el) {
        return $(el).val();
      }).get();
      var output_filter = $('.output_filter')
      var quizid = $('input[name="quiz"]').val()
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: './filter_students',
        type: 'POST',
        data: {
          quiz: quizid,
          students: students
        },
        dataType: 'json',
        success: function(res) {
          // console.log(res)
          if(res){
            output_filter.html(res)
          }
        }
      })
    })

    $(document).on('click', '.filter_objective', function(){
      var output_filter = $('.output_objective')
      var objective = $('select[name="objective"]').val()
      var quizid = $('input[name="quiz"]').val()
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: './filter_students',
        type: 'POST',
        data: {
          quiz: quizid,
          objective: objective
        },
        dataType: 'json',
        success: function(res) {
          // console.log(res)
          if(res){
            output_filter.html(res)
          }
        }
      })
    })

    function changeQuiz(el){
      let val = $.trim(el.find(":selected").val());
      if(val){
        var thead = $('.output').find('thead tr');
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: './get_list_questions',
          type: 'GET',
          data: {
            quizid: val
          },
          dataType: 'json',
          success: function(res) {
            thead.find('th').not(':first').remove();
            $.each(res, function(key, item){
              var stt = key+1
              thead.append($("<th/>", { html: 'Q'+stt }));
            });
          }
        });
        let attempts = {}
        $('.output').find('tbody tr').each(function(key, item){
          let _this = $(this)
          var userid = $(this).data('id')
          var attempt = {}
          $.ajax({
            url: rest_url,
            type: 'POST',
            data: {
              wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
              moodlewsrestformat: 'json',
              wsfunction: 'mod_quiz_get_user_attempts',
              status: 'finished',
              quizid: val,
              userid: userid
            },
            dataType: 'json',
            success: function(res) {
              if(res.attempts.length > 0){
                $.each(res.attempts, function(key, item){
                  if(item.state == 'finished'){
                    _this.removeClass('hidden')
                    var attemptid = item.id
                    var userid = item.userid
                    $.ajax({
                      url: rest_url,
                      type: 'POST',
                      data: {
                        wstoken: '38ab2831e0f19bc018a3a8a645ce4389',
                        moodlewsrestformat: 'json',
                        wsfunction: 'mod_quiz_get_attempt_review',
                        attemptid: attemptid
                      },
                      dataType: 'json',
                      success: function(res) {
                        if(res.questions.length > 0){
                          _this.find('td').not(':first').remove();
                          $.each(res.questions, function(key, item){
                            _this.append($("<td/>", { html: item.mark }));
                          });
                          attempts[userid] = res
                        }
                      }
                    });
                    return false
                  }

                })
              }else {
                _this.addClass('hidden')
              }
            }
          });
          // attempts[key] = attempt
        });
        report.attempts = attempts
        console.log(report)
        $.each(report.students, function(key,item){
          var attempts = report.attempts
          console.log(attempts[9])
        })
      }
    }


    function SelectClassAvg(el){
      val = el.val();
      if(val){
        $('.avgClassStd').html('');
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/teacher/get-students',
          type: 'POST',
          data: 'class_id='+val,
          success: function(res) {
            console.log(res);
            if(res.status == "success"){
              $('.avgClassStd').append(res.data);
            }
          }
        });
        button();
      }
    }
    function SelectAsm(el){
      val = el.val();
      if(val){
        $('.list_passage').find('option').not(':first').remove();
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/teacher/get-passages',
          type: 'POST',
          data: 'asm_id='+val,
          success: function(res) {
            if(res.status == "success"){
              if(res.show_passage == true) {
                $('.list_passage').append(res.data).parent().removeClass('hidden');
              }else {
                $('.list_passage').parent().addClass('hidden');
              }
            }
          }
        });
        button();
      }
    }
    function SelectPg(el){
        button();
    }
    function button(){
      // console.log($('.class_name').val(),$('.list_assessment').val(),$('.list_passage').val());
      if($('.class_name').val() && $('.list_assessment').val()/* && $('.list_passage').val()*/){
        $('button').prop('disabled', false);
      }
    }

      $(document).ready(function(){
        $("a.noclick").click(function(){
            if($(this).attr('aria-expanded') === "true"){
              $(this).removeClass('hasclick');
            } else {
              $(this).addClass('hasclick');
            }
          }
        );
      });
      $(document).ready(function(){
        $(".fw-ct .customshowlesson").first().find('.title-content').removeAttr('data-toggle');
        $(".customshowlesson .title-content").click(function(){
            if($(this).attr('aria-expanded') === "true"){
              $(this).removeClass('hasclick');
            } else {
             	$(this).addClass('hasclick');
            }
          }
        );
      });
  jQuery(document).ready(function(){
        button();
  });
</script>
@endpush
