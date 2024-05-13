<header>
    <div class="nav">
        <ul>
            <li><a href="#"><img src="{{url('public/assets/images/logo.png')}}" style="max-height: 30px;"/></a></li>
            <div class="dropdown pull-right profile-show">
                <button class="dropbtn two btn-name">{{$user->name}}
                    <i class="fa fa-user-o" style="margin-left: 10px;"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                    <a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </div>
            </div>
        </ul>
    </div>
</header>