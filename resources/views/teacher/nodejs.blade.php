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
              {{-- <teacher-component></teacher-component>  --}}

              <!-- PHUONG PRO --->
              <div class="content-vue">
                <div class="clearfix header-section-content">
                  <h3 class="title-content">Lesson 4.7A Angles - <p id="room-urls"></p></h3>
              </div>

              <h4>Please make new room id and click open room </h4>
              <input type="text" id="room-id" value="" placeholder="Enter room id">
              <button id="open-room" type="submit">open room</button>
              {{-- <button id="join-room">Join Room</button> --}}

              <div class="fw-ct">
                <div class="chosepeople">
                  <select class="form-control" name="chosestudent">
                      <option value="">Chose Student</option>
                      <option value="">Mai Khởi Công</option>
                      <option value="">Mai Xin Nghỉ</option>
                  </select>
                </div>
              </div>


              <div class="fw-ct">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                      <h5>Teacher Screen</h5>
                      <input type="checkbox" id="btnShare">
                      <label for="share-div">check box to start share lesson or stop</label>
                      <div id="share-creen"  class="embed-responsive embed-responsive-16by9">
                        <iframe id="ifram-share" class="embed-responsive-item" src="https://upliftk12.com/lesson1test/"></iframe>
                      </div>
                      <div class="bottom-nodejs">
                        <input class="form-control" type="text" name="notifications" placeholder="notifications">
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                      <h5>student screen</h5>
                      <div id="videos-container" class="embed-responsive embed-responsive-16by9">
                        {{-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe> --}}

                      </div>
                      <div class="bottom-nodejs">
                        <div class="content-chat">
                            <p>box show content chat here </p>
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
{{-- <script src="/dist/RTCMultiConnection.js"></script>
<script src="/socket.io/socket.io.js"></script>
<script src="/dist/screenshot.js"> </script> --}}
<link rel="stylesheet" href="{{url('public/css/phuongcss/getHTMLMediaElement.css')}}">
<script type="text/javascript" src="{{url('public/js/phuongjs/RTCMultiConnection.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/socket.io.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/screenshot.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/getHTMLMediaElement.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/domvas.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/phuongjs/iframe2Image.js')}}"></script>

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
    console.log('envent: ', event);
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


  // var sharedPartsOfScreenPreview = document.getElementById('shared-parts-of-screen-preview');

  // function getNewImage(id) {
  //   var image = new Image();
  //   image.id = id;

  //   sharedPartsOfScreenPreview.insertBefore(image, sharedPartsOfScreenPreview.firstChild);
  //   return image;
  // }




  // UI CODE -----------------
  // --------------------------

  var shareDiv = document.getElementById('cpDocument')

  window.elementToShare = shareDiv

  var pause = document.getElementById('btnShare');
  pause.onchange = function () {
      isShareDIV = this.checked;
      if (this.checked) {
          shareDIV()
      }

      console.log('checked: ', this.checked);
  }


  // create image div share and emit to server
  // var inner = document.getElementById('ifram-share')

  console.log('window element to share: ', window.elementToShare);


  function shareDIV() {
    console.log('isShareDIV: ', isShareDIV);
    if (!isShareDIV) {
        // setTimeout(shareDIV, 100);
        return;
    }

    // Get the image
    // iframe2image(inner, function (err, img) {
    //   // If there is an error, log it
    //   if (err) { return console.error(err); }
    //   connection.socket.emit('onMessage', {
    //       userID: connection.remoteUserId,
    //       screenshot: img.src
    //   })
    //   if (!!navigator.webkitGetUserMedia) setTimeout(shareDIV, 100);
    //   else setTimeout(shareDIV, 10)

    // });
    html2canvas(window.elementToShare, {
        onrendered: function (canvas) {
            var screenshot = canvas.toDataURL('image/webp', 1)
            connection.socket.emit('onMessage', {
                userID: connection.remoteUserId,
                screenshot: screenshot
            })
            if (!!navigator.webkitGetUserMedia) setTimeout(shareDIV, 100);
            else setTimeout(shareDIV, 10);
        }
    });
  }

  // process div put share screen




  // handle join room and open room
  document.getElementById('open-room').onclick = () => {
    var roomid = document.getElementById('room-id').value
    if (roomid == null || roomid == "") {
      alert('Please enter room id')
      return
    }
    beforeOpenOrJoin(roomid, () => {
        connection.open(roomid, () => {
            showRoomURL(connection.sessionid);
            // afterOpenOrJoin()
        })
    })
  }

  // document.getElementById('join-room').onclick = function() {
  //   var roomid = document.getElementById('room-id').value
  //   if (roomid == null || roomid == "") {
  //     alert('Please enter room id')
  //     return
  //   }
  //   disableInputButtons();

  //   connection.sdpConstraints.mandatory = {
  //       OfferToReceiveAudio: false,
  //       OfferToReceiveVideo: true
  //   };
  //   beforeOpenOrJoin(roomid, () => {
  //       connection.join(roomid, () => {
  //           // afterOpenOrJoin()
  //       });
  //   })
  // };

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


  function showRoomURL(roomid) {
      var roomHashURL = '#' + roomid;
      // var roomQueryStringURL = '?roomid=' + roomid;
      // var html = ''

      // var html = '<h2>Unique URL for your room:</h2><br>';

      // html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
      // html += '<br>';
      // html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

      var roomURLsDiv = document.getElementById('room-urls');
      roomURLsDiv.innerHTML = roomHashURL;

      roomURLsDiv.style.display = 'block';
  }

  // ..................................
  // ALL below scripts are redundant!!!
  // ..................................
  function disableInputButtons() {
    // document.getElementById('room-id').onkeyup();

    // document.getElementById('open-or-join-room').disabled = true;
    document.getElementById('open-room').disabled = true;
    // document.getElementById('join-room').disabled = true;
    document.getElementById('room-id').disabled = true;
  }
</script>


@endsection
