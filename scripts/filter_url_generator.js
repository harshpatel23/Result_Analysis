var class_filter_tags = ['filter_condition', "course_id", "batch"];


function apply_filter() {
	var page = "filters/teacher_filter.php";
		var checked = {};
		for(i = 0; i < class_filter_tags.length; i++){
			var filter_tag = class_filter_tags[i];
			$("input."+filter_tag+":checked").each(function() {
				checked[filter_tag] = $(this).val();
				console.log($(this).val());
			});
		}
		console.log("checked");
		console.log(checked);
	flag = true;
	for (filter in checked) {
		if (flag) {
			page += "?"+filter+"="+checked[filter];
			flag = false;
		}
		else
			page += "&"+filter+"="+checked[filter];
	}
	console.log(page);
	refreshChart(page, "pie_chart");
	refreshChart(page, "column_chart")
}


function change_to_checkbox(checkbox_class) {
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


function get_valid_cols(course_id) {
	$.get(
		"get_valid_cols.php",
		{"course_id": course_id},
		function(data, status) {
			data = JSON.parse(data);
			$("input.filter_condition").each(function() {
				if($(this).val() != "TOTAL"){
					if($.inArray($(this).val().toLowerCase()+"_outof_marks", data) != -1)
						$(this).prop("disabled", false);
					else
						$(this).prop("disabled", true);
				}
			});
		});
}


$(document).ready(function() {
	var course_id = $("input.course_id:checked").val();
	get_valid_cols(course_id);
	get_valid_batch(course_id);
	google.charts.setOnLoadCallback(apply_filter);
});


$(document).on("click", "input", function() {
	console.log("clicked"+$(this).val());
	if($(this).hasClass("course_id")) {
		get_valid_cols($(this).val());
		get_valid_batch($(this).val());
		$("input.filter-condition:checked").prop("checked", false);
		$(".TOTAL").prop("checked", true);
	}
	apply_filter();
});


function get_valid_batch(course_id) {
	$.ajax({
		url: "get_valid_batch.php",
		data: {"course_id": course_id},
		type: "GET",
		async: false,
		success: function(data, status) {
			$(".batch-div").empty();

			input_field = '<div class="form-check"><input class="form-check-input filter-group batch" type="radio" name="batch" id="batch_';
			checked_input_field = '<div class="form-check"><input class="form-check-input filter-group batch" type="radio" name="batch" checked id="batch_';

			for (var i=0; i<data.length; i++) {
				batch_id = data[i]["batch"];
				if(i == 0) 
					$(".batch-div").append(checked_input_field+batch_id+'" value="20'+batch_id+'"><label for="'+batch_id+'">20'+batch_id+'</label></div>');
				else
					$(".batch-div").append(input_field+batch_id+'" value="20'+batch_id+'"><label for="batch_'+batch_id+'">20'+batch_id+'</label></div>');

			}
		},
		dataType: "json"
	});
}
