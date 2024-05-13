@extends('layouts.master-front')
<style>
    .video-container { position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden; }

    .video-container iframe, .video-container object, .video-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
    .howto_video {
        margin-bottom: 30px;
    }
    h3 {
        color: #412A7F;
    }
</style>
@section('content')
<div class="banner-sec-wrap banner-bg" style="margin-top: 100px;">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-12 col-sm-12 col-md-12 col-lg-10 mx-auto">
        <div class="sec-title">
          <h3 class="mb-0 banner-title1 pt-5 pb-5">How to get started</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="content pt-0 pb-0">
  <div class="about-page-wrap">
    <div class="about-content sec-pad">
      <div class="container">
        <div class="row pt-2 pt-lg-0">
            <div class="col-md-12 howto_video">
                <h5>1. Free Trial</h5>
                <div class="video-container">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/eDgM23ODKy8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 howto_video">
                <h5>2. Add Class</h5>
                <div class="video-container">
                    <iframe width="1280" height="626" src="https://www.youtube.com/embed/C12mtPAwbUc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 howto_video">
                <h5>3. Search Lesson and Invite</h5>
                <div class="video-container">
                    <iframe width="1280" height="626" src="https://www.youtube.com/embed/sxIQx8L8reQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 howto_video">
                <h5>4. Interactive Board</h5>
                <div class="video-container">
                    <iframe width="1280" height="626" src="https://www.youtube.com/embed/pCO0CxwfgFc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 howto_video">
                <h5>5. Troubleshoot</h5>
                <div class="video-container">
                    <iframe width="1280" height="626" src="https://www.youtube.com/embed/TvgjJ5vBMl8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
