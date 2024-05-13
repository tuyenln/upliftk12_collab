@extends('teacher.layouts.master')
@section('title', 'Manage Class')
@section('style')
<link href="{{ url('public/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
 <!-- Responsive datatable examples -->
<link href="{{ url('public/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('public/css/LineIcons.css') }}" rel="stylesheet" type="text/css" />

<style>
.back-button {
    background: #DD9C25;
    border: none;
}
.back-button:hover {
    background: #BF4E00;
    border: none;
}
.alert-success {
    color: #4ac18e;
    background-color: #e2f5ed;
}

.add-button {
	background: #6F48A9;
	border:none;

}

.add-button:hover {
	background: #5B3B99;
	border:none;

}
</style>
@endsection
@section('content')
<?php   $user = Auth::user();?>
<div class="container">
    <div class="row align-items-start">
        <!-- side bar menu-->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2">
            <div>
                <h3 class="title-content text-center">Manage Classes</h3>
                <a href="{{ URL::to('/teacher') }}" class="btn btn-info pull-right button-header-content back-button" style="margin-bottom: 20px;">Back to List</a>
                <a href="{{ route('teacher.addClass') }}" class="btn btn-primary pull-right button-header-content add-button" style="margin-bottom: 20px; margin-right: 15px;">Add Class</a>
                
                <div class="clearfix"></div>
            </div>
            @if (Session::has('message'))
            <div class="alert alert-success" style="width: 100%;">
                {{Session::get('message')}}
            </div>
            @endif
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                    <td>{{$aRow->subject->name ?? ''}}</td>
                    <td>{{$aRow->grade_level->name ?? ''}}</td>                            
                    <td class="text-center">
                        <a class="edit" href="{{ route('teacher.class.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
                        <a class="manager" href="{{ route('teacher.class.manage.student',$aRow->id) }}"><i class="lni lni-users"></i></a>
                        <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
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
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ url('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Datatable init js -->
<!-- Buttons examples -->
<script src="{{ url('public/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ url('public/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
@endsection
@section('script-bottom')
<script>
$(document).ready(function() {
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

    //Buttons examples
    $('#datatable-buttons').DataTable();
});
</script>
@endsection