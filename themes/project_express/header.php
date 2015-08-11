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

    <!--facebook meta value setting-->
    <meta property="fb:app_id"          content="404371153094959" />
    <meta property="og:type"            content="article" />
    <meta property="og:url"             content="<?php echo get_the_permalink(); ?>" />
    <meta property="og:title"           content="<?php wp_title( ' | ', true, 'right' ); ?>" />
    <?php
    $og_image = get_template_directory_uri()."/img/defaultImg.jpg";
    global $post;
    if(is_single() && has_post_thumbnail()){
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
        $og_image = $thumb['0'];
    }
    ?>
    <meta property="og:image"           content="<?php echo $og_image; ?>" />
    <?php
    $content_post = get_field('review', $post->ID);
    $trimmed_content = wp_trim_words( $content_post, 40, ' ...Read More' );
    ?>
    <meta property="og:description"    content="<?php echo $trimmed_content;?>" />
    <meta name="naver-site-verification" content="2d34c81d92034cfec1b0229b8d2e613ffa43244c"/>
    <meta name="google-site-verification" content="3B-23CzPIx9eKPXOx28ha5Tuvfat6NGlP42TttDLS1U" />

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rajdhani:300,700' rel='stylesheet' type='text/css'>
    <script src="<?php echo get_template_directory_uri(); ?>/css/tooltipster.css"></script>
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
        <?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?>
            <div id="header-widget" class="widget-area"  data-sticky_column>
                <ul class="xoxo">
                    <?php dynamic_sidebar( 'header-widget-area' ); ?>
                </ul>
            </div>
        <?php endif; ?>
        <span class="open"><i class="fa fa-envelope"></i> Newsletter</span>
    </header>

