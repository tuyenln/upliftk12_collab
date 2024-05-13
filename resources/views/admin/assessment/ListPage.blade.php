@extends('layouts.master')
@section('content')
<?php   $user = Auth::user();?>

<style type="text/css"> .tbllist{display: none}  .heading{display: flex;} .instancename{margin-left: 10px} .list{list-style: none}

.list li {padding: 5px} .grdlevel{display: none;}
</style>
<div class="content sec-pad">
   <div class="team-detail-wrap shape-wrap">
      <div class="container">
         <div class="membersingle-info team-detail-space">
            <div class="row align-items-start">
               <!-- side bar menu-->
               @include('layouts/frontsidebar')
               <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
                  <div class="team-detail-content">
                     <div class="detail-about-content mb-5">
                        <div id="app" class="sec-content">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!--Form  add -->
                                 <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <h4>Assessment List</h4>
                                    <div class="col-xs-6">
                                    <div class="form-group">
                                    <label for="subject"><b>{{ __('Subject') }}</b></label>
                                    <select class="form-control CatList" id="category" onchange="cat(this.value)"> </select>
                                    </div>
                                    </div>
                                    <div class="col-xs-6 grdlevel">
                                    <div class="form-group">
                                    <label for="gradeLevel"><b>{{ __('Grade Level') }}</b></label>
                                    <select class="form-control" id="gradeLevel" onchange="displayAss(this.value)"> </select>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <div class="col-xs-12">
                                         <ul class="list"></ul>
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
      </div>
   </div>
</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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



 function displayAss(str){
      if(str > 0){

         $.ajax({
               url:'https://upliftk12.com/WebServices/get-course-content.php',
               data:{courseID:str},
               success:function(data){
                  $('.list').html(data);
                $('.list').show();

               }
   });
   }
else
{

   $('.list').hide();
}
}
</script>
