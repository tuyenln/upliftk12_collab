@extends('teacher.layouts.master')
@section('title', 'Teacher')
@section('content')
<link href="{{ URL::asset('public/assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('public/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .hover-end {
            width: 150px;
            padding: 0;
            margin: 0;
            font-size: 75%;
            text-align: center;
            position: absolute;
            z-index: 1001;
            background: white;
            opacity: 1;
            color: black;
        }

        .hover-end img {
            width: 100%;
        }

        .copy-link-btn {
            margin-top: 8px;
            margin-left: 10px;
            font-size: 18px;
        }

        .copy-link-btn:hover {
            cursor: pointer;
            border-color: #66afe9;
            outline: 0;
        }

        .launch {
            color: #6F48A9;
            font-family: Fira Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 15px;
            line-height: 24px;
            letter-spacing: 0.5px;
            border: 1px solid #6F48A9;
            border-radius: 10px;
            padding: 0 5px;
            float: right;
            margin-right: 50px;
            margin-top: -3px;
        }

        .launch:hover {
            cursor: pointer;
            text-decoration: none;
        }

        .searchbar {
            position: relative;
        }

        .searchbar .table-data {
            width: fit-content !important;
            position: absolute;
            margin-top: 50px;
            border: 1px solid;
            background: white;
            z-index: 10001;
            right: 0px;
            padding: 0px 10px;
        }

        #filterMenu {
            display: none;
            height: 500px;
            overflow-x: hidden;
        }
        #filterMenu1 {
            display: none;
            height: 500px;
            overflow-x: hidden;
        }
        /* Switch Button*/
        div.checkbox.switcher label, div.radio.switcher label {
            padding: 0;
        }
        div.checkbox.switcher label *, div.radio.switcher label * {
            vertical-align: middle;
        }
        div.checkbox.switcher label input, div.radio.switcher label input {
            display: none;
        }
        div.checkbox.switcher label input + span, div.radio.switcher label input + span {
            position: relative;
            display: inline-block;
            margin-right: 10px;
            width: 56px;
            height: 28px;
            background: #f2f2f2;
            border: 1px solid #eee;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
        }
        div.checkbox.switcher label input + span small, div.radio.switcher label input + span small {
            position: absolute;
            display: block;
            width: 50%;
            height: 100%;
            background: #fff;

            border-radius: 50%;
            transition: all 0.3s ease-in-out;
            left: 0;
        }
        div.checkbox.switcher label input:checked + span, div.radio.switcher label input:checked + span {
            background: #6f48a9;
            border-color: #6f48a9;
        }
        div.checkbox.switcher label input:checked + span small, div.radio.switcher label input:checked + span small {
            left: 50%;
        }
        body div.container {
            padding: 5% 0;
        }

        .class_status {
            font-family: Fira Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 21px;
            line-height: 24px;
            /* identical to box height, or 114% */

            letter-spacing: 0.15px;

            color: #000000;

        }
        .assessment {
            height: 56px;

            /* grey-050 */

            background: #F8F8F8;
            border-radius: 4px;
        }
        .report_nodata {
            background: #DDDDDD;

            /* Inside Auto Layout */

            flex: none;
            order: 0;
            align-self: center;
            flex-grow: 0;
            margin: 3px 0px;
            width: 100%;
            height: 15px;
            border: 1px solid #999999;
        }
        .report_nodata_noborder {
            background: #DDDDDD;

            /* Inside Auto Layout */

            flex: none;
            order: 0;
            align-self: center;
            flex-grow: 0;
            margin: 3px 0px;
            width: 100%;
            height: 15px;
        }
        .report_low {
            background: #FFDADA;
            border: 1px solid #690000;
            box-sizing: border-box;

            /* Inside Auto Layout */
            align-self: center;
            flex-grow: 0;
            margin: 3px 0px;
            height: 15px;
            width: 100%;
        }
        .report_medium {
            height: 15px;
            background: #FFF1C1;
            border: 1px solid #8D6E02;
            box-sizing: border-box;

            /* Inside Auto Layout */
            align-self: center;
            flex-grow: 0;
            margin: 3px 0px;
            width: 100%;
        }
        .report_high {
            height: 15px;
            background: #D2EDCD;
            border: 1px solid #158300;
            box-sizing: border-box;

            /* Inside Auto Layout */
            align-self: center;
            flex-grow: 0;
            margin: 3px 0px;
            width: 100%;
        }
        .report {
            display: inline-block;
            margin-left: 5px;
        }
        .report_badge {
            display: inline-block;
            margin-left: 8%;
        }
        .d-flex {
            display: flex;
        }
        .report_badge_des {
            margin-left: 10px;
            text-align: left;
        }
        .report_badge_des .heading {
            font-family: Fira Sans;
            font-style: normal;
            font-weight: 700;
            letter-spacing: 0.25px;
            color: #000000;
        }
        .report_badge_des .des {
            font-family: Fira Sans;
            font-style: normal;
            font-weight: 400;
            letter-spacing: 0.25px;
            color: #000000;
        }
        .report_lesson {
            margin-bottom: 5px;
            font-family: Fira Sans;
            font-style: normal;
            font-weight: normal;
            text-align: right;
            letter-spacing: 0.25px;

            color: #000000;
        }
        .report_lesson:hover {
            background: #EDE9F4;
            box-shadow: inset 3px 0px 0px #6743A3;
            cursor: pointer;
        }
        .lesson_name {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .report_lesson_selected {
            background: #EDE9F4;
            box-shadow: inset 3px 0px 0px #6743A3;
            cursor: pointer;
        }
        .report_student td {
            color: #6F48A9;
        }
        .fc-row.fc-rigid {
            overflow: visible!important;
        }
        .w-100 {
            width: 100%;
        }
        .instruction {
            font-size: 20px;
            font-weight: bolder;
            min-height: 60px;
            margin-bottom: auto;
        }
        .axis path,
        .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
        }
        .browse_lessons {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid black;
            cursor: pointer;
            background: #EDE9F4;
            font-size: 20px;
            font-weight: 900;
            color: #6743A3;
        }
        .browse_lessons:hover {
            text-decoration: none;
            box-shadow: inset 5px 0px 0px #6743A3;
            background: #CDC9F4;
            color: #9773E3;
        }
        @media (max-width: 1200px) {
            .mobile-responsive {
                text-align: center;
            }
            .lesson-tab-li {
                padding-left: 12px !important;
            }
            .lesson-tab-li.active {
                border-bottom: 3px solid #6F48A9 !important;
                box-shadow: none !important;
            }
            .tab-lessons-headers {
                display: inline-flex;
            }
        }
        h4 {
            font-family: Fira Sans;
            font-style: normal;
            font-weight: normal;
        }

        .hide_invite {
            display: none;
        }
        .fc-view-container thead {
            display: contents;
        }
        thead {
            display: none;
        }
        td {
            padding: 0px;
            border:0px;
        }

        .status-background {
            width: 100%;
            height: 25px;
        }
        .offline {
            background-color: #FF9A9A;
        }
        .online {
            background-color: #C0FF82;
        }
        .img-fluid {
            width: 100%;
            height: auto;
        }
        .student-name {
            text-transform: uppercase;
            color: black;
            font-size: 14px;
            padding: 6px;
            text-align: center;
            font-weight: 600;
        }
        .student-page {
            height: 600px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .waiting-queue {
            height: 600px;
            margin-left: 15%;
            width: 70%;
            background-color: #FCF8F8;
        }
        .modal.in {
            display:flex!important;
            flex-direction:column;
            justify-content:center;
            align-content:center;
            align-items: flex-start;
        }
/*
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
*/
        .waiting-queue {
            height: 600px;
            margin: 0 auto;
            width: 90%;
            background-color: #FCF8F8;
            overflow-y: scroll;
        }

    </style>
    <div class="tab-data">
        <div class="container-fluid">
            <ul class="tab-headers" role="tablist">

                <li class="dashboard active">
                  <a class="nav-link" data-toggle="tab" href="#dashboard" aria-controls="dashboard" aria-selected="false">
                    <i class="fa fa-dashboard"></i>
                    <p>Dashboard</p>
                    <div class="clearfix"></div>
                  </a>
                </li>

                <li class="lessons">
                    <a data-toggle="tab" href="#lessons" aria-controls="lessons" aria-selected="true">
                        <i class="fa fa-play-circle-o"></i>
                        <p>Lessons</p>
                    </a>
                </li>

                <li class="reports">
                    <a data-toggle="tab" href="#reports" aria-controls="reports" aria-selected="false">
                        <i class="fa fa-bar-chart"></i>
                        <p>Reports</p>
                    </a>
                </li>
            </ul>
            <div class="divider"></div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <div class="container-fluid" style="margin-top: 50px;">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="student-page">
                                    <div class="row">
                                    @foreach ($class_student_names as $name)
                                        <div class="col-sm-3 col-xs-4">
                                            <div class="status-background offline" data-id="{{$name['id']}}">
                                                <h5 class="student-name">{{$name['name']}} {{$name['lname']}}</h5>
                                            </div>
                                            @if ($name['avatar'] == '')
                                                <img src="{{url('public/studentprofile/avatar.19866.jpeg')}}" class="img-fluid">
                                            @else
                                                <img src="{{url('public/studentprofile/'.$name['avatar'])}}" class="img-fluid">
                                            @endif
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="waiting-queue">
                                    <h3 class="text-center" style="padding: 30px;"><i class="fa fa-hand-paper-o"></i> Waiting Queue</h3>
                                    <div class="student-list" style="margin-top: 20px;">
                                    @foreach($activity_help as $row)
                                    <div style="display: flex;">
                                        <div style="width: 80%; margin-left: 10px; margin-top: -10px;">
                                            <input type="checkbox" {{$row['ah_status'] == 1 ? 'checked disabled' : ''}} class="check-student" data-id="{{$row['ah_sid']}}" data-lesson-id="{{$row['ah_lid']}}"style="width: 24px; height: 16px; margin: 25px 12px 0;">
                                            <a style="color:black; font-size:14px" class="btn done">Done</a>
                                        </div>
                                        <div style="width: 80%; margin-left: 10px; margin-top: -10px;position:relative">
                                            <img class="img-circle" style="width: auto;
                                            height: 70px;
                                            margin: 0 auto;" src="{{url('/public/studentprofile/'.$row['avatar'])}}">
                                            <a style="color:black;font-size: 16px;position: absolute;
                                            left: -4%;
                                            top: 54%;padding:0" id="more_{{$row['ah_id']}}" class="btn more_info">More Info</a>
                                        </div>
                                        <div style="width: 80%; margin-left: 10px; margin-top: -10px;">
                                            <h4>{{$row['name']}}</h4>
                                            <a class="btn btn-success btn-join" data-id="{{$row['ah_sid']}}"style="height: 28px; line-height: 27px">Join<input type="hidden" class="student-name1" value="{{$row['name']}}"><input class="lesson-id" type="hidden" value="{{$row['ah_lid']}}"></a>
                                        </div>
                                    </div>


                                    <div class="modal modal-servey more_{{$row['ah_id']}}" style="" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body" style="padding: 30px;">
                                                <h3>Student: {{$row['name']}}</h3>
                                                <span style="font-size: 16px;">Do you need someone to help you with this learning task?</span><br>
                                                @php
                                                    echo $row['learn'] == 1 ? 'Yes' : 'No';
                                                @endphp
                                                <br><br><p class="text-center;" style="font-size: 16px;">How are you feeling today? </p>
                                                <div class="rate">
                                                    <span class="data-vote" style="cursor: pointer" data-vote="happy"><img src="{{ url('public/assets/img/servey/' . $row["vote"].'.png')}}" height="50"></span>
                                                </div>
                                                <br/>
                                                <p class="text-center;" style="font-size: 16px;">Please tell us more. What's going on? </p>
                                                <textarea disabled class="comment_vote" name="comment_vote" rows="4" cols="50">{{$row["comment"]}}</textarea>

                                                <div style="font-size: 16px;">Start Date : {{date("M d, Y", strtotime($row['ah_date']))}}</div>
                                            </div>
                                            <div class="modal-footer">
                                                <a  class="btn btn-default close-popup-more">Close</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>



                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 mobile-responsive">
                                <ul class="tab-lessons-headers" role="tablist">
                                    <li class="lesson-tab-li active" id="quiz_li">
                                        <a class="nav-link" data-toggle="tab" href="#quiz" aria-controls="quiz"
                                           aria-selected="true">
                                            <p>Quiz</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li class="lesson-tab-li">
                                        <a data-toggle="tab" href="#survey" aria-controls="survey"
                                           aria-selected="false">
                                            <p>Survey</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mobile-responsive">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="quiz" role="tabpanel" aria-labelledby="quiz">
                                        <div class="w-100">
                                            <div class="library-box" style="min-height: 800px;">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4">
                                                        <label>Lessons</label>
                                                        <select class="form-control select2 lesson-select" style="width: 100%" multiple>
                                                            @foreach($activity_lesson as $lesson)
                                                                <option value="{{$lesson['id']}}">{{$lesson['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <label>Students</label>
                                                        <select class="form-control select2 student-select" style="width: 100%" multiple>
                                                            @foreach($class_student_names as $student_name)
                                                                <option value="{{$student_name['id']}}">{{$student_name['name']}} {{$student_name['lanme']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4">
                                                        <button class="btn btn-success pull-right quiz-filter" style="margin-top: 20px;">Filter</button>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="text-center" style="margin-top: 50px;">
                                                    <div class="report_badge">
                                                        <div class="d-flex">
                                                            <div class="report_nodata" style="width: 15px;"></div>
                                                            <div class="report_badge_des"><div class="heading">No data</div></div>
                                                        </div>
                                                    </div>
                                                    <div class="report_badge">
                                                        <div class="d-flex">
                                                            <div class="report_low" style="width: 15px;"></div>
                                                            <div class="report_badge_des">
                                                                <div class="heading">Intervention needed</div>
                                                                <div class="des">Students Score: 0 - 50%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_badge">
                                                        <div class="d-flex">
                                                            <div class="report_medium" style="width: 15px;"></div>
                                                            <div class="report_badge_des">
                                                                <div class="heading">Needs work</div>
                                                                <div class="des">Student Score: 51 - 75%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="report_badge">
                                                        <div class="d-flex">
                                                            <div class="report_high" style="width: 15px;"></div>
                                                            <div class="report_badge_des">
                                                                <div class="heading">Succeeding:</div>
                                                                <div class="des">Student Score: 76 - 100%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" style="margin-top: 50px;">
                                                    <hr/>
                                                    <p class="class_status">Student Performance</p>
                                                    <div class="table-data" style="overflow-x:auto;">
                                                        <table style="margin-bottom: 200px;" id="student_tr">
                                                            <tr>
                                                                <th>StudentName</th>
                                                                <th>ActivityName</th>
                                                                <th>AssessmentScore</th>
                                                            </tr>
                                                            <tbody class="quiz-result">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="survey" role="tabpanel" aria-labelledby="survey">
                                        <div class="w-100">
                                            <div class="library-box" style="min-height: 800px;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="class_status" style="margin-top: 20px; display: inline-block;">Lessons:</p>
                                                        <select class="select2 survey-lesson" style="width: 300px; padding: 10px 20px; margin-top: -5px;">
                                                            @foreach ($survey_lessons as $lesson)
                                                                <option value="{{$lesson['lesson_id']}}">{{$lesson['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Start Date:</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="start_date">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>End Date:</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="end_date">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div id="figure" style="margin-bottom: 50px;"></div>
                                                <div class="question-details">
                                                </div>
                                                <div>
                                                    <button class="btn btn-success view-details" style="float: right; margin-top: 20px;">View Details</button>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="student-details table-responsive" style="margin-top: 20px; display: none;">
                                                    <table style="width: 100%;" class="table">
                                                        <thead style="display: contents;">
                                                            <tr>
                                                                <th scope="col" width="25%">Question</th>
                                                                <th scope="col" width="15%">Strongly Disagree</th>
                                                                <th scope="col" width="15%">Disagree</th>
                                                                <th scope="col" width="15%">No Opinion</th>
                                                                <th scope="col" width="15%">Agree</th>
                                                                <th scope="col" width="15%">Strongly Agree</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="student-tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="lessons" role="tabpanel" aria-labelledby="lessons-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 mobile-responsive">
                                <ul class="tab-lessons-headers" role="tablist">
                                    <li class="lesson-tab-li active" id="library_li">
                                        <a class="nav-link" data-toggle="tab" href="#library" aria-controls="library"
                                           aria-selected="true">
                                            <p>Small Group</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    {{-- <li class="lesson-tab-li">
                                        <a data-toggle="tab" href="#calendar" aria-controls="calendar"
                                           aria-selected="false">
                                            <p>Calendar</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li> --}}
                                    {{-- <li class="lesson-tab-li" style="padding-top: 12px; padding-left: 0;">
                                        <a class="nav-link" data-toggle="tab" href="#manage_invites" aria-controls="library"
                                           aria-selected="true">
                                            <p>Assignments</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li> --}}
                                    <li class="lesson-tab-li" style="padding-top: 12px; padding-left: 0;">
                                        <a class="nav-link" data-toggle="tab" href="#activity" aria-controls="library"
                                           aria-selected="true">
                                            <p>Assignments</p>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                @if (Session::has('msg'))
                                <div class="alert alert-success">
                                    {{Session::get('msg')}}
                                </div>
                                @endif
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="manage_invites" role="tabpanel"
                                         aria-labelledby="library-tab1">
                                        <div class="searchbar">

                                            <button type="button" class="filter">FILTER <i class="fa fa-bars"
                                                                                           aria-hidden="true"></i>
                                            </button>
                                            <div id="filterMenu" class="table-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4 class="text-center">Resource Type</h4>
                                                        <table>
                                                            {{--<tr>
                                                                <th class="cbox"><input type="checkbox" name="checkall"
                                                                                        id="checkall"
                                                                                        onclick="check_uncheck_checkbox(this.checked);"><span
                                                                        class="checkbox-mark"></span></th>
                                                                <th>Subjects</th>

                                                            </tr>--}}
                                                            @foreach($resource_types as $subject)
                                                                <tr class="search-tr">
                                                                    <td class="cbox"><input type="checkbox" name="subjects[]"
                                                                                            value="{{$subject->name}}" checked><span
                                                                            class="checkbox-mark"></span></td>
                                                                    <td>{{$subject->name}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="text-center">Grade Level</h4>
                                                        <table>
                                                            {{--<tr>
                                                                <th class="cbox"><input type="checkbox" name="checkall"
                                                                                        id="checkall"
                                                                                        onclick="check_uncheck_checkbox(this.checked);"><span
                                                                        class="checkbox-mark"></span></th>
                                                                <th>Subjects</th>

                                                            </tr>--}}
                                                            @foreach($grades as $subject)
                                                                <tr class="search-tr">
                                                                    <td class="cbox"><input type="checkbox" name="subjects1[]"
                                                                                            value="{{$subject->name}}" checked><span
                                                                            class="checkbox-mark"></span></td>
                                                                    <td>{{$subject->name}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="checkbox switcher">
                                                    <label for="test1">
                                                        <input type="checkbox" id="test1">
                                                        <span><small></small></span>
                                                        <small>Show Hidden Invites</small>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- <div style="float: right; margin-right: 40px;">
                                                <div class="checkbox switcher">
                                                    <label for="test">
                                                        <input type="checkbox" value="test" id="test">
                                                        <span><small></small></span>
                                                        <small>Disable/Enable VideoMode</small>
                                                    </label>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="calendar" role="tabpanel" aria-labelledby="calendar-tab">
                                        <div id="calendar"></div>
                                    </div>

                                    <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                        <table id="activities" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($activity_lesson as $activity)
                                            <tr>
                                                <td>
                                                    <div class="library-box">
                                                        <div class="l-image">
                                                            <img src="{{asset('public/')}}{{$activity->image_url}}" alt="" class="img-responsive">
                                                        </div>
                                                        @php
                                                            //var_dump($activity);
                                                        @endphp
                                                        <div class="l-description">
                                                            <div class="l-title">
                                                                <h3>{{$activity->name}}
                                                                    <a href="{{route('teacher.lesson.start', [$invite_activity_urls[$loop->index], 1])}}" class="launch">
                                                                    <i class="fa fa-play-circle" aria-hidden="true"></i>Launch</a>

                                                                    {{-- <a href="{{route('teacher.inviteStudent', [$activity->id, 1])}}" class="launch">
                                                                        <i class="fa" aria-hidden="true"></i>Assign</a> --}}
                                                                </h3>
                                                            </div>
                                                            <div class="l-text">
                                                                <p>{{$activity->description}}</p>
                                                            </div>
                                                            <div class="action-btn">
                                                                <a href="{{route('teacher.inviteStudent', [$activity->id, 1])}}" class="launch">
                                                                    <i class="fa" aria-hidden="true"></i>Assign</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade active in" id="library" role="tabpanel" aria-labelledby="library-tab">
                                        <div class="searchbar">
                                            <button type="button" class="filter">FILTER <i class="fa fa-bars" aria-hidden="true"></i>
                                            </button>
                                            <div id="filterMenu1" class="table-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4 class="text-center">Resource Type</h4>
                                                        <table>
                                                            {{--<tr>
                                                                <th class="cbox"><input type="checkbox" name="checkall"
                                                                                        id="checkall"
                                                                                        onclick="check_uncheck_checkbox(this.checked);"><span
                                                                        class="checkbox-mark"></span></th>
                                                                <th>Subjects</th>

                                                            </tr>--}}
                                                            @foreach($resource_types as $subject)
                                                                <tr class="search-tr">
                                                                    <td class="cbox"><input type="checkbox" name="resource_filter1"
                                                                                            value="{{$subject->id}}" checked><span
                                                                            class="checkbox-mark"></span></td>
                                                                    <td>{{$subject->name}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="text-center">Grade Level</h4>
                                                        <table>
                                                            {{--<tr>
                                                                <th class="cbox"><input type="checkbox" name="checkall"
                                                                                        id="checkall"
                                                                                        onclick="check_uncheck_checkbox(this.checked);"><span
                                                                        class="checkbox-mark"></span></th>
                                                                <th>Subjects</th>

                                                            </tr>--}}
                                                            @foreach($grades as $subject)
                                                                <tr class="search-tr">
                                                                    <td class="cbox"><input type="checkbox" name="filter1"
                                                                                            value="{{$subject->id}}" checked><span
                                                                            class="checkbox-mark"></span></td>
                                                                    <td>{{$subject->name}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="checkbox switcher">
                                                    <label for="test1">
                                                        <input type="checkbox" id="test1">
                                                        <span><small></small></span>
                                                        <small>Show Hidden Invites</small>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- <div style="float: right; margin-right: 40px;">
                                                <div class="checkbox switcher">
                                                    <label>
                                                        <input type="checkbox" value="test">
                                                        <span><small></small></span>
                                                        <small>Disable/Enable VideoMode</small>
                                                    </label>
                                                </div>
                                            </div> -->
                                        </div>
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        </table>
                                        <!--<div class="library-data" id="lesson_list">
                                            @foreach($lessons as $lesson)
                                                <div class="library-box">
                                                    <div class="l-image">
                                                        <img src="{{asset('public/'.$lesson->image_url)}}" alt=""
                                                             class="img-responsive">
                                                    </div>
                                                    <div class="l-description">
                                                        <div class="l-title">
                                                            <h3>{{$lesson->name}} <a
                                                                    href="{{route('teacher.lesson.start', [$invite_urls[$loop->index], 1])}}"
                                                                    class="launch"> <i class="fa fa-play-circle"
                                                                                       aria-hidden="true"></i>Launch</a>
                                                            </h3>
                                                        </div>
                                                        <div class="l-text">
                                                            <p>{{$lesson->description}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="dot-dropdown">
                                                        <div class="dropdown">
                                                            <i class="fa fa-ellipsis-v dropdown-toggle"
                                                               data-toggle="dropdown" aria-hidden="true"></i>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a href="{{route('teacher.lesson.start', [$invite_urls[$loop->index], 1])}}" class="launch-lesson"><i
                                                                            class="fa fa-external-link"
                                                                            aria-hidden="true"></i> Launch Lesson</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{route('teacher.inviteStudent', [$lesson->id, 1])}}"><i
                                                                            class="fa fa-user-plus"
                                                                            aria-hidden="true"></i> Invite Students</a>
                                                                </li>
                                                                <li><a data-toggle="modal" data-target="#myModal"
                                                                       class="my-modal"><i class="fa fa-link"></i>Get
                                                                        Link</a><input type="hidden" class="invite-link"
                                                                                       value="{{$invite_urls[$loop->index]}}">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{ $lessons->links() }}-->
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

    <div class="modal modal-waiting" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="border-left: 15px #FF9A9A solid; padding: 30px;">
                    <p class="text-center wait-text" style="font-size: 20px;">Please wait while <span class="student-name-modal">Xuan Ha1</span> accepts your request to join</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-declined" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="border-left: 15px #FF9A9A solid; padding: 30px;">
                    <p class="text-center wait-text" style="font-size: 20px;"><span class="student-name-modal-decline">Xuan Ha1</span> didn't accept your request.</p>
                    <button class="btn btn-info decline-accepted pull-right" style="margin-top: -15px;">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-accepted" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-left: 15px #C0FF82 solid;">
                <div class="modal-body" style="padding: 30px;">
                    <p class="text-center;" style="font-size: 20px;">The student is ready now. You can get started</p>
                </div>
                <div class="modal-footer">
                    <a href="{{route('teacher.student-activity', ['aaa', 1])}}" target="_blank" class="btn btn-success btn-get-started">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    @if(Session::get('message'))
        <div class="notification">
            <p>[{{Session::get('message')}}]</p>
        </div>
    @endif
    @if(Session::get('lesson_name'))
        <div class="notification">
            <p>Invite has been deleted for [{{Session::get('lesson_name')}}]</p>
        </div>
    @endif
    @if(Session::get('lesson_name1'))
        <div class="notification">
            <p>Invite has been hidden for [{{Session::get('lesson_name1')}}]</p>
        </div>
    @endif
    @if(Session::get('lesson_name2'))
        <div class="notification">
            <p>Invite has been shown for [{{Session::get('lesson_name2')}}]</p>
        </div>
    @endif
    @if(Session::get('invite_notify'))
        <div class="notification">
            <p>{{Session::get('invite_notify')}}</p>
        </div>
    @endif
    <div class="clear-invite" id="clear-invite">
        <form action="{{route('teacher.postClearInvites')}}" method="post">
            @csrf
            <h3>Delete Invite</h3>
            <p>Students will not be able to take quizzes after the invite is deleted.</p>
            <p>If you would rather hide this invite, then click here.</p>
            <input name="lesson_id" id="lesson_id" hidden>
            <div class="ci-button">
                <button type="button" class="cancel-button">CANCEL</button>
                <button type="submit" id="">DELETE INVITE</button>
            </div>
        </form>
    </div>
    <div class="clear-invite" id="hide-invite">
        <form action="{{route('teacher.postHideInvite')}}" method="post">
            @csrf
            <h3>Hide Invite</h3>
            <p>Do you want to hide this Invite?</p>
            <input name="lesson_id" id="lesson_id1" hidden>
            <div class="ci-button">
                <button type="button" class="cancel-button">CANCEL</button>
                <button type="submit" id="">Hide INVITE</button>
            </div>
        </form>
    </div>
    <div class="clear-invite" id="show-invite">
        <form action="{{route('teacher.postShowInvite')}}" method="post">
            @csrf
            <h3>Show Invite</h3>
            <p>Do you want to show this Invite?</p>
            <input name="lesson_id" id="lesson_id2" hidden>
            <div class="ci-button">
                <button type="button" class="cancel-button">CANCEL</button>
                <button type="submit" id="">Show INVITE</button>
            </div>
        </form>
    </div>
    <div class="clear-invite" id="device-warning">
        <h3>Warning</h3>
        <p>With your device, you cannot launch the lesson. We will make it work soon. Please use the PC.</p>
        <input name="lesson_id" id="lesson_id" hidden>
        <div class="ci-button">
            <button type="button" class="cancel-button">OK</button>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Get invite Link</h4>
                </div>
                <div class="modal-body">
                    <p style="color: #6F48A9; font-size: 14px; display: none; background: #EDE9F4; width: 30%; padding: 10px;"
                       class="alert-copy-link">Link is Copied</p>
                    <div style="display: flex">
                        <input type="text" class="form-control link-text" style="width: 90%;" value="aabbbccddee"
                               readonly>
                        <p class="copy-link-btn"><i class="fa fa-clone"></i></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="clear-invite" id="remove-invite">
        <form action="{{route('teacher.postRemoveInvite')}}" method="post">
            @csrf
            <h3>Remove this student from invites?</h3>
            <p>You are about to remove this student that have been invited to this lesson. He will no longer be able to
                access the content. Are you sure you want to continue?</p>
            <input name="lesson_id" id="lesson_id2" hidden>
            <input name="student_id" id="student_id" hidden>
            <div class="ci-button">
                <button type="button" class="cancel-button">CANCEL</button>
                <button type="submit" id="">REMOVE INVITE</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script src="{{ URL::asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        var filters = [];
        var filters2 = [];
        @foreach($grades as $subject)
            filters2.push("{{$subject->name}}");
        @endforeach

        @foreach($resource_types as $subject)
            filters.push("{{$subject->name}}");
        @endforeach
        setTimeout(function () {
            $(".notification").hide();
        }, 2000);

        $('.invitation .dropdown h3').click(function () {
            $(this).find('i').toggleClass('fa-caret-down fa-caret-up');
        });

        $('.view-details').click(function() {
            if ($(this).html() == "View Details") {
                $('.student-details').show();
                $(this).html('Hide Details');
            } else {
                $('.student-details').hide();
                $(this).html('View Details');
            }
        });

        $('.dot-dropdown li a#cbutton').click(function () {
            $('#lesson_id').val($(this).find('.lesson_id').val());
            $('#clear-invite').addClass("active");
        });
        $('.dot-dropdown li a#hbutton').click(function () {
            $('#lesson_id1').val($(this).find('.lesson_id').val());
            $('#hide-invite').addClass("active");
        });
        $('.dot-dropdown li a#sbutton').click(function () {
            $('#lesson_id2').val($(this).find('.lesson_id').val());
            $('#show-invite').addClass("active");
        });
        $('.invitation table tbody tr td .fa-minus-circle').click(function () {
            $('#lesson_id2').val($(this).closest('.table-data').find('.lesson_id').val());
            $('#student_id').val($(this).find('.student_id').val());
            $('#remove-invite').addClass("active");
        });
        $('.cancel-button').click(function () {
            $('.clear-invite').removeClass("active");
        });

        $("#search").keyup(function () {
            jQuery(".library-data .library-box").each(function () {
                jQuery(this).hide();
            });
            jQuery(".library-data .library-box").each(function () {
                for (i = 0; i < filters.length; i++) {
                    if (!(jQuery(this).text().search(new RegExp(filters[i], "i")) < 0)) {
                        for (j = 0; j < filters2.length; j++) {
                            if (!(jQuery(this).text().search(new RegExp(filters2[j], "i")) < 0)) {
                                jQuery(this).show();
                            }
                        }
                    }
                }
            });

            var filter = jQuery(this).val();
            jQuery(".library-data .library-box").each(function () {
                if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                    jQuery(this).hide();
                }
            });
        });

        $("#search1").keyup(function () {
            jQuery(".library-data .library-box").each(function () {
                jQuery(this).hide();
            });
            jQuery(".library-data .library-box").each(function () {
                for (i = 0; i < filters.length; i++) {
                    if (!(jQuery(this).text().search(new RegExp(filters[i], "i")) < 0)) {
                        for (j = 0; j < filters2.length; j++) {
                            if (!(jQuery(this).text().search(new RegExp(filters2[j], "i")) < 0)) {
                                jQuery(this).show();
                            }
                        }
                    }
                }
            });

            var filter = jQuery(this).val();
            jQuery(".library-data .library-box").each(function () {
                if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                    jQuery(this).hide();
                }
            });
        });

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        $('.filter').click(function () {
            $('#filterMenu').css('display', 'block');
            $('#filterMenu1').css('display', 'block');
        });

        $(document).mouseup(function (e) {
            if ($(e.target).closest("#filterMenu").length
                === 0) {
                $("#filterMenu").hide();
            }
            if ($(e.target).closest("#filterMenu1").length
                === 0) {
                $("#filterMenu1").hide();
            }
        });

        function check_uncheck_checkbox(isChecked) {
            if(isChecked) {
                $('input[name="subjects[]"]').each(function() {
                    this.checked = true;
                });
            } else {
                $('input[name="subjects[]"]').each(function() {
                    this.checked = false;
                });
            }
        }

        $('input[name="subjects[]"]').change(function(event) {
            var filter = $(this).val();
            if(event.target.checked) {
                filters.push(filter);
            }
            else {
                filters = filters.filter(e => e !== filter);
            }
            jQuery(".library-data .library-box").each(function () {
                jQuery(this).hide();
            });
            jQuery(".library-data .library-box").each(function () {
                for (i = 0; i < filters.length; i++) {
                    if (!(jQuery(this).text().search(new RegExp(filters[i], "i")) < 0)) {
                        for (j = 0; j < filters2.length; j++) {
                            if (!(jQuery(this).text().search(new RegExp(filters2[j], "i")) < 0)) {
                                jQuery(this).show();
                            }
                        }
                    }
                }
            });
            console.log(filters);
        });

        $(document).ready(function() {
            var dt = $('#example').DataTable({
                "autoWidth": false,
                "pageLength": 25,
                "processing": true,
                "serverSide": true,
                ajax:{
                    type: 'POST',
                    url: "{{route('teacher.getAjaxLessons')}}",
                    data: function (d) {
                        var filter = $('input[name="filter1"]');
                        var checked = [];
                        var checked_id = [];
                        for(var i = 0; i < filter.length; i++)
                        {
                            checked.push(1);
                            checked_id.push(0);
                        }
                        for(var i = 0; i < filter.length; i++)
                        {
                            checked_id[i] = filter[i].value;
                            if(filter[i].checked == true)
                            {
                                checked[i] = 1;
                            }
                            else
                            {
                                checked[i] = 0;
                            }
                        }
                        d.checked = checked;
                        d.checked_id = checked_id;

                        var resource_filter = $('input[name="resource_filter1"]');
                        var resource_checked = [];
                        var resource_checked_id = [];
                        for(var i = 0; i < resource_filter.length; i++)
                        {
                            resource_checked.push(1);
                            resource_checked_id.push(0);
                        }
                        for(var i = 0; i < resource_filter.length; i++)
                        {
                            resource_checked_id[i] = resource_filter[i].value;
                            if(resource_filter[i].checked == true)
                            {
                                resource_checked[i] = 1;
                            }
                            else
                            {
                                resource_checked[i] = 0;
                            }
                        }
                        d.resource_checked = resource_checked;
                        d.resource_checked_id = resource_checked_id;
                    },
                },
                "columns": [
                    { data: 'image_url', render: function(data, type, row) {
                        var str = '';
                        var lesson_start = "{{route('teacher.lesson.start', ['aaa', 1])}}"
                        lesson_start = lesson_start.replace("aaa", row.invite_urls);

                        str += '<div class="library-box"><div class="l-image"><img src="' + "{{asset('public/')}}" + row.image_url + '"alt="" class="img-responsive"></div>';
                        str += '<div class="l-description"><div class="l-title"><h3>' + row.name + ' <a href="' + lesson_start + '" class="launch"> <i class="fa fa-play-circle" aria-hidden="true"></i>Launch</a> </h3> </div> <div class="l-text"> <p>' + row.description + '</p> </div><div class="action-btn"><a data-toggle="modal" data-target="#myModal" class="my-modal launch"><i class="fa fa-link"></i>Get  Link</a><input type="hidden" class="invite-link" value="' + row.invite_urls + '"></a></div> </div>';

                        // str += '<div class="action-btn"><a data-toggle="modal" data-target="#myModal" class="my-modal"><i class="fa fa-link"></i>Get  Link</a><input type="hidden" class="invite-link" value="' + row.invite_urls + '"></a></div>';

                        var to_lesson = "{{route('teacher.inviteStudent', ['aaa', 1])}}"
                        to_lesson = to_lesson.replace("aaa", row.id);
                        str += '<div style="display:none" class="dot-dropdown"> <div class="dropdown"><i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i> <ul class="dropdown-menu"> <li> <a href="' + lesson_start + '" class="launch-lesson"><i  class="fa fa-external-link" aria-hidden="true"></i> Launch Lesson</a> </li> <li> <a href="' + to_lesson + '"><i class="fa fa-user-plus" aria-hidden="true"></i> Invite Students</a> </li> <li><a data-toggle="modal" data-target="#myModal" class="my-modal"><i class="fa fa-link"></i>Get  Link</a><input type="hidden" class="invite-link" value="' + row.invite_urls + '"> </li> </ul> </div> </div>'
                        return str;
                    }},
                ]
            });

            $('#activities').DataTable();

            $('input[name="filter1"]').change(function(event) {
                dt.draw();
            });
            $('input[name="resource_filter1"]').change(function(event) {
                dt.draw();
            });
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function clickLesson(e) {
            $('.report_lesson').removeClass('report_lesson_selected');
            $(e).addClass('report_lesson_selected');

            $invite_id = $(e).find('.invite_id')[0].value;

            $.ajax({
                url: "{{route('teacher.getQuizData')}}",
                type: 'POST',
                data: $(e).find('.report_form').serialize(),
                success: function(msg) {
                    $('#student_tr').html('<tr>\n' +
                        '<th class="cbox"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"><span class="checkbox-mark"></span></th>\n' +
                        '<th>First Name</th>\n' +
                        '<th>Last Name <i class="fa fa-arrow-down" aria-hidden="true"></i></th>\n' +
                        '<th>Objective</th>' +
                        '<th>Assessment Score</th>\n' +
                        '\n' +
                        '</tr>');

                    $('#student_tr').html($('#student_tr').html() + msg);
                }
            });

        }

        function browseClick() {
            $('#library_li').find('.nav-link').click();
        }

    </script>
    <script>
        var user_id = {{ $user->id }};
        var isTeacher = 1;
        var lid = 0;
        var uid = 0;
        var isAllow = 0;
        var isVideo = 0;
        var act_lesson = 0;
        var uname = "{{ $user->name }}";
        var avaUrl = "{{ $user->avatar ? url($user->avatar) : url('public/images/noavatar.png') }}";
        var uemail = "{{ $user->email }}";
        var students_id = {{ json_encode($students_id) }};
        var student_list = {{ $student_list}};
        var isRaiseHand;
        var activity_help;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
            integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="{{url('public/js/fullcalendar/core/main.js')}}"></script>
    <script src="{{url('public/js/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{url('public/js/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{url('public/js/fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{url('public/js/fullcalendar/list/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.13/d3.min.js"></script>
    <script src="https://raw.githubusercontent.com/eligrey/FileSaver.js/master/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://static.opentok.com/v2/js/opentok.min.js"></script>

    <script type="text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script type="text/javascript" src = "{{url('public/js/lsocket.js')}}"></script>
    <script src="{{ url('public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        !function(e,t,r,n){if(!e[n]){for(var a=e[n]=[],i=["survey","reset","config","init","set","get","event","identify","track","page","screen","group","alias"],c=0;c<i.length;c++){var s=i[c];a[s]=a[s]||function(e){return function(){var t=Array.prototype.slice.call(arguments);a.push([e,t])}}(s)}a.SNIPPET_VERSION="1.0.1";var o=t.createElement("script");o.type="text/javascript",o.async=!0,o.src="https://d2yyd1h5u9mauk.cloudfront.net/integrations/web/v1/library/"+r+"/"+n+".js";var p=t.getElementsByTagName("script")[0];p.parentNode.insertBefore(o,p)}}(window,document,"3mUH0KcRCAtADBEG","delighted");

        delighted.survey();
        </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                height: 'auto',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                defaultView: 'dayGridMonth',
                defaultDate: moment().format(),
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: function (info, callback) {
                    $.ajax({
                        url: "/teacher/calendar/read",
                        method: 'GET',
                        dateType: 'json',
                        data: 'start=' + moment(info.start.valueOf()).format('YYYY/MM/DD') + '&end=' + moment(info.end.valueOf()).format('YYYY/MM/DD'),
                        success: function (userData) {
                            console.log(userData);
                            var user_count = userData.length;
                            var eventData = [];
                            for (var i = 0; i < user_count; i++) {
                                eventData.push({
                                    id: userData[i].id,
                                    title: userData[i].name,
                                    start: userData[i].start_date,
                                    end: userData[i].start_date,
                                    invites: userData[i].invites,
                                    image_url: "{{asset('public/')}}" + userData[i].image_url,
                                });
                            }
                            callback(eventData);
                        }
                    });
                },
                eventMouseEnter: function (event) {
                    $(event.el).append('<div id=\"' + event.event.id + '\" class=\"hover-end\"> ' +
                        '<img src=\"' + event.event.extendedProps.image_url + '\">' +
                        'Start Time: ' + moment(event.event.start).format('MM-DD-Y') +
                        '<p> Invite number: ' + event.event.extendedProps.invites + '</p> </div>');
                },
                eventMouseLeave: function (event) {
                    $('#' + event.event.id).remove();
                }
            });

            calendar.render();
        });

        $('.copy-link-btn').click(function () {
            var link_url = $('.link-text');
            link_url.select();
            document.execCommand("copy");
            $('.alert-copy-link').show();
            console.log(link_url.val());
        });


        $(document).on('click', '.my-modal', function() {
            var invite_link;
            if ($('#test').prop('checked')) {
                invite_link = "{{URL::to('student/lesson/start')}}" + '/' + $(this).parent().find('.invite-link').val() + '/2';
            } else {
                invite_link = "{{URL::to('student/lesson/start')}}" + '/' + $(this).parent().find('.invite-link').val() + '/1';
            }
            $('.link-text').val(invite_link);
        })

        $(document).on('ready', function() {
            if( isMobile.any() || isMobile.iOS()) {
                $('#device-warning').addClass('active');
                $('.launch').hide();
                $('launch-lesson').hide();
            } else {
                $('.launch').show();
                $('launch-lesson').show();
            }
            var checked = 1;
            if ($('#test').prop('checked')) {
                console.log('ccc');
                checked = 2;
            }

            $('.launch-lesson').each(function() {
                var href = $(this).attr('href');
                if (checked == 1) {
                    href = href.replace('/2', '/1');
                } else {
                    href = href.replace('/1', '/2');
                }
                $(this).attr('href', href);
            })

            $('.launch').each(function() {
                var href = $(this).attr('href');

                if (checked == 1) {
                    href = href.replace('/2', '/1');
                } else {
                    href = href.replace('/1', '/2');
                }
                $(this).attr('href', href);
            })
        });
        $("input[value='test']").change(function() {
            var checked = 1;
            if ($(this).prop('checked')) {
                checked = 2;
            }
            $('.launch-lesson').each(function() {
                var href = $(this).attr('href');

                if (checked == 1) {
                    href = href.replace('/2', '/1');
                } else {
                    href = href.replace('/1', '/2');
                }
                $(this).attr('href', href);
            })

            $('.launch').each(function() {
                var href = $(this).attr('href');

                if (checked == 1) {
                    href = href.replace('/2', '/1');
                } else {
                    href = href.replace('/1', '/2');
                }
                $(this).attr('href', href);
            })
        });


        $('#test1').change(function() {
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
                $('.hide_invite').css('display', 'block');
            }
            else {
                $('.hide_invite').css('display', 'none');
            }
        });

        $( document ).ready(function() {

            $("input[value='test']").click(function(){
                if ($(this).prop("checked")) {
                    $("[value='test']").prop("checked", true);
                }
                else {
                    $("[value='test']").prop("checked", false);
                }
            })
            $('.select2').select2();
            console.log('ss');

        });

        var sat = new Date();
        sat.setDate(sat.getDate() - sat.getDay() - 1);

        var today = new Date();

        $('#start_date').datepicker({
            todayHighlight: true,
            format: 'mm/dd/yyyy',
        });

        $("#start_date").datepicker().datepicker('setDate', sat);

        $('#end_date').datepicker({
            todayHighlight: true,
            format: 'mm/dd/yyyy',
            defaultDate: today
        });
        $("#end_date").datepicker().datepicker('setDate', 'today');



        $('.select2').change(function() {
            show_graph();
        })
        show_graph();
        $('#start_date, #end_date').change(function() {
            show_graph();
        })
        $('.quiz-filter').click(function() {
            var student_list = $('.student-select').val();
            var lesson_list = $('.lesson-select').val();
            $.ajax({
                url: "{{route('getQuizData')}}",
                type: "POST",
                data: {student_list: student_list, lesson_list: lesson_list},
                success: function(data) {
                    if (data.length == 0) {
                        $('.quiz-result').html('');
                        return;
                    }
                    var html = '';
                    data.forEach(function(quiz) {
                        html += '<tr><td>' + quiz['fname'] + ' ' + quiz['lastname'] + '</td>';
                        html += '<td>' + quiz['lname'] + '</td>';
                        html += '<td><div class="d-flex" style="background-color: #ececec; position: relative;">';
                        if (quiz['score'] <= 50) {
                            html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                            <div class="report_low"></div></div>';
                        }
                        if (quiz['score'] >= 51 && quiz['score'] <= 75) {
                            html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                            <div class="report_medium"></div></div>';
                        }
                        if (quiz['score'] > 75) {
                            html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                            <div class="report_high"></div></div>';
                        }
                        html += '<h6 style="position: absolute; left: 45%; top: -7px; font-size: 14px; color: black; font-weight: 600;">' + quiz['score'] + '%' + '</h6></div></td></tr>';
                    });
                    console.log(html);
                    $('.quiz-result').html(html);

                }
            })
        });

        $.ajax({
            url: "{{route('getQuizData')}}",
            type: "POST",
            data: {student_list: '', lesson_list: ''},
            success: function(data) {
                if (data.length == 0) {
                    $('.quiz-result').html('');
                    return;
                }
                var html = '';
                data.forEach(function(quiz) {
                    html += '<tr><td>' + quiz['fname'] + ' ' + quiz['lastname'] + '</td>';
                    html += '<td>' + quiz['lname'] + '</td>';
                    html += '<td><div class="d-flex" style="background-color: #ececec; position: relative;">';
                    if (quiz['score'] <= 50) {
                        html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                        <div class="report_low"></div></div>';
                    }
                    if (quiz['score'] >= 51 && quiz['score'] <= 75) {
                        html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                        <div class="report_medium"></div></div>';
                    }
                    if (quiz['score'] > 75) {
                        html += '<div style="width: ' + quiz['score'] + '%;" class="report">\
                        <div class="report_high"></div></div>';
                    }
                    html += '<h6 style="position: absolute; left: 45%; top: -7px; font-size: 14px; color: black; font-weight: 600;">' + quiz['score'] + '%' + '</h6></div></td></tr>';
                });
                console.log(html);
                $('.quiz-result').html(html);
            }
        })

        function show_graph() {
            var lesson_id = $('.survey-lesson').val();

            $.ajax({
                url: '{{route("getSurveyData")}}',
                type: 'POST',
                data: {'lesson_id': lesson_id, start_date: $('#start_date').val(), end_date: $('#end_date').val()},
                success: function(data1) {
                    $('#figure').html('');
                    $('.question-details').html('');
                    $('.student-tbody').html('');
                    if (data1['survey_data'].length == 0) {
                        return;
                    }

                    var margin = {top: 50, right: 20, bottom: 10, left: 65},
                    width = 800 - margin.left - margin.right,
                    height = 600 - margin.top - margin.bottom;

                    var y = d3.scale.ordinal()
                        .rangeRoundBands([0, height], .3);

                    var x = d3.scale.linear()
                        .rangeRound([0, width]);

                    var color = d3.scale.ordinal()
                        .range(["#f04d52", "#e67283", "#e5e6e6", "#75aadc", "#5595d0"]);

                    var xAxis = d3.svg.axis()
                        .scale(x)
                        .orient("top");

                    var yAxis = d3.svg.axis()
                        .scale(y)
                        .orient("left")

                    var svg = d3.select("#figure").append("svg")
                        .attr("width", '100%')
                        .attr("height", height + margin.top + margin.bottom)
                        .attr("id", "d3-plot")
                    .append("g")
                        .attr("transform", "translate(" + 77 + "," + margin.top + ")");

                    color.domain(["Strongly Disagree", "Disagree", "No Opinion", "Agree", "Strongly Agree"]);
                    //color.domain(["Strongly disagree", "Disagree", "Neither agree nor disagree", "Agree", "Strongly agree"]);

                    var html = '';
                    var loop = 1;
                    var data = data1['survey_data'];

                    data.forEach(function(d) {
                        var total = d["C1"] + d["C2"] + d['C3'] + d['C4'] + d['C5'];
                        d["Strongly Disagree"] = +d["C1"]*100/total;
                        d["Disagree"] = +d["C2"]*100/total;
                        d["No Opinion"] = +d["C3"]*100/total;
                        d["Agree"] = +d["C4"]*100/total;
                        d["Strongly Agree"] = +d["C5"]*100/total;
                        var x0 = -1*(d["No Opinion"]/2+d["Disagree"]+d["Strongly Disagree"]);
                        var idx = 0;
                        html += '<p><span style="font-weight: 600;"> Question ' + loop + ": </span> " + d.question_name + ' </p>';

                        d.short_question = "Question " + loop;
                        d.boxes = color.domain().map(function(name) { return {name: name, x0: x0, x1: x0 += +d[name], N: +total, n: +d["C" + (idx += 1)]}; });
                        loop++;
                    });
                    var min_val = d3.min(data, function(d) {
                        return d.boxes["0"].x0;
                    });

                    var max_val = d3.max(data, function(d) {
                        return d.boxes["4"].x1;
                    });

                    x.domain([min_val, max_val]).nice();
                    y.domain(data.map(function(d) { return d.short_question; }));

                    svg.append("g")
                        .attr("class", "x axis")
                        .call(xAxis);

                    svg.append("g")
                        .attr("class", "y axis")
                        .call(yAxis)

                    var vakken = svg.selectAll(".question")
                        .data(data)
                        .enter().append("g")
                        .attr("class", "bar")
                        .attr("transform", function(d) { return "translate(0," + y(d.short_question) + ")"; });
                    var bars = vakken.selectAll("rect")
                        .data(function(d) { return d.boxes; })
                        .enter().append("g").attr("class", "subbar");

                    bars.append("rect")
                        .attr("height", y.rangeBand())
                        .attr("x", function(d) { return x(d.x0); })
                        .attr("width", function(d) { return x(d.x1) - x(d.x0); })
                        .style("fill", function(d) { return color(d.name); });

                    bars.append("text")
                        .attr("x", function(d) { return x(d.x0); })
                        .attr("y", y.rangeBand()/2)
                        .attr("dy", "0.5em")
                        .attr("dx", "0.5em")
                        .style("font" ,"10px sans-serif")
                        .style("text-anchor", "begin")
                        .text(function(d) { return d.n !== 0 && (d.x1-d.x0)>3 ? d.n : "" });
                    vakken.insert("rect",":first-child")
                        .attr("height", y.rangeBand())
                        .attr("x", "1")
                        .attr("width", width)
                        .attr("fill-opacity", "0.5")
                        .style("fill", "#F5F5F5")
                        .attr("class", function(d,index) { return index%2==0 ? "even" : "uneven"; });
                    svg.append("g")
                        .attr("class", "y axis")
                    .append("line")
                        .attr("x1", x(0))
                        .attr("x2", x(0))
                        .attr("y2", height);

                    var startp = svg.append("g").attr("class", "legendbox").attr("id", "mylegendbox");
                    // this is not nice, we should calculate the bounding box and use that
                    var legend_tabs = [0, 120, 200, 300, 375];
                    var legend = startp.selectAll(".legend")
                        .data(color.domain().slice())
                        .enter().append("g")
                        .attr("class", "legend")
                        .attr("transform", function(d, i) { return "translate(" + legend_tabs[i] + ",-45)"; });

                    legend.append("rect")
                        .attr("x", 0)
                        .attr("width", 18)
                        .attr("height", 18)
                        .style("fill", color);

                    legend.append("text")
                        .attr("x", 22)
                        .attr("y", 9)
                        .attr("dy", ".35em")
                        .style("text-anchor", "begin")
                        .style("font" ,"10px sans-serif")
                        .text(function(d) { return d; });

                    d3.selectAll(".axis path")
                        .style("fill", "none")
                        .style("stroke", "#000")
                        .style("shape-rendering", "crispEdges")

                    d3.selectAll(".axis line")
                        .style("fill", "none")
                        .style("stroke", "#000")
                        .style("shape-rendering", "crispEdges")

                    var movesize = width/2 - startp.node().getBBox().width/2;
                    d3.selectAll(".legendbox").attr("transform", "translate(" + 100.5  + ",0)");

                    // print the svg in a canvas
                    var element = document.getElementById('d3-plot');
                    var svgAsString = new XMLSerializer().serializeToString(element);
                    $('.question-details').html(html);
                    var student_data = data1['student_data'];
                    var html1 = '';
                    $.each(student_data, function(key, val) {
                        html1 += '<tr>\
                        <td scope="row">' + key + '</td>';
                        var html_sd = '<td></td>';
                        var html_d = '<td></td>';
                        var html_n = '<td></td>';
                        var html_a = '<td></td>';
                        var html_sa = '<td></td>';
                        $.each(val, function(key1, val1) {
                            if (key1 == 'Strongly Disagree') {
                                html_sd = '<td>'+val1.join(', ')+'</td>';
                            }
                            if (key1 == 'Disagree') {
                                html_d = '<td>'+val1.join(', ')+'</td>';
                            }
                            if (key1 == 'Agree') {
                                html_a = '<td>'+val1.join(', ')+'</td>';
                            }
                            if (key1 == 'No Opinion') {
                                html_n = '<td>'+val1.join(', ')+'</td>';
                            }
                            if (key1 == 'Strongly Agree') {
                                html_sa = '<td>'+val1.join(', ')+'</td>';
                            }
                        });
                        html1 += html_sd + html_d + html_n + html_a + html_sa;
                        html1 += '</tr>';
                    });
                    $('.student-tbody').html(html1);
                }
            });
        }

        $('.more_info').click(function() {
            var id = $(this).attr('id');
            $('.'+id).show();
        });
        $('.close-popup-more').click(function () {
            $(this).closest('.modal').hide();
        });


    </script>
@endpush
