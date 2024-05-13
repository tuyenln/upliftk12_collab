@extends('layouts.master')
@section('content')


<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">
              <div class="clearfix header-section-content">
                <h3 class="title-content countCls">Lesson: {{ $lesson->name }}</h3>
              </div>
              <div class="sec-content fw-ct">
                <iframe width="100%" height="700" src="{{ $lesson->url }}"></iframe>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
