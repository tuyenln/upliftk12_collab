@extends('layouts.admin')
@php
    $page_name = "Add Student"
@endphp
@section('content')
<div class="x_title">
<h2>{{ $page_name }}<small></small></h2>
<div class="clearfix"></div>
</div>
<div class="x_content">
<div class="col-md-6 col-sm-6 col-xs-6">
<form method="POST"  action="{{ route('teacher.class.manage.poststudent',$aClassId) }}" enctype="multipart/form-data">
@csrf
<div class="form-group">    
	<label for="name">{{ __('Select Student') }}</label>                           
	<select  class="js-example-basic-multiple-limit form-control" multiple name="student_list[]" >
	@foreach($aStudents as $aStudent)
     <option value="{{$aStudent->id}}">{{$aStudent->name}} ( {{$aStudent->student_id}} )</option>
     @endforeach	
	</select>
</div>
<button type="submit" class="btn btn-success">Save</button>
</form>
</div>
</div>

<br>
<br>
<br>

<div class="x_title" style="margin-top: 100px;">
<h2>Student List 1<small></small></h2>
<div class="clearfix"></div>
</div>
<div class="x_content">
  <div class="clearfix" >
        <a href="{{ route('teacher.class.printroster', ['pdf',$aClassId] ) }}" class="btn btn-primary pull-right">Print pdf</a>
        <a href="{{ route('teacher.class.printroster', ['csv',$aClassId] ) }}" class="btn btn-primary pull-right">Print csv</a>
        
    </div>
@if(count($aStudentLists))                       
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>                                                  
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @foreach($aStudentLists as $aKey => $aStudentList)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{$aStudentList->name}} ( {{$aStudentList->student_id}} )</td>                                     
                <td>                   
                    <a onclick="return confirm('Are you sure to delete?');" href="{{ route('teacher.class.delete.student',[$aClassId,$aStudentList->id]) }}">Delete</a>
                </td>
            </tr>
            @php $i++ @endphp
             @endforeach
        </tbody>
    </table>
@else
No data found
@endif
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
@endpush