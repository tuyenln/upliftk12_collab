@extends('layouts.new-master-front')

@section('content')
    <style>
        video {
            margin: auto;
        }
    </style>
    <main>

        <div class="py-5 bg-light text-dark">
            <div class="container">

                <h1 class="font-weight-light text-center pt-4">Students need to be involved in their learning.</h1>

                <h5 class="font-weight-light text-center"><u>Now</u> is the time to improve student outcomes</h5>

                <div class="text-center">
                    <a class="btn btn-secondary text-primary bg-white mt-5" href="/pricing">Ready to purchase</a>
                </div>

            </div>
        </div>

        <div class="py-5 bg-dark text-white text-md-left text-center">
            <div class="container">

                <div class="row">

                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <i class="fa fa-5x fa-lock"></i>
                            </div>

                            <div class="col-md-9 p-3">
                                <h3 class="font-weight-light">Unlock Their Growth</h3>

                                <p class="font-weight-light lead">
                                    Track progress. Tech-embedded quizzes after each lesson.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <i class="fa fa-5x fa-line-chart"></i>
                            </div>

                            <div class="col-md-9 p-3">
                                <h3 class="font-weight-light">Watch Them Learn Through Mistakes</h3>

                                <p class="font-weight-light lead">
                                    Immediate feedback helps them learn.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-lg-5">

                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <i class="fa fa-5x fa-handshake-o"></i>
                            </div>

                            <div class="col-md-9 p-3">
                                <h3 class="font-weight-light">Help Them Collaborate</h3>

                                <p class="font-weight-light lead">
                                    It's a real world skill!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <i class="fa fa-5x fa-user-circle-o"></i>
                            </div>

                            <div class="col-md-9 p-3">
                                <h3 class="font-weight-light">Mark Them Present</h3>

                                <p class="font-weight-light lead">
                                    Enjoy increased student engagement.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="py-5 bg-white">
            <div class="container">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                        <h3 class="text-primary mt-4">Unlock Student Growth and Potential</h3>

                        <p class="lead mt-4">
                            For many students, the first attempt at learning a topic doesn't work. Make the second attempt different.
                        </p>

                        <ul class="lead text-primary pl-0 align-bullets mt-4">
                            <li>Use online manipulatives</li>
                            <li>Add deeper learning with thinking maps</li>
                            <li>Allow students to create</li>
                        </ul>

                    </div>

                    <div class="col-md-6 mt-4" style="display: flex;">
                        <video width="100%" controls loop>
                            <source src="{{url('public/images/1_unlock_growth.mov')}}" type="video/mp4">
                            <source src="{{url('public/images/1_unlock_growth.mov')}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>

                <hr class="my-5">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 order-3" style="display: flex;">
                        <video width="100%" controls loop>
                            <source src="{{url('public/images/2_learn_through_mistakes.mov')}}" type="video/mp4">
                            <source src="{{url('public/images/2_learn_through_mistakes.mov')}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="col-md-6 pl-md-5 order-2 order-md-12 mb-4">

                        <h3 class="text-primary mt-4">Watch them learn through mistakes.</h3>

                        <p class="lead mt-4">
                            The "we do" component to your lesson is where real learning takes place.
                        </p>

                        <ul class="lead text-primary pl-0 align-bullets mt-4">
                            <li>Students can get your immediate feedback on errors.</li>
                            <li>As they learn, they are building confidence.</li>
                            <li>Their mistakes will lead to lightbulb moments.</li>
                        </ul>

                    </div>

                </div>

                <hr class="my-5">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                        <h3 class="text-primary mt-4">Help Them Collaborate.</h3>

                        <p class="lead mt-4">
                            Students can collaborate on the shared board as they complete activities.
                        </p>

                        <ul class="lead text-primary pl-0 align-bullets mt-4">
                            <li>Adults have to collaborate. Let's start them early.</li>
                            <li>Peer mentoring and conversation are researched methods for increasing growth.</li>
                            <li>Allow students to talk and move, not just listen and repeat.</li>
                        </ul>

                    </div>

                    <div class="col-md-6 mt-4" style="display: flex;">
                        <video width="100%" controls loop>
                            <source src="{{url('public/images/3_collaborate.mov')}}" type="video/mp4">
                            <source src="{{url('public/images/3_collaborate.mov')}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
                <hr class="my-5">

                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 order-3" style="display: flex;">
                        <video width="100%" controls loop>
                            <source src="{{url('public/images/4_engage.mov')}}" type="video/mp4">
                            <source src="{{url('public/images/4_engage.mov')}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <div class="col-md-6 pl-md-5 order-2 order-md-12 mb-4">

                        <h3 class="text-primary mt-4">Mark Them Present.</h3>

                        <p class="lead mt-4">
                            We all know how difficult it can be to engage students. Our software makes it easier.
                        </p>

                        <ul class="lead text-primary pl-0 align-bullets mt-4">
                            <li>Students can interact on almost every screen.</li>
                            <li>Watch them type, draw, drag, match, click, and smile.</li>
                            <li>The lessons feel like a simulation, game, or activity.</li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
        <!-- Finish later
              <div class="py-5 bg-dark text-white" style="background:url('{{url('public/assets/img/bg-testimonial-01@2x.png')}}') no-repeat center center; background-size: cover">
                <div class="container">

                  <div class="row my-5">
                    <div class="col-md-6">
                      <em class="lead">
                        "Unlike the customer testimonials on the home page, that highlight the benefits of the single feature, this testimonial should highlight the benefits of the service/product as a whole. It should be from the persons own experience and how the product has helped their business."
                      </em>

                      <p class="lead mt-5">
                        <strong>Sarah Jennings</strong>
                        - Vice President Accounting
                      </p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="py-5 bg-white">
                <div class="container">

                  <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 order-3">
                      <img class="img-fluid" src="{{url('public/assets/img/place-holder-image@2x.png')}}">
                    </div>

                    <div class="col-md-6 pl-md-5 order-2 order-md-12 mb-4">

                      <h3 class="text-primary mt-4">This is a headline that should introduce the feature.</h3>

                      <p class="lead mt-4">
                        Create a compelling sales message about the feature. Highlight the key attributes and major benefits.
                      </p>

                      <ul class="lead text-primary pl-0 align-bullets">
                        <li>Selling points about the feature</li>
                        <li>Selling points about the feature</li>
                        <li>Selling points about the feature</li>
                      </ul>

                    </div>

                  </div>

                  <hr class="my-5">

                  <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                      <h3 class="text-primary mt-4">This is a headline that should introduce the feature.</h3>

                      <p class="lead mt-4">
                        Create a compelling sales message about the feature. Highlight the key attributes and major benefits.
                      </p>

                      <ul class="lead text-primary pl-0 align-bullets">
                        <li>Selling points about the feature</li>
                        <li>Selling points about the feature</li>
                        <li>Selling points about the feature</li>
                      </ul>

                    </div>

                    <div class="col-md-6 mt-4">
                      <img class="img-fluid" src="{{url('public/assets/img/place-holder-image@2x.png')}}">
                    </div>

                  </div>

                </div>
              </div>

              <div class="py-5 bg-light" style="background:url('img/bg-testimonial-02@2x.png') no-repeat center center; background-size: cover">
                <div class="container">

                  <div class="row my-5">
                    <div class="col"></div>
                    <div class="col-md-6 col-sm-8">
                      <em class="lead">
                        "Unlike the customer testimonials on the home page, that highlight the benefits of the single feature, this testimonial should highlight the benefits of the service/product as a whole. It should be from the persons own experience and how the product has helped their business."
                      </em>

                      <p class="lead mt-5">
                        <strong>Nancy Drew</strong>
                        - Vice President Accounting
                      </p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="py-5 bg-white">
                <div class="container">

                  <h1 class="font-weight-light text-center py-4">More Features</h1>

                  <div class="row text-muted lead">

                    <div class="col-md-4">
                      <strong>Collection Headline</strong>
                      <ul class="pl-0 align-bullets">
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                      </ul>
                    </div>

                    <div class="col-md-4">
                      <strong>Collection Headline</strong>
                      <ul class="pl-0 align-bullets">
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                      </ul>
                    </div>

                    <div class="col-md-4">
                      <strong>Collection Headline</strong>
                      <ul class="pl-0 align-bullets">
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                        <li>Couple word description here</li>
                      </ul>
                    </div>

                  </div>

                </div>
              </div>
        -->
        <div class="py-4 bg-black text-white" id="demo">
            <div class="container">

                <div class="row pt-3">

                    <div class="col-md-4">
                        <h3>Ready for demo?</h3>
                    </div>

                    <div class="col">
                        <form class="form-inline" id="fom-newsletter">

                            <input name="name" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-4 col-sm-12" placeholder="First Name">

                            <input name="email" type="text" class="form-control font-weight-light mr-lg-2 mb-2 border col-lg-5 col-sm-12" placeholder="Email">

                            <button type="submit" class="btn btn-primary text-white font-weight-light mb-sm-2 col">Opt In</button>

                        </form>
                        <div class="output_response"></div>
                    </div>

                </div>

            </div>
        </div>

    </main>
@endsection
@include('layouts.analytics')
