function apply_filter() {
	var class_filter_tags = ['filter_condition', "course_id"];
	var page = "filters/teacher_filter.php";
		var checked = {};
		for(i = 0; i < class_filter_tags.length; i++){
			var filter_tag = class_filter_tags[i];
			$("."+filter_tag+":checked").each(function() {
				console.log($(this).val());
				checked[filter_tag] = $(this).val();
			});
		}

	flag = true;
	for (filter in checked) {
		if (flag) {
			page += "?"+filter+"="+checked[filter];
			flag = false;
		}
		else
			page += "&"+filter+"="+checked[filter];
	}
	refreshChart(page, "pie_chart");
}

function toggle_filters() {

}

$(document).ready(function(){
	google.charts.setOnLoadCallback(apply_filter);
});

$(".filter-group").click(function() {
		apply_filter();
});
