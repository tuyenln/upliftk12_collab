<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="{{url('public/fonts/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{url('public/css/animate.min.css')}}" rel="stylesheet">
  <!-- Custom styling plus plugins -->
  <link href="{{url('public/css/custom.css')}}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!--[if lt IE 9]>
<script src="../assets/js/ie8-responsive-file-warning.js"></script>
<![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<!--<div class="loader"></div>-->
<body class="nav-md">
  <div class="spinner-wrapper"></div>
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/')}}" target="blank" class="site_title">
              <img src="{{url('public/assets/images/logo-gray.png')}}" style="height: 40px;"><br>
            </a>
          </div>
          <div class="clearfix"></div>
          <!-- menu prile quick info -->
          <div class="profile" >
            <div class="profile_pic"></div>
            <div class="profile_info" style="    padding: 0px 0px 15px 0px;width: 90%;float: left;"></div>
          </div>
          <!-- /menu prile quick info -->
          <br />
          <!-- sidebar menu -->
          @include('admin.sidebar')
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="" href="home.php?logout='1'" data-original-title="Logout" aria-describedby="tooltip513079">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>
    <div class="top_nav">

      <div class="nav_menu">
        <nav class="" role="navigation">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="images/img.jpg" alt="">
                <strong></strong>
              </a>
            </li>
          </ul>

        </nav>
      </div>
    </div>


    <style type="text/css">
      .invalid-feedback{color:red;}
    </style>

    <!-- middle content -->
    <div class="right_col" role="main">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel" style="margin-bottom:350px;">
           @yield('content')
         </div>
       </div>
     </div>
   </div>

   <!-- middle content -->



   <!-- footer content -->
   <footer>
    <div class="pull-right">
      @2020 All Rights Reserved Powered By  <a target="_blank" href="https://webplanetsoft.com/">WebPlanetSoft</a>
    </div>
    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->

</div>

<!-- /page content -->
</div>
</div>

<!--<div id="custom_notifications" class="custom-notifications dsp_none">
<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
</ul>
<div class="clearfix"></div>
<div id="notif-group" class="tabbed_notifications"></div>
</div>-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('public/js/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/public/js/datepicker/daterangepicker.js')}}"></script>
<script src="{{url('public/js/custom.js')}}"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).on("change", '#dist', function(e) {
    var department = $(this).val();
    var url="{{url('get_school_dist')}}";
    $.ajax({
      type: "POST",
      data: {department: department,        "_token": "{{ csrf_token() }}"},
      url: url,
      success: function(json) {
        $('#school_name').html(json);
      }
    });
  });
</script>

@stack('scripts')
</body>
</html>
