@extends('layouts.new-master-front')

@section('content')

    <main>

        <div class="py-5 mb-5 bg-white">
            <div class="container">

                <h1 class="font-weight-light text-center mt-5">About Us</h1>

                <div class="row mt-3 mb-5">

                    <div class="col-md-6 col-centered lead text-center">
                        Uplift K12 was built to advocate for students with diverse learning styles. Built "by educators, for educators," our software products put students first.</div>

                </div>

                <center><img class="img-fluid my-5" src="{{url('public/assets/img/banner.png')}}"></center>

                <div class="row font-weight-light text-center mt-3">
                    <div class="col-md col-sm-4">
                        <p class="text-primary font-weight-bold">Mehul Shah</p>
                        CEO
                    </div>
                    <div class="col-md col-sm-4">
                        <p class="text-primary font-weight-bold">Michelle Shah</p>
                        Chief Academic Officer
                    </div>
                    <div class="col-md col-sm-4">
                        <p class="text-primary font-weight-bold"><a href="https://www.generationtextonline.com" style="color: #412A7F;">Generation Text Online</a></p>
                        SEL Partner
                    </div>
                    <div class="col-md col-sm-4 mt-md-0 mt-sm-5">
                        <p class="text-primary font-weight-bold">Jin Jing</p>
                        Chief Technology Officer
                    </div>

                </div>

            </div>
        </div>

        <div id="mission" class="bg-dark text-white my-5 py-5" style="background:url('{{url('public/assets/img/about.jpg')}}') no-repeat center center; background-size:cover">
            <div class="container p-5">

                <p class="text-center text-muted my-5">
                    <i class="fa fa-5x fa-unlock" style="color:white;"></i>
                </p>

                <h2 class="text-center text-dark font-weight-bold mb-5"><em>
                        "Tell me and I forget.  Teach me and I remember.  Involve me and I learn."  - Benjamin Franklin
                    </em></h2>

            </div>
        </div>

        <div class="my-5 py-5 bg-white">
            <div class="container">

                <div class="row">

                    <div class="col-md-6 mb-5">
                        <img class="img-fluid" src="{{url('public/assets/img/map.png')}}">
                    </div>

                    <div class="col-md-6 px-5">
                        <h1 class="font-weight-light text-primary">Contact Us</h1>

                        <p class="lead">We would love to hear from you</p>

                        <div class="row text-primary lead mb-3">
                            <div class="col-1">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="col">
                                (469) 431-0809
                            </div>
                        </div>

                        <div class="row text-primary lead mb-3">
                            <div class="col-1">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="col">
                                teach@upliftk12.com
                            </div>
                        </div>

                        <div class="row text-primary lead mb-5">
                            <div class="col-1">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="col">
                                Houston, TX
                            </div>
                        </div>

                        <div class="row lead">
                            <a class="text-gray mr-2" href="https://youtube.com">
                                <i class="fa fa-2x fa-youtube-square"></i>
                            </a>
                            <a class="text-gray mr-2" href="https://facebook.com">
                                <i class="fa fa-2x fa-facebook-square"></i>
                            </a>
                            <a class="text-gray mr-2" href="https://instagram.com">
                                <i class="fa fa-2x fa-instagram"></i>
                            </a>
                            <a class="text-gray mr-2" href="https://twitter.com">
                                <i class="fa fa-2x fa-twitter-square"></i>
                            </a>
                            <a class="text-gray mr-2" href="https://linkedin.com">
                                <i class="fa fa-2x fa-linkedin-square"></i>
                            </a>
                        </div>

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

                            @if(config('services.recaptcha.key'))
                                <div class="g-recaptcha"
                                    data-sitekey="{{config('services.recaptcha.key')}}">
                                </div>
                            @endif

                        </form>
                        <div class="output_response"></div>
                    </div>

                </div>

            </div>
        </div>

    </main>

@endsection
@include('layouts.analytics')
