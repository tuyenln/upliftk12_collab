var isDrag = false;
var dragID = 'asdf';
var isControllable = false;
var server_addr = 'https://readsolo.com:3000/';
var socket;
var isTeacher = false;
var downID = 'asdf';

$(document).ready(function () {
	socket = io(server_addr);

	$.get('/getActiveLessonId', function (data) {
		isTeacher = data.user_type == 3 ? 1 : 0;
		var jdata = {
			'lid': data.lesson_id,
			'uid': data.id,
			'uname': data.name,
			'isTeacher': isTeacher
		};
		if (data.user_type == 3) {
			setControllable(true);
		}
		socket.emit('join', jdata);
	});

	$(document).on('mousemove', '#main_container', function (e) {
		if (isTeacher == false) $('#playbar').hide();

		var param = {};

		if ($('#mouseCursor').length == 0) {
			$('body').append("<div id='mouseCursor' style='position: fixed; z-index: 9999; width: 15px; height: 15px; border-radius: 8px; background: rgba(0, 100, 0, 0.8);'></div><div style='width: 100%; height: 100%; position: fixed; z-index: 999999; background: rgba(255, 255, 255, 0.1); top: 0; left: 0;' id='controllableDiv'></div>");
			setControllable(isControllable);
		}

		param['clientX'] = e.clientX
		param['clientY'] = e.clientY;
		param['X'] = $(e.target).css('left');
		param['Y'] = $(e.target).css('top');

		if (!$(e.target).attr('id') || $(e.target).attr('id') == downID) {
			param['flag'] = true;
		} else {
			param['flag'] = false;
		}

		param['id'] = $(e.target).attr('id');
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

		param['clientX'] = e.clientX
		param['clientY'] = e.clientY;
		downID = param['id'] = $(e.target).attr('id');
		sendEvent('mousedown', param);
	});

	$(document).on('mouseup', '#main_container', function (e) {
		var param = {};

		if ($(e.target).closest('#playbar').length != 0) {
			setTimeout(sendMainMovieEvent, 500);
		}

		param['clientX'] = e.clientX
		param['clientY'] = e.clientY;
		param['id'] = $(e.target).attr('id');
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

	socket.on('getUserData', function (data) {
		if (data.event == 'mousemove') {
			console.log('mousemove');
			$('#mouseCursor').css('left', data.param.clientX);
			$('#mouseCursor').css('top', data.param.clientY);

			if (isDrag && data.param.flag) {
				$('#re-' + dragID + 'c').css('left', data.param.X);
				$('#re-' + dragID + 'c').css('top', data.param.Y);
				$('#' + dragID).css('left', data.param.X);
				$('#' + dragID).css('top', data.param.Y);
			}
		} else if (data.event == 'mouseover') {
			console.log('mouseover');
			$('#' + data.param['id']).mouseover();
		} else if (data.event == 'mouseout') {
			console.log('mouseout');
			$('#' + data.param['id']).mouseout();
		} else if (data.event == 'mousedown') {
			console.log('mousedown');
			$('#mouseCursor').css('background', 'rgba(0, 0, 100, 0.8)');
			dragID = data.param['id'];
			isDrag = true;
			$('#' + data.param['id']).mousedown();
		} else if (data.event == 'mouseup') {
			console.log('mouseup');
			isDrag = false;

			$('#mouseCursor').css('background', 'rgba(0, 100, 0, 0.8)');

			if ($('#' + data.param['id']).attr('role') != 'img') {
				cp(data.param['id']).click();
			} else {
				$('#' + data.param['id']).mouseup();
			}
		} else if (data.event == 'keyup') {
			console.log('keyup');
			$('#' + data.param['id']).val(data.param['value']);
		} else if (data.event == 'mainMovie') {
			console.log('mainMovie');
			if (typeof cp.PB != 'undefined') {
				cp.PB.mainMovie.play();
				cp.PB.mainMovie.jumpToFrame(data.param.position);

				if (data.param.isPaused == true) {
					cp.PB.mainMovie.pause();
				} else {
					cp.PB.mainMovie.play();
				}
			} else {
				cp.playMovie();
				cp.jumpToSlide(data.param['position']);
			}

			setTimeout(function(){
				for (var i = 0; i < data.param.xypos.length; i ++) {
					$('#' + data.param.xypos[i].id).css('left', data.param.xypos[i].left);
					$('#' + data.param.xypos[i].id).css('top', data.param.xypos[i].top);
				}

				for (var i = 0; i < data.param.values.length; i ++) {
					$('#' + data.param.values[i].id).val(data.param.values[i].value);
				}
			}, 500);
		}
	});

	socket.on('toggleActive', setControllable);

	socket.on('newConnected', function (data) {
		sendMainMovieEvent();
	});

	function sendMainMovieEvent() {
		if (isTeacher == false) return;

		var param = {};
		var pos = [];
		var vals = [];

		if (typeof cp.PB != 'undefined') {
			param['position'] = vh._cpInfoCurrentFrame;
			param['isPaused'] = cp.PB.mainMovie.paused;
		} else {
			param['position'] = cp.movie.stage.currentSlideName.substring(5);
			param['isPaused'] = true;
		}
		
		var elem = $('#main_container *');

		for (var i = 0; i < elem.length; i ++) {
			pos.push({'id': $(elem[i]).attr('id'),'left': $(elem[i]).css('left'), 'top': $(elem[i]).css('top')});
		}

		elem = $('input');

		for (var i = 0; i < elem.length; i ++) {
			vals.push({'id': $(elem[i]).attr('id'), 'value': $(elem[i]).val()});
		}

		param['xypos'] = pos;
		param['values'] = vals;

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
