//const { post } = require("jquery");

//const { type } = require("jquery");

var socket = io('https://readsolo.com:3000/');
//var socket = io('http://localhost:3000/');



var ot_session;
var publisher = null;
var students = {};

$(document).ready(function () {
    if (isRaiseHand == 0) {
        $('.raise-hand-view').attr('disabled');
        socket.emit('raisehand', {
            'uid': user_id,
            'uname': uname,
            'isTeacher': isTeacher,
            'avaurl': avaUrl,
            'lesson_id': lid
        });
    }
})

socket.on('connect', function () {
    // Send join event right after connect:
    if (act_lesson != 2) {
        socket.emit('studentlogin', {
            'user_id': user_id,
            'user_type': isTeacher
        });
    }
    if (act_lesson != 1) {
        socket.emit('join', {
            'lid': lid,
            'uid': uid,
            'isTeacher': isTeacher,
            'uname': uname,
            'isLesson': 1,
            'avaUrl': avaUrl,
        });
        if (isTeacher == 0) {
            addStudentItem(uid, avaUrl, uname, 1);
        }
    }
});

//New Student Connect
socket.on('newConnected', function (data) {
    if (data.isTeacher == 1) {
        toggleTeacherDiv(1);
        replaceTeacherAvatar(data.avaUrl);
        return;
    }
    var chathistory = $('.message-area').html();

    // socket.emit('get_chat', {
    //     'chat': chathistory
    // });
    if (act_lesson != 1 /*|| isTeacher == 1*/) {
        addStudentItem(data.uid, data.avaUrl, data.uname);
        if (isTeacher == 1 && data.active == 1) {
            toggleStudent(data.uid, 1);
        }
    }

})

socket.on('no-teacher', function(data) {
    if (data.no_teacher == 1) {
        alert("The teachers are not online at the moment");
    } else {
        alert("Your help request is successfully sent to the teacher");
        $('.raise-hand-view').attr('disabled', 'disabled');
    }
})
/*
socket.on('chatData', function (data) {
    var chat_history = data.chat;
    var t_name = data.t_name + '(Teacher)';
    console.log(chat_history);
    chat_history = chat_history.replace(/You:/g, t_name + ":");
    chat_history = chat_history.replace(uname, 'You');
    $('.message-area').html(chat_history);
});
*/
socket.on('soDisconnected', function (data) {
    console.log('ddd');
    if (data.isTeacher == 0) {
        var items = $('.item span');
        for (var i = 0; i < items.length; i++) {
            var item = $(items[i]);
            if(item.attr('id') == 'student_' + data.uid) break;
        }
        //console.log(i);
        i = i + 1;
        $('#client-avatar-section .item:nth-child('+i+')').remove();
        //$("#client-avatar-section").trigger('remove.owl.carousel', [i]);
        if ($('.student-disallow-control-noti[data-uid="' + data.uid + '"]').length > 0)
            $('.student-disallow-control-noti[data-uid="' + data.uid + '"]').parent().remove();
    }
    else if (isTeacher == 0) {
        $('.board-control-notification-div').remove();
        publishVideo();
        toggleTeacherDiv(0);
    }

})

socket.on('login', function(data) {
    console.log('login');
    $('.status-background').each(function() {
        var flag = 0;
        var _this = $(this);
        data.forEach(client => {
            if (client.isTeacher == 0 && client.user_id == $(this).attr('data-id'))
            {
                $(this).removeClass('offline').addClass('online');
                flag = 1;
            }
        });
        if (flag == 0) {
            $(this).removeClass('online').addClass('offline');
        }
    });
});

socket.on('updateStudentList', function (data) {
    data.forEach(client => {
        if (client.isTeacher == 1) {
            toggleTeacherDiv(1);
            replaceTeacherAvatar(client.avaUrl);
        }
        else {
            addStudentItem(client.uid, client.avaUrl, client.uname);
        }
    })
})

socket.on('OTData', data => {
    setup_local_media(data);
})

socket.on('toggleCamera', function (data) {
    if (data == 1) publishVideo();
    else disableLocalMedia();
})

socket.on('removeUser', () => {
    window.location.href = "/"
})

socket.on('refreshStudent', () => {
    window.location.reload();
})

socket.on('toggled', (data) => {
    if (isTeacher == 1) return;
    isAllow = data.status;
    var items = $('.item span');
    for (var i = 0; i < items.length; i++) {
        var item = $(items[i]);
        if(item.attr('id') == 'student_' + data.uid) break;
    }
    i = i + 1;
    console.log(i);

    if (data.status && $('.board-control-notification-div').length == 0) {
        var dstr = '<div class="board-control-notification-div">\
            <div class="board-control-notification-text">You have control of the board</div>\
        </div>';
        $('#frame_col').prepend(dstr);

        $('#client-avatar-section .item:nth-child('+i+') .button.circle').css('background', '#46a72d');
        $('#client-avatar-section .item:nth-child('+i+') .button::before').css('border', '2px solid #38c736');
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').hover(function() {
            $(this).css('background', '#7ecc38');
        }, function() {
            $(this).css('background', '#46a72d');
        });

    }
    if (!data.status) {
        $('.board-control-notification-div').remove();
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').css('background', '#23466e');
        $('#client-avatar-section .item:nth-child('+i+') .button::before').css('border', '2px solid #468cdc');
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').hover(function() {
            $(this).css('background', '#3e70aa');
        }, function() {
            $(this).css('background', '#23466e');
        });
    }
})

socket.on('studentToggled', (data) => {
    toggleStudentVideo(data.uid, data.status);
})

function toggleTeacherDiv(status) {
    if (status) $('#teacher_div').show();
    else $('#teacher_div').hide();
}

socket.on('raisehandlist', function(data) {
    data.forEach(client => {
        if (client.uname != undefined) {
            if ($.inArray(client.uid, students_id) && $.inArray(client.uid, student_list) == -1) {
                console.log(students_id, client.uid, student_list);
                $('.student-list').append('<div style="display: flex;">\
                <input type="checkbox" class="check-student" data-id="'+client.uid+'" data-lesson-id="'+client.lid+'"style="width: 24px; height: 16px; margin: 25px 12px 0;">\
                <img class="img-circle" style="width: 80px; height: 70px; margin-left: 7%;" src="'+client.avaUrl+'">\
                <div style="width: 80%; margin-left: 10px; margin-top: -10px;">\
                <h4>' + client.uname + '</h4>\
                <a class="btn btn-success btn-join" data-id="'+client.uid+'"style="height: 28px; line-height: 27px">Join<input type="hidden" class="student-name1" value="'+client.uname+'"><input class="lesson-id" type="hidden" value="'+client.lid+'"></a></div></div>');
                //console.log(client.uname);
                student_list.push(client.uid);
            }
        }
    })
});

$(document).on('click', '.btn-join', function() {
    var student_id = $(this).attr('data-id');
    var lesson_id = $(this).find('.lesson-id').val();
    var student_name = $(this).find('.student-name1').val();
    $('.student-name-modal').html(student_name);
    $('.modal-waiting').modal('show');
    socket.emit('request-join', {
        'student_id': student_id,
        'teacher_id': user_id,
        'lesson_id': lesson_id,
        'teacher_name': uname
    });
});

socket.on('accept-join', function(data) {
    $('.teacher-name').html(data.teacher_name);
    $('.btn-accept-request').attr('data-id', data.lesson_id);
    $('.teacher-id').val(data.teacher_id);
    $('.student-id').val(data.student_id);

    $('.modal-accept').modal('show');
});

$(document).on('change', '.check-student', function() {
    var client_id = $(this).attr('data-id');
    var lid = $(this).attr('data-lesson-id');
    var isChecked = 0;
    if(this.checked) {
        isChecked = 1;
    } else {
        isChecked = 0;
    }
    var _this = $(this);
    var returnVal = confirm("Are you sure this help is resolved?");
    if (returnVal == 1) {
        _this.attr('disabled', 'disabled');
        _this.closest('.student-list').remove();
        student_list.splice( $.inArray(client_id, student_list), 1 );
        var base_url = window.location.origin;

        socket.emit('enable-raise-hand', {
            'student_id': client_id,
            'teacher_id': user_id,
            'lesson_id': lid
        });

        $.ajax({
            'url': base_url + '/activity-help',
            'type': 'POST',
                data: {s_id: client_id, t_id: user_id, status: isChecked, lid: lid},
                success: function(response) {
                    if (response == 1) {
                        alert('The issue is successfully resolved');
                    }
                }
        });
    }
});

$(document).on('click', '.btn-accept-request', function() {

    var teacher_id = $(this).find('.teacher-id').val();
    var student_id = $(this).find('.student-id').val();
    var lesson_id = $(this).attr('data-id');

    var teacher_name = $('.teacher-name').html();
    var base_url = window.location.origin;
    $.ajax({
        'url': base_url + '/update-activityhelp',
        'type': 'POST',
        data: {sid: student_id, tid: teacher_id, lid: lid},
        success: function(response) {
            if (response == 1) {
                socket.emit('accepted-request', {
                    'teacher_id': teacher_id,
                    'student_id': student_id,
                    'lesson_id': lesson_id,
                    'student_name': uname,
                    'teacher_name': teacher_name
                });
                socket.emit('join', {
                    'lid': lesson_id,
                    'uid': student_id,
                    'isTeacher': 0,
                    'uname': uname,
                    'isLesson': 1,
                    'avaUrl': avaUrl,
                });
                addStudentItem(student_id, avaUrl, uname, 1);
            }
        }
    })
});

socket.on('decline-request', function(data) {
    if (data.isDecline == 1) {
        var student_name = $('.student-name-modal').html();
        $('.student-name-modal-decline').html(student_name);
        $('.modal-waiting').modal('hide');
        $('.modal-declined').show();
    }
});

$(document).on('click', '.decline-accepted', function() {
    $('.modal-declined').hide();
});

$(document).on('click', '.btn-decline-request', function() {
    var teacher_id = $(this).parent().find('.btn-accept-request').find('.teacher-id').val();
    var student_id = $(this).parent().find('.btn-accept-request').find('.student-id').val();
    var lesson_id = $(this).parent().find('.btn-accept-request').attr('data-id');
    socket.emit('decline-request', {
        'teacher_id': teacher_id,
        'student_id': student_id,
        'lesson_id': lesson_id
    });
    $('.modal-accept').modal('hide');

});

socket.on('enable-raise-button', function(data) {
    if (data.status == 1) {
        $('.raise-hand').removeAttr('disabled');
    }
});

socket.on('start-activity', function(data) {
    var lesson_start = $('.btn-get-started').attr('href');
    var href = "abg98" + data.student_id + "Zgbs33" + data.lesson_id;
    lesson_start = lesson_start.replace("aaa", href);
    $('.btn-get-started').attr('href', lesson_start);
    $('.modal-waiting').modal('hide');
    $('.modal-accepted').modal('show');

});

$(document).on('click', '.btn-get-started', function() {
    $('.modal-accepted').modal('hide');

});

function replaceTeacherAvatar(avaUrl) {
    $('#tdefava_div .def-ava-img').attr('src', avaUrl);
}

function toggleStudent(sid, status) {
    var items = $('.item span');
    for (var i = 0; i < items.length; i++) {
        var item = $(items[i]);
        if(item.attr('id') == 'student_' + sid) break;
    }
    console.log(i);
    i = i + 1;
    if (status == 1) {
        $('.student-disallow-control[data-uid="' + sid + '"]').show();
        $('.student-allow-control[data-uid="' + sid + '"]').hide();
        if ($('.student-disallow-control-noti[data-uid="' + sid + '"]').length == 0) {
            var dstr = '<div class="board-control-notification-div">\
                <div class="board-control-notification-text">%UNAME% has control of the board</div>\
                <div class="board-control-notification-control student-disallow-control-noti" data-uid="%UID%">Revoke Control</div>\
            </div>';
            dstr = dstr.replace('%UNAME%', students[sid]);
            dstr = dstr.replace('%UID%', sid);
            $('#frame_col').prepend(dstr);
        }

        $('#client-avatar-section .item:nth-child('+i+') .button.circle').css('background', '#46a72d');
        $('#client-avatar-section .item:nth-child('+i+') .button::before').css('border', '2px solid #38c736');
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').hover(function() {
            $(this).css('background', '#7ecc38');
        }, function() {
            $(this).css('background', '#46a72d');
        });
    }
    else {
        console.log(sid);
        $('.student-disallow-control-noti[data-uid="' + sid + '"]').parent().remove();
        $('.student-allow-control[data-uid="' + sid + '"]').show();
        $('.student-disallow-control[data-uid="' + sid + '"]').hide();
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').css('background', '#23466e');
        $('#client-avatar-section .item:nth-child('+i+') .button::before').css('border', '2px solid #468cdc');
        $('#client-avatar-section .item:nth-child('+i+') .button.circle').hover(function() {
            $(this).css('background', '#3e70aa');
        }, function() {
            $(this).css('background', '#23466e');
        });
    }
    socket.emit('toggleUser', {
        'uid': sid,
        'status': status
    });
}

function toggleStudentVideo(uid, status) {
    if (status == 1) {
        $('.student-mute[data-uid="' + uid + '"]').show();
        $('.student-unmute[data-uid="' + uid + '"]').hide();
    }
    else {
        $('.student-unmute[data-uid="' + uid + '"]').show();
        $('.student-mute[data-uid="' + uid + '"]').hide();
    }
}

$(document).on('click', '.raise-hand', function() {
    socket.emit('raisehand', {
        'uid': user_id,
        'uname': uname,
        'isTeacher': isTeacher,
        'avaurl': avaUrl,
        'lesson_id': lid
    });
    var base_url = window.location.origin;
    // $.ajax({
    //     url: base_url + "/add-activity",
    //     type: "POST",
    //     data: {s_id: user_id, lid: lid}
    // })
});

$(document).on('click', '.student-allow-control', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    var uid = target.data('uid');
    toggleStudent(uid, 1);
})

$(document).on('click', '.student-disallow-control', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    var uid = target.data('uid');
    $('.student-disallow-control-noti[data-uid="' + uid + '"]').parent().remove();
    $('.student-allow-control[data-uid="' + uid + '"]').show();
    $('.student-disallow-control[data-uid="' + uid + '"]').hide();
    socket.emit('toggleUser', {
        'uid': uid,
        'status': 0
    });
    //$('.board-control-notification-div').remove();
    var items = $('.item span');
    for (var i = 0; i < items.length; i++) {
        var item = $(items[i]);
        if(item.attr('id') == 'student_' + uid) break;
    }
    //console.log(i);
    i = i + 1;
    $('#client-avatar-section .item:nth-child('+i+') .button.circle').css('background', '#23466e');
    $('#client-avatar-section .item:nth-child('+i+') .button::before').css('border', '2px solid #468cdc');
    $('#client-avatar-section .item:nth-child('+i+') .button.circle').hover(function() {
        $(this).css('background', '#3e70aa');
    }, function() {
        $(this).css('background', '#23466e');
    });


})

$(document).on('click', '.student-disallow-control-noti', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    var uid = target.data('uid');
    toggleStudent(uid, 0);

})

$(document).on('click', '.student-mute', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    var uid = target.data('uid');
    toggleStudentVideo(uid, 0);
    socket.emit('toggleCamera', {
        'uid': target.data('uid'),
        'status': 0
    });
})

$(document).on('click', '.student-unmute', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    var uid = target.data('uid');
    toggleStudentVideo(uid, 1);
    socket.emit('toggleCamera', {
        'uid': target.data('uid'),
        'status': 1
    });
})

$(document).on('click', '.student-remove', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    socket.emit('removeUser', {
        'uid': target.data('uid'),
    });
})

$(document).on('click', '.student-refresh', function (e) {
    if (isTeacher == 0) return;
    var target = $(this);
    socket.emit('refreshStudent', {
        'uid': target.data('uid'),
    });
})

$(document).on('click', '.mute-teacher', function (e) {
    disableLocalMedia();
})

$(document).on('click', '.mute-audio-teacher', function(e) {
    disableLocalAudio();
})

$(document).on('click', '.unmute-teacher', function (e) {
    publishVideo();
})

$(document).on('click', '.unmute-audio-teacher', function (e) {
    publishAudio();
})

$(document).on('click', '.refreshall', function (e) {
    socket.emit('refreshAllStudents');
})
$(document).on('click', '.refreshall-activity', function (e) {
    socket.emit('refreshAllStudents-activity');
})

$(document).on('click', '.mute-myself', function (e) {
    disableLocalMedia();
    socket.emit('studentToggled', {
        status: 0
    });
})

$(document).on('click', '.unmute-myself', function (e) {
    publishVideo();
    socket.emit('studentToggled', {
        status: 1
    });
})

$(document).on('click', '.mute-audio-myself', function (e) {
    disableLocalAudio();
    socket.emit('studentToggled', {
        status: 0
    });
})

$(document).on('click', '.unmute-audio-myself', function (e) {
    publishAudio();
    socket.emit('studentToggled', {
        status: 1
    });
})


function disableLocalMedia() {
    if (publisher) {
        // ot_session.unpublish(publisher);
        // publisher = null;
        publisher.publishVideo(false);
    }
    $('.unmute-teacher').show();
    $('.mute-teacher').hide();
    $('.unmute-myself').show();
    $('.mute-myself').hide();
}

function disableLocalAudio() {
    if (publisher) {
        // ot_session.unpublish(publisher);
        // publisher = null;
        publisher.publishAudio(false);
    }
    $('.unmute-audio-teacher').show();
    $('.mute-audio-teacher').hide();
    $('.unmute-audio-myself').show();
    $('.mute-audio-myself').hide();
}

function publishAudio() {
    if (publisher) {
        // ot_session.unpublish(publisher);
        // publisher = null;
        publisher.publishAudio(true);
    }
    $('.unmute-audio-teacher').hide();
    $('.mute-audio-teacher').show();
    $('.unmute-audio-myself').hide();
    $('.mute-audio-myself').show();
}


function publishVideo() {
    if (publisher) {
        publisher.publishVideo(true);
    }
    $('.unmute-teacher').hide();
    $('.mute-teacher').show();
    $('.unmute-myself').hide();
    $('.mute-myself').show();
}

function enableLocalMedia() {
    if (ot_session.capabilities.publish == 1) {
        OT.getDevices(function (err, devices) {
            var pdata = {
                // 'videoSource': 'screen',
                'name': '',
                height: "166px",
                width: "189px"
            };
            // Initialize a Publisher, and place it into the element with id="video_section"
            var pdiv;
            if (isTeacher == 1) {
                pdata.name = 'teacher'
                pdiv = 't_publisher';
                if ($('#t_publisher').length == 0) {
                     var html = '<div id="t_publisher"></div><div class="dot-dropdown">\
                         <i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>\
                        <ul class="dropdown-menu">\
                             <li><a href="#" class="refreshall"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh All Students</a></li>\
                             %TMUTE%\
                         </ul>\
                     </div >';
                    var mutehtml = '<li><a href="#" class="mute-teacher"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Disable Video</a>\
                        <a href="#" class="unmute-teacher" style="display: none;"><i class="fa fa-microphone" aria-hidden="true"></i> Enable Video</a></li>\
                        <li><a href="#" class="mute-audio-teacher"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Mute Audio</a>\
                        <a href="#" class="unmute-audio-teacher" style="display: none;"><i class="fa fa-microphone" aria-hidden="true"></i> Unmute Audio</a></li>';
                    html = html.replace('%TMUTE%', isVideo ? mutehtml : '');
                    $('#teacher_div').prepend(html);
                }
            }
            else {
                pdata.name = uid;
                pdiv = 'me_publisher';
            }
            if (devices.length > 0 && isVideo == 1) {
                $('#t_def_ava_div').hide();
                publisher = OT.initPublisher(pdiv, pdata);
                publisher.on('streamDestroyed', function (e) {
                    $('#t_def_ava_div').show();
                })
                ot_session.publish(publisher).setStyle('backgroundImageURI', avaUrl);
            }
            if (devices.length == 0 && isVideo == 1) {
                $('#clear-invite').addClass("active");
            }
        })
    } else {
        console.log('no pub');
    }
}

function setup_local_media(otdata) {
    ot_session = OT.initSession(otdata.apikey, otdata.session);

    // Connect to the Session using the 'apiKey' of the application and a 'token' for permission
    ot_session.connect(otdata.token, function (error) {
        if (error) {
            console.log("Error connecting: ", error.name, error.message);
        } else {
            console.log("Connected to the session.");
        }
    });
    // Attach event handlers
    ot_session.on({

        // This function runs when ot_session.connect() asynchronously completes
        sessionConnected: function () {
            enableLocalMedia();
        },

        // This function runs when another client publishes a stream (eg. ot_session.publish())
        streamCreated: function (event) {
            if (event.stream.name == 'teacher') {
                if ($('#t_subscriber').length == 0) {
                    $('#teacher_div').prepend('<div id="t_subscriber"></div>');
                }
                $('#tdefava_div').hide();
                console.log('subscriber-teacher');
                var subscribeOptions = {
                    width: "189px",
                    height: "166px"
                    };
                if (!event.stream.hasVideo) {
                    ot_session.subscribe(event.stream, 't_subscriber', subscribeOptions).setStyle('backgroundImageURI', $('#tdefava_div .def-ava-img').attr('src'));
                } else {
                    ot_session.subscribe(event.stream, 't_subscriber', subscribeOptions);
                }
            }
            else {
                var sid = event.stream.name;
                event.stream.name = students[event.stream.name];
                var subscribeOptions = {
                    width: "189px",
                    height: "166px"
                    };
                if (!event.stream.hasVideo) {
                    ot_session.subscribe(event.stream, sid + '_subscriber', subscribeOptions).setStyle('backgroundImageURI', $('.def-ava-img-student').attr('src'));
                } else {
                    ot_session.subscribe(event.stream, sid + '_subscriber', subscribeOptions);

                }
            }
        },

        streamDestroyed: function (event) {
            if (event.stream.name == 'teacher') {
                $('#tdefava_div').show();
            }
        }

    });
}

$('.cancel-button').click(function () {
    $('.clear-invite').removeClass("active");
});

$(document).on('hover', '.item span', function() {

})

function addStudentItem(sid, avaUrl, sname, isPub = 0) {
    var pdiv = 'student_' + sid;
    students[sid] = sname;
    if (($('#' + pdiv).length == 0 && activity_help != 1 && act_lesson != 1) || ($('#' + pdiv).length == 0 && activity_help == 1 && $('.item').length == 0) || ($('#' + pdiv).length == 0 && act_lesson == 1 && $('.item').length == 0)) {
        var dhtml = '';
        if (isVideo == 0) {
            dhtml = '<div class="item"><span class="button circle" data-toggle="dropdown" title="'+sname+'" id="' + pdiv + '">' + sname.substring(0, 2) + '</span>';
        } else {
            dhtml = '<div class="item" style="top: 120px; right: 59px;">';
        }
        var mutehtml = '';
        if (isTeacher) {
            if (isVideo == 0) {
                dhtml += '<ul class="dropdown-menu">\
                <li><a href="#" class="student-allow-control" data-uid="%UID%"><i class="fa fa-pencil" aria-hidden="true"></i> Give board control</a>\
                <a href="#" class="student-disallow-control" data-uid="%UID%" style="display: none;"><i class="fa fa-pencil" aria-hidden="true"></i> Revoke board control</a></li>\
                <li><a href="#" class="student-remove" data-uid="%UID%"><i class="fa fa-sign-out" aria-hidden="true"></i> Remove</a></li>\
                <li><a href="#" class="student-refresh" data-uid="%UID%"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh Student</a></li>\
            </ul>\
                </div >';
            } else {
            mutehtml = '<li><a href="#" class="student-mute" data-uid="%UID%"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Mute Student</a>\
                <a href="#" class="student-unmute" data-uid="%UID%" style="display: none;"><i class="fa fa-microphone" aria-hidden="true"></i> Unmute Student</a></li>';
            }
            dhtml = dhtml.replace(/%UID%/g, sid);
            mutehtml = mutehtml.replace(/%UID%/g, sid);
        }
        //dhtml += '<img class="def-ava-img-student" src="' + avaUrl + '" alt="" style="display:none;"/>';
        if (isPub == 1 && (act_lesson == 1  || activity_help == 1)) {
            dhtml += '<div id="me_publisher"></div>%MUTE%';
            mutehtml = '<div class="dot-dropdown">\
            <i class="fa fa-ellipsis-v dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>\
            <ul class="dropdown-menu">\
                <li><a href="#" class="mute-myself"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Disable Video</a>\
                <a href="#" class="unmute-myself" style="display: none;"><i class="fa fa-microphone" aria-hidden="true"></i> Enable Video</a></li>\
                <li><a href="#" class="mute-audio-myself"><i class="fa fa-microphone-slash" aria-hidden="true"></i> Mute Audio</a>\
                <a href="#" class="unmute-audio-myself" style="display: none;"><i class="fa fa-microphone" aria-hidden="true"></i> Unmute Audio</a></li>\
            </ul></div>';
        }
        else if(act_lesson == 1 || activity_help == 1){
            dhtml += '<div id="' + sid + '_subscriber"></div>';
        }
       // dhtml += '<div class="name-bar"><span>' + sname.substring(0, 1) + '</span></div>'
       $('.title-name').html(sname);
        if (act_lesson == 1 || activity_help == 1) {
            dhtml += '</div><div style="margin-top:118px"><span style="font-size: 18px; font-weight: 600">' + sname + '</span></div></div>';
            dhtml = dhtml.replace('%MUTE%', isVideo ? mutehtml : '');
        }
        $('#client-avatar-section').append(dhtml);
        /*$('#client-logos').trigger('', dhtml);
        $('#client-logos').trigger('add.owl.carousel', [dhtml]);
        $('#client-logos').trigger('refresh.owl.carousel');
        var items = $('.owl-item');
        $("#client-logos").trigger("to.owl.carousel", [items.length, 1]);*/
    }
}
