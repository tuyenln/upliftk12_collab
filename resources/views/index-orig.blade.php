@extends('layouts.new-master-front')
<style>
.top-content {
    width: 100%;
    padding: 60px 0 120px 0;
}
.carousel-control-next-icon {
    width: 36px !important;
    height: 36px !important;
    position: absolute !important;
    right: -50px !important;
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMCAwIDMyIDMyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxzdHlsZT4uY2xzLTF7ZmlsbDojMTAxODIwO308L3N0eWxlPjwvZGVmcz48dGl0bGUvPjxnIGRhdGEtbmFtZT0iTGF5ZXIgNiIgaWQ9IkxheWVyXzYiPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTE2LDMxQTE1LDE1LDAsMSwxLDMxLDE2LDE1LDE1LDAsMCwxLDE2LDMxWk0xNiwzQTEzLDEzLDAsMSwwLDI5LDE2LDEzLDEzLDAsMCwwLDE2LDNaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTIuNiwyMi44bC0xLjItMS42TDE4LjMzLDE2LDExLjQsMTAuOGwxLjItMS42LDgsNmExLDEsMCwwLDEsMCwxLjZaIi8+PC9nPjwvc3ZnPg==) !important;
}
.carousel-control-prev-icon {
    width: 36px !important;
    height: 36px !important;
    position: absolute !important;
    left: -50px !important;
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMCAwIDMyIDMyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxzdHlsZT4uY2xzLTF7ZmlsbDojMTAxODIwO308L3N0eWxlPjwvZGVmcz48dGl0bGUvPjxnIGRhdGEtbmFtZT0iTGF5ZXIgNyIgaWQ9IkxheWVyXzciPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTE2LDMxQTE1LDE1LDAsMSwxLDMxLDE2LDE1LDE1LDAsMCwxLDE2LDMxWk0xNiwzQTEzLDEzLDAsMSwwLDI5LDE2LDEzLDEzLDAsMCwwLDE2LDNaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTkuNCwyMi44bC04LTZhMSwxLDAsMCwxLDAtMS42bDgtNiwxLjIsMS42TDEzLjY3LDE2bDYuOTMsNS4yWiIvPjwvZz48L3N2Zz4=) !important;
}
</style>
@section('content')
    <main>

        <div class="top-content" style="position: relative; z-index: 0; background: none;">
	        <div class="container">
	        	<!-- Title and description row -->
	            <div class="row">
	                <div class="col-md-12 text-center">
	                	<h1>Interactive group lessons for hybrid learning</h1>
	                	<div class="description">
	                		<p>
                        Increase student engagement and improve outcomes
	                		</p>
	                	</div>
	                </div>
	            </div>
	            <!-- End title and description row -->
	            <!-- Carousel row -->
	            <div class="row">
                  <div class="col-md-2"></div>
	                <div class="col-md-8 text-center">
	                	<!-- Carousel -->
	                	<div id="carousel-example" class="carousel slide"  data-interval="false">
	       					<ol class="carousel-indicators">
	       						<li data-target="#carousel-example" data-slide-to="0" class="active"></li>
	       						<li data-target="#carousel-example" data-slide-to="1"></li>
	       						<li data-target="#carousel-example" data-slide-to="2"></li>
	       					</ol>
	       					<div class="carousel-inner">
	       						<div class="carousel-item active">
	       							<div class="embed-responsive embed-responsive-16by9">
	       								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/5B4-59TUoMk" allowfullscreen=""></iframe>
	       							</div>
	       						</div>
	       						<div class="carousel-item">
	       							<div class="embed-responsive embed-responsive-16by9">
	       								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/o0wznPIkGM8" allowfullscreen=""></iframe>
	       							</div>
	       						</div>
	       						<div class="carousel-item">
	       							<div class="embed-responsive embed-responsive-16by9">
	       								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/n0HBeeMINu8" allowfullscreen=""></iframe>
	       							</div>
	       						</div>
	       					</div>
							<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
	       				</div>
	                	<!-- End carousel -->
	                </div>
	            </div>
	            <!-- End carousel row -->
	        </div>
          <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 846.625px; width: 1903px; z-index: -999998; position: absolute;">
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

                        <form class="form-inline" id="fom-newsletter" >
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
                <h1 class="text-center font-weight-light">Benefits</h1>
                <div class="row my-md-5 py-lg-5">

                    <div class="col-md-6 pr-md-5">

                        <h3 class="text-primary mt-lg-4">Expand Your Hybrid Teaching Toolbelt</u></h3>

                        <p class="lead mt-4">
                            Students learn in different ways. Improve outcomes by adding kinesthetic learning to your online teaching toolbelt. Use our drag and drop and writing activities to reach students across a wider range of learning styles.</p>

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

                        <h3 class="text-primary mt-md-4">Improve Student Outcomes Through Engagement</u></h3>

                        <p class="lead mt-4">
                            Students have the ability to type with their teacher, move objects, click on buttons, and much more on almost every slide. Students show improved outcomes and their focus/attention, time spent engaging is higher on interactive activities. It maintains their interest longer, which allows for learning breakthroughs and improved comprehension.
</p>

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

                        <h3 class="text-primary mt-md-4">Cut Down on Prep Time</h3>

                        <p class="lead mt-4">
                            Quickly select from a collection of pre-made lessons so you can replace prep-time with quality student time.</p>

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