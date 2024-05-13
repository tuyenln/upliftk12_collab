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
                      <h3 class="title-content">{{ $aRow ? "Edit" : "Add New" }} Note</h3>
                    </div>
                        <div class="sec-content fw-ct">
                           <div class="row">

                                 <!--Form  add -->

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       @if($aRow)
                                       <form method="POST"  action="{{ route('admin.note.update',$aRow->id) }}" enctype="multipart/form-data" style="width:100%">
                                          @method('PUT')
                                          @else
                                       <form method="POST"  action="{{ route('admin.note.store', $id) }}" enctype="multipart/form-data" style="width:100%">
                                          @endif
                                          @csrf
                                          <div class="form-group">
                                             <label for="name"><b>{{ __('Notes') }}</b></label>
                                             <input hidden value="{{$user->id}}" name="created_by">
                                             <textarea type="text" id="name" name="notes" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}" required placeholder="Notes">{{ $aRow ? $aRow->notes : old('notes') }}</textarea>
                                             @if ($errors->has('notes'))
                                             <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('notes') }}</strong>
                                             </span>
                                             @endif
                                          </div>
                                          <button type="submit" class="btn btn-df">Submit</button>
                                       </form>
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
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style type="text/css">
   .hidden{display: none;}
   .bootstrap-tagsinput{
       display: block;
       width: 100%;
       min-height: calc(1.5em + 2rem + 2px);
       padding: 1rem 1.9rem;
       font-size: 1rem;
       font-weight: 400;
       line-height: 1.5;
       color: #495057;
       background-color: #fff;
       background-clip: padding-box;
       border: 1px solid #ced4da;
       border-radius: 0.625rem;
   }
   .bootstrap-tagsinput .tag {color: #1f1f1f;}
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@endpush
