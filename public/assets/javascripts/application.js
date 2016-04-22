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
	if(! pluginExists("clockpicker")){
		return;
	}

	$('.clockpicker').clockpicker({
		autoclose: true
	});

});