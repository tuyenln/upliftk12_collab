@extends('layouts.app')

@section('content')
<!--====== Banner ======-->
<section id="home" class="banner" style="background: url({{url('public/assets/img/banner.png')}}); height:980px; background-size: contain; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="slider-content">
                    <h1 class="title">Keep Students Engaged</h1>
                    <p class="text">A 21st Century Learning Platform with Ready-Made Multisensory Lessons.</p>
                    <ul class="slider-btn rounded-buttons">
                        <li><a class="main-btn rounded-one" href="https://vimeo.com/518451195" class="venobox btn-watch-video" data-vbtype="video" style="background: #412a7f; color: white; border: none;" data-autoplay="true">Watch Video</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== Lesson ======-->
<section id="lesson" class="about-area">
    <div class="container">
        <div class="row">
            <h1 style="text-align: center; color: #412A7F; font-size: 45px;">More Interactivity with Research-Based Lessons</h2>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="faq-content mt-45">
                    <div class="about-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 35px; color: #412A7F;">
                                        <span><img src="{{ url('public/assets/img/tag1.png')}}" height="50"></span>
                                        Active Student Engagement
                                    </a>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text" style="font-size: 20px; font-style: italic;">Students and teachers can move objects on the same board at the same time. Teachers can see student work in real time.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="font-size: 35px; color: #412A7F;">
                                        <span><img src="{{ url('public/assets/img/tag2.png')}}" height="50"></span>
                                        Drive Academic Growth
                                    </a>
                                </div>

                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text" style="font-size: 20px; font-style: italic;">Our curriculum supplements the CPA/CRA Framework for math grades K-Algebra 1. Synchronous and asynchronous content available.</p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <a href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="font-size: 35px; color: #412A7F;">
                                        <span><img src="{{ url('public/assets/img/tag3.png')}}" height="50"></span>
                                        Reduce Teacher Stress
                                    </a>
                                </div>

                                <div id="collapseThree" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p class="text" style="font-size: 20px; font-style: italic;">
                                            We help teachers cut down on prep time with ready-made lessons and activities.
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- card -->
                        </div>
                    </div> <!-- faq accordion -->
                </div> <!-- faq content -->
            </div>
            <div class="col-lg-5">
                <div class="about-image mt-50">
                    <img src="{{url('public/assets/img/lesson.png')}}" alt="lesson">
                </div> <!-- faq image -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== Research ======-->
<section id="research" class="features-area" style="background: url({{url('public/assets/img/research.png')}}); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title pb-10">
                    <h3 class="title" style="color: white; font-size:55px;">Research on the CRA Framework</h3>
                    <p class="text" style="color: white; font-size:20px; line-height: normal;">
                        CRA methods to teach place value, fractions, addition, subtraction, multiplication, algebra, and word problems are supported by research. Students who rely on memorizing procedural steps and lack the conceptual understanding related to foundational operations will not understand why steps are used. <a href="https://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.1030.5029&rep=rep1&type=pdf">Mancl, Miller,& Kennedy, 2012</a>
                        <br>
                        <br>
                        CRA provides an opportunity for increased interaction with content and increased frequency of response for all students <a href="https://eric.ed.gov/?id=EJ797683">Witzel, 2005</a>
                    </p>
                </div> <!-- row -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7 col-sm-9 mt-40">
                <img src="{{url('public/assets/img/r-1.png')}}" alt="" style="width:100%">
            </div>
            <div class="col-lg-4 col-md-7 col-sm-9 mt-40">
                <img src="{{url('public/assets/img/r-2.png')}}" alt="" style="width:100%">
            </div>
            <div class="col-lg-4 col-md-7 col-sm-9 mt-40">
                <img src="{{url('public/assets/img/r-3.png')}}" alt="" style="width:100%">
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== Feature ======-->
<section id="features" class="pb-100">
    <div class="container">
        <div class="row" style="padding: 50px;">
            <h1 style="font-size: 45px; color:#412A7F;">Features</h1>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-lg-6 col-md-10">
                <img src="{{ url('public/assets/img/feature1.png')}}" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="section-title pb-10">
                    <h3 class="title text-center" style="font-size: 35px; color:#412A7F;">Ready-Made Lessons</h3>
                    <p class="text" style="font-size: 20px;">
                        We help cut lesson prep time significantly by providing ready-made lessons for your convenience. <br> <br>
                        Teachers can search through and preview lessons they love. Each lesson, virtual manipulative, guided practice, or game is meant to last about 20 minutes.
                    </p>
                </div> <!-- section title -->
            </div>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-lg-6 col-md-10">
                <div class="section-title pb-10">
                    <h3 class="title text-center" style="font-size: 35px; color:#412A7F;">Quick Links - No Student Login</h3>
                    <p class="text" style="font-size: 20px;">
                        If you are virtual and just want to launch a lesson, there is no student login required. <br><br>
                        You can choose to “Get Link” for each lesson and paste the link into your preferred video conferencing platform or learning management system. Students click the link, enter their name, and immediately begin the lesson. <br><br>
                        If you’re using a lesson on a SmartBoard, you can easily project it by just pushing “Launch”.
                    </p>
                </div> <!-- section title -->
            </div>
            <div class="col-lg-6 col-md-10">
                <img src="{{ url('public/assets/img/feature2.png')}}" alt="" style="width: 100%;">
            </div>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-lg-6 col-md-10">
                <img src="{{ url('public/assets/img/feature3.png')}}" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="section-title pb-10">
                    <h3 class="title text-center" style="font-size: 35px; color:#412A7F;">Student Progress Tracker</h3>
                    <p class="text" style="font-size: 20px;">
                        Students and teachers can see how students are progressing on asynchronous activities. <br><br>
                        Asynchronous activities have voice-over content as well as short quiz questions to see if they mastered the lesson.
                    </p>
                </div> <!-- section title -->
            </div>
        </div>
    </div> <!-- container -->
</section>

<!--====== Practice ======-->
<section id="practice" class="features-area" style="background: url({{url('public/assets/img/research.png')}}); background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <h3 class="title" style="color: white; font-size:55px;">SEL Lessons Now Available!</h3>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-lg-6 col-md-10">
                <div class="section-title pb-10">
                    <p class="text" style="font-size: 25px; color:white; line-height:normal;">
                        The Generation Text Online framework provides a process to develop a SEL skill set and foundation in order to set young adults up for successful relationships and a process for resolving conflict, solving problems and self-advocating.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <img src="{{ url('public/assets/img/available.gif')}}" alt="" style="width: 100%;">
            </div>
        </div>
    </div> <!-- container -->
</section>

<section id="pricing" class="pricing-area ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section-title text-center pb-25">
                    <h3 class="title" style="color: #412a7f;">Engage Students Now</h3>
                    <p class="text">Access our database of interactive lessons, for your synchronous instruction</p>
                </div>
            </div>
        </div>
        <div>
            <p style="color: #412A7F; font-size: 18px; font-weight: 600; background: rgba(98, 0, 238, 0.08); padding: 20px; ">Please note: Only Kindergarten-5rd grade resources available currently. We are adding new content daily and plan to release 6th-Algebra 1 content by February 2021.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="pricing-style mt-30">
                    <div class="pricing-icon text-center">
                        <img src="{{url('public/assets/images/basic.svg')}}" alt="">
                    </div>
                    <div class="pricing-header text-center">
                        <h5 class="sub-title">FREE TRIAL</h5>
                        <p class="month"><span class="price">$ 0</span> 7 days</p>
                    </div>
                    <div class="pricing-list">
                        <ul class="text-muted star-bullets">
                            <li>7 days free</li>
                            <li>Full access to our lessons with your students with <u>shareable link only</u></li>
                            <li>Full Web Conferencing Platform</li>
                            <li>Add-on to Zoom, Microsoft Teams, Hangouts, Etc.</li>
                            <li>Formative assessments embedded in the lessons</li>
                        </ul>
                    </div>
                    <div class="pricing-btn rounded-buttons text-center">
                        <a class="main-btn rounded-one" href="free-trial">GET STARTED</a>
                    </div>
                </div> <!-- pricing style one -->
            </div>
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="pricing-style mt-30">
                    <div class="pricing-icon text-center">
                        <img src="{{url('public/assets/images/pro.svg')}}" alt="">
                    </div>
                    <div class="pricing-header text-center">
                        <h5 class="sub-title">EDUCATOR PLAN</h5>
                        <p class="month"><span class="price">$ 20</span> per month</p>
                    </div>
                    <div class="pricing-list">
                        <ul class="text-muted star-bullets">
                            <li>Monthly Subscription</li>
                            <li>Everything in Free Trial, plus:</li>
                            <li>Create classes and assign student accounts</li>
                            <li>Unlimited Quizzes available after lesson</li>
                            <li>Track student growth</li>
                            <li>Assessment-driven recommendations (coming soon)</li>
                        </ul>
                    </div>
                    <div class="pricing-btn rounded-buttons text-center">
                        <a class="main-btn rounded-one" href="free-trial">GET STARTED</a>
                    </div>
                </div> <!-- pricing style one -->
            </div>
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="pricing-style mt-30">
                    <div class="pricing-icon text-center">
                        <img src="{{url('public/assets/images/enterprise.svg')}}" alt="">
                    </div>
                    <div class="pricing-header text-center">
                        <h5 class="sub-title">SCHOOLS & DISTRICTS</h5>
                        <p class="month"><span class="price">3 +</span> educators</p>
                    </div>
                    <div class="pricing-list">
                        <ul class="text-muted star-bullets">
                            <li>Annual License</li>
                            <li>Everything in Educator Plan, plus:</li>
                            <li>Unlimited Use for Campus / District</li>
                            <li>Alignment to State Tests</li>
                            <li>Alignment to State Standards</li>
                            <li>Advanced Reporting</li>
                            <li>Assessments</li>
                        </ul>
                    </div>
                    <div class="pricing-btn rounded-buttons text-center">
                        <a class="main-btn rounded-one" href="#">Contact Us</a>
                    </div>
                </div> <!-- pricing style one -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== About Us ======-->
<section id="about" class="pt-100 pb-120">
    <div class="container">
        <div class="row">
            <h3 class="title" style="font-size:55px; color:#412A7F;">About Us</h3>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-lg-6 col-md-10">
                <div class="pb-10" style="position: relative;">
                    <h3 style="font-size: 35px; line-height:normal;">
                        We advocate for students with diverse learning styles.
                    </h3>
                    <p class="text mt-40" style="font-size: 20px; line-height:normal; font-style: italic; color:#412A7F;">
                        "Tell me and I forget. Teach me and I remember. Involve me and I learn."
                    <div style="position:absolute; right:10px; bottom:-30px;">- Benjamin Franklin</div>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <img src="{{ url('public/assets/img/about.png')}}" alt="" style="width: 100%;">
            </div>
        </div>
        <div class="row mt-100">
            <div class="col-lg-4 col-sm-6">
                <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="team-image">
                        <img src="{{url('public/assets/img/team1.png')}}" alt="Team">
                        <div style="height: 100px;"></div>
                    </div>
                    <div class="team-content">
                        <div class="team-social">
                            <ul class="social">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram"></i></a></li>
                            </ul>
                        </div>
                        <h4 class="team-name"><a href="#">Mehul Shah</a></h4>
                        <span class="sub-title">Founder</span>
                    </div>
                </div> <!-- single team -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="team-image">
                        <img src="{{url('public/assets/img/team2.png')}}" alt="Team">
                        <div style="height: 100px;"></div>
                    </div>
                    <div class="team-content">
                        <div class="team-social">
                            <ul class="social">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram"></i></a></li>
                            </ul>
                        </div>
                        <h4 class="team-name"><a href="#">Michelle Garces</a></h4>
                        <span class="sub-title">Founder</span>
                    </div>
                </div> <!-- single team -->
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="team-style-eleven text-center mt-30 wow fadeIn" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="team-image">
                        <img src="{{url('public/assets/img/team3.png')}}" alt="Team">
                        <div style="height: 100px;"></div>
                    </div>
                    <div class="team-content">
                        <div class="team-social">
                            <ul class="social">
                                <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="#"><i class="lni lni-instagram"></i></a></li>
                            </ul>
                        </div>
                        <h4 class="team-name"><a href="#">Ashish Trehan</a></h4>
                        <span class="sub-title">CTO</span>
                    </div>
                </div> <!-- single team -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== Contact ======-->
<section id="contact" class="pt-120 pb-120" style="background-color: #0a588b;">
    <div class="container" style="width: 95%;">
        <div class="row">
            <div class="col-lg-2 col-md-4">
                <img src="{{ url('public/assets/img/contact.png')}}" alt="" style="width: 100%;">
            </div>
            <div class="col-lg-10 col-md-10" style="padding-left: 100px;">
                <div class="pb-10" style="position: relative;">
                    <h3 style="font-size: 45px; line-height:normal; color:white;">
                        Not sure yet? Request a demo
                    </h3>
                    <p class="text mt-40" style="font-size: 25px; line-height:normal; color:white;">
                        Schedule 15 minutes with us to learn how you can transform intervention instruction. We will set you up with a free trial.
                    </p>
                    <div class="mt-50" style="width: 100%;">
                        <div class="output_response"></div>
                        <form class="form-inline" id="fom-newsletter">
                            <input name="name" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-4 col-sm-12" placeholder="Name">
                            <input name="email" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-5 col-sm-12" placeholder="Email">
                            <button type="submit" class="btn btn-primary text-white font-weight-light mb-sm-2 col">Submit</button>
                            @if(config('services.recaptcha.key'))
                                <div class="g-recaptcha"
                                    data-sitekey="{{config('services.recaptcha.key')}}">
                                </div>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
</section>

<section id="trial" class="pt-100 pb-100" style="background-color: #f4f6f7;">
    <div class="container">
        <div class="content sec-pad justify">
            <div class="team-detail-wrap shape-wrap">
                <div class="container">
                    <div class="membersingle-info team-detail-space">
                        <div class="row align-items-start ">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2 mx-auto card py-5 px-4">
                                <h2 class="text-center">Start your 7 days free trial</h2><br/>
                                @if(session('success'))
                                    <div class="alert alert-success">{!!session('success')!!}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="free-trial" accept-charset="UTF-8">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Name" class="control-label">Name</label>
                                                <input class="form-control" name="name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email address" class="control-label">Email Address</label>
                                                <input class="form-control" name="email" type="email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="State Name" class="control-label">State Name</label>
                                                <input class="form-control" name="state_name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="District Name" class="control-label">District Name</label>
                                                <input class="form-control" name="district_name" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="School Name" class="control-label">School Name</label>
                                                <input class="form-control" name="school_name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Phone Number" class="control-label">Phone Number</label>
                                                <input class="form-control" name="phone" type="number" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="Username" class="control-label">Username</label>
                                                <input class="form-control" name="username" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="control-label">Password</label>
                                                <input class="form-control" name="password" type="password" value="" id="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password Confirm" class="control-label">Password Confirm</label>
                                                <input class="form-control" name="confirm_password" type="password" value="" required>
                                            </div>

                                            @if(config('services.recaptcha.key'))
                                            <div class="g-recaptcha"
                                                data-sitekey="{{config('services.recaptcha.key')}}">
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="term" class="checkbox-inline">
                                            <input id="term" class="mr-1" type="checkbox" name="agree" value="1" required>By accepting this trial, you agree to abide by <a href="https://www.upliftk12.com/term-of-use">Uplift K12's terms of service</a>.
                                        </label>
                                    </div>
                                    <div class="form-group text-center mb-0">
                                        <button class="main-btn rounded-one" type="submit">Request free trial</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection