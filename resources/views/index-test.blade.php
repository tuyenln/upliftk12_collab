@extends('layouts.master-front')

@section('content')
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container-fluid" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Grow Your Students to Grade Level</h1>
          <h2>with Interactive Instruction</h2>
          <div><a href="/free-trial" class="btn-get-started scrollto">Schedule a Demo</a>&nbsp;<a href="/demo" class="btn-get-started scrollto">Watch a Recorded Session</a>
          </div>
          
        </div>
        <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-video" data-aos="zoom-in" data-aos-delay="150" {{-- style="    background-image: url(public/assets/images/newimage.png);
    background-size: 100% auto;
    background-repeat: no-repeat;
    background-position: center right;" --}}>
          {{-- <img src="{{url('public/assets/images/newimage.png')}}" class="animated" style="width: auto; height: 450px;" alt=""> --}}
          <video width="100%" autoplay controls loop>
            <source src="{{url('public/images/frontpagevideo.mov')}}" type="video/mp4">
            <source src="{{url('public/images/frontpagevideo.mov')}}" type="video/ogg">
            Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="150">
            <img src="{{url('public/assets/images/about.jpg')}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
            <h3>We're here to help students who need more engaging, hands-on lessons.</h3>
              <h6><bold>Now</bold> is the time to start thinking about intervention.</h6>
          
              
            <a href="#" class="read-more">Schedule a live demo with us<i class="icofont-long-arrow-right"></i></a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= 
    <section id="counts" class="counts">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1,422</span>
            <p>Lessons</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">259</span>
            <p>Simulations</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">711</span>
            <p>Hours of Content</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">15</span>
            <p>Assessments</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= 
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
               </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="bx bxl-dribbble"></i>
              </div>
              <h4><a href="">Interactive Lesson Database</a></h4>
              <p>Thousands of lessons readily available for Math, Reading, and Science for Grades 3-8</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box iconbox-orange ">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                </svg>
                <i class="bx bx-file"></i>
              </div>
              <h4><a href="">Virtual Delivery Platform</a></h4>
              <p>Students and teachers can meet for synchronous instruction, using video, audio, chat, and other features on our own platform. There are also add-ins available for other virtual instruction platforms.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box iconbox-pink">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                </svg>
                <i class="bx bx-tachometer"></i>
              </div>
              <h4><a href="">Assessments & Analytics</a></h4>
              <p>Students take assessments and teachers can see which students need remediation and which of our ready-made lessons they should receive instruction on.</p>
            </div>
          </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column align-items-lg-center">
            <div class="icon-box mt-5 mt-lg-0" data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-receipt"></i>
              <h4>Reteaching <u>lessons are included</u> in various subjects</h4>
              <p>You can choose from thousands of lessons, ready-made and readily-available to teach at a moment's notice</p>
            </div>
            <div class="icon-box mt-5" data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-cube-alt"></i>
              <h4>Students and teachers can <u>move objects together</u></h4>
              <p>Thinking maps. Realistic virtual manipulatives. How do students learn to use a ruler? Lining up the ruler with the object might be the most challenging part. Unlike other platforms, you can move rulers on our board for added interactivity.</p>
            </div>
            <div class="icon-box mt-5" data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-images"></i>
              <h4>The dashboard <u>prescribes lessons</u> for specific students</h4>
              <p>Let us help you plan your small group instruction and pull-outs. Our recommendations assign lessons directly to students based on data.</p>
            </div>
          </div>
          <div class="image col-lg-6 order-1 order-lg-2 " data-aos="zoom-in" data-aos-delay="100">
            <img src="{{url('public/assets/images/features.svg')}}" alt="" class="img-fluid">
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <section id="faq" class="faq">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">What's the difference between an E-Learning lesson from Uplift and a Powerpoint? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>Most platforms don't support lessons with moveable objects.  Powerpoints, for example, are flattened upon upload onto video conferencing systems. With an E-Learning lesson, you can manipulate objects and allow students access to move objects when you want them to.</p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Can students move objects on my board any time they want? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                <p>
                  We built in protections for teachers to keep control of the board.  As the admin, you can allow and take away access of participants to video, audio, and mouse movements on the screen. 
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">How do interactivities help student learn? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                <p>
                  Many students struggle with just auditory learning. By allowing students more opportunities to become involved in the lesson by dragging and dropping, typing, or using thinking maps, we are essentially gamifying their experience and increasing the accessibility of the content for diverse learners, who for example, may learn subtraction better by moving place value blocks instead of watching / listening to a teacher perform subtraction on the screen by themselves.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5" class="collapsed">Can I use your interactivities on Zoom or Microsoft Teams? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                <p>
                  Yes. Our platform was designed to work with video conferencing or without.  If you want to use Zoom or Microsoft Teams (or any video conferencing platform of your choice), you can just open our lesson link in another tab and get started immediately.
                </p>
              </div>
            </li>
  <li data-aos="fade-up" data-aos="fade-up" data-aos-delay="600">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapsed" href="#faq-list-6">Is the learning on this website synchronous or asynchronous? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-6" class="collapse" data-parent=".faq-list">
                <p>It's mostly synchronous. The lessons are designed for educators to be present in the learning process. However, there are activities, simulations, and quizzes that students can complete on their own, without guidance, </p>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection
@include('layouts.analytics')