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
                    $page_name = $aRow ? "Edit Class" : "Add New Class"
                @endphp
                <h3 class="title-content">{{ $page_name }}</h3>
              </div>
                <div class="sec-content fw-ct">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="x_content customform-class">

                      @if($aRow)
                      <form method="POST"  action="{{ route('teacher.class.update',$aRow->id) }}" enctype="multipart/form-data">
                      @method('PUT')
                      @else
                      <form method="POST"  action="{{ route('teacher.class.store') }}" enctype="multipart/form-data">
                      @endif

                      @csrf
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                          	<label for="name">{{ __('Name') }}</label>
                          	<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Class Name">
                          	@if ($errors->has('name'))
                          		<span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                          	@endif
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                          	<label for="name">{{ __('Subject') }}</label>
                          	{{ Form::select('subject_id', ['' =>'Please Select'] + $aSubjects,  $aRow ? $aRow->subject_id : old('subject_id') , ['class' => 'form-control', 'required' => 'required','id'=>'cat']) }}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group">
                          	<label for="name">{{ __('Grade Level') }}</label>
                          	{{ Form::select('grade_level_id', ['' =>'Please Select'] + $aGradeLevels,  $aRow ? $aRow->grade_level_id : old('grade_level_id') , ['class' => 'form-control','id'=>'gradeLevel']) }}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                          <button type="submit" class="btn btn-df">Save</button>
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
</div>
@endsection

@push('scripts')
<script type="text/javascript">
  $('#cat').change(function(){
    var str= $(this).val();
    if(str == 44444){
      $('#gradeLevel').val('');
      $('#gradeLevel').attr('disabled', 'disabled');
      /*$.ajax({
                 url:'https://upliftk12.com/WebServices/get-course-list.php',
                 data:{category:3},
                 success:function(data){
                  //alert(data);
                   $('#gradeLevel').html(data);


                 }
     });*/

     }else{
      $('#gradeLevel').prop("disabled", false);
     }
  });
/*load*/

$(document).ready(function(){

<?php if(!empty($aRow)){?>

  loadCat(<?= $aRow->subject_id?>,<?=$aRow->grade_level_id?>);
<?php }?>
  function loadCat(str,lvl){
  if(str ==4){
      $.ajax({
                 url:'https://upliftk12.com/WebServices/get-course-list.php',
                 data:{category:3,lvl:lvl},
                 type:'POST',
                 success:function(data){
                  //alert(data);
                   $('#gradeLevel').html(data);


                 }
     });

     }
  }
});
</script>
@endpush
