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
                     <div class="clearfix header-section-content hasbutton">
                        <h3 class="title-content">Manage Lessons</h3>
                        @if(Session::has('message'))
                           <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                        <a href="{{ route('admin.lesson.create') }}" class="btn btn-primary pull-right button-header-content">Add Lesson</a>
                     </div>
                        <div class="sec-content fw-ct">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!--tabel start-->
                                 <div class="x_content">

                                    @if(count($aRows))
                                    <div class="table-scroll">
                                       <table class="table table-bordered table-striped customtable1 actionlistform">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th class="w-100">Grade Levels</th>
                                                <th>Subject</th>
                                                 <th>Resource Type</th>
                                                <th>Objective</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($aRows as $aKey => $aRow)
                                             <tr>
                                                <th scope="row">{{ $aKey+1 }}</th>
                                                <td>{{$aRow->name}}</td>
                                                <td>{!! $aRow->image !!}</td>
                                                <td>{{$aRow->gl()}}</td>
                                                <td>{{$aRow->subject->name}}</td>
                                                 <td>{{$aRow->resource_type->name}}</td>
                                                <td>{{$aRow->objective}}</td>
                                                <td>
                                                   @if($user->is_admin)
                                                   <a class="edit" href="{{ route('admin.lesson.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
                                                   <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                                                   </a>
                                                   <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('admin.lesson.destroy',$aRow->id) }}" method="post" style="display: none;">
                                                      {{ method_field('DELETE') }}
                                                      {{ csrf_field() }}
                                                   </form>
                                                   @else
                                                   <a href="#">Invite Student</a>
                                                   @endif
                                                </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                       </table>
                                    </div>
                                    @else
                                    No data found
                                    @endif
                                 </div>
                                 <!--t6abel end-->
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
