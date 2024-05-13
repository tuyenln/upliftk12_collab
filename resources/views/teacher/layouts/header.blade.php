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
                    <a href="{{route('teacher.changePassword')}}"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a>
                    <a href="{{route('teacher.manageClass')}}"><i class="fa fa-book" aria-hidden="true"></i> Manage Class</a>
                    @if($user->parent_user_id == -1)
                        @if(!$user->subscribed('educator'))
                            <a href="{{route('teacher.update_payment_method')}}"><i class="fa fa-usd" aria-hidden="true"></i> Subscribe</a>
                        @else
                            <a href="{{route('teacher.addStudent')}}"><i class="fa fa-users" aria-hidden="true"></i>Add Students</a>
                            <a href="{{route('teacher.cancel_membership')}}"><i class="fa fa-trash" aria-hidden="true"></i>Unsubscribe</a>
                        @endif
                    @endif
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
            @foreach($classes as $class)
                <li onclick="window.location.href = '{{route('teacher.selectClass', $class->id)}}'">{{$class->name}}</li>
            @endforeach
        </ul>
    </div>
</header>
