function check_values (inputs){
    var values = [];
    inputs.each(function(){
        if ($(this).val() != false ){
            values.push($(this).val());
        };
    });
    return values; 
};

function enable_button_next (values){
    if (values.length == 3){
        $("#next").attr("disabled", false);
        $("#next").attr("class", "arrow-btn");
    };
};

$(document).ready(function(){
    $("#next").attr("disabled", true);
    $("#next").attr("class", "arrow-btn-disabled");
    var values = check_values ($("input"));
    enable_button_next (values);


    $("input").each (function(){
        $(this).on("change", function(){
            var values = check_values ($("input"));
            enable_button_next (values);
        });
    });
});