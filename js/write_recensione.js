$(document).ready(function(){
    $(".fa").click(function(){
        if( $(this).hasClass("star")){
            $(this).css("color", "black");
        }
        else{
            $("star").removeClass("star");
            $(this).addClass("star");
            $(this).css("color", "orange");
        }
    });
});