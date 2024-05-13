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
                        <div class="flash-message col-sm-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        </div>
                        <div class="flash-message">
                           @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                           @if(Session::has('alert-' . $msg))
                           <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                           @endif
                           @endforeach
                        </div>
                        <div class="col-sm-12">
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.teacher.signup.update', $aRow->id]]) !!}
                           <div class="form-group">
                             {!!  Form::label('Name', null, ['class' => 'control-label']) !!}
                             {!!  Form::text('name', $aRow->name, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('Email address', null, ['class' => 'control-label']) !!}
                             {!!  Form::email('email', $aRow->email, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('State Name', null, ['class' => 'control-label']) !!}
                             {!!  Form::text('state_name', $aRow->teacher_signup->state, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('District Name', null, ['class' => 'control-label']) !!}
                             {!!  Form::text('district_name', $aRow->teacher_signup->district, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('School Name', null, ['class' => 'control-label']) !!}
                             {!!  Form::text('school_name', $aRow->teacher_signup->school, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('Phone Number', null, ['class' => 'control-label']) !!}
                             {!!  Form::number('phone', $aRow->teacher_signup->phone, ['class' => 'form-control']) !!}
                           </div>
                           {{-- <div class="form-group">
                             {!!  Form::label('Username', null, ['class' => 'control-label']) !!}
                             {!!  Form::text('username', $aRow->username, ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('password', null, ['class' => 'control-label']) !!}
                             {!!  Form::password('password', ['class' => 'form-control']) !!}
                           </div>
                           <div class="form-group">
                             {!!  Form::label('password Confirm', null, ['class' => 'control-label']) !!}
                             {!!  Form::password('confirm_password', ['class' => 'form-control']) !!}
                           </div> --}}
                           <div class="form-group">
                             {!!  Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                           </div>
                        {!! Form::close() !!}
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
