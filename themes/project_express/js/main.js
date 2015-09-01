


var inview = new Waypoint.Inview({
    element: $('.copyright')[0],
    enter: function(direction) {
        $( ".copyright" ).addClass( "move" );
    },
    exited: function(direction) {
        $( ".copyright" ).removeClass( "move" );
    },
})




$(window).ready(function(){

    $("body").addClass("move");
    $( "li.image iframe" ).wrap( "<div class='videoWrapper'></div>" );

});




	$("header").addClass("fix");



$( ".pure-form.email input" ).focus(function() {
  $( ".pure-form.email").addClass("move");
});

/*request popup*/
$(".request .action").click(function() {
	$(".popup.request").addClass("move");
	$("body").addClass("fix");
});

$(".open").click(function(e) {
    $("header").toggleClass("opened");
});

$(".close").click(function(e) {
	$(".popup").removeClass("move");
	$("body").removeClass("fix");
});

/*movie popup*/
$(".image div.video").click(function(e){
    e.preventDefault();
    $(this).parent().find('.popup').addClass("move");
    $("body").removeClass("fix");

});

/*remove iframe when movie popup close*/
$(".image .close").click(function(e){
    e.preventDefault();
    $movie_iframe = $(this).parent().find('iframe')
    $(this).parent().find('iframe').remove();
    $(this).parent().find('.iframe_wrap').append($movie_iframe);
});

/*subscribe event tracking*/
$('#subscribe-button').on('click', function() {
    ga('send', 'event', 'button', 'click', 'subscribe-buttons', 1);
});