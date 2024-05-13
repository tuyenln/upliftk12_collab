<?php
extract($_REQUEST);
$name= base64_decode($n);
$QuizUlr="https://upliftk12.com/assessments/mod/quiz/view.php?id=".base64_decode($id);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
	<title>Quiz Test Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://upliftk12.com/public/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style type="text/css">.iframe{height:2500px;width: 100%;border: none;overflow: hidden;}.logo{width:230px;}
	.navbar-dark .navbar-nav .nav-link{color:#343a40!important;font-weight: 600}
	.clpd{padding-left: 0px}
	</style>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-12 clpd">
               <!-- Navigation -->
               <nav class="navbar navbar-expand-lg navbar-dark static-top">
                  <div class="container">
                     <a class="navbar-brand" href="https://upliftk12.com">
                     <img src="https://upliftk12.com/public/assets/images/logo-dark.png" class="logo"alt="">
                     </a>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                           <li class="nav-item">
                              <a class="nav-link" href="https://upliftk12.com/student"><?php echo $name?></a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="https://upliftk12.com/logout">Logout</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </nav>
            </div>
         </div>
     </div>
      <iframe src="<?php echo $QuizUlr ?>" class="iframe" scrolling="no"></iframe>
   </body>
</html>