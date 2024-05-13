@extends('layouts.master')
@section('content')
<?php $user = Auth::user();?>

<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          <!-- side bar menu-->
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content">
              <h2>{{ $aClass->name }}</h2>
              @foreach($aClass->assessments() as $assessment)
              <h5>{{ $assessment->name }}</h5>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Words correct per min</th>
                    <th>Words</th>
                    <th>Phonemes</th>
                    <th>Syllables</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($aClass->students() as $key=>$student)
                    @php
                    $total = 0; $avg = 0;
                    $list_pt = $student->placement_tests()->filterAssessment($assessment->id)->pluck('id')->toArray();
                    if($list_pt){
                      $list_sp = $student->speech_results()->placementTest($list_pt)->get();
                      if($list_sp){
                        foreach($list_sp as $sr){
                          $total += $sr->result['overall_metrics']['wcm'];
                        }
                      }
                    }
                    if($count = $student->speech_results->count()){
                      $avg = $total/$count;
                    }
                  @endphp
                  <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ number_format($avg, 2) }}</td>
                    <td>{{ number_format($student->speech_words->average('score'), 2) }}%</td>
                    <td>{{ number_format($student->phonemes->average('score'), 2) }}%</td>
                    <td>{{ number_format($student->syllables->average('score'), 2) }}%</td>
                  </tr>
                 @endforeach
               </tbody>
              </table>
              @endforeach
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection
