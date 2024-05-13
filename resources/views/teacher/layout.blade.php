  
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}"></link>
    <link href='https://fonts.googleapis.com/css?family=Fira Sans:300,400,500,600,700,800,900' rel='stylesheet'>
    <link rel="stylesheet" href="{{url('public/css/new-style.css')}}"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{url('public/css/fullcalendar.css')}}" rel="stylesheet">
    @yield('style')
</head>
<body>
<header>
    <div class="nav">
        <ul>
            <li><a href="{{route('teacher')}}"><img src="{{url('public/images/small-logo.png')}}" style="max-height: 30px;"/></a></li>
            <li class="class-show"><?php if (Session::has('selectedClass')) echo (Session::get('selectedClass')->name); ?></li>
            <li class="collapse-icon" style="margin-left: 10px; "><i class="fa fa-bars"></i></li>
            <div class="dropdown pull-right profile-show">
                <button class="dropbtn two btn-name"><img class="rounded-circle" src="<?php 
                    if ($user->avatar == '') {
                        echo url("public/images/noavatar.png");
                    } else {
                        echo url($user->avatar);
                    }?>" style="width: 30px; height: 30px; border-radius: 50%;"/> {{$user->name}}
                    <i class="fa fa-angle-down" style="margin-left: 10px;"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="{{route('teacher.profile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                    <a href="{{route('teacher.manageClass')}}"><i class="fa fa-book" aria-hidden="true"></i> Manage Class</a>
                    <a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
        </ul>
    </div>
    <div class="left-panel">
        <div class="header" onclick="window.location.href='/teacher'">
            <img src="{{url('public/images/Subtract.png')}}" class="header-logo">
            <div class="title">
                <h2>Uplift K12</h2>
                <p>Body 2</p>
            </div>
        </div>
        <div class="divider"></div>
        <ul class="class-name">
            @if (count($classes) > 0)
            @foreach($classes as $class)
                <li onclick="window.location.href = '{{route('teacher.selectClass', $class->id)}}'">{{$class->name}}</li>
            @endforeach
            @endif
        </ul>
    </div>
</header>
@yield('content')
<script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"> </script>
<script type="text/javascript" src="{{url('public/js/datepicker.js')}}"> </script>
<script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"> </script>
@yield('script')
<script type="text/javascript">
    $('.collapse-icon').click(function() {
        $('.left-panel').toggleClass('show-left-panel');
    });
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.dropbtn')) {
            var myDropdown = document.getElementById("myDropdown");
            if (myDropdown.classList.contains('show')) {
                myDropdown.classList.remove('show');
            }
        }
    }
</script>
@stack('scripts')
</body>
</html>