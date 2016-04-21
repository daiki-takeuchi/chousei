function pluginExists(pluginName){
	return $.fn[pluginName] != undefined;
}

$(function(){
	/*-- カレンダー --*/
	if(! pluginExists("datepicker")){
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

$(function(){
	/*-- 時間リスト --*/
	if(! pluginExists("timepicker")){
		return;
	}

	$('.input-group.time').click(function(e){
		e.stopPropagation();
		$(this).children('.form-control.time').timepicker({
			minTime: "8:00",
			maxTime: "7:30",
			timeFormat: "H:i",
			step: "30"
		}).timepicker('show');
	});

});
