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
                        <h3 class="title-content">{{ $aRow ? "Edit" : "Add New" }} Resource Type</h3>
                     </div>

                        <div class="sec-conten fw-ct">
                           <div class="row">
                                 <!--Form  add -->
                                 <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       @if($aRow)
                                       <form method="POST"  action="{{ route('admin.resource_type.update',$aRow->id) }}" enctype="multipart/form-data" style="width:100%;">
                                          @method('PUT')
                                          @else
                                       <form method="POST"  action="{{ route('admin.resource_type.store') }}" enctype="multipart/form-data" style="width:100%;">
                                          @endif
                                          @csrf
                                          <label for="name"><b>{{ __('Name') }}</b></label>
                                          <div class="form-group">
                                             <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Name">
                                             @if ($errors->has('name'))
                                             <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('name') }}</strong>
                                             </span>
                                             @endif
                                          </div>
                                          <button type="submit" class="btn btn-df">Save</button>
                                       </form>
                                    </div>
                                 </div>
                                 <!--Form  add end-->
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
