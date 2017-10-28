$(function(){
    
    
    $(".clickable-row").click(function() {
        window.location = $(this).data("href")
    })
    
    
    $('.clickable-row').hover(function() {
        $(this).css('cursor','pointer');
    })
    
    $('#add_to_cart_btn').hover(function(){
        $(this).css('cursor','pointer')
    })
    
    $('#buy_btn').click(function(){
        console.log(JSON.parse($.cookie('cart_items_cookie')))
    })
    
    $('#buy_btn').hover(function(){
        $(this).css('cursor','pointer')
    })
})