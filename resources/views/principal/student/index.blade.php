@extends('layouts.admin')

@section('content')
<div class="x_title">
<h2>Students<small></small></h2>

<div class="clearfix"></div>
</div>
<div class="x_content">
    <div class="clearfix" >
        <a href="{{ route('principal.student.create') }}" class="btn btn-primary pull-right">Add Student</a>
        <a href="{{ route('principal.student.uploadcsv') }}" class="btn btn-primary pull-right">Upload Csv</a>
    </div>
    @if(count($aRows))                       
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Student ID</th>
                <th>UseName</th> 
                <th>Name</th>                          
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aRows as $aKey => $aRow)
            <tr>
                <th scope="row">{{ $aKey+1 }}</th>
                <td>{{$aRow->student_id}}</td>
                 <td>{{$aRow->username}}</td>
                <td>{{$aRow->name}}</td>                            
                <td>
                    <a href="{{ route('principal.student.edit',$aRow->id) }}">Edit</i></a>
                    <a href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();">Delete</i>
                    </a>
                    <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('principal.student.destroy',$aRow->id) }}" method="post" style="display: none;">
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





