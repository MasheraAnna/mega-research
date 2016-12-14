function change_next (state, useclass){
    $("#next").attr("disabled", state);
    $("#next").attr("class", useclass);
};

$(document).ready(function(){

// нужно написать скрипт, который отмечает скрытый инпут, делает его "checked" , если респ нажал на див с ответом
$(".answer-item-sm-horisont").each(function(){
    $(this).on('click', function(){
        alert("hey1");
    });
});





// проверяем, нажат ли хоть один инпут и разблокирем кнопку, если да
    change_next(true, "arrow-btn-disabled");

    $("input").each(function(){
        $(this).on('click', function(){
            change_next(false, "arrow-btn");
        })
    });

    $("input").each(function(){
        if ($(this).attr('checked')=="checked") {
            change_next(false, "arrow-btn");
        };
    });

});