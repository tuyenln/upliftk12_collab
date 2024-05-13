<div class="col-12 col-sm-12 col-md-12 col-lg-3 mrgn-b-2">

@php
if (Auth::user()->user_type == 1)  {
  $array = [
    [
        'url' => 'admin.home',
        'name' => 'Dashboard',
        'icon' => 'dashboard'
    ],
    [
        'url' => 'admin.principal.index',
        'name' => 'Principals',
        'icon' => 'list'
    ],
    [
        'url' => 'admin.teacher.index',
        'name' => 'Teachers',
        'icon' => 'list'
    ],
    [
        'url' => 'admin.teacher.signup.index',
        'name' => 'Premium Teachers',
        'icon' => 'list'
    ],
    [
        'url' => 'admin.subject.index',
        'name' => 'Subjects',
        'icon' => 'list'
    ],
    [
        'url' => 'admin.gradelevel.index',
        'name' => 'Grade Level',
        'icon' => 'ruler'
    ],
    [
        'url' => 'admin.lesson.index',
        'name' => 'Lessons',
        'icon' => 'book'
    ],
    [
        'url' => 'admin.resource_type.index',
        'name' => 'Resource Types',
        'icon' => 'book'
    ],
    [
        'url' => 'admin.note.index',
        'name' => 'Notes',
        'icon' => 'notepad'
    ],
    [
        'url' => 'admin.shortcode',
        'name' => 'Cases / Objectives',
        'icon' => 'book'
    ],
    [
        'url' => 'admin.assessment',
        'name' => 'Assessments',
        'icon' => 'list'
    ],
    [
        'url' => 'admin.library',
        'name' => 'Library',
        'icon' => 'folder'
    ],
    [
        'url' => 'admin.demo_requests',
        'name' => 'Demo Requests',
        'icon' => 'book'
    ],
    [
        'url' => 'admin.lesson_log',
        'name' => 'Lesson Log',
        'icon' => 'log'
    ]
  ];
}
if (Auth::user()->user_type == 2) {
  $array = [
    [
        'url' => 'principal.home',
        'name' => 'Dashboard',
        'icon' => 'dashboard'
    ],
    [
        'url' => 'principal.teacher.index',
        'name' => 'Teachers',
        'icon' => 'list'
    ],
    [
        'url' => 'principal.student.index',
        'name' => 'Students',
        'icon' => 'graduation'
    ],
  ];
}
if (Auth::user()->user_type == 3) {
  $array = [
    [
        'url' => 'teacher.home',
        'name' => 'Dashboard',
        'icon' => 'dashboard'
    ],
    [
        'url' => 'teacher.class.index',
        'name' => 'Classes',
        'icon' => 'library'
    ],
    [
        'url' => 'teacher.class.report',
        'name' => 'Reading Reports',
        'icon' => 'pencil-alt'
    ],
    [
        'url' => 'teacher.mathreport',
        'name' => 'Math Reports',
        'icon' => 'pencil-alt'
    ],
    [
        'url' => 'teacher.lesson',
        'name' => 'Lessons',
        'icon' => 'book'
    ],
    [
        'url' => 'teacher.invite',
        'name' => 'Invites',
        'icon' => 'user'
    ],
  ];
}
if (Auth::user()->user_type == 4) {
  $array = [
    [
        'url' => 'student.home',
        'name' => 'Dashboard',
        'icon' => 'dashboard'
    ],
    [
        'url' => 'student.reading',
        'name' => 'Reading',
        'icon' => 'library'
    ],
    [
        'url' => 'student.lessons',
        'name' => 'Lessons',
        'icon' => 'library'
    ]
  ];
}
  $array[] = [
      'url' => 'logout',
      'name' => 'Logout',
      'icon' => 'exit'
    ]
@endphp
<ul class="sidebar-list list-unstyled px-0 m-0 styleshadow">
  @foreach( $array as $route )
      @php $active = Request::route()->getName() == $route['url'] ? 'active' : '' @endphp
      <li class="{{(isset($route['children'])) ? 'has-child' : ''}} {{$active}}">
          @isset($route['children'])
              <i class="lni lni-circle-plus has-submenu"></i>
          @endif
          <a href="{{route($route['url'])}}"  data-title="{{$route['name']}}">
              <i class="lni lni-{{$route['icon']}} "></i>
              <span>{{$route['name']}}</span>
          </a>
          @if(isset($route['children']))
              <ul class="sub-menu">
              @foreach($route['children'] as $route)
                  <li class="">
                      <a href="{{route($route['url'])}}"  data-title="{{$route['name']}}">
                          <i class="lni lni-{{$route['icon']}}"></i>
                          <span>{{$route['name']}}</span>
                      </a>
                  </li>
              @endforeach
              </ul>
          @endif
      </li>
  @endforeach
</ul>
</div>
