		
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <!-- Meta, title, CSS, favicons, etc. -->
  
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
  <div class="spinner-wrapper">
</div>

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
             <a href="" target="blank" class="site_title"><img src="{{url('public/assets/images/logo-dark.png')}}" style="height: 50px; width: 100px"> <br></a>
          </div>
          <div class="clearfix"></div>


          <!-- menu prile quick info -->
          
          <div class="profile" >
            <div class="profile_pic">
             
            </div>
            <div class="profile_info" style="    padding: 0px 0px 15px 0px;width: 90%;float: left;">
			

            
			  
			  
            </div>
          
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3 style="font-size: 15px;">{{Auth::user()->name}}</h3>
              <ul class="nav side-menu">
               
                   <li><a href="{{url('home')}}"><i class="fa fa-home"></i> HOME</a>
                </li>
               
				          
          
			
        
        
      
                

                               

				
				
               
                <li>	


                                                                        <a href="{{ url('principle/logout') }}" style="color: red;" >
                                    
<i class="fa fa-sign-out" aria-hidden="true"></i>LOGOUT</a></li>
              
               
              </ul>
            </div>
          

          </div>
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
              </li>

            

            </ul>
          </nav>
        </div>

      </div>