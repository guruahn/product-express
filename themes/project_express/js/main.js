



$(window).ready(function(){

    $("body").addClass("move");

});



 $(".fb-like").attr("data-width", $(".fb-like").parent().width());
        $(window).on('resize', function () {
            resizeiframe();
        });

    function resizeiframe() {
        var width2 = $(".fb-like").parent().width();

        $('.fb-like iframe').css("width", width2);
    }


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



