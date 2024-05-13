<!DOCTYPE html>
<html>
    <head>
        <title>Lesson</title>
        <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}"></link>
        <link href='https://fonts.googleapis.com/css?family=Fira Sans:300,400,500,600,700,800,900' rel='stylesheet'>
        <link rel="stylesheet" href="{{url('public/css/new-style.css')}}"></link>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://www.24limousine.com/wp-content/themes/24Limousine/assets/css/owl.carousel.min.css">
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
            }
            .cover-wrapper {
                padding: 75px;
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
                width: 3%;
                background: rgba(0, 0, 0, 0.08);
                border: 1px solid #DDDDDD;
                height: 510px;
                text-align: center;
            }
            #save {
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
            .note-section h3{
                font-family: Fira Sans;
                font-style: normal;
                font-weight: 500;
                font-size: 15px;
                line-height: 3px;
            }
            .directions {
                font-size: 12px !important;
                line-height: 14px !important;
                color: rgba(0, 0, 0, 0.6) !important;
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
            #erase {
                background: #6F48A9;
                color: white;
                padding: 5px;
                font-size: 16px;
                margin-bottom: 10px;
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
                height: 508px;
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
                /* identical to box height, or 133% */

                letter-spacing: 0.25px;
            }
            .message-area span {
                font-weight: normal;
                font-size: 12px;
            }
            .msg{
                margin-top: 10px;
            }
            .logout {
                margin-left: 20px;
                border: 1px white solid;
                padding: 10px;
                border-radius: 30px;
                font-size: 14px;
                background: white;
                font-weight: 600;
                color: #412A7F;
            }
            .logout:hover {
                text-decoration: none;
                font-weight: bold;
            }

        </style>
    </head>
    <body>
        <header>
            <div class="nav">
                <a href="{{route('teacher')}}"><img src="{{url('https://upliftk12.com/public/assets/images/logo.png')}}" style="max-height: 30px; margin-top: -7px; margin-left: 30px;"/></a>
                <h3 class="title">Lesson Title: {{$lesson->name}}</h3>
                <h4 class="pull-right" style="margin-right: 65px; color: white; line-height: 38px;">{{$user_name}} <a class="logout" href="/logout">LOGOUT</a></h4>
                <!--<img src="{{url('public/assets/images/robots/'). '/' . $student_avatar}}" class="pull-right" style="width: 50px; height: 50px; margin-right: 30px;"/>-->

            </div>
        </header>
        <div class="cover-wrapper">

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12">
                    <div class="iframe-section" id="iframe_section">
                        <iframe style="width: 100%; height: 750px; border: none;" src="{{url($lesson->quiz_url) . '?cpQuizInfoStudentID='. $user_id .'&cpQuizInfoStudentName=' . $lesson_id}}"></iframe>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var lid = {{ $lid }};
            var uid = "{{ $user_id }}";
            console.log(uid, lid);
            var isTeacher = 0;
            var uname = "{{ $user_name }}";
            var isVideo = {{ $isVideo }};
            var avaUrl = "{{ url('public/assets/images/robots/'). '/' . $student_avatar }}";
        </script>
        <script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/datepicker.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"> </script>
    </body>
</html>
