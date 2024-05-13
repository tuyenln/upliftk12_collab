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
                                    <h3 class="title-content">{{ $aRow ? "Edit" : "Add New" }} Lesson</h3>
                                </div>
                                <div class="sec-content fw-ct">
                                    <div class="row">

                                        <!--Form  add -->

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            @if($aRow)
                                                <form method="POST"  action="{{ route('admin.lesson.update',$aRow->id) }}" enctype="multipart/form-data" style="width:100%">
                                                    @method('PUT')
                                            @else
                                                <form method="POST"  action="{{ route('admin.lesson.store') }}" enctype="multipart/form-data" style="width:100%">
                                            @endif
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name"><b>{{ __('Name') }}</b></label>
                                                    <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Name">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1"><b>{{ __('Image') }}</b></label>
                                                    @if($aRow && $aRow->image_url)
                                                        <img width="200" src="{{asset('public'.$aRow->image_url)}}">
                                                    @endif
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="image" accept="image/*" class="form-control-file" id="exampleFormControlFile1">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($aRow && $aRow->lessons_url)
                                                    <input type="hidden" name="old_lesson_file" value="{{$aRow->lessons_url}}">
                                                @endif

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile2"><b>{{ __('Lesson Files') }}</b></label>

                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="lesson" accept=".zip,.tar.gz" class="form-control-file" id="exampleFormControlFile2">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile4"><b>{{ __('Source File for Lesson') }}</b></label>

                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="cptx" accept=".cptx" class="form-control-file" id="exampleFormControlFile4">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile3"><b>{{ __('Quiz Files') }}</b></label>

                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="quiz" class="form-control-file" id="exampleFormControlFile3">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile5"><b>{{ __('Source File for Quiz') }}</b></label>

                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="quiz_cptx" accept=".cptx" class="form-control-file" id="exampleFormControlFile5">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="subject"><b>{{ __('Subject') }}</b></label>
                                                    <select name="subject_id" class="select_subject form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" required>
                                                        <option value="">Select subject</option>
                                                        @foreach($subjects as $s)
                                                            <option value="{{$s->id}}" {{ (($aRow && $aRow->subject_id == $s->id) || old('subject_id') == $s->id) ? 'selected' : '' }}>{{$s->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('subject_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subject_id') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="subject"><b>{{ __('Resource Type') }}</b></label>
                                                    <select name="resource_type_id" class="select_subject form-control{{ $errors->has('resource_type_id') ? ' is-invalid' : '' }}" required>
                                                        <option value="">Select subject</option>
                                                        @foreach($resource_types as $s)
                                                            <option value="{{$s->id}}" {{ (($aRow && $aRow->resource_type_id == $s->id) || old('resource_type_id') == $s->id) ? 'selected' : '' }}>{{$s->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('resource_type_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('resource_type_id') }}</strong>
                                                     </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="s_grade"><b>{{ __('Grade Level') }}</b></label>
                                                    <select id="s_grade" name="grade_levels[]" class="form-control{{ $errors->has('grade_level') ? ' is-invalid' : '' }}" multiple required>
                                                        <option value="" disabled>Select grade level</option>
                                                        @foreach($grade_levels as $l)
                                                            <option value="{{$l->id}}" {{ ( ($aRow && in_array($l->id, $aRow->grade_levels)) || (old('grade_levels') && in_array($l->id, old('grade_levels'))) ) ? 'selected' : '' }}>{{$l->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('grade_levels'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('grade_levels') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="objective"><b>{{ __('Objective') }}</b></label>
                                                    <select class="form-control js-states js-example-basic-single{{ $errors->has('objective') ? ' is-invalid' : '' }}" name="objective" data-placeholder="Select a objective">
                                                        <option value=""></option>
                                                        @foreach($short_codes as $short)
                                                            <option value="{{$short->shortCode}}" @if($aRow) @if($short->shortCode == $aRow->objective) selected="selected" @endif @endif>{{$short->shortCode}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{--<input type="text" id="objective" name="objective" class="tagsinput form-control{{ $errors->has('objective') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->objective : old('objective') }}" required placeholder="objective" data-role="tagsinput">--}}

                                                    @if ($errors->has('objective'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('objective') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="description"><b>{{ __('Description') }}</b></label>
                                                    <textarea class="form-control" name="description" placeholder="Description">{{ $aRow->description ?? old('description') }}</textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>

                                                <button type="submit" class="btn btn-df">Submit</button>
                                            </form>
                                        </div>
                                        <!--Form  add end-->
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
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <style type="text/css">
        .hidden{display: none;}
        .bootstrap-tagsinput{
            display: block;
            width: 100%;
            min-height: calc(1.5em + 2rem + 2px);
            padding: 1rem 1.9rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.625rem;
        }
        .bootstrap-tagsinput .tag {color: #1f1f1f;}
    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

        });
    </script>
@endpush
