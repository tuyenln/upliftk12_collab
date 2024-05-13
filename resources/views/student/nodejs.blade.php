@extends('layouts.master')
@section('content')
<?php   $user = Auth::user(); ?>

<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">
    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          <!-- side bar menu-->
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">
              <!-- <student-component></student-component>  -->
              <div class="content-vue">
      <div class="clearfix header-section-content">
        <h3 class="title-content">Lesson 4.7A Angles</h3>
      </div>
      <h4>Or if you have other room id, put it to input and click join room</h4>
      <input type="text" id="room-id" value="" placeholder="Enter room id">
      <button id="join-room" type="submit">join room</button>
      <div class="fw-ct">
          <div class="chosepeople">
            <select class="form-control" name="choseteacher">
                <option value="">Chose Teacher</option>
                <option value="">Mai Nghỉ Dậy</option>
                <option value="">Mai Kiểm Tra</option>
            </select>
          </div>
      </div>
      <div class="fw-ct">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <h5>Student Screen</h5>
            <div id="shared-parts-of-screen-preview" class="embed-responsive embed-responsive-16by9">
              <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe> -->
            </div>
            <!-- <canvas id="canvas" width="350" height="206"></canvas> -->
            <div class="bottom-nodejs">
              <input class="form-control" type="text" name="notifications" placeholder="notifications">
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <h5>teacher screen</h5>
            <div id="videos-container" class="embed-responsive embed-responsive-16by9">
              <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe> -->
            </div>
            <div class="bottom-nodejs">
              <div class="content-chat">
                  <p>box show content chat here</p>
              </div>
              <input class="form-control" type="text" name="typetext" placeholder="type writing">
            </div>
          </div>
        </div>
      </div>
    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="{{url('public/css/phuongcss/getHTMLMediaElement.css')}}">
<script type="text/javascript" src="{{url('public/js/phuongjs/RTCMultiConnection.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/socket.io.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/screenshot.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/getHTMLMediaElement.js')}}"></script>
<script>
  var publicRoomIdentifier = 'part-screen-share';

  var connection = new RTCMultiConnection();

  connection.socketURL = 'https://upliftk12.com:9001/';

  console.log('url socket: ', connection.socketURL);

  /// make this room public
  connection.publicRoomIdentifier = publicRoomIdentifier;
  connection.socketMessageEvent = publicRoomIdentifier;
  // connection.connectSocket
  connection.connectSocket(function(socket) {
    // looper();

    socket.on('disconnect', function() {
        location.reload();
    });
  });
  connection.session = {
    audio: true,
    video: true,
    data: true
  };

  connection.sdpConstraints.mandatory = {
    OfferToReceiveAudio: true,
    OfferToReceiveVideo: true
  };

  // https://www.rtcmulticonnection.org/docs/iceServers/
  // use your own TURN-server here!
  connection.iceServers = [{
    'urls': [
      'stun:stun.l.google.com:19302',
      'stun:stun1.l.google.com:19302',
      'stun:stun2.l.google.com:19302',
      'stun:stun.l.google.com:19302?transport=udp',
    ]
  }];

  var isShareDiv = false
  connection.videosContainer = document.getElementById('videos-container');
  connection.onstream = function(event) {
    if(event.type === 'local') {
      return
      video.muted = true;
    }
    event.mediaElement.removeAttribute('src');
    event.mediaElement.removeAttribute('srcObject');

    var video = document.createElement('video');
    video.controls = true;
    video.srcObject = event.stream;

    var width = parseInt(connection.videosContainer.clientWidth / 2) - 20;
    var mediaElement = getHTMLMediaElement(video, {
        title: event.userid,
        buttons: ['full-screen'],
        width: width,
        showOnMouseEnter: false
    });

    connection.videosContainer.appendChild(mediaElement);

    setTimeout(function() {
        mediaElement.media.play();
    }, 5000);

    mediaElement.id = event.streamid;
  }


  var sharedPartsOfScreenPreview = document.getElementById('shared-parts-of-screen-preview');

  function getNewImage(id) {
    var image = new Image();
    image.id = id;

    sharedPartsOfScreenPreview.insertBefore(image, sharedPartsOfScreenPreview.firstChild);
    return image;
  }
  document.getElementById('join-room').onclick = function() {
    var roomid = document.getElementById('room-id').value
    console.log('room-id: ', roomid);
    if (roomid == null || roomid == "") {
      alert('Please enter room id')
      return
    }

    disableInputButtons();

    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: false,
        OfferToReceiveVideo: true
    };
    beforeOpenOrJoin(roomid, () => {
        connection.join(roomid, () => {
            afterOpenOrJoin()
        });
        // connection.join(roomid)
    })
  };

  function beforeOpenOrJoin(roomid, callback) {
    connection.socketCustomEvent = roomid;
    callback();
  }

  function afterOpenOrJoin() {
    connection.socket.on('onMessage', data => {
        console.log('onMessage', connection.socketCustomEvent, data.screenshot);
        if (!data.screenshot) return;
        var image = document.getElementById(data.userID);
        if (!image) image = getNewImage(data.userID);
        image.src = data.screenshot;
    })
  }

  // ..................................
  // ALL below scripts are redundant!!!
  // ..................................
  function disableInputButtons() {
    // document.getElementById('room-id').onkeyup();

    // document.getElementById('open-or-join-room').disabled = true;
    // document.getElementById('open-room').disabled = true;
    document.getElementById('join-room').disabled = true;
    document.getElementById('room-id').disabled = true;
  }

</script>
@endsection
