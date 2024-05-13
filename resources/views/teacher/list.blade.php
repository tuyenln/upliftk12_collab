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
                <h3 class="title-content">Manage Classes</h3>
                <a href="{{ route('teacher.class.create') }}" class="btn btn-primary pull-right button-header-content">Add Class</a>
              </div>
              <div class="fw-ct">
                            @if(count($aRows))
                            <div class="table-scroll">
                              <table class="table table-bordered customtable1 actionlistform">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Subject</th>
                                          <th>Grade Level</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($aRows as $aKey => $aRow)
                                      <tr>
                                          <th scope="row">{{ $aKey+1 }}</th>
                                          <td>{{$aRow->name}}</td>
                                           <td>{{$aRow->subject->name ?? ''}}</td>
                                          <td>{{$aRow->grade_level->name ?? ''}}</td>
                                          <td>
                                              <a class="edit" href="{{ route('teacher.class.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
                                              <a class="manager" href="{{ route('teacher.class.manage.student',$aRow->id) }}"><i class="lni lni-users"></i></a>
                                              <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                                              </a>
                                              <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('teacher.class.destroy',$aRow->id) }}" method="post" style="display: none;">
                                                 {{ method_field('DELETE') }}
                                                 {{ csrf_field() }}
                                              </form>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
