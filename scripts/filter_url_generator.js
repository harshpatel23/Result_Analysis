var class_filter_tags = ['filter_condition', "course_id"];
function apply_filter() {
	var page = "filters/teacher_filter.php";
		var checked = {};
		for(i = 0; i < class_filter_tags.length; i++){
			var filter_tag = class_filter_tags[i];
			$("input."+filter_tag+":checked").each(function() {
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
	refreshChart(page, "column_chart")
}

function change_to_checkbox(checkbox_class){
	mode = $("button."+checkbox_class).html();

	if(mode == 'Compare') {
		$("button."+checkbox_class).html("Cancel");
		$("input."+checkbox_class).each(function () {
			$(this).attr("type", "checkbox");
		});
	}
	else if(mode == 'Cancel') {
		$("button."+checkbox_class).html("Compare");
		$("input."+checkbox_class).each(function () {
			$(this).attr("type", "radio");
		});
	}
}

function toggle_filters(data) {
	$("input.filter_condition").each(function() {
		if($(this).val() != "TOTAL"){
			if($.inArray($(this).val().toLowerCase()+"_outof_marks", data) != -1)
				$(this).prop("disabled", false);
			else
				$(this).prop("disabled", true);
		}
	});
}

function get_valid_cols(course_id) {
	$.get(
		"get_valid_cols.php",
		{"course_id": course_id},
		function(data, status) {
			toggle_filters(JSON.parse(data));
		});
}

$(document).ready(function(){
	var course_id = $("input.course_id:checked").val();
	get_valid_cols(course_id);
	google.charts.setOnLoadCallback(apply_filter);
});

$("input.filter-group").click(function() {
	if($(this).hasClass("course_id")) {
		get_valid_cols($(this).val());
		$(".filter-condition:checked").prop("checked", false);
		$(".TOTAL").prop("checked", true);
	}
	apply_filter();
});
