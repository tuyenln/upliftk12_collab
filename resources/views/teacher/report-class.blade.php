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
                    <select class="form-control class_name" name="class" onchange="SelectClass($(this))">
                      <option value="">Select Class</option>
                      @foreach($user->classes as $class)
                        <option value="{{$class->id}}" {{isset($_GET['class']) && $_GET['class'] == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="fwrow">
                  <div class="form-group w40">
                    <select class="form-control list_assessment" name="assessment" onchange="SelectAsm($(this))">
                      <option value="">Select Assessment</option>
                      @if($aClass)
                        @foreach($aClass->assessments() as $asm)
                          <option value="{{$asm->id}}" {{isset($_GET['assessment']) && $_GET['assessment'] == $asm->id ? 'selected' : ''}}>{{$asm->name}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w40 {{isset($_GET['passage']) && $_GET['passage'] == '' ? 'hidden' : ''}}">
                    <select class="form-control list_passage" name="passage" onchange="SelectPg($(this))">
                      <option value="">Select Passage</option>
                      @if($assessment && $assessment->passages)
                        @foreach($assessment->passages as $key=>$pg)
                          <option value="{{$key+1}}" {{isset($_GET['passage']) && $_GET['passage'] == $key+1 ? 'selected' : ''}}>{{$pg['name']}}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group w20">
                    <button class="btn btn-primary" type="submit" disabled>Apply Filter</button>
                  </div>
                </div>
              </form>

             <div class="fw-ct">
              <!-- section  1 -->
                @if($aClass && $passage_id >= 0 && !$assessment->sections)
                <div class="customshowlesson">
                  <h3 class="title-content bg_underline" data-toggle="collapse" href="#collapse-a1" aria-expanded="false" aria-controls="collapseExample">Students <span></span></h3>
                  <div class="table-scroll detail-ct-rp collapse" id="collapse-a1">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Student</th>
                              <th>Words correct/min</th>
                              <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php $j = 1 @endphp
                          @foreach($aClass->students() as $key=>$student)
                            @php
                              $content_word = $assessment->passages[$passage_id]['content'];
                              $array_word = explode(' ', $content_word);
                              $total = 0; $avg = 0;
                              $student_pt = $student->placement_tests()
                                            ->filterAssessment($assessment->id)
                                            ->filterPassage($passage_id+1)
                                            ->first();
                            @endphp
                            @if($student_pt)
                              <tr>
                              @php
                              $student_pt_words = $student_pt->speech_words->pluck('score', 'word')->toArray();
                              $speech_results = $student_pt->speech_results->first();
                              @endphp
                              <td>{{ $j }}</td>
                              <td><strong>{{ $student->full_name }}</strong></td>
                              <td>{{ number_format($speech_results->result['overall_metrics']['wcm'] ?? 0, 2) }}</td>
                              <td><a class="" href="{{ route('teacher.placement.singlee', $student_pt->id) }}">Click here</a></td>
                              @php $j = $j+1; @endphp
                            </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                @endif

                <!-- section  2 -->
                @if($assessment && $assessment->sections)
                <div class="customshowlesson">
                  <h3 class="title-content bg_underline" data-toggle="collapse" href="#collapse-a2" aria-expanded="false" aria-controls="collapseExample">Whole class average<span></span></h3>
                  @php
                    $students = $aClass->students();
                    $placement_tests = $assessment->placement_tests;
                    $list_sections_name = collect($assessment->sections)->pluck('name')->toArray();
                    $list_sections_value_chart = [];
                    $arr_color = [];
                    $list_color = ['255, 0, 0','255, 153, 0','255, 255, 0','0, 255, 0'];
                    $arr_students = [];
                    foreach ($assessment->sections as $key => $section) {
                      $pt_ids = $assessment->placement_tests()->filterSection($key+1)->pluck('id')->toArray();
                      $phonemes = $assessment->phonemes()->select('phonemes.*')->whereIn('phonemes.pt_id', $pt_ids)->get();
                      $score = (int) number_format($phonemes->avg('score') ?? 0);
                      $list_sections_value_chart[] = $score;
                      switch ($score) {
                        case $score >= 90:
                          $color = 3;
                          break;
                        case $score >= 70:
                          $color = 2;
                          break;
                        case $score >= 60:
                          $color = 1;
                          break;
                        case $score < 60:
                          $color = 0;
                          break;

                        default:
                          $color = 0;
                          break;
                      }
                      $arr_color[] = "rgba($list_color[$color], 0.5)";
                      $students_section = [];
                      foreach ($students as $key => $student) {
                        $phonemes = $assessment->phonemes()->select('phonemes.*')->where('phonemes.user_id', $student->id)->get();
                        $score = (int) number_format($phonemes->avg('score') ?? 0);
                        if($score < 70){
                          $students_section[] = $student->full_name;
                        }
                      }

                      $arr_students[$section['name']] = $students_section;
                    }
                  @endphp
                  <!-- draw chart -->
                  <div class="collapse detail-ct-rp detail-canvas" id="collapse-a2">
                  	<ul class="note-style">
                  		<li class="bullet-color color1">>90</li>
                  		<li class="bullet-color color2">71-90</li>
                  		<li class="bullet-color color3">60-70</li>
                  		<li class="bullet-color color4"><60</li>
                  	</ul>
                    <canvas id="myChart" width="400" height="200"></canvas>

                  </div>
                </div>
                @endif

                <!-- section  3 -->
                @if($assessment && $assessment->sections && $arr_students)
                <div class="customshowlesson">
                  <h3 class="title-content bg_underline" data-toggle="collapse" href="#collapse-a3" aria-expanded="false" aria-controls="collapseExample">Whole Class Small Grouping by Assessment Section<span></span></h3>
                  <div class="table-scroll detail-ct-rp collapse" id="collapse-a3">
                    <table class="table table-bordered table-striped">
                      <tr style="vertical-align:top;">
                          @foreach ($arr_students as $name=>$students_section)
                          <td style="padding: 0;">
                              <table>
                                <thead><tr style="height: 150px"><th style="vertical-align:middle;">{{$name}}</th></tr></thead>
                                  @foreach ($students_section as $student_name)
                                  <tr style="height: 100px">
                                      <td style="vertical-align:middle;">
                                          {{$student_name}}
                                      </td>
                                  </tr>
                                  @endforeach
                              </table>
                          </td>
                          @endforeach
                      </tr>
                    </table>
                  </div>
                </div>
                @endif

               <!-- section  4 -->
                @if($assessment && $assessment->sections)
                <div class="customshowlesson">
                   <h3 class="title-content bg_underline"  data-toggle="collapse" href="#collapse-a4" aria-expanded="false" aria-controls="collapseExample">Whole Class Average Phoneme <span></span></h3>
                  @php
                    $phonemes_lable_chart = [];
                    $phonemes_value_chart = [];
                    $phonemes_color_chart = [];
                    $phoneme_students = [];
                      foreach($assessment->phonemes->groupBy('phoneme') as $phonemes){
                        $phoneme_name = $phonemes->first()->phoneme;
                          $phonemes_lable_chart[] = $phoneme_name;
                          $score = (int) number_format($phonemes->avg('score') ?? 0);
                          $phonemes_value_chart[] = $score;
                          switch ($score) {
                            case $score >= 90:
                              $color = 3;
                              break;
                            case $score >= 70:
                              $color = 2;
                              break;
                            case $score >= 60:
                              $color = 1;
                              break;
                            case $score < 60:
                              $color = 0;
                              break;

                            default:
                              $color = 0;
                              break;
                          }
                          $phonemes_color_chart[] = "rgba($list_color[$color], 0.5)";

                          $students_section = [];
                          $students_ph = [];
                          foreach ($students as $key => $student) {
                            $phonemes_count = $assessment->phonemes()
                                          ->select('phonemes.*')
                                          ->where([
                                            'phonemes.user_id' => $student->id,
                                            'phonemes.phoneme' => $phoneme_name,
                                          ])
                                          ->where('score', '<', 80)
                                          ->count();
                            if($phonemes_count >= 3){
                              $students_ph[] = $student->full_name;
                            }
                          }
                          $phoneme_students[$phoneme_name] = $students_ph;
                      }
                  @endphp
                  <!-- draw chart -->
                  <div class="collapse detail-ct-rp detail-canvas" id="collapse-a4">
                  	<ul class="note-style">
                  		<li class="bullet-color color1">>90</li>
                  		<li class="bullet-color color2">71-90</li>
                  		<li class="bullet-color color3">60-70</li>
                  		<li class="bullet-color color4"><60</li>
                  	</ul>
                    <canvas id="phonemeChart" width="400" height="200"></canvas>
                  </div>
              </div>
              @endif

              <!-- section  5 -->
                @if($assessment && $assessment->sections && $phoneme_students)
                <div class="customshowlesson">
                  <h3 class="title-content bg_underline" data-toggle="collapse" href="#collapse-a5" aria-expanded="false" aria-controls="collapseExample">Whole Class Small Grouping by Phoneme<span></span></h3>
                  <div class="table-scroll detail-ct-rp collapse" id="collapse-a5">
                    <table class="table table-bordered table-striped">
                      <tr style="vertical-align:top;">
                          @foreach ($phoneme_students as $name=>$students_ph)
                          <td style="padding: 0;width: 100px">
                              <table style="width: 100%;">
                                <thead><tr><th style="vertical-align:middle;">{{$name}}</th></tr></thead>
                                  @foreach ($students_ph as $student_name)
                                  <tr style="height: 100px">
                                      <td style="vertical-align:middle;">
                                          {{$student_name}}
                                      </td>
                                  </tr>
                                  @endforeach
                              </table>
                          </td>
                          @endforeach
                      </tr>
                    </table>
                  </div>
                </div>
                @endif

              <!-- section  6 -->
              @if($assessment && $assessment->sections && $students)
                <h3 class="title-content bg_underline">Individual Student Report</h3>
                @php $students_id = $students->pluck('id')->toJson(); @endphp

                <div class="students_chart" data-students="{{ $students_id }}">
                  @foreach ($students as $student)
                    <h5>
                      <a class="noclick" type="button" data-toggle="collapse" href="#collapse-{{ $student->id }}" aria-expanded="false" aria-controls="collapseExample">
                        {{ $student->full_name }}
                        <span></span>
                      </a>
                    </h5>
                    <div class="collapse" id="collapse-{{ $student->id }}">
                      <div class="card card-body">
                      @php
                      $sections_value = [];
                      $sections_color = [];
                      foreach ($assessment->sections as $key => $section) {
                        $pt_ids = $assessment->placement_tests()->filterSection($key+1)->pluck('id')->toArray();
                        $phonemes = $assessment->phonemes()
                          ->select('phonemes.*')
                          ->whereIn('phonemes.pt_id', $pt_ids)
                          ->where('phonemes.user_id', $student->id)
                          ->get();
                          $score = (int) number_format($phonemes->avg('score') ?? 0);
                          $sections_value[] = $score;
                          switch ($score) {
                            case $score >= 90:
                              $color = 3;
                              break;
                            case $score >= 70:
                              $color = 2;
                              break;
                            case $score >= 60:
                              $color = 1;
                              break;
                            case $score < 60:
                              $color = 0;
                              break;
                            default:
                              $color = 0;
                              break;
                          }
                          $sections_color[] = "rgba($list_color[$color], 0.5)";
                      }
                      @endphp
                      <div class="detail-canvas">
	                    <ul class="note-style">
	                  		<li class="bullet-color color1">>90</li>
	                  		<li class="bullet-color color2">71-90</li>
	                  		<li class="bullet-color color3">60-70</li>
	                  		<li class="bullet-color color4"><60</li>
	                  	</ul>

                      	<canvas id="chartSections-{{ $student->id }}" data-value="{{ json_encode($sections_value) }}" data-color="{{ json_encode($sections_color) }}"></canvas>
                     </div>

                      @php
                      $phonemes_value = [];
                      $phonemes_color = [];
                      foreach($assessment->phonemes->groupBy('phoneme') as $phonemes){
                          $phoneme_name = $phonemes->first()->phoneme;
                          $phonemes = $assessment->phonemes()
                                          ->select('phonemes.*')
                                          ->where([
                                            'phonemes.user_id' => $student->id,
                                            'phonemes.phoneme' => $phoneme_name,
                                          ])
                                          ->get();
                          $score = (int) number_format($phonemes->avg('score') ?? 0);
                          $phonemes_value[] = $score;
                          switch ($score) {
                            case $score >= 90:
                              $color = 3;
                              break;
                            case $score >= 70:
                              $color = 2;
                              break;
                            case $score >= 60:
                              $color = 1;
                              break;
                            case $score < 60:
                              $color = 0;
                              break;
                            default:
                              $color = 0;
                              break;
                          }
                          $phonemes_color[] = "rgba($list_color[$color], 0.5)";
                      }
                      @endphp
	                    <div class="detail-canvas">
	                      <ul class="note-style">
		                  		<li class="bullet-color color1">>90</li>
		                  		<li class="bullet-color color2">71-90</li>
		                  		<li class="bullet-color color3">60-70</li>
		                  		<li class="bullet-color color4"><60</li>
		                  </ul>
	                      <canvas id="chartPhonemes-{{ $student->id }}" data-value="{{ json_encode($phonemes_value) }}" data-color="{{ json_encode($phonemes_color) }}"></canvas>
	                    </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
{{--               <!-- section  7 -->
              <div class="bottomreport">
                <h3 class="title-content bg_underline">Find Averages</h3>
                <div class="detail-bottomreport">
                  <select id="test" name="avgClass" class="avgClass form-control" onchange="SelectClassAvg($(this))">
                          <option>Choose class</option>
                        @foreach($user->classes as $class)
                          <option value="{{$class->id}}" {{isset($_GET['class']) && $_GET['class'] == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                        @endforeach
                  </select>
                </div>
                <span class="avgClassStd"></span>
              </div> --}}


              </div>
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
  var ctx = document.getElementById('myChart').getContext('2d');
  var arr_label = [<?php echo '"'.implode('","', $list_sections_name ?? []).'"' ?>];
  var arr_data = [<?php echo '"'.implode('","', $list_sections_value_chart ?? []).'"' ?>];
  var arr_color = [<?php echo '"'.implode('","', $arr_color ?? []).'"' ?>];
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: arr_label,
          datasets: [{
              label: 'Score',
              data: arr_data,
              backgroundColor: arr_color,
              borderColor: 'rgba(4, 51, 128, 1)',
              borderWidth: 1
          }]
      },
      options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
      }
  });
  var phonemeChart = document.getElementById('phonemeChart').getContext('2d');
  var arr_label = [<?php echo '"'.implode('","', $phonemes_lable_chart ?? []).'"' ?>];
  var arr_data = [<?php echo '"'.implode('","', $phonemes_value_chart ?? []).'"' ?>];
  var arr_color = [<?php echo '"'.implode('","', $phonemes_color_chart ?? []).'"' ?>];
  var myChart = new Chart(phonemeChart, {
      type: 'bar',
      data: {
          labels: arr_label,
          datasets: [{
              label: 'Score',
              data: arr_data,
              backgroundColor: arr_color,
              borderColor: 'rgba(4, 51, 128, 1)',
              borderWidth: 1
          }]
      },
      options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
      }
  });
//student chart
if($('.students_chart').length){
  var students = $('.students_chart').data('students');
  $.each(students, function(i, s){
    var selector = $('#chartSections-'+s);
    var arr_data = selector.data('value');
    var arr_color = selector.data('color');
    var ctx = document.getElementById('chartSections-'+s).getContext('2d');
    var arr_label = [<?php echo '"'.implode('","', $list_sections_name ?? []).'"' ?>];
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arr_label,
            datasets: [{
                label: 'Score',
                data: arr_data,
                backgroundColor: arr_color,
                borderColor: 'rgba(4, 51, 128, 1)',
                borderWidth: 1
            }]
        },
        options: {
          legend: {
              display: false,
          },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var selector = $('#chartPhonemes-'+s);
    var arr_data = selector.data('value');
    var arr_color = selector.data('color');
    var ctx = document.getElementById('chartPhonemes-'+s).getContext('2d');
    var arr_label = [<?php echo '"'.implode('","', $phonemes_lable_chart ?? []).'"' ?>];
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arr_label,
            datasets: [{
                label: 'Score',
                data: arr_data,
                backgroundColor: arr_color,
                borderColor: 'rgba(4, 51, 128, 1)',
                borderWidth: 1
            }]
        },
        options: {
          legend: {
              display: false
          },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    // console.log(i,s);
  });
}

    function SelectClass(el){
      val = el.val();
      if(val){
        $('.list_assessment').find('option').not(':first').remove();
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/teacher/get-assessments',
          type: 'POST',
          data: 'class_id='+val,
          success: function(res) {
            if(res.status == "success"){
              $('.list_assessment').append(res.data);
            }
          }
        });
        button();
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
