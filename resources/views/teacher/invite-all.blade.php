@extends('layouts.master')
@section('content')
<?php   $user = Auth::user();?>

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
                        <h3 class="title-content">Invite Students here</h3>
                        <a href="/teacher/lesson" class="btn gotosingle">Invite More</a>
                     </div>
                     <div class="sec-content fw-ct">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           @if(count($aRows))
                              <table class="table table-bordered table-striped">
                                 <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Lesson</th>
                                          <th>Student Name</th>
                                          <th>Action</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                 <?php $i =1; ?>
                                    @foreach($aRows as $aKey => $aRow)
                                    <tr>
                                       <th scope="row"><?php echo $i++;?></th>
                                       <td>{{$aRow->lesson()->name}}</td>
                                       <td>@foreach($aRow->students() as $index => $t) @if($loop->first) {{$t->name}} @else , {{$t->name}}@endif @endforeach</td>
                                       <td>
                                          <a class="edit" href="{{route('teacher.lesson.start', $aRow->lesson()->id)}}"><i class="lni lni-play"></i></a>
                                          <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                                          </a>
                                          <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('teacher.invite.lesson.destroy', $aRow->id) }}" method="post" style="display: none;">
                                             {{ method_field('DELETE') }}
                                             {{ csrf_field() }}
                                          </form>
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
