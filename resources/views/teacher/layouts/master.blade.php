<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}"></link>

        <link rel="stylesheet" href="{{url('public/css/LineIcons.css')}}">
        <link rel="stylesheet" href="{{url('public/css/update-style.css')}}">
        <link href='https://fonts.googleapis.com/css?family=Fira Sans:300,400,500,600,700,800,900' rel='stylesheet'>
        <link rel="stylesheet" href="{{url('public/css/new-style.css')}}"></link>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{url('public/css/fullcalendar.css')}}" rel="stylesheet">
        @yield('style')
    </head>
    <body>
        @include('teacher.layouts.header')
        <div class="content-page">
            @if($user->parent_user_id == -1 && !$user->teacher_signup && !$user->subscribed('educator'))
            @else
            <div class="content">
                @yield('content')
            </div>
            @endif
            @include('teacher.layouts.footer')
        </div>
        @include('teacher.layouts.footerscript')
        <!-- begin olark code -->
        <script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
        /* custom configuration goes here (www.olark.com/documentation) */
        olark.identify('8255-204-10-2600');</script>
        <!-- end olark code -->
        <!-- begin use --->
        <script>
        (function (w, d, s) {
            var a = d.getElementsByTagName('head')[0];
            var r = d.createElement('script');
            r.async = 1;
            r.src = s;
            r.setAttribute('id', 'usetifulScript');
            r.dataset.token = "e97421cb449e497da7e87c71db030a38";
                    a.appendChild(r);
        })(window, document, "https://www.usetiful.com/dist/usetiful.js");
        </script>
        <!-- end ==>

    </body>
</html>
