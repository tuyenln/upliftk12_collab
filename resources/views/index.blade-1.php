@extends('layouts.new-master-front')

@section('content')
    <main>

        <div class="py-5 bg-white">
            <div class="container">

                <div class="row">

                    <div class="col-md-5 text-md-center text-center my-md-5 py-md-5 text-dark">
                        <h1 class="font-weight-light">We bring the "we do" to virtual instruction</h1>

                        <p class="lead text-muted">
                            Help students interact and grow like never before.
                        </p>

                        <a class="btn btn-primary navbar-btn px-4 text-white font-weight-light" href="/pricing">Sign Up</a>
                    </div>

                    <div class="col-md-7 align-self-center">
                        <video width="100%" autoplay controls loop>
                            <source src="{{url('public/images/frontpagevideo.mov')}}" type="video/mp4">
                            <source src="{{url('public/images/frontpagevideo.mov')}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>

            </div>
        </div>

        <div class="py-4 bg-light text-white" id="demo">
            <div class="container mb-4">

                <div class="row pt-3">

                    <div class="col-md-2 text-center">
                        <img class="img-fluid" src="{{url('public/assets/img/product-opt-in@2x.png')}}">
                    </div>

                    <div class="col-md-8 px-5 pt-lg-3 mt-5 mt-md-0">
                        <h2 class="font-weight-light text-dark">Request a Demo</h2>

                        <p class="lead text-dark">
                            Schedule 15 minutes with us to learn how you can transform intervention instruction. We'll set you up with a free trial.
                        </p>

                        <form class="form-inline" id="fom-newsletter">

                            <input name="name" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-4 col-sm-12" placeholder="Name">

                            <input name="email" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-5 col-sm-12" placeholder="Email">

                            <button type="submit" class="btn btn-primary text-white font-weight-light mb-sm-2 col">Submit</button>

                        </form>
                        <div class="output_response"></div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Social
              <div class="py-5 bg-white">
                <div class="container mb-4">

                  <h6 class="text-center text-dark font-weight-light">Customers who use us</h6>

                  <div class="row mt-5 text-center">

                    <div class="col-lg col-md-6 mb-5">
                      <span class="p-4 bg-gray text-white text-uppercase">
                        Company Logo
                      </span>
                    </div>

                    <div class="col-lg col-md-6 mb-5">
                      <span class="p-4 bg-gray text-white text-uppercase">
                        Company Logo
                      </span>
                    </div>

                    <div class="col-lg col-md-6 mb-5">
                      <span class="p-4 bg-gray text-white text-uppercase">
                        Company Logo
                      </span>
                    </div>

                    <div class="col-lg col-md-6 mb-5">
                      <span class="p-4 bg-gray text-white text-uppercase">
                        Company Logo
                      </span>
                    </div>

                    <div class="col-lg col-md-6">
                      <span class="p-4 bg-gray text-white text-uppercase">
                        Company Logo
                      </span>
                    </div>

                  </div>

                </div>
              </div>
        -->
        <div class="py-5 bg-white">
            <div class="container">
                <h1 class="text-center font-weight-light">Features</h1>
                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                        <h3 class="text-primary mt-lg-4">The lessons are built to <u>help students</u> with diverse learning styles <u>grow</u></h3>

                        <p class="lead mt-4">
                            Students have diverse learning styles. When struggling students need to be retaught, they can use our platform to engage in a hands-on style of instruction that brings manipulatives and other learning tools online.
                        </p>

                        <div class="row mt-4 font-weight-light">
                            <div class="col-1 pr-5">
                                <img class="rounded-circle bg-light" src="{{url('public/assets/img/1.png')}}" width="52px" height="52px">
                            </div>
                            <div class="col">

                                <p class="text-primary">
                                    “This lesson was more helpful for me. I learned more because usually my teacher shows me how to do things, but I don't get to practice with her during the lesson. We usually just fill out a worksheet and take a picture of it.”
                                </p>

                                <p class="text-muted"><b>Kaylee</b> - 8 year old student</p>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 mt-4">
                        <img class="img-fluid" src="{{url('public/assets/img/manip.jpg')}}">
                    </div>

                </div>

                <hr class="my-5">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 order-3">
                        <img class="img-fluid" src="{{url('public/assets/img/engage.jpg')}}">
                    </div>

                    <div class="col-md-6 pl-md-5 order-2 order-md-12 mb-4">

                        <h3 class="text-primary mt-md-4">Teachers can <u>keep students engaged</u></h3>

                        <p class="lead mt-4">
                            Students have the ability to type with their teacher, move objects, click on buttons, and much more on almost every slide.  Compared to PPT lessons using only voice and drawing, students report very high engagement with Uplift lessons.</p>

                        <div class="row mt-4 font-weight-light">
                            <div class="col-1 pr-5">
                                <img class="rounded-circle bg-light" src="{{url('public/assets/img/2.png')}}" width="50px" height="50px">
                            </div>
                            <div class="col">

                                <p class="text-primary">
                                    “I can tell because in his school's virtual instruction, he will sit there, and not answer and not say anything, unless he's prompted to do so. The engagement was high during his Uplift lesson. He was talking throughout the lesson and was excited to share what he learned with me."</p>

                                <p class="text-muted"><b>Wendy</b> - Parent of a 9 year-old</p>

                            </div>
                        </div>

                    </div>

                </div>

                <hr class="my-5">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                        <h3 class="text-primary mt-md-4">Reteaching <u>lessons included to save time</u> in various subjects</h3>

                        <p class="lead mt-4">
                            Teachers have enough to do when preparing for Tier 1 instruction. Our growing database of ready-made lessons have been reported to save teachers an average of 2-3 hours per week.</p>

                        <div class="row mt-4 font-weight-light">
                            <div class="col-1 pr-5">
                                <img class="rounded-circle bg-light" src="{{url('public/assets/img/3.png')}}" width="46px" height="46px">
                            </div>
                            <div class="col">

                                <p class="text-primary">
                                    “I was able to use Uplift's large database of phonics lessons for my small group instruction.  I was pleasantly surprised by the way the lesson was organized. It would have taken me a really long time to make a similar lesson."</p>

                                <p class="text-muted"><b>Michelle</b> - Early Childhood Teacher from Houston, TX</p>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 mt-4">
                        <img class="img-fluid" src="{{url('public/assets/img/savetime.jpg')}}">
                    </div>

                </div>

            </div>
        </div>
        <!-- Start Blog
              <div class="py-5 bg-white text-white">
                <div class="container">

                  <h1 class="font-weight-light text-dark text-center py-4">Latest Blog Posts</h1>

                  <div class="row py-4">

                    <div class="col-md col-sm-12 mb-5 text-md-left text-sm-center">
                      <img class="img-fluid img-shadow" src="img/blog-image-01@2x.jpg" width="100%">

                      <p class="py-3 text-dark font-weight-bold">This is a headline to one of the most popular blog post</p>

                      <a class="font-weight-light text-white text-uppercase text-dark" href="#">
                        Read Article
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </div>

                    <div class="col-md col-sm-12 mb-5">
                      <img class="img-fluid img-shadow" src="img/blog-image-02@2x.jpg" width="100%">

                      <p class="py-3 font-weight-bold text-dark">This is another really popular blog post headline</p>

                      <a class="font-weight-light text-dark text-uppercase" href="#">
                        Read Article
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </div>

                    <div class="col-md col-sm-12">
                      <img class="img-fluid img-shadow" src="img/blog-image-03@2x.jpg" width="100%">

                      <p class="py-3 font-weight-bold text-dark">This is yet another really popular blog post headline</p>

                      <a class="font-weight-light text-white text-uppercase text-dark" href="#">
                        Read Article
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </div>

                  </div>

                </div>
              </div>


        -->


    </main>
@endsection
@include('layouts.analytics')
