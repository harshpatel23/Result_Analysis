$.get(
    "/final_analysis/total.php",
    function(data,status,xhr){
        // stop loading
        $(".loader").remove();

        $('#total td').eq(0).html(data["total"]["male"]);
        $('#total td').eq(1).html(data["total"]["female"]);

        $('#minority td').eq(0).html(data["minority"]["male"]);
        $('#minority td').eq(1).html(data["minority"]["female"]);

        for (var i = 0; i < data["grade-point"].length; i++) {
            $("#grade-point td").eq(2*i).html(data["grade-point"][i]["male"]);
            $("#grade-point td").eq(2*i+1).html(data["grade-point"][i]["female"]);
        }
    },
    "json"
);