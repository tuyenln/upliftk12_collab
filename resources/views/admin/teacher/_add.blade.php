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
                     <div class="clearfix header-section-content ">
                        <h3 class="title-content">{{ isset($aRow) ? 'Edit' : 'Add New' }} Teacher</h3>
                     </div>
                     <div class="fw-ct">
                     <div class="row">
                        <div class="flash-message">
                           @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                           @if(Session::has('alert-' . $msg))
                           <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                           @endif
                           @endforeach
                        </div>
                        @if(isset($aRow))
                           @php $url = $user->is_admin ? route('admin.teacher.update',$aRow->id) : route('principal.teacher.update',$aRow->id); @endphp
                        <form method="POST"  action="{{ $url }}" enctype="multipart/form-data" style="width:100%;">
                           @method('PUT')
                        @else
                           @php $url = $user->is_admin ? route('admin.teacher.store') : route('principal.teacher.store'); @endphp
                        <form method="POST"  action="{{ $url }}" enctype="multipart/form-data" style="width:100%;">
                        @endif
                           @csrf
                           @if($user->is_admin)

                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <label class="control-label" for="name">State Name <span class="required">*</span></label>
                                 @php
                                 $path = resource_path('us-states.json');
                                 $jsonString = file_get_contents($path);
                                 $data = json_decode($jsonString);
                                 $states = $data->states->state;
                                 @endphp
                                 <select class="form-control @error('state_name') is-invalid @enderror" name="state_name">
                                    <option value="">--Select State--</option>
                                    @foreach($states as $state)
                                       <option value="{{ $state->name }}" {{ (isset($aRow) && $aRow->state == $state->name) ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                                 {{-- <input class="form-control error('state_name') is-invalid @enderror" name="state_name" placeholder="State Name"  type="text"  value="{{ old('state_name') }}"  autocomplete="state_name" autofocus> --}}
                                 @error('state_name')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <label class="control-label" for="name"> District Name  <span class="required">*</span>
                                 </label>
                                 <select class="form-control  @error('district_name') is-invalid @enderror" name="district_name" id="dist">
                                    <option value="">--Select District Name--</option>
                                    @foreach($districts as $districts)
                                    <option value="{{$districts->id}}" {{ (isset($aRow) && $aRow->school_info->district == $districts->id) ? 'selected' : '' }}>{{$districts->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('district_name')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <label class="control-label " for="name"> School Name <span class="required">*</span>
                                 </label>
                                 <select class="form-control @error('school_name') is-invalid @enderror" name="school_name" id="school_name">
                                    @if(isset($aRow))
                                    <option value="{{ $aRow->school_info->id }}" selected="">{{ $aRow->school_info->school }}</option>
                                    @endif
                                 </select>
                                 @error('school_name')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           @else
                              <input type="hidden" name="state_name" value="{{ $user->state }}">
                              <input type="hidden" name="district_name" value="{{ $user->district }}">
                              <input type="hidden" name="school_name" value="{{ $user->school_district }}">
                           @endif
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <label class="control-label" for="name"> First Name<span class="required">*</span>
                                 </label>
                                 <input class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name" type="text"
                                    value="{{ $aRow->first_name ?? old('first_name') }}" autocomplete="first_name" autofocus />  @error('first_name')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="item form-group">
                                 <label class="control-label" for="name"> Last Name<span class="required">*</span>
                                 </label>
                                 <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name" type="text"
                                    value="{{ $aRow->last_name ?? old('last_name') }}" autocomplete="last_name" autofocus/>
                                 @error('last_name')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class=" form-group">
                                 <label class="control-label" for="name"> Email<span class="required">*</span>
                                 </label>
                                 <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $aRow->email ?? old('email') }}"  autocomplete="email" autofocus placeholder="Email"  type="email">
                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class=" form-group">
                                 <label class="control-label " for="name"> Password<span class="required">*</span>
                                 </label>
                                 <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="password" autofocus placeholder="Password "  type="password">
                                 @error('password')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <label class="control-label " for="name"> Re-enter password <span class="required">*</span>
                                 </label>
                                 <input class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ old('confirm_password') }}"  autocomplete="confirm_password" autofocus placeholder="Re-enter Password "  type="password">
                                 @error('confirm_password')
                                 <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group">
                                 <input type="submit" name ="add_category" class="btn btn-success" value="Submit" />
                                 <input type="reset" name ="add_category" class="btn btn-danger" value="Cancel" />
                              </div>
                           </div>
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
@push('scripts')
<script type="text/javascript">
   $(document).on("change", '#dist', function(e) {
   var department = $(this).val();
   var url="{{url('get_school_dist')}}";
   $.ajax({
   type: "POST",
   data: {department: department,"_token": "{{ csrf_token() }}"},
   url: url,
   success: function(json)
   {
   $('#school_name').html(json);
   }
   });

   });
</script>
@endpush
