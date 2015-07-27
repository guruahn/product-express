



$(window).ready(function(){

    $("body").addClass("move");

});




	$("header").addClass("fix");



$( ".pure-form.email input" ).focus(function() {
  $( ".pure-form.email").addClass("move");
});


$(".request .action").click(function() {
	$(".popup").addClass("move");
	$("body").addClass("fix");
});



$(".popup .close").click(function() {
	$(".popup").removeClass("move");
	$("body").removeClass("fix");
});





var inview = new Waypoint.Inview({
    element: $('.copyright')[0],
    enter: function(direction) {
        $( ".copyright" ).addClass( "move" );
    },
    exited: function(direction) {
        $( ".copyright" ).removeClass( "move" );
    },
})

