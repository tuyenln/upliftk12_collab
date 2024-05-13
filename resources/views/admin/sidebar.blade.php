<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3 style="font-size: 15px;">Welcome, {{Auth::user()->name}}!</h3>
    <ul class="nav side-menu">
      @if (Auth::user()->user_type == 1)
        <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{route('admin.add.principal')}}"><i class="fa fa-plus"></i> Adding Principal</a></li>

        <li><a href="{{route('admin.assessment')}}"><i class="fa fa-plus"></i>List Assessments</a></li>
        <li><a href="{{route('admin.assessment.add')}}"><i class="fa fa-plus"></i> Adding Assessment</a></li>
        <li><a href="{{route('admin.subject.index')}}"><i class="fa fa-book"></i> Subjects</a></li>
        <li><a href="{{route('admin.gradelevel.index')}}"><i class="fa fa-list-ul"></i> Grade Level</a></li>
        <li><a href="{{route('admin.contact')}}"><i class="fa fa-bell"></i>Contacts</a></li>
        @endif

        @if (Auth::user()->user_type == 2)
        <li><a href="{{route('principal.home')}}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{route('principal.student.index')}}"><i class="fa fa-users"></i> Student</a></li>
        @endif

        @if (Auth::user()->user_type == 3)
        <li><a href="{{route('teacher.home')}}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{route('teacher.class.index')}}"><i class="fa fa-users-class"></i> Classes</a></li>
      @endif
      <li><a href="{{ route('logout') }}" style="color: red;" ><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
    </ul>
  </div>
</div>
