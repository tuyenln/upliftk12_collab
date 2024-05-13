<header>
    <div class="nav">
        <ul>
            {{--<li class="collapse-icon"><i class="fa fa-bars"></i></li>--}}
            <li class="class-show">Principal</li>
            <div class="dropdown pull-right profile-show">
                <button class="dropbtn two btn-name" onclick="myFunction()">
                    {{$user->name}}
                    <i class="fa fa-user-o" style="margin-left: 10px;"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                    <a href="{{route('principal.ChangePassword')}}"><i class="fa fa-user" aria-hidden="true"></i> Change password</a>
                    <a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
        </ul>
    </div>
    <div class="left-panel">
        <div class="header" onclick="window.location.href='/principal'">
            <img src="{{url('public/images/Subtract.png')}}" class="header-logo">
            <div class="title">
                <h2>Uplift K12</h2>
                <p>Body 2</p>
            </div>
        </div>
        <div class="divider"></div>
        <ul class="class-name">
        </ul>
    </div>
</header>
