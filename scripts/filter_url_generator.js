var class_filter_tags = ['filter_condition', "course_id"];
$(document).ready(function(){
	$(".filter-group").on('click', function(event){
		var page = "filters/teacher_filter.php";
    //loop through all filter_tags and create a query using 
    var checked = {};
    for(i = 0; i < class_filter_tags.length; i++){
    	var filter_tag = class_filter_tags[i];
    	$("."+filter_tag+":checked").each(function() {
    		checked[filter_tag] = $(this).val();
	    });
    }

    var flag = true;
    for (filter in checked) {
    	if (flag) {
    		page += "?"+filter+"="+checked[filter];
            flag = false;
        }
    	else
    		page += "&"+filter+"="+checked[filter];
    }
    console.log(page);
    refreshChart(page, "pie_chart")
});
});



