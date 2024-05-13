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
                  $page_name = "Upload Csv"
                @endphp
                <h3 class="title-content">{{ $page_name }}<small></small></h3>
              </div>
                <div class="sec-content fw-ct">
                  <div class="row">
                    <div class="col-sm-12">
                          <form method="POST" enctype='multipart/form-data' action="{{ route('principal.student.postcsv') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="name">{{ __('Upload File') }}</label>
                              <input type="file" name="uploadcsv" class="form-control" required="">
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
