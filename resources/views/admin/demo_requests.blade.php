@extends('layouts.master')
@section('content')
<?php  $user = Auth::user();?>
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
                    <h3 class="title-content">Demo Requests</h3>
                    You can see demo requests information(name, email) from users.
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
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($aRows as $aKey => $aRow)
                                                <tr>
                                                    <th scope="row">{{ $aKey+1 }}</th>
                                                    <td>{{$aRow->name}}</td>
                                                    <td>{{$aRow->email}}</td>
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
    @push('scripts')
    @endpush
@endsection
