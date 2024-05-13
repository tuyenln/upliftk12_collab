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
                     <div class="detail-about-content mb-5">
                        <div class="sec-content">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!--table start-->
                                 <div class="x_content">
                                    @if(count($contacts))
                                    <table class="table table-bordered table-striped">
                                       <thead>
                                          <tr>
                                             <th>#</th>
                                             <th>Name</th>
                                             <th>Title</th>
                                             <th>District</th>
                                             <th>School</th>
                                             <th>Phone</th>
                                             <th>Email</th>
                                             <th>Type</th>
                                             <th>Time</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach($contacts as $key => $c)
                                          <tr>
                                             <th scope="row">{{ $key+1 }}</th>
                                             <td>{{$c->name}}</td>
                                             <td>{{$c->title}}</td>
                                             <td>{{$c->district_name}}</td>
                                             <td>{{$c->school_name}}</td>
                                             <td>{{$c->phone}}</td>
                                             <td>{{$c->email}}</td>
                                             <td>{{$c->tyon}}</td>
                                             <td>{{$c->created_at}}</td>
                                          </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                    @else
                                    No data found
                                    @endif
                                 </div>
                                 <!--table end-->
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
</div>
@endsection
