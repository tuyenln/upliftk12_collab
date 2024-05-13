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
        @include('student.layouts.header')
        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
            @include('student.layouts.footer')
        </div>
        @include('student.layouts.footerscript')
    </body>
</html>