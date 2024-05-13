@extends('layouts.master')
@section('content')
<style>
.takelesson {
  background: #412A7F;
  padding: 5px 20px;
  color: #fff;
}
</style>

<div class="content sec-pad">
   <div class="team-detail-wrap shape-wrap">
      <div class="container">
         <div class="membersingle-info team-detail-space">
            <div class="row align-items-start">
               <!-- side bar menu-->
               @include('layouts/frontsidebar')
               <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
                  <div class="team-detail-content">
                     <div class="clearfix header-section-content">
                        <h3 class="title-content">My Lessons</h3>
                     </div>
                     <div class="sec-content fw-ct">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           @if(count($lessons))
                              <table class="table table-bordered table-striped">
                                 <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Lesson</th>
                                          <th>Action</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                 <?php $i =1; ?>
                                    @foreach($lessons as $lesson)
                                    <tr>
                                       <th scope="row"><?php echo $i++;?></th>
                                       <td>{{$lesson->name}}</td>
                                       <td>
                                          <a class="takelesson" href="{{route('student.lesson.start', $lesson->id)}}">Take Lesson</a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           @else
                           No data found
                           @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
