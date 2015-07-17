
 $(".fb-comments").attr("data-width", $(".fb-comments").parent().width());
        $(window).on('resize', function () {
            resizeiframe();
        });

    function resizeiframe() {
        var width2 = $(".fb-comments").parent().width();

        $('.fb-comments iframe').css("width", width2);
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



