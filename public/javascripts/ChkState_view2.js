function ChkState() {
    var bt = $("#next");
    bt.attr("disabled", true);
      
    var btNextState=true;
    $("input").each(function(){
        if ($(this).prop("checked")){
            btNextState=false;
        }
        });
    bt.attr("disabled",btNextState);
    };
      
$(document).ready( function() {
    ChkState();
    $("input").bind("click",function(){ ChkState(); });
});