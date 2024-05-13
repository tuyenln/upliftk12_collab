var scrollTop = 0;
var canvas;
var context;
var radius = 2;
var dragging = false;
var x, y, prevX, prevY;
var allowdraw = (act_lesson == 1) ? true : false;
var color = 'black';
var mode = 'draw';


$( window ).scroll(function() {
	scrollTop = $(window).scrollTop();
})



$('.allow-drawing').change(function(){
	$(this).attr('disabled', 'disabled');

	setTimeout(function () {
		$('.allow-drawing').removeAttr('disabled');
	}, 1000);
	if($(this).prop("checked") == true){
		console.log('sss');
		socket.emit('drawingchecked', {
			'checked' : true
		});
		allowdraw = true;
		$('#canvas').show();
		canvas = document.getElementById('canvas');
		//canvas.width  = $('.iframe-section')[0].clientWidth;
		//canvas.height = $('.iframe-section')[0].clientHeight;
		context= canvas.getContext('2d');
		context.clearRect(0, 0, canvas.width, canvas.height);
		radius = 2;
		context.lineWidth = 2*radius;

	}
	else if($(this).prop("checked") == false){
		socket.emit('drawingchecked', {
			'checked' : false
		});
		allowdraw = false;
		dragging = false;
		$('#canvas').hide();
	}
});

function formatAMPM(date) {
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	return strTime;
  }


$('.send-message-btn').click(function() {
	var message = $('.message').val();
	var date = formatAMPM(new Date);
	var str = '<div class="msg">\
	<p>You: <span>&nbsp;&nbsp;%DATE%</span></p>\
	<p>%MESSAGE%</p>\
	</div>';
	str = str.replace('%DATE%', date);
	str = str.replace('%MESSAGE%', message);
	var message_area = $('.message-area')[0];
	shouldScroll = message_area.scrollTop + message_area.clientHeight === message_area.scrollHeight;
	$('.message-area').append(str);
	if (!shouldScroll) {
		message_area.scrollTop = message_area.scrollHeight;
	}
	message_area.scrollTop = message_area.scrollHeight;

	$('.message').val('');
	socket.emit('chat', {
		'name': uname,
		'date': date,
		'message': message
	});
});

$(".message").keyup(function(event) {
    if (event.keyCode === 13) {
        $(".send-message-btn").click();
    }
});


var putPoint = function(e){
	/*if ($('.allow-drawing').prop('checked') == true) {
		allowdraw = true;
	} else {
		allowdarw = false;
	}*/
	if(dragging && allowdraw)
	{
		console.log('allowdraw', allowdraw);
		context.lineTo(e.offsetX, e.offsetY);
		context.stroke();
		context.beginPath();
		context.arc(e.offsetX, e.offsetY , radius, 0, Math.PI*2);
		context.fill();
		context.beginPath();
		context.moveTo(e.offsetX,e.offsetY);
	}
}

function drawLine(context, x1, y1, x2, y2, radius, color, mode) {
	
	context.lineWidth = 2*radius;
	context.fillStyle = color;
	context.strokeStyle = color;
	context.fill();
	// context.arc(x2, y2 , radius, 0, Math.PI*2);
	if (mode != 'draw') {
		console.log(mode);
		context.globalCompositeOperation="destination-out";
		
		context.arc(x2, y2, radius, 0, Math.PI*2, false);
		context.fill();	
	} else {
		context.globalCompositeOperation="source-over";
		context.moveTo(x1,y1);
		context.lineTo(x2, y2);
		context.stroke();
		context.beginPath();	
	}
/*
	context.moveTo(x1, y1);
	context.lineTo(x2, y2);
	context.stroke();
	context.arc(e.offsetX, e.offsetY , radius, 0, Math.PI*2);
	context.fill();
	context.beginPath();
	context.moveTo(x2, y2);*/
}

$(document).on('mouseup', '#canvas', function(e) {
	dragging = false;
	context.beginPath();
});

socket.on('draw', function(data) {
	console.log('draw');
	drawLine(context, data.x1, data.y1, data.x2, data.y2, data.radius, data.color, data.mode);
});

socket.on('chat', function(data) {
	var str = '<div class="msg">\
	<p>%NAME%:<span>&nbsp;&nbsp;%DATE%</span></p>\
	<p>%MESSAGE%</p>\
	</div>';
	var name = '';
	if (data.name == uname) {
		name = 'You';
	} else if (data.name == data.t_name) {
		name = data.name + ' (Teacher)';
	} else {
		name = data.name;
	}
	str = str.replace('%NAME%', name);
	str = str.replace('%DATE%', data.date);
	str = str.replace('%MESSAGE%', data.message);
	var message_area = $('.message-area')[0];
	shouldScroll = message_area.scrollTop + message_area.clientHeight === message_area.scrollHeight;
	$('.message-area').append(str);
	if (!shouldScroll) {
		message_area.scrollTop = message_area.scrollHeight;
	}
	message_area.scrollTop = message_area.scrollHeight;
});

socket.on('drawingchecked', function(data) {
	
	$('.allow-drawing').prop('checked', data.checked);
	if (data.checked == true) {
		if (isTeacher == 0 || activity_help == 1) {
			console.log('in');
			allowdraw = true;
			$('#canvas').show();
			canvas = document.getElementById('canvas');
			//canvas.width  = $('.iframe-section')[0].clientWidth;
			//canvas.height = $('.iframe-section')[0].clientHeight;
			context= canvas.getContext('2d');
			context.clearRect(0, 0, canvas.width, canvas.height);
			radius = 2;
			context.lineWidth = 2*radius;
		}
	}
	else {
		allowdraw = false;
		dragging = false;
		$('#canvas').hide();
	}
});

$(document).on('mousemove', '#canvas', function(e) {
	x = e.offsetX;
	y = e.offsetY;
	var width = $('.iframe-inner')[0].offsetWidth;
	var height = $('.iframe-inner')[0].offsetHeight;
	var scale = 1.0;
	
	var offsetLeft = (width - height / 721 * 1280) / 2;

	scale = 1280 / (width - offsetLeft * 2);

	if ($('#canvas').css('width') != 'calc(100% - ' + (offsetLeft * 2 + 40) + 'px)')
		$('#canvas').css('width', 'calc(100% - ' + (offsetLeft * 2 + 40) + 'px)');
	if ($('#canvas').css('top') != '60px')
		$('#canvas').css('top', '60px');
	if ($('#canvas').css('height') != 721 * ((width - offsetLeft * 2) / 1280 + 'px'))
		$('#canvas').css('height', 721 * ((width - offsetLeft * 2) / 1280 + 'px'));
	if ($('#canvas').css('left') != 'calc(' + offsetLeft + 'px)')
		$('#canvas').css('left', 'calc(' + offsetLeft + 'px)');

	x = x * scale;
	y = y * scale;

	socket.emit('setUserData', {
		event: 'mousemove',
		param: {
			clientX: x,
			clientY: y,
			flag: false,
			userID: isTeacher ? '0' : uid
		}
	});

	if(dragging && allowdraw) {
		socket.emit('draw', {
			'x1': prevX,
			'y1': prevY,
			'x2': x,
			'y2': y, 
			'radius': radius,
			'color': color,
			'mode': mode
		});
		drawLine(context, prevX, prevY, x, y, radius, color, mode);
		prevX = x;
		prevY = y;
	} 
});

$(document).on('mousedown', '#canvas', function(e) {
	if (isTeacher == 1 || (isTeacher == 0 && allowdraw == 1)) {
		dragging = true;
		prevX = x;
		prevY = y;	
	} else {
		dragging = false;
	}
});

var engage = function(e){
	dragging = true;
	//putPoint(e);
}

var disengage = function(){
	dragging = false;
	context.beginPath();
}/*
canvas.addEventListener('mousedown',engage);
canvas.addEventListener('mousemove', putPoint);
canvas.addEventListener('mouseup',disengage);*/

//radius
var setRadius = function(newRadius){
	if(newRadius < minRad)
		newRadius = minRad;
	else if(newRadius > maxRad)
		newRadius = maxRad
	radius = newRadius;
	context.lineWidth = 2*radius;
	radSpan.innerHTML = radius;
}


var minRad = 2,
	maxRad = 100,
	defaultRad = 10,
	interval = 2,
	radSpan = document.getElementById('radval'),
	decRad = document.getElementById('decrad'),
	incRad = document.getElementById('incrad');

	decRad.addEventListener('click',function(){
		if (canvas != undefined) {
			setRadius(radius - interval)
		}
	});

incRad.addEventListener('click',function(){
	if (canvas != undefined)
		setRadius(radius + interval)
});
if (canvas != undefined)
	setRadius(defaultRad);

//color
var colors = ['black','white','red','blue','yellow','green']

for(var i=0,n=colors.length;i<n;i++){
	var swatch = document.createElement('div');
	swatch.className = 'swatch';
	swatch.style.backgroundColor = colors[i];
	swatch.addEventListener('click',setSwatch);
	document.getElementById('colors').appendChild(swatch);

}

function setColor(color)
{
	if (context != undefined) {
		context.fillStyle = color;
		context.strokeStyle = color;
	}
	var active = document.getElementsByClassName('active-custom')[0];
	if(active){
		active.className = 'swatch';
	}
	mode = 'draw';
}

function setSwatch(e){
	var swatch = e.target;
	color = swatch.style.backgroundColor;
	setColor(swatch.style.backgroundColor);
	swatch.className += ' active-custom';
}

setSwatch({target: document.getElementsByClassName('swatch')[0]});

//save
$('#erase').click(function() {
	mode = 'erase';

});

