function answerspansfunc() {

$("#mcq").change(function () {
    removeHTMLelements();
    for (var i = 4; i > 0; i--) {
        var $elementinput = $("<span class='mcqspan'><label><b>" + i + " Mark as correct -> </b></label> <input type='radio' name='correct_ans' title='Mark as correct' value='"+i+"'/> <input type='text' name='anstext[]' class='txtinput' placeholder='Add Answer text here' value='' /><br/></span>");
       $('#attachafter').after($elementinput);
}
});

$("#truefalse").change(function () {
    removeHTMLelements();
/* 1=>True & 2=>False */
    var $elementinput = $("<span class='truefalsespan'><label><b>Select circle for right option </b></label><br/><label>True</label><input type='radio' name='correct_ans' title='Mark as correct' value='1' /><br /><label>False</label><input type='radio' name='correct_ans' title='Mark as correct' value='2' /><br/></span><br/>");
    $('#attachafter').after($elementinput);
});

$("#fillblanks").change(function () {
    removeHTMLelements();
    var $elementinput = $("<span class='fillblankspan'><label><b> Answer </b></label><input type='text' name='anstext' class='txtinput' placeholder='Add Correct Answer here' value='' /><br/></span>");
    $('#attachafter').after($elementinput);
});

function removeHTMLelements() {
    
    $('span.mcqspan').each(function(i) {                 
        $(this).delay(200*i).fadeOut(1000);
            $(this).animate({
                "opacity" : "0"
                },{
                "complete" : function() {
                      $("span").remove(".mcqspan");
                }
            });
    });
    
        $('span.truefalsespan').each(function(i) {                 
        $(this).delay(200*i).fadeOut(1000);
            $(this).animate({
                "opacity" : "0"
                },{
                "complete" : function() {
                      $("span").remove(".truefalsespan");
                }
            });
    });
    
    
        $('span.fillblankspan').each(function(i) {                 
        $(this).delay(200*i).fadeOut(1000);
            $(this).animate({
                "opacity" : "0"
                },{
                "complete" : function() {
                      $("span").remove(".fillblankspan");
                }
            });
    });
}
}
