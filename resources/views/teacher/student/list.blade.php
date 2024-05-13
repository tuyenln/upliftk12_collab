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
              <div class="clearfix header-section-content hasbutton doublebutton">
                <h3 class="title-content">Manage Students</h3>
                <div class="h2-button">
                  <a href="{{ route('teacher.student.create') }}" class="btn btn-primary pull-right button-header-content">Add Student</a>
                  <a href="{{ route('teacher.student.uploadcsv') }}" class="btn btn-primary pull-right button-header-content">Upload Csv</a>
                </div>
              </div>
              <div class="sec-content fw-ct">
                <div class="row">
                  <div class="col-sm-12">
                   <div class="x_content">
                    @if(count($aRows))
                    <div class="table-scroll">
                      <table class="table table-bordered table-striped actionlistform">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>UseName</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($aRows as $aKey => $aRow)
                          <tr>
                            <th scope="row">{{ $aKey+1 }}</th>
                            <td>{{$aRow->student_id}}</td>
                            <td>{{$aRow->username}}</td>
                            <td>{{$aRow->name}}</td>
                            <td>
                              <a class="edit" href="{{ route('teacher.student.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
                              <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                              </a>
                              <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('teacher.student.destroy',$aRow->id) }}" method="post" style="display: none;">
                               {{ method_field('DELETE') }}
                               {{ csrf_field() }}
                             </form>
                           </td>
                         </tr>
                         @endforeach
                       </tbody>
                     </table>
                   </div>
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
