@extends('layouts.master')
@section('content')
<?php   $user = Auth::user();?>
<div class="content sec-pad">
   <div class="team-detail-wrap shape-wrap">
      <div class="container-fluid">
         <div class="membersingle-info team-detail-space"  style="margin-top: -40px;">
            <div class="row align-items-start">
               <!-- side bar menu-->
               <div class="col-2">
                  <h5>Participants:</h5>
                  <div class="container" id="students_list">
                  </div>
                  <div id="teacher_div">
                  </div>
                  <textarea class="w-100 mt-3" rows="10"></textarea>
               </div>
               <div class="col-8">
                  <iframe class="w-100" style="height: 650px;" src="{{url($lesson->lessons_url)}}"></iframe>
               </div>
               <div class="col-2 student-videos-div">
                  <div id="video_section">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var lid = {{ $lesson->id }};
   var uid = {{ $user->id }};
   var isTeacher = {{ $user->user_type == 3 ? 1 : 0 }};
   var uname = "{{ $user->name }}";
</script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script src = "{{url('public/js/lsocket.js')}}"></script>
@endsection