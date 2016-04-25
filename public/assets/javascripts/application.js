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
        success: function(data, dataType) {
            if(data !== '') {
                alert(data);
            } else {
                toggledStatus(objClicked);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){alert(errorThrown.message);}
    });
    return false;
}

function toggledStatus(objClicked) {
    var objNotClickd;
    var retStatus;
    if(objClicked.hasClass('btn-attendance')) {
        objNotClickd = $('.btn-absence');
    } else {
        objNotClickd = $('.btn-attendance');
    }
    if(objClicked.hasClass('btn-default')) {
        objClicked.removeClass('btn-default');
        objClicked.addClass('btn-primary');
        if(objNotClickd.hasClass('btn-primary')) {
            objNotClickd.removeClass('btn-primary');
            objNotClickd.addClass('btn-default');
        }
    } else {
        objClicked.removeClass('btn-primary');
        objClicked.addClass('btn-default');
    }
}

function getStatus(objClicked) {
    
    // 更新前なので逆
    if(objClicked.hasClass('btn-attendance') && objClicked.hasClass('btn-default')) {
        retStatus = '1';
    } else if (objClicked.hasClass('btn-absence') && objClicked.hasClass('btn-default')) {
        retStatus = '0';
    } else {
        retStatus = null;
    }
    return retStatus;
}