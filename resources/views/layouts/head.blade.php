<!doctype html>
<html lang="en" class="no-js">
<head>
   <title>Uplift K12</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700,800,900" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,900" rel="stylesheet">

   <link rel="stylesheet" href="{{url('public/assets/css/all.min.css')}}">
   <link rel="stylesheet" href="{{url('public/assets/css/slick.css')}}">
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" href="{{ asset('public/favicon.ico') }}">
  <link rel="stylesheet" href="{{url('public/assets/css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{url('public/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{url('public/css/LineIcons.css')}}">
  <link rel="stylesheet" href="{{url('public/css/update-style.css')}}">
  <script type="text/javascript" src="{{url('public/assets/js/jquery.js')}}"></script><!--jquery-->
  <script type="text/javascript" src="{{url('public/assets/js/bootstrap.min.js')}}"></script><!--bootstrap js -->
  <link href="{{url('public/assets/css/select2.min.css')}}" rel="stylesheet" />
  <script src="{{url('public/assets/js/select2.min.js')}}"></script>
  @yield('css')
<style>
    button:focus{
        outline: none;
    }
    .nav {
        background: #412A7F;
        float: left;
        width: 100%;
    }
    header .nav ul {
        padding: 0 20px;
        margin: 0;
    }
    .nav li {
        list-style: none;
        font-family: Fira Sans;
        font-style: normal;
        font-weight: normal;
        display: inline-block;
        font-size: 21px;
        line-height: 60px;
        letter-spacing: 0.15px;
        color: #FFFFFF;
    }

    .nav li:hover {
        cursor: pointer;
    }

    .nav li.class-show {
        margin-left: 10px;
    }

    .nav li.profile-show{
        font-size: 18px;
    }

    .nav li.collapse-icon {
        color: #FFFFFF;
        font-size: 18px;
        line-height: 60px;
    }
    .dropdown.profile-show .dropbtn.two {
         cursor: pointer;
         font-size: 21px;
         border: none;
         outline: none;
         color: white;
         padding: 15px 16px;
         background-color: inherit;
         font-family: inherit;
         margin: 0;
        display: flex;
     }
    .dropdown.profile-show .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 11111;
        right: 0;
    }
    .dropdown.profile-show .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        font-family: Fira Sans;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
    }
    .dropdown.profile-show .dropdown-content a i{
        margin-right: 6px;
    }
    .dropdown.profile-show .dropdown-content a:hover {
        background-color: #ddd;
    }
    .dropdown.profile-show .dropdown-content.show {
        display: block;
    }
    .pull-right {
        float: right;
    }
</style>
</head>
