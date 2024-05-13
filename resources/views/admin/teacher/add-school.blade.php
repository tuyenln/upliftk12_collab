@extends('principal.layouts.master')
@section('title', 'Principal')
@section('content')
    <div class="tab-data">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px;">
                        <div class="team-detail-content nopaddingtop">
                            <div class="clearfix header-section-content ">
                                <h3 class="title-content">Add New School</h3>
                            </div>
                            <div class="fw-ct">
                                <div class="row">
                                    <div class="flash-message">
                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                            @if(Session::has('alert-' . $msg))
                                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a
                                                        href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                </p>
                                            @endif
                                        @endforeach
                                    </div>
                                    @php $url = $user->is_admin ? route('admin.teacher.addSchools') : route('principal.teacher.addSchools') @endphp
                                        <form method="POST" action="{{ $url }}" enctype="multipart/form-data"
                                              style="width:100%;">
                                        @csrf
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label class="control-label" for="name"> District Name
                                                    <span class="required">*</span>
                                                </label>
                                                <select
                                                    class="form-control  @error('district_name') is-invalid @enderror"
                                                    name="district_name" id="dist" onchange="districtChange(this)">
                                                    <option value="">--Select District Name--</option>
                                                    @foreach($districts as $districts)
                                                        <option
                                                            value="{{$districts->id}}">{{$districts->name}}</option>
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
                                                <label class="control-label " for="name"> School Name
                                                    <span class="required">*</span>
                                                </label>
                                                <select
                                                    class="form-control @error('school_name') is-invalid @enderror"
                                                    name="school_name" id="school_name">
                                                </select>
                                                @error('school_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <a href="#" class="btn btn-info pull-right"  data-toggle="modal" data-target="#addSchool">Add Schools</a>
                                                <a href="#" class="btn btn-success pull-right" style="margin-right: 20px;" data-toggle="modal" data-target="#myModal">Add District</a>
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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add District</h4>
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -27px;">&times;</button>
            </div>
            <form method="post" action="{{route('admin.teacher.addDistrict')}}">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>District Name:</label>
                            <input class="form-control" type="text" name="district">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="addSchool">
        <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add School</h4>
            <button type="button" class="close" data-dismiss="modal" style="margin-top: -27px;">&times;</button>
            </div>
            <form method="post" action="{{route('admin.teacher.addSchools')}}">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>District Name:</label>
                            <input type="hidden" id="district-id" name="district_id">
                            <input class="form-control" type="text" name="district" id="district" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>School Name:</label>
                            <input class="form-control" type="text" name="school_name" id="school">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function districtChange(e) {
            var url="{{route('admin.teacher.getSchools')}}";
            $.ajax({
                type: "POST",
                data: {district_id: $(e).val(),        "_token": "{{ csrf_token() }}"},
                url: url,

                success: function(json) {
                    $('#school_name').html(json);
                }
            });

        };
        $('#dist').change(function() {
            var optionSelected = $(this).find("option:selected");
            var valueSelected  = optionSelected.val();
            var textSelected   = optionSelected.text();
            $('#district-id').val(valueSelected);
            $('#district').val(textSelected);
        })
    </script>
@endpush
