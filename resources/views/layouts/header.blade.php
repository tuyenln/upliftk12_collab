<header>
    <div class="nav">
        <ul style="width: 100%;">
            <li><a href="{{route('teacher')}}"><img src="{{url('public/images/small-logo.png')}}" style="max-height: 30px; display: inherit;"/></a></li>
            {{--<li class="collapse-icon" style="margin-left: 10px; "><i class="fa fa-bars"></i></li>--}}
            <div class="dropdown pull-right profile-show">
                <button class="dropbtn two btn-name"><img class="rounded-circle" src="<?php
                    if ($user->avatar == '') {
                        echo url("public/images/noavatar.png");
                    } else {
                        echo url($user->avatar);
                    }?>" style="width: 30px; height: 30px; border-radius: 50%;"/> {{$user->name}}
                    <i class="fa fa-angle-down" style="margin-left: 10px; margin-top: 5px;"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    {{--<a href="{{route('admin.profile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>--}}
                    <a href="/logout"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
        </ul>
    </div>
</header>
