function pluginExists(pluginName) {
    return $.fn[pluginName] != undefined;
}

$(function () {
    /*-- カレンダー --*/
    if (!pluginExists("datepicker")) {
        return;
    }

    $('.input-group.date').datepicker({
        format: "yyyy/mm/dd",
        startDate: "today",
        language: "ja",
        autoclose: true,
        todayHighlight: true
    });
});

$(function () {
    /*-- 時間リスト --*/
    if (!pluginExists("clockpicker")) {
        return;
    }

    $('.clockpicker').clockpicker({
        autoclose: true
    });
});

var MessageBox = (function() {
    "use strict";

    var elem,
        hideHandler,
        that = {};

    that.init = function(options) {
        elem = $(options.selector);
    };

    that.show = function(text) {
        clearTimeout(hideHandler);

        elem.find("span").html(text);
        elem.delay(200).fadeIn().delay(4000).fadeOut();
    };

    return that;
}());

$(function () {
    MessageBox.init({
        "selector": ".bb-alert"
    });
});

$(function () {

    $('.delete-alert').click(function (e) {
        bootbox.dialog({
            message: "削除してよろしいですか？",
            buttons: {
                cancel: {
                    label: "キャンセル",
                    className: "btn-default"
                },
                delete: {
                    label: "削除",
                    className: "btn-danger delete",
                    callback: function() {
                        window.location.href = $(e.target).data('href');
                    }
                }
            }
        });
    });
});

$(function () {

    $('.btn-attendance').click(function (e) {
        updateStatus($(this));
    });

    $('.btn-absence').click(function (e) {
        updateStatus($(this));
    });
});

function updateStatus(objClicked) {
    var objPanel = objClicked.parent().parent();
    var url = location.href;
    url = url.substring(0, url.indexOf('events')) + 'events/update_status';
    var status = getStatus(objClicked);
    var data = {
            event_id: objPanel.attr('id'),
            status: status
            };
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function(data, dataType) {
            if(data.message === '') {
                objPanel.find('.panel-body p.remain').text('募集 : ' + data.number_of_people + '\u00a0\u00a0|\u00a0\u00a0残り : ' + data.remain);
                toggledStatus(objClicked);
            } else {
                objPanel.find('.panel-body p.remain').text('募集 : ' + data.number_of_people + '\u00a0\u00a0|\u00a0\u00a0残り : ' + data.remain);
                MessageBox.show(data.message);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){MessageBox.show(errorThrown.message);}
    });
    return false;
}

function toggledStatus(objClicked) {
    var objNotClicked;
    if(objClicked.hasClass('btn-attendance')) {
        objNotClicked = $('.btn-absence');
    } else {
        objNotClicked = $('.btn-attendance');
    }
    if(objClicked.hasClass('btn-default')) {
        objClicked.removeClass('btn-default');
        objClicked.addClass('btn-primary');
        if(objNotClicked.hasClass('btn-primary')) {
            objNotClicked.removeClass('btn-primary');
            objNotClicked.addClass('btn-default');
        }
    } else {
        objClicked.removeClass('btn-primary');
        objClicked.addClass('btn-default');
    }
}

function getStatus(objClicked) {
    var retStatus;
    // 更新前なので逆
    if(objClicked.hasClass('btn-attendance') && objClicked.hasClass('btn-default')) {
        retStatus = '1';
    } else if (objClicked.hasClass('btn-absence') && objClicked.hasClass('btn-default')) {
        retStatus = '2';
    } else {
        retStatus = '0';
    }
    return retStatus;
}

$(function () {
    var spinner_input = $('.spinner input');
    $('.spinner .btn:first-of-type').on('click', function () {
        spinner_input.val(parseInt(spinner_input.val(), 10) + 1);
    });
    $('.spinner .btn:last-of-type').on('click', function () {
        spinner_input.val(parseInt(spinner_input.val(), 10) - 1);
    });
});

function userSelect() {
    bootbox.dialog({
            title: "参加者を選んで下さい",
            message: '<script>getUsers();</script> ' +
            '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form class="form-horizontal"> ' +
            '<div class="form-group"> ' +
            '<div class="col-md-4" id="users"> ' +
            '</div> ' +
            '</div> ' +
            '</form> </div>  </div>',
            buttons: {
                success: {
                    label: "追加",
                    className: "btn-success",
                    callback: function () {
                        $("input[name='name']:checkbox:checked").each(function () {
                            var elmAttendee = $("#attendee");
                            if (elmAttendee.text().indexOf($(this).val()) == -1) {
                                var attendee = '<p class="small">' + $(this).val() + ' => 未回答</p>' +
                                    '<input type="hidden" name="invite_users[]" value="' + $(this).attr("id") + '">';
                                elmAttendee.append(attendee);
                            }
                        });
                    }
                }
            }
        }
    );
}

function getUsers() {
    var url = location.href;
    url = url.substring(0, url.indexOf('events')) + 'users/get_users_ajax';

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        success: function(data, dataType) {
            var user;
            for(var i in data){
                user = '<div class="checkbox"> ' +
                    '<label for="' + data[i].id + '"> ' +
                    '<input type="checkbox" name="name" id="' + data[i].id + '" value="' + data[i].name + '"> ' + data[i].name + ' </label> ' +
                    '</div>';
                $("#users").append(user);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){MessageBox.show(errorThrown.message);}
    });
    return false;
}