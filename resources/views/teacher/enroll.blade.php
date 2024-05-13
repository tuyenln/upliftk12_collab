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
                  <div class="detail-about-content mb-5">
                     <div class="sec-content">
                        <div class="row">
                           <div class="col-sm-12">
                              <!-- this is form secton-->
                              <div class="x_content">
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                    <form method="POST"  action="
https://upliftk12.com/WebServices/enroll_student.php" id="idForm" enctype="multipart/form-data">
                                       @csrf
                                       <div class="form-group">
                                          <label for="name"><b>{{ __('Select Student') }}</b></label>
                                          <select  class="js-example-basic-multiple-limit form-control" multiple name="student_list[]" >
                                             @foreach($aStudents as $aStudent)
                                             <option value="{{$aStudent->id}}">{{$aStudent->name}} ( {{$aStudent->student_id}} )</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="form-group">
                                          <label for="subject"><b>{{ __('Subject') }}</b></label>
                                          <select class="form-control CatList" id="category" onchange="cat(this.value)"></select>
                                       </div>
                                       <div class="form-group grdlevel">
                                          <label for="gradeLevel"><b>{{ __('Grade Level') }}</b></label>
                                          <select class="form-control" id="gradeLevel" onchange="displayAss(this.value)"  name="gradeLevel"></select>
                                       </div>
                                       <button type="submit" class="btn btn-success">Save</button>
                                    </form>
                                 </div>
                              </div>
                              <!--end -->

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
   $(".js-example-basic-multiple-limit").select2({
     tags: true,
     allowClear: true,
     placeholder: 'Select Student',
   });
</script>
<script type="text/javascript">
   function cat(str){
        if(str > 0){

           $.ajax({
                 url:'https://upliftk12.com/WebServices/get-course-list.php',
                 data:{category:str},
                 success:function(data){

                    $('#gradeLevel').html(data);
                   $('.grdlevel').show();

                 }
     });
     }
    else{
   $('.grdlevel').hide();

    }
   }

   $(document).ready(function(){
     function ShowcatList(){
           $.ajax({
                 url:'https://upliftk12.com/WebServices/get-category-list.php',
                 success:function(data){
                 $('.CatList').html(data);
                 }
     });

   }
   ShowcatList();
   });



  /* submit form*/


  // this is the id of the form
$("#idForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });


});
</script>
@endpush
