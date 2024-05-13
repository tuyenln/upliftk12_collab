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
                        <h3 class="title-content">Lesson Detail</h3>
                     </div>
                     <div class="sec-content fw-ct">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="images-style">
                                 <div>{!! $aRow->image !!}</div>
                              </div>
                              <h3 class="title-content bg_underline">{{ $aRow -> name}}</h3>
                              <div class="single-des">
                                 {!! $aRow ->description !!}
                              </div>

                              {{-- @dump($aRow) --}}
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
