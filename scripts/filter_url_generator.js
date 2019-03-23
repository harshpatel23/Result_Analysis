var class_filter_tags = ['marks_type', 'subject_id'];

$(".filter_group").on('click', function(event){
    //loop through all filter_tags and create a query using 
    for(i = 0; i < class_filter_tags.length; i++){
    	var filter_tag = class_filter_tags[i];

    	$(filter_tag).each(function() {
    		console.log($(this));
	    });
    }
});