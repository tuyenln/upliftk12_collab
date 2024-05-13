<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>UpliftK12</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{url('public/assets/images/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ url('public/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/LineIcons.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/default.css')}}">
    <link rel="stylesheet" href="{{ url('public/assets/css/style-for-new.css')}}">
    <link href="{{ url('public/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="title" property="og:title" content="Uplift K12 - A Visual Collaboration Tool for Education" />
    <meta name="image" property="og:image" content="https://media.giphy.com/media/1pSWNAVCuplavttvsg/giphy.gif">
    <meta property="og:image:secure_url" content="https://media.giphy.com/media/1pSWNAVCuplavttvsg/giphy.gif" />
    <meta name="og:image:width" property="og:image:width" content="400" />
    <meta name="og:image:height" property="og:image:height" content="200" />
    <meta name="description" property="og:description" content="Uplift K12 is a visual collaboration platform with built in virtual lessons, guided practice, and digital manipualtvies" />
    <meta name="author" content="Uplift K12 LLC">
    <meta content="991618354275198" property="fb:app_id" />
    <meta content="Upliftk12" property="og:site_name" />
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        .navbar-area.sticky .navbar .navbar-nav .nav-item a {
            color: #412a7f;
        }
    </style>

</head>

<body>

    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area">
    <div style="width: 100%; height: 10px; background-color: #412a7f; margin-top: -10px;"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand" href="/">
                            <img src="{{ url('public/assets/img/logo.png')}}" width="250">
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <!-- <li class="nav-item active"><a class="page-scroll" href="#home">home</a></li> -->
                                <li class="nav-item"><a class="page-scroll" href="#about">About Us</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#features">Features</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#research">Research</a></li>
                                {{-- <li class="nav-item"><a class="page-scroll" href="#practice">Practice</a></li> --}}
                                <li class="nav-item"><a class="page-scroll" href="free-trial">Trial</a></li>
                            </ul>
                        </div>

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li><a class="solid" href="login" style="background-color: #412A7F; border: none; border-radius: 10px; color: white;">Login</a></li>
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->

    @yield('content')

    <!--====== FOOTER PART START ======-->

    <section class="" style="background: url({{url('public/assets/img/footer.png')}}); position: relative; background-size: 100%; background-repeat: no-repeat;">
        <div style="position: absolute; right:0; left:0; text-align:center; margin:auto; top: -40px; width: 60px;">
    <img src="{{ url('public/assets/img/footer-rokect.png')}}" alt="">
        </div>=
        <div class="container pt-150 pb-150">
            <div class="row">
                <div class="link" style="width: 40%; margin-right:0; margin-left:auto;">
                    <a class="page-scroll" href="#about" style="color: white; font-size:28px">About</a> <br>
                    <a class="page-scroll" href="#pricing" style="color: white; font-size:28px">Pricing</a> <br>
                    <a class="page-scroll" href="#features" style="color: white; font-size:28px">Features</a> <br>
                    <a href="https://www.upliftk12.com/term-of-use" style="color: white; font-size:28px">Terms and Conditions</a> <br>
                    <a href="https://www.upliftk12.com/privacy-policy" style="color: white; font-size:28px">Privacy Policy</a>
                </div>
            </div>
            <div class="row text-center mt-200">
                <div class="footer" style="margin: auto;">
                    <h1 class="mt-20" style="color: white; font-size:55px;">Contact Us!</h1>
                    <p class="mt-20" style="color: white; font-size:30px;">teach@upliftk12.com</p>
                    <p class="mt-20" style="color: white; font-size:30px;">(469) 431-0809</p>
                    <p class="mt-20" style="font-size:30px;">Uplift K12 LLC © Copyright 2021</p>
                </div>
            </div>
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>



    <!--====== Jquery js ======-->
    <script src="{{ url('public/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{ url('public/assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ url('public/assets/js/popper.min.js')}}"></script>
    <script src="{{ url('public/assets/js/bootstrap.min.js')}}"></script>

    <!--====== Slick js ======-->
    <script src="{{ url('public/assets/js/slick.min.js')}}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ url('public/assets/js/jquery.magnific-popup.min.js')}}"></script>

    <!--====== Ajax Contact js ======-->
    <script src="{{ url('public/assets/js/ajax-contact.js')}}"></script>

    <!--====== Isotope js ======-->
    <script src="{{ url('public/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ url('public/assets/js/isotope.pkgd.min.js')}}"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="{{ url('public/assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{ url('public/assets/js/scrolling-nav.js')}}"></script>

    <!--====== Main js ======-->
    <script src="{{ url('public/assets/js/main-new.js')}}"></script>
    <script src="{{ url('public/assets/vendor/venobox/venobox.min.js') }}"></script>

    <script type="text/javascript">
	jQuery(document).ready(function(){
        $('.venobox').venobox();
		$(document).on('submit', '#fom-newsletter', function(e) {
			e.preventDefault();
			//disable the submit button
            console.log('ss');
            $("input[type=submit]").attr("disabled", true);
                    var formData = $(this).serialize()
                    var output = $(this).siblings('.output_response')
                    output.html('<i class="fa fa-spin fa-spinner fa-2x"></i>')
                    $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'newsletter',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(res) {
                            if(res.status == 'error') {
                                output.html('<div class="alert alert-danger">'+res.message+'</div>')
                            }else {
                                output.html('<div class="alert alert-success">'+res.message+'</div>')
                            }
                }
            }).then(function() {
                $("input[type=submit]").attr("disabled", false);
                    });
                })
            });
    </script>
    <!-- begin olark code -->
    <script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify('8255-204-10-2600');</script>
    <!-- end olark code -->

</body>

</html>