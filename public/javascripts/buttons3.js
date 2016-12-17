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
            // если у этого бокса в наследниках есть input type number, то показать этот инпут, увеличить размер бокса, 
            // отметить его серым

            $("input").each(function(){
                $(this).attr("checked", false);
            });
            $("#" + (($(this).attr("id")).substr(7))).attr("checked", true);

        });
    });
}

function unlock_next_if_one_input_checked(button_class, btn_disabled_class, inputs) {
    change_next(true, btn_disabled_class);
    $("." + inputs).each(function(){
        $(this).on('click', function(){

            if ($(this).attr('id') != $("input[type = number]").parent().attr('id')){
                // удаляем значения из "другого"
                $("input[type = number]").val('');
                change_next(false, button_class);    
            } else {
                change_next(true, btn_disabled_class);
            }
        });
    });
}


function other_field_show_or_hide (inputs, other_answer_class, input_other) {
    
    $("." + inputs).each(function(){
        $(this).on('click', function(){
            // если оно не отмечено - скрыть инпут
            if ($(this).children("." + other_answer_class).html() == 98 ){
                $(this).children("." + input_other).css("display", 'inline-block');
                $(this).css("width", "400px");
            
            } else {
                $("." + other_answer_class).parent().find(".input-other").hide();
                $("." + other_answer_class).parent().css('width', '200px');
            }

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

        // for other button

        if ($('input[type = number]').val()){
            var parentDiv = $('input[type = number]').parent("." + inputs_class);
            parentDiv.attr("class", inputs_class_to_set);
            parentDiv.find("." + tick_class).attr('class', tick_class_to_set);
            parentDiv.css('width', '400px');
            $('input[type = number]').css('display', 'inline-block');
        };

    });   
}


function unblock_next_if_textfield_full(btn){
    if ($('input[type = number]').val()){
        change_next(false, btn);
    };

    $("input[type = number]").on ('focusout', function(){
        if ($('input[type = number]').val()){
            // alert("there is a value");
            $("#next").attr("disabled", false);
            $("#next").attr("class", "arrow-btn");
        } else {
            // alert("there is no value");
            $("#next").attr("disabled", true);
            $("#next").attr("class", "arrow-btn-disabled");
        };
    }); 
}



$(document).ready(function(){

// отмечаем скрытые инпуты по нажанию на блок
    mark_item_onclick("answer-item-sm-1col", "answer-item-sm-1col-grey", "tick-hidden", "tick-shown");
// проверяем, нажат ли хоть один инпут и разблокирем кнопку, если да
    unlock_next_if_one_input_checked ("arrow-btn", "arrow-btn-disabled", "answer-item-sm-1col");
// если необходимо - скрываем или показываем поля в "Другом"
    other_field_show_or_hide ("answer-item-sm-1col", "answer-num-grey", "input-other");
// блокируем кнопки, если ни один из инпутов не отмечен
    block_if_none_of_inputs_checked("input", "arrow-btn");
// ставим галочки и окрашиваем те блоки, инпуты которых выбраны

    put_mark_if_input_checked("input", "answer-item-sm-1col", "answer-item-sm-1col-grey", "tick-hidden", 'tick-shown');
// если есть кнопка "другое", и она нажата, то проверить есть ли в ее поле ответ и только тогда активировать кнопку "далее"
// когда отмечают какое-либо еще поле, кроме кнопки "другое" - удалить значение из кнопки "другое"
   unblock_next_if_textfield_full("arrow-btn");
   
});