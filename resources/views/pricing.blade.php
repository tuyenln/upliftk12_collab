@extends('layouts.new-master-front')

@section('content')
    <main>

        <div class="py-4 bg-light text-white">
            <div class="container">

                <h1 class="font-weight-light text-center mt-5 text-primary">Engage Students Now</h1>

                <div class="row mt-3 mb-sm-3">

                    <div class="col-md-6 col-centered lead text-center text-primary font-weight-light">
                        Access our database of interactive lessons, for your synchronous instruction
                    </div>
                </div>

                <div class="col-md-12">
                    <p style="color: #412A7F; font-size: 18px; font-weight: 600; background: rgba(98, 0, 238, 0.08); padding: 20px; ">Please note: Only Kindergarten-5rd grade resources available currently. We are adding new content daily and plan to release 6th-Algebra 1 content by February 2021.</p>
                </div>

                <div class="" style="margin-top: 20px !important;">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-12 my-5">
                            <div class="card text-dark" style="height: 661px;">
                                <h2 class="font-weight-light text-primary text-center my-5 text-uppercase text-spaced">Free Trial</h2>

                                <h1 class="display-4 text-center font-weight-bold">$0 <small class="font-weight-light text-gray h3">7 days</small></h1>

                                <hr class="mx-4">

                                <ul class="text-muted star-bullets px-5 mx-auto">
                                    <li class="p-2">7 days free</li>
                                    <li class="p-2">Full access to our lessons with your students with <u>shareable link only</u></li>
                                    <li class="p-2">Full Web Conferencing Platform</li>
                                    <li class="p-2">Add-on to Zoom, Microsoft Teams, Hangouts, Etc.</li>
                                    <li class="p-2">Formative assessments embedded in the lessons</li>
                                </ul>

                                <hr class="mx-4 mb-5">

                                <a class="btn btn-primary text-white font-weight-light mx-auto border-overlap" href="/free-trial">Sign me up</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 my-5">
                            <div class="card text-dark" style="height: 661px;">

                                <h2 class="font-weight-light text-primary text-center my-5 text-uppercase text-spaced">Educator Plan</h2>

                                <h1 class="display-4 text-center font-weight-bold">$20 <small class="font-weight-light text-gray h3">per month</small></h1>

                                <hr class="mx-4">

                                <ul class="text-muted star-bullets px-5 mx-auto">
                                    <li class="p-2">Monthly Subscription</li>
                                    <li class="p-2">Everything in Free Trial, plus:</li>
                                    <li class="p-2">Create classes and assign student accounts</li>
                                    <li class="p-2">Unlimited Quizzes available after lesson</li>
                                    <li class="p-2">Track student growth</li>
                                    <li class="p-2">Assessment-driven recommendations (coming soon)</li>


                                </ul>

                                <hr class="mx-4 mb-5">

                                <a class="btn btn-primary text-white font-weight-light mx-auto border-overlap" href="/teacher/signup">Sign me up</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 my-md-5 my-sm-2 mb-sm-3">
                            <div class="card text-dark" style="height: 661px;">
                                <h2 class="font-weight-light text-primary text-center my-5 text-uppercase text-spaced">Schools & Districts</h2>

                                <h1 class="display-4 text-center font-weight-bold">3+ <small class="font-weight-light text-gray h3">educators</small></h1>

                                <hr class="mx-4">

                                <ul class="text-muted star-bullets px-3 mx-auto">
                                    <li class="p-2">Annual License</li>
                                    <li class="p-2">Everything in Educator Plan, plus:</li>
                                    <li class="p-2">Unlimited Use for Campus / District</li>
                                    <li class="p-2">Alignment to State Tests</li>
                                    <li class="p-2">Alignment to State Standards</li>
                                    <li class="p-2">Advanced Reporting</li>
                                    <li class="p-2">Assessments</li>

                                </ul>

                                <hr class="mx-4 mb-5">

                                <a class="btn btn-primary text-white font-weight-light mx-auto border-overlap" href="https://calendly.com/upliftk12/45-minute-demo">Contact us</a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="py-4 bg-primary text-white" id="demo">
            <div class="container mb-4">

                <div class="row pt-3">

                    <div class="col-md-2 text-center">
                        <img class="img-fluid" src="{{url('public/assets/img/product-opt-in@2x.png')}}">
                    </div>

                    <div class="col-md-8 px-5 pt-lg-3 mt-5 mt-md-0">
                        <h2 class="font-weight-light text-light">Not sure yet? Request a demo</h2>

                        <p class="lead text-light">
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




        <div class="py-5 bg-white">
            <div class="container" id="faq">

                <h1 class="font-weight-light text-center px-4 mb-5 mt-md-5 mt-sm-3">Common questions</h1>

                <div class="row my-md-5 my-sm-3">
                    {{--<div class="col-md col-sm-12 px-5">
                        <h4 class="text-primary">Do you offer yearly plans?</h4>
                        <p class="lead">If you pay for a year upfront (optional) you are eligible for a 10% discount.</p>
                    </div>--}}
                    <div class="col-md col-sm-12 px-5 mt-sm-3 mt-md-0">
                        <h4 class="text-primary">Do you have a setup cost?</h4>
                        <p class="lead">Absolutely not. All plans are month to month with no contracts, no setup fees, and no hidden gimmicks. Cancel anytime.</p>
                    </div>
                </div>
                <div class="row my-md-5 my-sm-3">
                    <div class="col-md col-sm-12 px-5">
                        <h4 class="text-primary">Do you restrict features with a free trial?</h4>
                        <p class="lead">While trials are more limited than paid accounts, you will be able to try most of our features.</p>
                    </div>

                </div>
                <div class="row my-md-5 my-sm-3">
                    <div class="col-md col-sm-12 px-5">
                        <h4 class="text-primary">What payment methods do you accept?</h4>
                        <p class="lead">Visa, Mastercard, American Express, Discover, JCB Diners Club, China UnionPay, credit and debit cards. Stripe also supports a range of additional payment methods, depending on the country of your Stripe account.</p>
                    </div>

                </div>

            </div>
        </div>


    </main>

@endsection
@include('layouts.analytics')
