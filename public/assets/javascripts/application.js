function pluginExists(pluginName){
	return $.fn[pluginName] != undefined;
}

$(function(){
	/*-- カレンダー --*/
	if(! pluginExists("datepicker")){
		return;
	}

	$('.calendar').datepicker({
		dateFormat: 'yy/mm/dd',
	});
});

$(function(){
	/*-- 時間リスト --*/
	if(! pluginExists("timepicker")){
		return;
	}

	var tp = $('.timepicker').timepicker({'minTime': '8:00' ,'maxTime': '7:30' ,'timeFormat': 'H:i' ,'step':'30' });

	$('.tp-trigger').click(function(e){
		e.stopPropagation();
		tp.timepicker('show');
	});
});
