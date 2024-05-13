@extends('layouts.master')
@section('content')

<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content">
              <div class="detail-about-content mb-5">
                <div class="sec-title mrgn-b-2">
                  <h3>My Courses ({{$list_asm->count()}})</h3>
                </div>
                <div class="sec-content">
                  <div class="row">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">


$(document).ready(function(){


displayAss(<?= $mdlCat->gradeLevel?>,<?=$user->student_id?>);
 function displayAss(str,stID){
      if(str > 0){

         $.ajax({
               url:'https://upliftk12.com/WebServices/get-course-content.php',
               data:{courseID:str,action:'quiz',stID:stID},
               type:'POST',
               success:function(data){
                  $('.list').html(data);

               }
   });
   }
else
{

   $('.list').hide();
}
}

<?php if(empty($mdlUser->mdl_UserID)){?>
/*student registration */
_studentRegistration();
function _studentRegistration(){
  $.ajax({
               url:'https://upliftk12.com/WebServices/create_student_account.php',
               data:{

            'name': '<?= $user->name ?>',
            'mname': '<?=$user->mname?>',
            "lname":'<?=$user->lname?>',
            "email":'<?=$user->email?>',
            "username":'<?=$user->username?>',
            "student_id":'<?=$user->id?>'},
               type:'POST',
               success:function(data){
                 // alert(data);

               }
   });
}

<?php } ?>

});
</script>
