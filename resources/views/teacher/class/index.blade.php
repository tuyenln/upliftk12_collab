@extends('layouts.admin')

@section('content')
<?php
$grd=[];
        $grd[3] ="3rd Grade Math";
        $grd[4] = "4th Grade Math";
        $grd[5] = "5th Grade Math";
        $grd[6] ="6th Grade Math";
        $grd[7] ="7th Grade Math";
        $grd[8] = "8th Grade Math";
        $grd[9] ="Algebra 1";
?>
<div class="x_title">
<h2>Classes<small></small></h2>

<div class="clearfix"></div>
</div>
<div class="x_content">
    <div class="clearfix" >
        <a href="{{ route('teacher.class.create') }}" class="btn btn-primary pull-right">Add Class</a>
        
    </div>
    @if(count($aRows))                       
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>  
                <th>Subject</th>
                <th>Grade Level</th>                                        
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aRows as $aKey => $aRow)
            <tr>
                <th scope="row">{{ $aKey+1 }}</th>
                <td>{{$aRow->name}}</td>
                 <td>{{$aRow->subject_name}}</td>
                <td>
                <?php


echo $aRow->subject_id;


/*
if($aRow->subject_id==4){
                echo $grd[$aRow->grade_level_id]

}
else{
    echo $aRow->grade_level_name

                }

*/

                ?>



                </td>                            
                <td>
                    <a href="{{ route('teacher.class.edit',$aRow->id) }}">Edit</i></a>
                    <a href="{{ route('teacher.class.manage.student',$aRow->id) }}">Manage Student</i></a>
                    <a href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();">Delete</i>
                    </a>
                    <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('teacher.class.destroy',$aRow->id) }}" method="post" style="display: none;">
                       {{ method_field('DELETE') }}
                       {{ csrf_field() }}                           
                    </form>             
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
@else
No data found
@endif
</div>
@endsection