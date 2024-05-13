@extends('layouts.new-master-front')

@section('content')
<section class="container-fluid aos-init aos-animate" style="min-height: 600px;">
    <div class="content sec-pad">
      <div class="team-detail-wrap shape-wrap">
        <div class="container">
          <div class="membersingle-info team-detail-space">
            <div class="row align-items-start">
              <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2 mx-auto">
                <h2>Activation</h2>
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error')}}
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success')}}
                </div>
                @endif
                  {{-- @if(session('success'))
                      <div class="alert alert-success">{!!session('success')!!}</div>
                  @endif
                  @if(session('error'))
                      <div class="alert alert-danger">{!!session('error')!!}</div>
                  @endif --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection