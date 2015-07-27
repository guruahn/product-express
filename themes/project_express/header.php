<!doctype html>
<!--
  _  _  _  _      _ __   _      _  _  _  _  _
 /_//_// // | / // `/   /_`\ / /_//_//_`/_`/_`
/  / \/_//_.'/_//_,/   /_, /'\/  / \/_,._/._/
==============================================
-->
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rajdhani:300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

    <?php wp_head(); ?>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
    <!--<![endif]-->

    <!--[if lt IE 9]>
    <script src="js/vendor/html5-3.6-respond-1.4.2.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.4&appId=404371153094959";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <header>
        <p class="desc"><?php bloginfo( 'description' ); ?></p>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'project_express' ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></h1>
        <div class="pure-form request">
            <a href="#" class="action">의뢰하기 <i class="fa fa-paper-plane"></i></a>
            <p>솔직한 서비스 리뷰가 필요하신가요? 프로덕트 익스프레스에 연락해 주세요!</p>
        </div>


    </header>

