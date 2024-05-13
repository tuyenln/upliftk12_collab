var dragID = {};
var isControllable = true;
var server_addr = 'https://readsolo.com:3000/';
//var server_addr = 'http://localhost:3000/';

var socket;
var isTeacher = true;
var downID = 'asdf';
var upID = '';
var myData = null;
var myColor =  null;
var colors = ['', 'rgba(0, 100, 0, 0.8)', 'rgba(0, 0, 100, 0.8)', 'rgba(100, 100, 0, 0.8)', 'rgba(100, 0, 100, 0.8)', 'rgba(0, 100, 100, 0.8)', 'rgba(100, 100, 100, 0.8)', 'rgba(0, 0, 0, 0.8)'];

$(document).ready(function () {
	socket = io(server_addr);

	$.get('/getActiveLessonId', function (data) {
		myData = data;
		//isTeacher = data.user_type == 3 ? 1 : 0;

		var jdata = {
			'lid': data.lesson_id,
			'uid': data.id,
			'uname': data.name,
			'isTeacher': 1
		};

		var joinInterval = setInterval( function() {
			if ((typeof cp) == "undefined") return;
			socket.emit('join', jdata);

			if (isTeacher == true) {
				//sendEvent('refreshStudent', {});

				setTimeout(function () {
					setControllable(true);
				}, 2000);
			}
			clearInterval(joinInterval);
		}, 500);

	});

	$(document).on('mousemove', '#main_container', function (e) {
		if (isTeacher == false) $('#playbar').hide();

		var param = {};

		if ($('#controllableDiv').length == 0) {
			$('body').append("<div style='width: 100%; height: 100%; position: fixed; z-index: 999999; background: rgba(255, 255, 255, 0.1); top: 0; left: 0;' id='controllableDiv'></div>");
			setControllable(isControllable);
		}

		param['clientX'] = parseInt(e.clientX) - parseInt($('#main_container').css('left'));
		param['clientY'] = parseInt(e.clientY) - parseInt($('#main_container').css('top'));
		param['scale'] = $('#main_container').css('transform').split('(')[1].split(')')[0].split(',')[0];

		if ($('#div_Slide *').last().prop('tagName') != 'CANVAS') {
			param['X'] = $('#' + downID).css('left');
			param['Y'] = $('#' + downID).css('top');
			param['zindex'] = $('#' + downID).css('z-index');
		} else {
			param['X'] = $('#div_Slide *').last().css('left');
			param['Y'] = $('#div_Slide *').last().css('top');
			param['zindex'] = $('#div_Slide *').last().css('z-index');
		}
		

		/*if (!$(e.target).attr('id') || $(e.target).attr('id') == downID) {
			param['flag'] = true;
		} else {
			param['flag'] = false;
		}*/
		if (myData == null || myColor == null) {
			param['userID'] = 'undefined';
			param['username'] = 'undefined';
			param['userColor'] = 'undefined';
		} else {
			if (isTeacher) param['userID'] = '0';
			else param['userID'] = myData.id;

			param['username'] = myData.name;
			param['userColor'] = myColor;
		}

		sendEvent('mousemove', param);
	});

	$(document).on('mouseover', '#main_container', function (e) {
		if (isTeacher == false) $('#playbar').hide();

		var param = {};

		param['id'] = $(e.target).attr('id');

		sendEvent('mouseover', param);
	});

	$(document).on('mouseout', '#main_container', function (e) {
		if (isTeacher == false) $('#playbar').hide();

		var param = {};

		param['id'] = $(e.target).attr('id');

		sendEvent('mouseout', param);
	});

	$(document).on('mousedown', '#main_container', function (e) {
		var param = {};

		if (myData == null) {
			param['userID'] = 'undefined';
		} else {
			if (isTeacher) param['userID'] = '0';
			else param['userID'] = myData.id;
		}

		downID = param['id'] = $(e.target).attr('id');
		sendEvent('mousedown', param);
	});

	$(document).on('mouseup', '#main_container', function (e) {
		var param = {};

		if ($(e.target).closest('#playbar').length != 0) {
			setTimeout(sendMainMovieEvent, 500);
		}

		param['id'] = $(e.target).attr('id');

		var cnt = 0;

		function redrawtime() {
			cnt ++;
			if (cnt == 7) return;
			param['X'] = $('#' + downID).css('left');
			param['Y'] = $('#' + downID).css('top');
			param['opacity'] = $('#' + downID + 'c').css('opacity');
			param['id'] = downID;
			sendEvent('setPosition', param);
			setTimeout(redrawtime, 100);
		}

		setTimeout(redrawtime, 100);

		if ($('#' + downID).attr('role') == 'button') {
			$('#controllableDiv').show();

			setTimeout(function () {$('#controllableDiv').hide()}, 2000);
		}

		if (myData == null) {
			param['userID'] = 'undefined';
		} else {
			if (isTeacher) param['userID'] = '0';
			else param['userID'] = myData.id;
		}

		sendEvent('mouseup', param);
	});

	$(document).on('keyup', '#main_container', function (e) {
		var param = {};

		param['id'] = $(e.target).attr('id');
		param['value'] = $(e.target).val();

		sendEvent('keyup', param);
	});

	function sendEvent(event, param) {
		var data = {};

		data['event'] = event;
		data['param'] = param;
		socket.emit('setUserData', data);
	}

	socket.on('updateStudentList', function (data) {
		var len = data.length;

		if (isTeacher) myColor = 'rgba(100, 0, 0, 0.8);';
		else myColor = colors[len];
	});

	socket.on('getUserData', function (data) {
		if (data.event == 'mousemove') {
			if (data.param.userID != 'undefined') {
				var offsetLeft = parseInt($('#main_container').css('left'));
				var offsetTop = parseInt($('#main_container').css('top'));
				var scale = parseFloat($('#main_container').css('transform').split('(')[1].split(')')[0].split(',')[0]);
				var scaleOther = parseFloat(data.param.scale);

				$('#mouseCursor_' + data.param.userID).css('left', (offsetLeft + scale / scaleOther * data.param.clientX) + 'px');
				$('#mouseCursor_' + data.param.userID).css('top', (offsetTop + scale / scaleOther * data.param.clientY) + 'px');

				if ($('#mouseCursor_' + data.param.userID).length == 0) {
					$('body').append("<div id='mouseCursor_" + data.param.userID + "' style='position: fixed; z-index: 9999; width: 15px; height: 15px; border-radius: 8px; padding-left: 20px 20px 0px 0px; background: " + data.param.userColor + ";'><font style='margin-left: 20px;'>" + data.param.username + "</font></div>");
				}
			}

			for (const [key, value] of Object.entries(dragID)) {
				if (key != data.param.userID) continue;
				$('#re-' + value + 'c').css('left', data.param.X);
				$('#re-' + value + 'c').css('top', data.param.Y);
				$('#re-' + value + 'c').css('z-index', data.param.zindex);
				$('#' + value).css('left', data.param.X);
				$('#' + value).css('top', data.param.Y);
				$('#' + value).css('z-index', data.param.zindex);
			}
		} else if (data.event == 'refreshStudent') {
			location.reload();
		} else if (data.event == 'mouseover') {
			$('#' + data.param['id']).mouseover();
		} else if (data.event == 'mouseout') {
			$('#' + data.param['id']).mouseout();
		} else if (data.event == 'setPosition') {
			$('#' + data.param['id']).css('left', data.param['X']);
			$('#' + data.param['id']).css('top', data.param['Y']);
			$('#re-' + data.param['id'] + 'c').css('left', data.param['X']);
			$('#re-' + data.param['id'] + 'c').css('top', data.param['Y']);
			$('#' + data.param['id'] + 'c').css('opacity', data.param['opacity']);
		} else if (data.event == 'mousedown') {
			//$('#mouseCursor').css('background', 'rgba(0, 0, 100, 0.8)');
			dragID[data.param['userID']] = data.param.id;
		} else if (data.event == 'mouseup') {
			delete dragID[data.param['userID']];

			//$('#mouseCursor').css('background', 'rgba(0, 100, 0, 0.8)');
			if (cp.DD.CurrInteractionManager) {
				cp.DD.CurrInteractionManager.m_ActiveInteraction.resetAvailable = true;
			}

			if ($('#' + data.param['id']).attr('role') != 'img') {
				cp(data.param['id']).click();
			} else {
				$('#' + data.param['id']).mouseup();
			}
		} else if (data.event == 'keyup') {
			$('#' + data.param['id']).val(data.param['value']);
		} else if (data.event == 'mainMovie') {
			if (typeof cp != "undfined" && typeof cp.PB != 'undefined') {
				cp.PB.mainMovie.play();
				cp.PB.mainMovie.jumpToFrame(data.param.position);

				if (data.param.isPaused == true) {
					cp.PB.mainMovie.pause();
				} else {
					cp.PB.mainMovie.play();
				}
			} else {
				if (typeof cp != "undfined" && data.param['position']) {
					cp.playMovie();
					cp.jumpToSlide(data.param['position']);
				}
			}

			setTimeout(function(){
				for (var i = 0; i < data.param.xypos.length; i ++) {
					$('#' + data.param.xypos[i].id).css('left', data.param.xypos[i].left);
					$('#' + data.param.xypos[i].id).css('top', data.param.xypos[i].top);
				}

				for (var i = 0; i < data.param.zidx.length; i ++) {
					$('#' + data.param.zidx[i].id).css('z-index', data.param.zidx[i].zindex);
				}

				for (var i = 0; i < data.param.values.length; i ++) {
					$('#' + data.param.values[i].id).val(data.param.values[i].value);
				}
			}, 500);
		}
	});

	socket.on('toggleActive', setControllable);

	socket.on('newConnected', function (data) {
		console.log('bbbbbbb');
		sendMainMovieEvent();
	});

	function sendMainMovieEvent() {
		if (isTeacher == false) return;

		var param = {};
		var pos = [];
		var vals = [];
		var zidx = [];

		if (typeof cp.PB != 'undefined') {
			param['position'] = vh._cpInfoCurrentFrame;
			param['isPaused'] = cp.PB.mainMovie.paused;
		} else {
			if (typeof cp.movie.stage.currentSlideName == 'string') {
				param['position'] = cp.movie.stage.currentSlideName.substring(5);
				param['isPaused'] = true;	
			}
		}
		
		var elem = $('#main_container *');

		for (var i = 0; i < elem.length; i ++) {
			pos.push({'id': $(elem[i]).attr('id'),'left': $(elem[i]).css('left'), 'top': $(elem[i]).css('top')});
			zidx.push({'id': $(elem[i]).attr('id'),'zindex': $(elem[i]).css('z-index')});
		}

		elem = $('input');

		for (var i = 0; i < elem.length; i ++) {
			vals.push({'id': $(elem[i]).attr('id'), 'value': $(elem[i]).val()});
		}

		param['xypos'] = pos;
		param['values'] = vals;
		param['zidx'] = zidx;

		sendEvent('mainMovie', param);
	}


	socket.on('soDisconnected', function (data) {
		if (isTeacher == 0 && data.isTeacher == 1) setControllable(false);
	})

	socket.on('entireContent', function (data) {
	});
});

function setControllable(v) {
	isControllable = v;
	if (v) $('#controllableDiv').hide();
	else $('#controllableDiv').show();
}
