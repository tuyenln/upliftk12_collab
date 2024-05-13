<!DOCTYPE html>
<html>
    <head>
        <title>Lesson</title>
        <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}"></link>
        <link href='https://fonts.googleapis.com/css?family=Fira Sans:300,400,500,600,700,800,900' rel='stylesheet'>
        <link rel="stylesheet" href="{{url('public/css/new-style.css')}}"></link>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link href="{{url('public/css/fullcalendar.css')}}" rel="stylesheet">
        <style>
            .title {
                font-family: Fira Sans;
                font-style: normal;
                font-weight: normal;
                font-size: 21px;
                line-height: 24px;
                /* identical to box height, or 114% */
                letter-spacing: 0.15px;
                /* 03. On Primary / High Emphasis */
                color: #FFFFFF;
                margin-left: 25px;
                display: inline-block;
            }
            .dropdown-menu {
                position: absolute;
                top: 30px;
                padding: 0px;
            }
            .end-btn {
                background: #FFFFFF;
                border: 1px solid #6F48A9;
                border-radius: 20px;
                padding: 9px 10px;
                margin-right: 29px;
                color: #6F48A9;
                margin-top: 10px;
                font-family: Fira Sans;
                font-style: normal;
                font-weight: 500;
                font-size: 15px;
                line-height: 16px;
                display: inline-block;
            }
            .end-btn:hover{
                text-decoration: none;
                color: #412a7f;
                cursor: pointer;
            }
            button.disabled {
                background: grey;
                border: 1px solid #6F48A9;
                border-radius: 20px;
                padding: 9px 10px;
                margin-right: 29px;
                color: darkgrey;
                margin-top: 10px;
                font-family: Fira Sans;
                font-style: normal;
                font-weight: 500;
                font-size: 15px;
                line-height: 16px;
                display: inline-block;
            }
            button.disabled:hover{
                text-decoration: none;
                color: darkgrey;
                cursor: pointer;
            }
            .nav {
                height: 60px;
            }
            *{
                margin:0px;
                padding:0px;
            }
            #client-logos .item {
                margin: 1px;
                box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.14), 0px 1px 18px rgba(0, 0, 0, 0.12), 0px 3px 5px rgba(0, 0, 0, 0.2);
                height: 123px !important;
            }
            .cover-wrapper {
                padding: 16px;
            }
            .client-inners img {
                height: 100%;
                object-fit: contain;
            }
            .client-inners {
                border: 1px solid #ccc;
                height: 140px;
                text-align: center;
                padding: 8px;
            }
            .owl-item.active {
                z-index: 0;
                position: relative;
            }
            .owl-nav img {
                width: 34px;
            }
            .owl-prev img {
                position: absolute;
                left: -38px;
                top: 50%;
                margin-top: -20px;
            }
            .owl-next img {
                position: absolute;
                right: -38px;
                top: 50%;
                margin-top: -20px;
            }
            .iframe-section {
                position: relative;
                width: 97%;
                border: 1px solid #DDDDDD;
            }
            .toolbar-section {
                width: 40px;
                background: rgba(0, 0, 0, 0.08);
                border: 1px solid #DDDDDD;
                height: 659px;
                text-align: center;
            }
            #erase {
                background: #6F48A9;
                color: white;
                padding: 5px;
                font-size: 16px;
                margin-bottom: 10px;
            }
            #save:hover {
                cursor: pointer;
            }
            #clear {
                background: #6F48A9;
                color: white;
                padding: 5px;
                font-size: 16px;
            }
            #clear:hover {
                cursor: pointer;
            }
            .send-message {
                position: absolute;
                top: 460px;
                left: 0;
                width: 100%;
                border-top: 1px solid #dddddd;
            }
            .send-message-str {
                font-family: Fira Sans;
                font-style: normal;
                font-weight: normal;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
                letter-spacing: 0.25px;
                padding: 0px 20px;
            }
            .send-message textarea {
                font-family: Fira Sans;
                border: none;
                width: 90%;
                font-size: 12px;
                font-style: normal;
                font-weight: normal;
                margin-left: 5%;
                margin-top: 15px;
                resize: none;
                color: rgba(0, 0, 0, 0.87);
                border-bottom: 2px solid #6F48A9;
                position: relative;
            }

            .send-message textarea::-webkit-scrollbar{
                display: none;
            }

            .send-message-btn {
                position: absolute;
                top: -9px;
                right: 30px;
                font-size: 16px;
                color: #6F48A9;
                cursor: pointer;
            }

            .send-message textarea:focus {
                outline: none;
            }
            .note-section {
                height: 250px;
            }
            .note-title {
                background: #6F48A9;
                color: white;
                height: 40px;
                margin-top: 10px;
            }
            .note-content {
                height: 190px;
                overflow-y: scroll;
                overflow-x: hidden;
                border-bottom: 1px solid #dddddd;
            }
            .message-area {
                height: 200px;
                overflow-y: auto;
                overflow-x: hidden;
                border-bottom: 1px solid #dddddd;
            }
            .note-section h3{
                font-family: Fira Sans;
                font-style: normal;
                font-weight: 500;
                font-size: 15px;
                line-height: 3px;
            }
            .directions {
                font-size: 20px; 
                color: red;
                line-height: 14px !important;
            }
            .teacher-note {
                font-size: 12px !important;
                line-height: 14px !important;
                color:black !important;
            }
            .note-content::-webkit-scrollbar {
                width: 10px;
            }

            .note-content::-webkit-scrollbar-track {
                background-color: #ebebeb;
                -webkit-border-radius: 10px;
                border-radius: 10px;
            }

            .note-content::-webkit-scrollbar-thumb {
                -webkit-border-radius: 10px;
                border-radius: 10px;
                background: #6d6d6d;
            }
            .radcontrol {
                width: 30px;
                height: 30px;
                background-color: #6F48A9; ;
                display: inline-block;
                text-align: center;
                padding: 5px;
                border-radius: 15px;
                color: white;
            }
            .radcontrol:active
            {
                background-color: #8462B6;
            }
            .radcontrol:hover
            {
                background-color: #8462B6;
            }
            #canvas {
                position: absolute;
                top: 0;
                left: 2%;
                width: 93%;
            }
            .swatch.active-custom {
                border: 2px solid white;
            }
            .swatch {
                width: 30px;
                height: 30px;
                border-radius: 15px;
                box-shadow: inset 0px 1px 0px rgba(255,255,255,0.5), 0px 2px 2px rgba(0,0,0,0.5);
                display: inline-block;
            }
            .message-area p {
                font-family: Fira Sans;
                font-style: normal;
                font-weight: bold;
                font-size: 12px;
                line-height: 16px;
                color: black;
                margin: 0px 0 3px;

                letter-spacing: 0.25px;
            }
            .message-area span {
                font-weight: normal;
                font-size: 12px;
            }
            .msg{
                margin-top: 10px;
            }

            .add_notes:hover {
                cursor: pointer;
            }
            /*

            .msger-chat {
                flex: 1;
                overflow-y: auto;
                padding: 10px;
            }
            .msger-chat::-webkit-scrollbar {
                width: 6px;
            }
            .msger-chat::-webkit-scrollbar-track {
                background: #ddd;
            }
            .msger-chat::-webkit-scrollbar-thumb {
                background: #bdbdbd;
            }
            .msg {
                display: flex;
                align-items: flex-end;
                margin-bottom: 10px;
            }
            .msg:last-of-type {
                margin: 0;
            }
            .msg-img {
                width: 50px;
                height: 50px;
                margin-right: 10px;
                background: #ddd;
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                border-radius: 50%;
            }
            .msg-bubble {
                max-width: 450px;
                padding: 15px;
                border-radius: 15px;
                background: #ececec;
            }
            .msg-info {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }
            .msg-info-name {
                margin-right: 10px;
                font-weight: bold;
            }
            .msg-info-time {
                font-size: 0.85em;
            }

            .left-msg .msg-bubble {
                border-bottom-left-radius: 0;
            }

            .right-msg {
                flex-direction: row-reverse;
            }
            .right-msg .msg-bubble {
                background: #579ffb;
                color: #fff;
                border-bottom-right-radius: 0;
            }
            .right-msg .msg-img {
                margin: 0 0 0 10px;
            }*/

            #client-avatar-section {
                margin-top: 30px; 
                margin-left: 25px;
            }

            .avatar-div {
                position: absolute; 
                right: 40px; 
                top: 0px;
                width: 160px; 
                height: 800px;1
            }

            .item {
                display: inline-block; 
                margin-right: 20px; 
                position: relative;
            }
            /*
            .item span {
                background-color: blue; 
                color: white; 
                border-radius: 50%; 
                padding: 20px; 
                font-weight: 600; 
                font-size: 20px; 
                cursor: pointer;
            }*/

            .button {
                text-align: center;
                text-transform: uppercase;
                text-decoration: none;
                font-size: 14px;
                font-weight: 100;
                font-family: "Segoe UI";
                letter-spacing: 1px;
            }
            .button:before {
                border-radius: 50px;
                border: 2px solid #468cdc;
                box-shadow: 0 0 15px rgba(0, 255, 204, 0.15), 0 0 15px rgba(0, 255, 204, 0.15) inset;
                content: "";
                display: block;
                position: absolute;
                left: 54%;
                top: 54%;
                height: 60px;
                width: 60px;
                margin-left: -32px;
                margin-top: -32px;
                opacity: 1;
                transform: scale(1);
                transition: all 300ms;
            }
        .button:hover:before {
            transform: scale(1.05);
        }
        .button.circle {
            background: #23466e;
            border: none;
            border-radius: 900px;
            color: #e4ecfa;
            cursor: pointer;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            position: relative;
            margin: auto;
            margin-top: 25px;
            transition: 0.5s;
        }
        .button.circle:hover {
            background: #3e70aa;
            padding: -2px;
        }
        </style>
    </head>
    <body>
        <header>
            <div class="nav">
                <a href="{{route('teacher')}}"><img src="{{url('https://upliftk12.com/public/assets/images/logo.png')}}" style="max-height: 30px; margin-top: -7px; margin-left: 30px;"/></a>
                <h3 class="title">Lesson Title: {{$lesson->name}}</h3>
                <h4 class="pull-right" style="margin-right: 65px; color: white; line-height: 38px;">{{$user_name}}</h4>
                <!--<img src="{{url('public/assets/images/robots/'). '/' . $student_avatar}}" class="pull-right" style="width: 50px; height: 50px; margin-right: 30px;"/>-->
                @if (!empty($user))
                <a class="end-btn pull-right" href="{{route('student')}}">END LESSON</a>
                @endif
            </div>
        </header>
        <div class="cover-wrapper">
            <div id="client-logos" class="owl-carousel text-center" style="box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.14), 0px 1px 18px rgba(0, 0, 0, 0.12), 0px 3px 5px rgba(0, 0, 0, 0.2);">
            </div>
            
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12" id="frame_col">
                </div>
                <div style="width: 100%; display: flex; position: relative;">
                    <div class="iframe-section" id="iframe_section">
                        <iframe class="iframe-inner" style="width: 100%; border: none;" src="{{url($lesson->lessons_url)}}"></iframe>
                    </div>
                    <div class="toolbar-section">
                        <div>
                        <span style="font-size:10px;">Draw</span>
                            <input type="checkbox" class="allow-drawing" readonly disabled>
                            <span style="font-size:10px;">Colors</span>
                            <div id="colors"></div>
                            <div id="rad">
                                <span style="font-size:10px;">Brush</span>
                                <div id="decrad" class="radcontrol" style="margin-bottom: 10px;">-</div>
                                <span id="radval" style="margin-bottom: 10px;">2</span>
                                <div id="incrad" class="radcontrol" style="margin-top: 10px; margin-bottom: 10px;">+</div>
                            </div>
                            <span style="font-size:10px;">Erase</span>
                            <div id="erase"> <i class="fa fa-eraser"></i> </div>
                        </div>
                    </div>
                    <div id="teacher_div" style="position: absolute; left: 5px; top: 30%;">
                        <div id="tdefava_div" class="def-ava-div">
                            <img class="def-ava-img" style="width: 160px; height: auto; cursor: pointer;" src="{{url('public/images/noavatar.png')}}" alt="">
                        </div>
                    </div>
                    <div class="avatar-div">
                        <div id="client-avatar-section"><!--
                            <div class="item">
                                <span data-toggle="dropdown">RS</span>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="student-allow-control" data-uid="%UID%"><i class="fa fa-pencil" aria-hidden="true"></i> Give board control</a>
                                    <a href="#" class="student-disallow-control" data-uid="%UID%" style="display: none;"><i class="fa fa-pencil" aria-hidden="true"></i> Revoke board control</a></li>
                                    <li><a href="#" class="student-remove" data-uid="%UID%"><i class="fa fa-sign-out" aria-hidden="true"></i> Remove</a></li>
                                    <li><a href="#" class="student-refresh" data-uid="%UID%"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh Student</a></li>
                                </ul>
                            </div>
                            <div class="item" style="display: inline-block; margin-bottom: 50px; position: relative;">
                                <span data-toggle="dropdown">MS</span>
                                <ul class="dropdown-menu" style="position: absolute;">
                                    <li><a href="#" class="student-allow-control" data-uid="%UID%"><i class="fa fa-pencil" aria-hidden="true"></i> Give board control</a>
                                    <a href="#" class="student-disallow-control" data-uid="%UID%" style="display: none;"><i class="fa fa-pencil" aria-hidden="true"></i> Revoke board control</a></li>
                                    <li><a href="#" class="student-remove" data-uid="%UID%"><i class="fa fa-sign-out" aria-hidden="true"></i> Remove</a></li>
                                    <li><a href="#" class="student-refresh" data-uid="%UID%"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh Student</a></li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                </div>
                <canvas id="canvas" style="border: 1px solid #33333; display: none;" width="1280" height="721"></canvas>
            </div>
        </div>
        <div class="clear-invite" id="clear-invite">
            <h3>Video input error</h3>
            <p>You do not have available video and audio input devices.</p>
            <div class="ci-button">
                <button type="button" class="cancel-button">OK</button>
            </div>
        </div>


        <script>
            var lid = {{ $lid }};
            var uid = "{{ $user_id }}";
            console.log(uid, lid);
            var isTeacher = 0;
            var isAllow = 0;
            var act_lesson = 2;
            var uname = "{{ $user_name }}";
            var isVideo = {{ $isVideo }};
            var activity_help = 0;
            var isRaiseHand;
            var avaUrl = "{{ url('public/assets/images/robots/'). '/' . $student_avatar }}";
        </script>
        <script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/datepicker.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"> </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
        <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
        <script src = "{{url('public/js/lsocket.js')}}"></script>
        <script type="text/javascript" src="{{url('public/js/main.js')}}"></script>
        <script>
                
                $(document).on('click', '.fa-ellipsis-v', function() {
                    var getMaxIndex = 0;
                    $('.fa-ellipsis-v').each(function() {
                        var z_index =  $(this).closest('.owl-item').css('z-index');
                        if (getMaxIndex < parseInt(z_index)) {
                            getMaxIndex = parseInt(z_index);
                        }
                    })
                    console.log($(this).closest('.owl-item'));
                    $(this).closest('.owl-item').css('z-index', getMaxIndex + 1);
                });

                $(document).on('ready', function() {
                    var width = $('.iframe-inner').width();
                    var height = width / 1901.0 * 807;
                    $('.iframe-inner').css('height', height);
                });

                $(window).on('resize', function() {
                    var width = $('.iframe-inner').width();
                    var height = width / 1901.0 * 807;
                    //var teacher_width = ;
                    //$('.def-ava-img').css('width', teacher_width);
                    $('.iframe-inner').css('height', height);
                });
        </script>
    </body>
</html>