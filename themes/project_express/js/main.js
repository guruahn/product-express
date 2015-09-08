


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
    requestResultPopup();
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

$(".close, .confirm").click(function(e) {
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


/*
*
* functions
*
*/

function requestResultPopup(){
    var url = window.location.href;
    var hashes = url.split('#');
    var is_ok = false;
    //var is_fail = false;
    if(hashes.length > 1) {
        for (var i = 1; i < hashes.length; i++) {
            if(hashes[i] == "request_ok") is_ok = true;
            //if(hashes[i] == "requset_fail") is_fail = true;
        }
    }
    if(is_ok){
        $(".popup.requestResult").addClass("move");
        $("body").addClass("fix");
        setTimeout(function(){
            $(".hi-icon, .popup.requestResult .msg").addClass("move");
        }, 100);
    }
}

//Get hash tags by URL
function getHashParams() {

    var hashParams = {};
    var e,
        a = /\+/g,  // Regex for replacing addition symbol with a space
        r = /([^&;=]+)=?([^&;]*)/g,
        d = function (s) { return decodeURIComponent(s.replace(a, " ")); },
        q = window.location.hash.substring(1);

    while (e = r.exec(q))
        hashParams[d(e[1])] = d(e[2]);

    return hashParams;
}