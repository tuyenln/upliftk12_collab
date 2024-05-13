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
                @php
                  $page_name = $aRow ? "Edit Student" : "Add New Student"
                @endphp
                <h3 class="title-content">{{ $page_name }}<small></small></h3>
              </div>

                <div class="sec-content fw-ct">
                  <div class="row">
                    <div class="col-sm-12">

                          @if($aRow)
                          <form method="POST"  action="{{ route('principal.student.update',$aRow->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @else
                            <form method="POST"  action="{{ route('principal.student.store') }}" enctype="multipart/form-data">
                              @endif

                              @csrf
                              <div class="form-group">
                                <label for="name">{{ __('First Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="First Name">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">{{ __('Middle Name') }}</label>
                                <input type="text" name="mname" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->mname : old('mname') }}" placeholder="Middle Name">
                                @if ($errors->has('mname'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mname') }}</strong></span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">{{ __('Last Name') }}</label>
                                <input type="text" name="lname" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->lname : old('lname') }}" required placeholder="Last Name">
                                @if ($errors->has('lname'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('lname') }}</strong></span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label for="name">{{ __('Student Id') }}</label>
                                <input type="text" name="student_id" id="student_id" class="form-control{{ $errors->has('student_id') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->student_id : old('student_id') }}" required placeholder="Student Id">
                                @if ($errors->has('student_id'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('student_id') }}</strong></span>
                                @endif
                              </div>

                              <button type="submit" class="btn btn-success">Save</button>
                            </form>

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
