


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

