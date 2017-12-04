$(document).ready(function() {
$('.main_teaser').fadeIn(10);
$("i[name='btnMenu'").click(function(){
    if($("i[name='btnMenu'").hasClass("fa fa-times")){
        $("i[name='btnMenu'").attr('class','fa fa-bars');
        $(".navbar").css("background-color","transparent");
    }else{
        $("i[name='btnMenu'").attr('class','fa fa-times');
        $(".navbar").css("background-color","#f1ece6");
    }
});

$(window).resize(function() {
    if($(window).width() > 770){
        if($(".navbar").css("background-color","transparent")){
            $(".navbar").css("background-color","#f1ece6");
        }
    }

});
})
