function change_next (state, useclass){
    $("#next").attr("disabled", state);
    $("#next").attr("class", useclass);
};

function mark_item_onclick( item_class, item_class_to_set, current_tick_class, tick_class_to_set){

    $("." + item_class).each(function(){

        $(this).on('click', function(){

            // change state of the answer item div
            $("." + item_class_to_set).each(function(){
                $(this).attr("class", item_class);    
            });
            $(this).attr("class", item_class_to_set);

            // show the tick
            $("." + tick_class_to_set).each(function(){
                $(this).attr("class", current_tick_class);
            });
            $(this).find("." + current_tick_class).attr('class', tick_class_to_set);

            // check the input
            $("input").each(function(){
                $(this).attr("checked", false);
            });
            $("#" + (($(this).attr("id")).substr(7))).attr("checked", true);
        });
    });
}

function unblock_if_one_input_checked(button_class, btn_disabled_class, inputs) {
    change_next(true, btn_disabled_class);
    $("." + inputs).each(function(){
        $(this).on('click', function(){
            change_next(false, button_class);
        })
    });
}

function block_if_none_of_inputs_checked(input, btn){
    $(input).each(function(){
        if ($(this).attr('checked')=="checked") {
            change_next(false, btn);
        };
    });
}

function put_mark_if_input_checked(input, inputs_class, inputs_class_to_set, tick_class, tick_class_to_set){
    $(input).each(function(){
        if ($(this).attr('checked')=="checked") {
            var parentDiv = $(this).parent("." + inputs_class);
            parentDiv.attr("class", inputs_class_to_set);
            parentDiv.find("." + tick_class).attr('class', tick_class_to_set);
        };
    });   
}

$(document).ready(function(){

// отмечаем скрытые инпуты по нажанию на блок
    mark_item_onclick("answer-item-md", "answer-item-md-grey", "tick-hidden", "tick-shown");
// проверяем, нажат ли хоть один инпут и разблокирем кнопку, если да
    unblock_if_one_input_checked ("arrow-btn", "arrow-btn-disabled", "answer-item-md");
// блокируем кнопки, если ни один из инпутов не отмечен
    block_if_none_of_inputs_checked("input", "arrow-btn");
// ставим галочки и окрашиваем те блоки, инпуты которых выбраны
    put_mark_if_input_checked("input", "answer-item-md", "answer-item-md-grey", "tick-hidden", 'tick-shown');
});