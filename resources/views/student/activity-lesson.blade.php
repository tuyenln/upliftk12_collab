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
            .modal.in {
                display:flex!important;
                flex-direction:column;
                justify-content:center;
                align-content:center;
                align-items: flex-start;
            }
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
            }*/

            .data-vote {
                background-color: white;
                display: inline-block;

            }
            .data-vote img:hover {
                opacity: .5;
            }
            .selected{
                filter: drop-shadow(0px 10px 10px #666);
            }

            .selected1 {
                filter: drop-shadow(0px 10px 10px #666);
            }

            .rate_text {
                display: block;
                text-align: center;
                padding-top: 5px;
                text-transform: capitalize;
            }


        </style>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <header>
            <div class="nav">
                <a href="{{route('teacher')}}"><img src="{{url('https://upliftk12.com/public/assets/images/logo.png')}}" style="max-height: 30px; margin-top: -7px; margin-left: 30px;"/></a>
                <h3 class="title">Lesson Title: {{$lesson->name}}</h3>

                <h4 class="pull-right" style="margin-right: 65px; color: white; line-height: 38px;"> <button class="btn btn-success raise-hand-view" href="#">Raise Hand </button> {{$user_name}} <a class="logout" href="/logout">LOGOUT</a></h4>
            </div>
        </header>
        <div class="cover-wrapper">
            <!-- <div id="client-logos" class="owl-carousel text-center" style="box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.14), 0px 1px 18px rgba(0, 0, 0, 0.12), 0px 3px 5px rgba(0, 0, 0, 0.2);">
            </div> -->

            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12" id="frame_col">
                </div>
                <div style="width: 100%; display: flex; position: relative;">
                    <div class="iframe-section" id="iframe_section">
                        <iframe class="iframe-inner" style="width: 100%; border: none;" src="{{url($lesson->lessons_url)  . '?cpQuizInfoStudentID='. $user_id . '&cpQuizInfoStudentName=' . $lesson_id}}"></iframe>
                    </div>
                    <div class="toolbar-section">
                        <div>
                        <span style="font-size:10px;">Draw</span>
                            <input type="checkbox" class="allow-drawing">
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
                            <img class="def-ava-img" style="width: 160px; height: auto; cursor: pointer;" src="{{ $user->avatar ? url('/public/studentprofile/'.$user->avatar) :url('public/studentprofile/avatar.19866.jpeg') }}" alt="">
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

        <div class="modal modal-accept" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content"  style="border-left: 15px #FF9A9A solid;">
                <div class="modal-body" style="padding: 30px;">
                    <p class="text-center;" style="font-size: 20px;">Your teacher(<span class="teacher-name">Mehul Shah</span>)is ready to join. Push accept to get started. </p>
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-success btn-accept-request" data-dismiss="modal">Accept<input type="hidden" class="teacher-id"><input type="hidden" class="student-id"></a>
                    <a  class="btn btn-danger btn-decline-request">Decline</a>
                </div>
                </div>
            </div>
        </div>

        <div class="modal modal-servey" style="" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body" style="padding: 30px;">
                    <h3>Hi {{$user_name}}!</h3>
                    <span style="font-size: 16px;font-weight: bold;">Do you need someone to help you with this learning task?</span><br><br>
                    <a  class="btn btn-success btn-accept-request data-yes" data-yes="1" data-dismiss="modal">Yes</a>
                    <a  class="btn btn-danger btn-decline-request data-yes" data-yes="0">No</a>

                    <br><br><p class="text-center;" style="font-size: 16px;font-weight: bold;">How are you feeling today? (Choose the picture). </p>
                    <div class="rate">
                        <span class="data-vote" style="cursor: pointer" data-vote="happy"><img class="selectImage" src="{{ url('public/assets/img/servey/happy.png')}}" height="50"><span class="rate_text">happy</span></span>
                        <span class="data-vote" style="cursor: pointer" data-vote="sleepy"><img class="selectImage" src="{{ url('public/assets/img/servey/sleepy.png')}}" height="50"><span class="rate_text">sleepy</span></span>
                        <span class="data-vote" style="cursor: pointer" data-vote="angry"><img class="selectImage" src="{{ url('public/assets/img/servey/angry.png')}}" height="50"><span class="rate_text">angry</span></span>
                        <span class="data-vote" style="cursor: pointer" data-vote="sad"><img class="selectImage" src="{{ url('public/assets/img/servey/bad.png')}}" height="50"><span class="rate_text">sad</span></span>
                        <span class="data-vote" style="cursor: pointer" data-vote="sick"><img class="selectImage" src="{{ url('public/assets/img/servey/sick.png')}}" height="50"><span class="rate_text">sick</span></span>
                        <span class="data-vote" style="cursor: pointer" data-vote="other"><img class="selectImage" src="{{ url('public/assets/img/servey/other.png')}}" height="50"><span class="rate_text">other</span></span>
                    </div>
                    <br>
                    <p class="text-center;" style="font-size: 16px;font-weight: bold;">Please tell us more. What's going on? </p>
                    <form action="" name="servey" method="POST">
                        @csrf
                        <input type="hidden" name="help" class="form-control yes-value" value="">
                        <input type="hidden" name="vote" class="form-control vote-value" value="">
                        <input type="hidden" name="user_id" class="user_id" value="{{$user_id}}">
                        <textarea style="width: 100%" class="comment_vote" name="comment_vote" rows="4" cols="50"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default close-popup-more">Close</a>
                    <a class="btn btn-success btn-accept-request raise-hand-fake" data-dismiss="modal">Raise Hand<input type="hidden" class="teacher-id"><input type="hidden" class="student-id"></a>
                    <a style="display: none" class="btn btn-success btn-accept-request raise-hand" data-dismiss="modal">Raise Hand<input type="hidden" class="teacher-id"><input type="hidden" class="student-id"></a>
                </div>
                </div>
            </div>
        </div>

        <script>
            var lid = {{ $lid }};
            var uid = "{{ $user_id }}";
            console.log(uid, lid);
            var isTeacher = 0;
            var uname = "{{ $user->name }}";
            var isVideo = 1;
            var user_id = {{ $user_id }};
            var act_lesson = 1;
            var activity_help = 0;
            var comment = 'ok Comment';
            var avaUrl = "{{ $user->avatar ? url('/public/studentprofile/'.$user->avatar) :url('public/studentprofile/avatar.19866.jpeg') }}";
            var isRaiseHand = {{empty($activity) ? 1 : $activity['ah_status']}};
        </script>
        <script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/datepicker.js')}}"> </script>
        <script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"> </script>
        <script type="text/javascript" src="https://static.opentok.com/v2/js/opentok.min.js"></script>

        <script type="text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
        <script type="text/javascript" src = "{{url('public/js/lsocket.js')}}"></script>
        <script type="text/javascript" src="{{url('public/js/main.js')}}"></script>

        <script>
            $(document).on('ready', function() {
                var width = $('.iframe-inner').width();
                var height = width / 1901.0 * 807;
                $('.iframe-inner').css('height', height);

                $('.raise-hand-view').click(function() {
                    $('.modal-servey').show();
                });

                $('.close-popup-more').click(function () {
                    $(this).closest('.modal').hide();
                });

                $('.selectImage').click(function(){
                    $('.selected').removeClass('selected');
                    $(this).addClass('selected');
                });

                $('.data-yes').click(function(){
                    $('.selected1').removeClass('selected1');
                    $(this).addClass('selected1');
                });

                var dataYes;
                //Set dataservey
                $(".data-yes").click(function(){
                    dataYes = $(this).attr("data-yes");
                    $('.yes-value').val(dataYes);
                });

                $(".data-vote").click(function(){
                    dataVote = $(this).attr("data-vote");
                    $('.vote-value').val(dataVote);
                });

                $('.raise-hand-fake').click(function(){
                    var yesValue = $('.yes-value').val();
                    var voteValue = $('.vote-value').val();
                    var voteComment = $('.comment_vote').val();
                    if (yesValue == '' || voteValue == '' || voteComment == '') {
                            alert("Please answer all questions!");
                    } else {
                        $('.raise-hand-fake').hide();
                        $('.raise-hand').click();
                    }
                });

                $('.raise-hand').click(function() {

                    // setTimeout(function(){


                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });

                        var yesValue = $('.yes-value').val();
                        var voteValue = $('.vote-value').val();
                        var voteComment = $('.comment_vote').val();
                        var base_url = window.location.origin;

                        $.ajax({
                            // url: base_url + "/add-activity",
                            // type: "POST",
                            // data: {s_id: user_id, lid: lid, learn: yesValue, vote: voteValue, comment: voteComment}

                            type: "POST",
                                url: base_url + '/add-activity',
                                data: { s_id: user_id, lid: lid, learn: yesValue, vote: voteValue, comment: voteComment, _token: '{{csrf_token()}}' },
                                success: function (data) {
                                console.log(data);
                                $('.modal-servey').hide();
                                },
                                error: function (data, textStatus, errorThrown) {
                                    console.log(data);
                                    $('.modal-servey').hide();
                                },
                        })

                // },5000);


                });
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
