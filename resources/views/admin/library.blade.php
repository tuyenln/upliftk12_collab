@extends('layouts.master')
@section('content')
    <style>
        .searchbar {
            position: relative;
        }
        .searchbar {
            float: left;
            width: 100%;
        }
        .search {
            float: left;
            position: relative;
        }
        .search input[type="text"] {
            background: rgba(33, 33, 33, 0.08);
            border: none;
            border-bottom: 1px solid #000;
            padding: 12px 12px 12px 40px;
            width: 400px;
            color: rgba(0,0,0,0.6);
            border-radius: 10px 10px 0 0;
            font-family: Fira Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 24px;
            letter-spacing: 0.15px;
        }
        .search button {
            background: transparent;
            border: none;
            font-size: 20px;
            position: absolute;
            left: 5px;
            top: 0;
            bottom: 0;
            margin: auto;
        }
        button.filter {
            border: 1px solid #6F48A9;
            border-radius: 20px;
            padding: 9px 15px;
            background: transparent;
            color: #6F48A9;
            float: right;
            margin: 6px 0;
            font-family: Fira Sans;
            font-style: normal;
            font-weight: 500;
            font-size: 15px;
            line-height: 16px;
        }
        #filterMenu {
            display: none;
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
        button.filter:hover {
            border: 2px solid #6F48A9;
            background: #6F48A9;
            color: #fff;
        }
        button.filter:focus {
            outline: none;
        }
        .cbox {
            width: 50px;
            text-align: center;
            position: relative;
        }
        .cbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 20px;
            width: 20px;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            margin: auto;
            z-index: 99;
        }
        input:checked ~ .checkbox-mark {
            background-color: #6F48A9;
            border: 1px solid #6F48A9;
        }
        .checkbox-mark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border-radius: 4px;
            right: 0;
            bottom: 0;
            margin: auto;
            cursor: pointer;
            border: 1px solid #000;
        }
        .checkbox-mark:after {
            content: '';
            position: absolute;
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .table-data td {
            font-family: Fira Sans;
            color: #000;
            font-size: 15px;
            font-weight: normal;
        }
        .workingpanel_foldersarea{
            justify-content: flex-start;
            height: calc(100vh - 169px);
            padding: 8px 20px;
        }
        .foldersarea_grid{
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: auto;
            gap: 30px;
        }
        .grid_item{
            /*width: 270px;*/
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        .griditem_image{
            width: 86%;
            height: 160px;
            background-position: center;
            background-size: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: transform 0.1s ease, filter 0.1s ease;
            -webkit-filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.2));
            filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.2));
        }
        .griditem_image:hover{
            -webkit-filter: drop-shadow(0px 2px 5px rgba(0,0,0,0.5));
            filter: drop-shadow(0px 5px 4px rgba(0,0,0,0.4));
        }
        .griditem_image:active{
            transform: scaleX(0.9) scaleY(0.9);
        }
        .griditem_invisiblealigner_folderimage{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .griditem_folderimage{
            margin-top: 14px;
            background-size: cover;
            background-position: center;
            width: 88px;
            height: 88px;
            border-radius: 100px;
            overflow: hidden;
            border: 4px solid white;
        }
        .griditem_title{
            font-weight: bold;
            user-select: none;
            text-align: center;
            max-width: 198px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
            font-size: 1.1em;
            width: 80%;
        }
        .griditem_textpreview{
            color: darkgray;
            user-select: none;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 120px;
            font-size: 0.9em;
        }
        .grid_item.folder .griditem_image{
            position: relative;
            background-image: url(../assets/folder.png);
            background-size: contain;
            background-color: transparent;
            background-repeat: no-repeat;
        }
        .grid_item.folder .griditem_image > span{
            display: block;
            width: 80px;
            height: 20px;
            background-color: lightskyblue;
            position: absolute;
            right: 20px;
            top: -10px;
            border-radius: 8px;
            z-index: -5;
        }
        .griditem_menu_btn{
            position: absolute;
            background-image: url(/public/assets/menu.svg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: 60%;
            height: 26px;
            width: 26px;
            right: 0px;
            bottom: 8px;
            border-radius: 50px;
            transition: all 0.2s ease;
            cursor: pointer;
            opacity: 0.5;
        }
        .griditem_menu_btn:hover{
            background-color: white;
            opacity: 1;
        }
        .griditem_menu{
            top: calc(100% - 42px);
        }
        .select_menu{
            overflow: hidden;
            border-radius: 8px;
            position: absolute;
            right: 2px;
            width: 120px;
            background-color: white;
            border: 4px solid white;
            box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.25);
            z-index: 4;
            display: none;
            user-select: none;
        }
        .select_item{
            cursor: pointer;
            height: 30px;
            display: flex;
            justify-content: flex-end;
            padding-right: 8px;
            align-items: center;
            border-radius: 4px;
            color: black;
            user-select: none;
            font-size: 15px;
            user-select: none;
        }
        .select_item:hover{
            background-color: dodgerblue;
            color: white!important;
        }
        .select_item:active{
            background-color: dodgerblue;
            color: white;
        }
        .select_item.selected{
            background-color: dodgerblue;
            color: white;
        }
        .red{
            color: red;
        }
        .sec-content {
            height: 550px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .sec-content::-webkit-scrollbar {
            width: 10px;
        }

        .sec-content::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        .sec-content::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #6d6d6d;
        }
    </style>
<?php  $user = Auth::user();?>
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

                    <div class="searchbar">
                        <div class="search">
                            <form action="#">
                                <input type="text" id="search" placeholder="Search source files"
                                       name="search">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <button type="button" class="filter">FILTER <i class="fa fa-bars"
                                                                       aria-hidden="true"></i>
                        </button>
                        <div id="filterMenu" class="table-data"
                             style="overflow-x:auto; width: 100%; height: 200px;">
                            <table>
                                <tr>
                                    <td class="cbox"><input type="checkbox" value="Lesson" checked onclick="lessonFilterClick(this)"><span
                                            class="checkbox-mark"></span></td>
                                    <td>Lesson</td>

                                </tr>
                                <tr style="border-bottom: 1px solid black;">
                                    <td class="cbox"><input type="checkbox" value="Quiz" checked onclick="quizFilterClick(this)"><span
                                            class="checkbox-mark"></span></td>
                                    <td>Quiz</td>

                                </tr>
                                <tr>
                                    <td class="cbox"><input type="checkbox" name="subjects[]" value="" checked onclick="check_uncheck_checkbox(this)"><span
                                            class="checkbox-mark"></span></td>
                                    <td>Select All</td>

                                </tr>
                                @foreach($grades as $grade)
                                <tr>
                                    <td class="cbox"><input type="checkbox" name="subjects[]" value="{{$grade->name}}" checked><span
                                            class="checkbox-mark"></span></td>
                                    <td>{{$grade->name}}</td>

                                </tr>
                                @endforeach
                                @foreach($subjects as $subject)
                                <tr>
                                    <td class="cbox"><input type="checkbox" name="subjects[]" value="{{$subject->name}}" checked><span
                                            class="checkbox-mark"></span></td>
                                    <td>{{$subject->name}}</td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
              	</div>
                <div class="sec-content fw-ct">
                    <div class="workingpanel_foldersarea">
                        <div class="foldersarea_grid">
                            <div class="lesson col-md-12 row">
                            @foreach($cptxs as $row)
                            <div class="grid_item concept col-md-3">
                                <div class="griditem_image" style="background-image: url(/public/assets/cptx.png);"></div>
                                <div class="griditem_title">{{ substr($row->cptx_url, strpos($row->cptx_url, '_') + 1) }}</div>
                                <div class="griditem_textpreview">Lesson:{{ $row->updated_at }}</div>
                                <div class="" hidden>{{$row->objective}}</div>
                                <div class="" hidden>{{$row->gl()}}</div>
                                <div class="" hidden >{{$row->subject->name}}</div>
                                <div class="griditem_menu_btn" onclick="openSelectMenu(this)"></div>
                                <div class="select_menu griditem_menu">
                                    <a href="/{{$row->cptx_url}}" class="select_item" onclick="closeSelectMenu(this, 'download')">Download</a>
                                    {{--<div class="select_item red" onclick="closeSelectMenu(this, 'delete')">Delete</div>--}}
                                </div>
                            </div>
                            @endforeach
                            </div>
                            <div class="quiz">
                            @foreach($quiz_cptxs as $row)
                                <div class="grid_item concept">
                                    <div class="griditem_image" style="background-image: url(/public/assets/cptx.png);"></div>
                                    <div class="griditem_title">{{ substr($row->quiz_cptx_url, strpos($row->quiz_cptx_url, '_', 15) + 1) }}</div>
                                    <div class="griditem_textpreview">Quiz:{{ $row->updated_at }}</div>
                                    <div class="" hidden>{{$row->objective}}</div>
                                    <div class="" hidden>{{$row->gl()}}</div>
                                    <div class="" hidden >{{$row->subject->name}}</div>
                                    <div class="griditem_menu_btn" onclick="openSelectMenu(this)"></div>
                                    <div class="select_menu griditem_menu">
                                        <a href="/{{$row->quiz_cptx_url}}" class="select_item" onclick="closeSelectMenu(this, 'download')">Download</a>
                                        {{--<div class="select_item red" onclick="closeSelectMenu(this, 'delete')">Delete</div>--}}
                                    </div>
                                </div>
                            @endforeach
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
    @push('scripts')
    <script>
        $('.filter').click(function () {
            $('#filterMenu').css('display', 'block');
            $('#filterMenu1').css('display', 'block');
        });

        $(document).mouseup(function (e) {
            if ($(e.target).closest("#filterMenu").length === 0) {
                $("#filterMenu").hide();
            }
            if ($(e.target).closest("#filterMenu1").length === 0) {
                $("#filterMenu1").hide();
            }
            if ($(e.target).closest(".select_menu").length === 0) {
                $(".select_menu").hide();
            }
        });
    </script>
    <script> // SELECT MENU HANDLING

        var filters = [];

        @foreach($subjects as $subject)
        filters.push("{{$subject->name}}");
        @endforeach
        @foreach($grades as $grade)
        filters.push("{{$grade->name}}");
        @endforeach
        filters.push("Lesson");
        filters.push("Quiz");

        function openSelectMenu(target){
            target.nextElementSibling.style.display="block";
        }

        function closeSelectMenu(target, type){
            let selectedItemText = target.innerHTML;
            if (type == 'download'){
            }
            target.parentNode.style.display = "none";
        }
        function check_uncheck_checkbox(isChecked) {
            if($(isChecked).prop("checked")) {
                $('input[name="subjects[]"]').each(function() {
                    this.checked = true;
                });
                @foreach($subjects as $subject)
                filters.push("{{$subject->name}}");
                @endforeach
                @foreach($grades as $grade)
                filters.push("{{$grade->name}}");
                @endforeach
            } else {
                $('input[name="subjects[]"]').each(function() {
                    this.checked = false;
                });
                filters = [];
            }
        }

        function lessonFilterClick(isChecked) {
            if($(isChecked).prop("checked")) {
                $('.lesson').show();
            }
            else {
                $('.lesson').hide();
            }
        }

        function quizFilterClick(isChecked) {
            if($(isChecked).prop("checked")) {
                $('.quiz').show();
            }
            else {
                $('.quiz').hide();
            }
        }

        $("#search").keyup(function () {
            jQuery(".foldersarea_grid .grid_item").each(function () {
                jQuery(this).hide();
            });
            jQuery(".foldersarea_grid .grid_item").each(function () {
                for (i = 0; i < filters.length; i++) {
                    if (!(jQuery(this).text().search(new RegExp(filters[i], "i")) < 0)) {
                        jQuery(this).show();
                    }
                }
            });

            var filter = jQuery(this).val();
            jQuery(".foldersarea_grid .grid_item").each(function () {
                if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                    jQuery(this).hide();
                }
            });
        });

        $('input[name="subjects[]"]').change(function(event) {
            var filter = $(this).val();
            if(event.target.checked) {
                filters.push(filter);
            }
            else {
                filters = filters.filter(e => e !== filter);
            }
            jQuery(".foldersarea_grid .grid_item").each(function () {
                jQuery(this).hide();
            });
            jQuery(".foldersarea_grid .grid_item").each(function () {
                for (i = 0; i < filters.length; i++) {
                    if (!(jQuery(this).text().search(new RegExp(filters[i], "i")) < 0)) {
                        jQuery(this).show();
                    }
                }
            });
        });
    </script>
    @endpush
@endsection
