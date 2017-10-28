$(function(){
    
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    
    
    $('.clickable-row').hover(function() {
        $(this).css('cursor','pointer');
    });
})