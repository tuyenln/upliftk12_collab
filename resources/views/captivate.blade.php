@extends('layouts.master')

@section('content')
<div class="banner-sec-wrap banner-bg">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 col-sm-12 col-md-12 col-lg-10 mx-auto">
        <div class="sec-title">
          <h4 class="mb-0 banner-title1 pt-5 pb-5">Captivate</h4>
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
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2 mx-auto">
            <div class="contact-content">
              <div class="sec-title mb-5">
                <h3>Test Captivate</h3>
              </div>
              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                       <th>#</th>
                       <th>Student ID</th>
                       <th>Invite ID</th>
                       <th>Quiz Name</th>
                       <th>Quiz Attempts</th>
                       <th>Total Questions</th>
                       <th>Status</th>
                       <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($aRows as $i=>$aRow)
                  <tr>
                  {{--@if(isset($aRow->data['CompanyName']))
                  @php
                  $var = [];
                  foreach($aRow->data as $key=>$ele){
                    if(isset($ele['@attributes'])){
                      $var[$key] = $ele['@attributes']['value'];
                    }else {
                      $var_child = [];
                      foreach($ele as $key_1=>$e){
                        if(isset($e['@attributes'])){
                          $var_child[$key_1] = $e['@attributes']['value'];
                        }else{
                          $var_child_child = [];
                          /*foreach($e as $key_2=>$chau){
                            if(isset($chau['@attributes'])){
                              $var_child_child[$key_2] = $chau['@attributes']['value'];
                            }
                          }*/
                          $var_child[$key_1] = $var_child_child;
                        }
                      }
                      $var[$key] = $var_child;
                    }
                  }
                  $var['Result']['CoreData']['Status'] = ($aRow->data['Result']['CoreData']['Status']['@attributes']['value']);
                  $var['Result']['CoreData']['Score'] = ($aRow->data['Result']['CoreData']['Score']['@attributes']['value']);
                  @endphp--}}
                    <td>{{ $i+1 }}</td>
                    <td>{{ $aRow['student_id'] }}</td>
                    <td>{{ $aRow['invite_id'] }}</td>
                    <td>{{ $aRow['quiz_name'] }}</td>
                    <td>{{ $aRow['quiz_attempts'] }}</td>
                    <td>{{ $aRow['total_questions'] }}</td>
                    <td>{{ $aRow['status'] ?? '' }}</td>
                    <td>{{ $aRow['score'] ?? '' }}</td>
                  </tr>
                  {{-- @dump($var) --}}
                @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
