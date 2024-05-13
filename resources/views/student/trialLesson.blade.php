
<!DOCTYPE html>
<html>
<head>
	<title>Get into Lesson</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('public/assets/css/style-front.css')}}">
	<!--Custom styles-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    
    <!------ Include the above in your HEAD tag ---------->
    <style>
    /* Made with love by Mutiullah Samim*/

    @import url('https://fonts.googleapis.com/css?family=Numans');

    html,body{
        background: #412A7F;
        height: calc(100% - 80px);
        font-family: 'Numans', sans-serif;
    }

    .container{
        height: 100%;
        align-content: center;
    }

    .card{
        margin-top: auto;
        margin-bottom: auto;
        width: 400px;
        background-color: rgba(0,0,0,0.5) !important;
    }

    .social_icon span{
        font-size: 60px;
        margin-left: 10px;
        color: #FFC312;
    }

    .social_icon span:hover{
    color: white;
    cursor: pointer;
    }

    .card-header h3{
    color: white;
    }

    .social_icon{
    position: absolute;
    right: 20px;
    top: -45px;
    }

    .input-group-prepend span{
    width: 50px;
    background-color: #6f48a9;
    color: white;
    border:0 !important;
    }

    input:focus{
    outline: 0 0 0 0  !important;
    box-shadow: 0 0 0 0 !important;

    }

    .remember{
    color: white;
    }

    .remember input
    {
    width: 20px;
    height: 20px;
    margin-left: 15px;
    margin-right: 5px;
    }

    .login_btn{
    color: white;
    background-color: #5b3b99;
    width: 150px;
    }

    .login_btn:hover{
    color: white;
    background-color: #6f48a9;
    }

    .links{
    color: white;
    }

    .links a{
    margin-left: 4px;
    }
    </style>

</head>
<body>
<header id="header" class="fixed-top ">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="/"><img src="{{url('public/assets/images/logo.png')}}" alt=""></a></h1>
        </div>
      </div>

    </div>
  </header><!-- End Header -->
<div class="container" style="margin-top: 80px;">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="{{route('student.starttriallesson')}}">
                @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="yourname" name="student_name">
						<input type="hidden" name="lessonid" value="{{$lesson_id}}">
                        <input type="hidden" name="mod" value="{{$mod}}">
					</div>
					<div class="form-group">
						<input type="submit" value="Get Started" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        if( isMobile.any() || isMobile.iOS()) {
            $.alert({
                title: 'Warning',
                content: 'You cannot take the lesson with your device. Please Use your PC. We will fix it as soon as possible',
            });
            $('.login_btn').attr('disabled', 'disabled');
        }
    });
    var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
    
</script>
</body>
</html>