@extends('layouts.master')
@section('content')


<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">
              <div class="clearfix header-section-content">
                <h3 class="title-content countCls" count="{{$list_asm->count()}}">My Courses  (
                    <span class="rslt">{{$list_asm->count()}}</span>)</h3>
              </div>
              <div class="sec-content fw-ct">
                <div class="row">
                  @if($list_asm)
                    @foreach($list_asm as $asm)
                    <div class="col-sm-6">
                      <ul id="progress">
                        <li><div class="node"><i class="fa fa-calculator"></i></div><p>{{$asm->name}}<span class="badge orange">Start</span></p></li>
                        <li><div class="divider grey"></div></li>
                        <li><div class="node orange"></div><p><a href="{{route('assessment.index', $asm->id)}}">Take a Placement Test</a></p></li>
                      </ul>
                    </div>
                    @endforeach
                  @endif
                  <div class="col-sm-6">
                      <ul id="progress" class="list"></ul>
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
<style type="text/css">
  .badge {
    color: #fff;
  }
  .node {
    height: 10px;
    width: 10px;
    border-radius: 50%;
    display:inline-block;
    transition: all 1000ms ease;
  }

  .activated {
    box-shadow: 0px 0px 3px 2px rgba(194, 255, 194, 0.8);
  }

  .divider {
    height: 40px;
    width: 2px;
    margin-left: 4px;
    transition: all 800ms ease;
    border: 1px dashed;
  }

  li p {
    display:inline-block;
    margin-left: 25px;
  }

  li {
    list-style: none;
    line-height: 1px;
  }

  .node.grey {background-color: rgba(201, 201, 201, 1);}
  .node.orange, .badge {background-color: rgba(255, 140, 0, 1);}
  .grey { border-color: rgba(201, 201, 201, 1); }
  .orange { border-color: rgba(255, 140, 01, 1); }
</style>

@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

});
</script>
@endpush
