
function ChkState() {
    var bt = $("#next");
    bt.attr("disabled", true);

    var all_filled = true;
    $("input").each( function() {
      if ( !$(this).val() ) {
        all_filled = false;
      };
    });

    if ( all_filled ) {
      bt.attr("disabled", false);
    };
};

$(document).ready( function() {
    ChkState();
    $("input").bind("input" , function() { ChkState(); });
});