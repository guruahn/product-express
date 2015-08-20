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
    <title><?php wp_title( ' ― ', true, 'right' ); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--facebook meta value setting-->
    <link rel="canonical" href="<?php echo project_express_get_the_archive_permalink(); ?>" />
    <meta property="fb:app_id"          content="404371153094959" />
    <meta property="og:type"            content="article" />
    <meta property="og:url"             content="<?php echo project_express_get_the_archive_permalink(); ?>" />
    <meta property="og:title"           content="<?php wp_title( ' ― ', true, 'right' ); ?>" />
    <meta property="og:image"           content="<?php echo project_express_get_og_image(); ?>" />
    <?php
    $content_post = get_field('review', $post->ID);
    $trimmed_content = wp_trim_words( $content_post, 60, ' ...Read More' );
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


    <!--START MAILPoet Scripts : this is the script part you can add to the header of your theme-->
    <script type="text/javascript" src="http://localhost:8887/wordpress/wp-includes/js/jquery/jquery.js?ver=2.6.16"></script>
    <script type="text/javascript" src="http://localhost:8887/wordpress/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-en.js?ver=2.6.16"></script>
    <script type="text/javascript" src="http://localhost:8887/wordpress/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.6.16"></script>
    <script type="text/javascript" src="http://localhost:8887/wordpress/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.16"></script>
    <script type="text/javascript">
        /* <![CDATA[ */
        var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"http://localhost:8887/wordpress/wp-admin/admin-ajax.php","loadingTrans":"Loading..."};
        /* ]]> */
    </script><script type="text/javascript" src="http://localhost:8887/wordpress/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.6.16"></script>
    <!--END MAILPoet Scripts-->


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
        <span class="open"><i class="fa fa-envelope"></i> 구독하기</span>



        <div class="widget_wysija_cont html_wysija">
            <div id="msg-form-wysija-html55d5617b76a4c-1" class="wysija-msg ajax"></div>
            <form id="form-wysija-html55d5617b76a4c-1" method="post" action="#wysija" class="widget_wysija html_wysija">
                <div class="Email">
                    <div class="pure-form email move">
                        <input type="email" name="wysija[user][email]" class="wysija-input  pure-input-rounded" title="이메일" placeholder="이메일" value="" />
                        <span class="abs-req">
                            <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
                        </span>
                        <button class="wysija-submit wysija-submit-field pure-button" type="submit" >
                            <i class="fa fa-envelope"></i>
                        </button>
                    </div>


                    <h4>PRODUCT EXPRESS의 글을 구독하세요!</h4>
                </div>
                <input type="hidden" name="form_id" value="1" />
                <input type="hidden" name="action" value="save" />
                <input type="hidden" name="controller" value="subscribers" />
                <input type="hidden" value="1" name="wysija-page" />


                <input type="hidden" name="wysija[user_list][list_ids]" value="1" />

            </form>
        </div>
    </header>

