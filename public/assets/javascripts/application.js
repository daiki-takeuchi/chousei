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
