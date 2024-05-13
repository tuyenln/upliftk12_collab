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
                  <div class="team-detail-content nopaddingtop">
                     <div class="clearfix header-section-content">
                        <h3 class="title-content">Lesson</h3>
                     </div>
                     <div class="fw-ct ct-list-lessons">
                        <div class="row">
                           @foreach($aRows as $aKey => $aRow)
                           <div class="col-sm-6 item-lesson">
                              <h3 class="title-content bg_underline">{{ $aRow->name }}</h3>
                              <div class="images-style">
                                 <div>{!! $aRow->image !!}</div>
                              </div>
                              <div class="deslesson">{!! $aRow->description !!}
                              </div>
                              <a href="{{ route('teacher.lesson.detail',$aRow->id) }}" class="btn gotosingle">Detail</a>
                              <a href="{{ route('teacher.lesson.invite',$aRow->id) }}" class="btn mr-2 gotosingle">Invite</a>
                           </div>
                           @endforeach
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
