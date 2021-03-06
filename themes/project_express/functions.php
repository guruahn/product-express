<?php
add_action( 'after_setup_theme', 'project_express_setup' );
function project_express_setup()
{
    load_theme_textdomain( 'project-express', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    global $content_width;
    if ( ! isset( $content_width ) ) $content_width = 640;
    register_nav_menus(
        array( 'main-menu' => __( 'Main Menu', 'project-express' ) )
    );
}

/*modify allow html in profile description*/
remove_filter('pre_user_description', 'wp_filter_kses');

// register scripts
add_action( 'wp_enqueue_scripts', 'project_express_load_scripts' );
function project_express_load_scripts()
{
    wp_enqueue_style( 'normalize-stylesheet', get_template_directory_uri().'/css/normalize.min.css', array(), '20150717' );
    wp_enqueue_style( 'grid-stylesheet', get_template_directory_uri().'/css/grid.css', array(), '20150717' );
    wp_enqueue_style( 'main-stylesheet', get_template_directory_uri().'/css/main.css', array(), '20150717' );
    wp_enqueue_style( 'style-stylesheet', get_template_directory_uri().'/css/style.css', array(), '20150717' );
    //wp_enqueue_script( 'jquery' );
}

/**
 * Since the install of WP-Mail-SMTP we need to make sure the FROM is the same as the one specified in the plugin
 * These filters will overwrite any FROM send by other plugins.
 */
/*add_filter('wp_mail_from','custom_wp_mail_from');
function custom_wp_mail_from($email) {
    return get_option('mail_from');
}
add_filter('wp_mail_from_name','custom_wp_mail_from_name');
function custom_wp_mail_from_name($name) {
    return get_option('mail_from_name');
}*/

/*add_action( 'phpmailer_init', 'my_phpmailer_init' );
function my_phpmailer_init( PHPMailer $phpmailer ) {
    $phpmailer->Host = 'email-smtp.us-east-1.amazonaws.com';
    $phpmailer->Port = 465; // could be different
    $phpmailer->Username = 'AKIAJWHL276QUTJTXZ3A'; // if required
    $phpmailer->Password = 'AuXbYIVVB1RWM5JD/VO0ssp2iBkL3ljGKDUWl5Cb7LUz'; // if required
    $phpmailer->SMTPAuth = true; // if required
    $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value
    $phpmailer->IsSMTP();
}*/

// register Product_Express_Tags widget
include_once('widget_tags.php');
function register_product_express_tags()
{
    register_widget( 'Product_Express_Tags' );
}
add_action( 'widgets_init', 'register_product_express_tags' );


// register Product_Express_Writers widget
include_once('widget_writers.php');
function register_product_express_writers()
{
    register_widget( 'Product_Express_Writers' );
}
add_action( 'widgets_init', 'register_product_express_writers' );


add_filter( 'the_title', 'project_express_title' );
function project_express_title( $title )
{
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}


add_filter( 'wp_title', 'project_express_filter_wp_title' );
function project_express_filter_wp_title( $title )
{
    return $title . esc_attr( get_bloginfo( 'name' ) );
}

//add attributes to next link on author page
add_filter('next_posts_link_attributes', 'project_express_filter_nav_next_attr_for_author');
function project_express_filter_nav_next_attr_for_author($attr){
    if(is_author()){
        $attr .= 'class="prev" rel="prev"';
    }
    return $attr;
}

//add attributes to prev link on author page
add_filter('previous_posts_link_attributes', 'project_express_filter_nav_prev_attr_for_author');
function project_express_filter_nav_prev_attr_for_author($attr){
    if(is_author()){
        $attr .= 'class="next" rel="next"';
    }
    return $attr;
}


/**
 * Register our sidebars and widgetized areas.
 *
 */
add_action( 'widgets_init', 'header_widgets_init' );
function header_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Header Widget Area', 'project_express' ),
        'id'            => 'header-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

}


add_action( 'widgets_init', 'project_express_widgets_init' );
function project_express_widgets_init()
{
    register_sidebar( array (
    'name' => __( 'Sidebar Widget Area', 'project_express' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
}


add_action( 'widgets_init', 'project_express_footer_widgets_init' );
function project_express_footer_widgets_init()
{
    register_sidebar( array (
        'name' => __( 'Footer Widget Area', 'project_express' ),
        'id' => 'footer-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}


function project_express_custom_pings( $comment )
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter( 'get_comments_number', 'project_express_comments_number' );
function project_express_comments_number( $count )
{
    if ( !is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}

/*
 * print daily navigation
 * */
function project_express_print_daily_arrow($arr_date){
    if(is_object($arr_date)) {
        if( !$arr_date->is_archive ) return;
        $arr_date = date_parse($arr_date->query_vars['year'].'-'.$arr_date->query_vars['monthnum'].'-'.$arr_date->query_vars['day']);
    }
    $str_date = $arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day'];
    $current_date = date("F j, Y, g:i a", strtotime($str_date));
    /*preview*/
    $args1 = array(
        'posts_per_page'=> 1,
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'=>1,
        'date_query' => array(
            array(
                'column'  => 'post_date',
                'before'     => $current_date,
                'inclusive' => false,
            ),
        ),
        'orderby' => 'date',
        'order' => 'DESC',

    );
    wp_reset_query();
    $query1 = new WP_Query($args1);

    $prev_daily = '';
    $url_prev = '#';
    $title_prev = 'There are no products.';
    if($query1->have_posts()){
        $prev_daily = date_parse($query1->posts[0]->post_date);

        $url_prev = product_express_get_daily_url(date_parse($prev_daily['year'].'-'.$prev_daily['month'].'-'.$prev_daily['day']));
        $title_prev = date(get_option('date_format'), strtotime($prev_daily['year'].'/'.$prev_daily['month'].'/'.$prev_daily['day']));
    }

    /*next*/
    $str_date = strtotime('+1 day', strtotime($str_date));
    $current_date = date("F j, Y, g:i a", $str_date);
    $args2 = array(
        'posts_per_page'=> 10,
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'=>1,
        'date_query' => array(
            array(
                'column'  => 'post_date',
                'after'     => $current_date,
                'inclusive' => true,
            ),
        ),
        'orderby' => 'date',
        'order' => 'ASC',

    );
    wp_reset_query();
    $query2 = new WP_Query($args2);
    $next_daily = '';
    $url_next = '#';
    $title_next = 'There are no products.';
    if($query2->have_posts()){
        $next_daily = date_parse($query2->posts[0]->post_date);
        $url_next = product_express_get_daily_url(date_parse($next_daily['year'].'-'.$next_daily['month'].'-'.$next_daily['day']));
        $title_next = date(get_option('date_format'), strtotime($next_daily['year'].'/'.$next_daily['month'].'/'.$next_daily['day']));
    }



    ?>

    <div class="more pure-u-1" role="navigation">
        <a href="<?php echo $url_prev; ?>" class="prev" rel="prev">
            <i class="fa fa-chevron-left"></i>
            <span class="date"><?php echo $title_prev;?></span>
            <span class="text"><?php _e('Previous', 'project-express'); ?></span>
        </a>
        <a href="<?php echo $url_next; ?>" class="next" rel="next">
            <i class="fa fa-chevron-right"></i>
            <span class="date"><?php echo $title_next;?></span>
            <span class="text"><?php _e('Next', 'project-express') ?></span>
        </a>
    </div>
<?php


}

//custom archive title
function project_express_archive_title($title=null){

    $title = date(get_option('date_format'), strtotime(get_query_var('year').'-'.get_query_var('monthnum').'-'.get_query_var('day')));

    return $title;
}

if ( ! function_exists( 'project_express_custom_archive_page' ) ) :
    //
    /**
     * Collection filter/action on daily page/index.
     *
     * - archive page query setting.
     * - add daily navigation action.
     * - add archive title filter.
     * - author page query setting.
     *
     * @since Product Express 1.0
     */
    add_action('pre_get_posts', 'project_express_custom_archive_page', 1);
    function project_express_custom_archive_page($args){
        if(is_author()){

            $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
            //set_query_var( 'meta_query', $meta_query );
            global $wpdb;
            $postids = $wpdb->get_col($wpdb->prepare(
                "SELECT      ID ".
                " FROM       $wpdb->posts ".
                "WHERE       post_author = '%s'",
                $author->ID
            ));
            $postids_meta2 = $wpdb->get_col($wpdb->prepare(
                "SELECT      post_id ".
                " FROM        $wpdb->postmeta ".
                "WHERE       meta_key = 'writer2' and meta_value = %s",
                $author->ID
            ));
            $postids_meta3 = $wpdb->get_col($wpdb->prepare(
                "SELECT      post_id ".
                " FROM        $wpdb->postmeta ".
                "WHERE       meta_key = 'writer2' and meta_value = %s",
                $author->ID
            ));
            $postids = array_merge($postids, $postids_meta2);
            $postids = array_merge($postids, $postids_meta3);

            set_query_var( 'post__in', $postids );
            set_query_var( 'author_name', null);

            /*global $wp_query;
            printr($wp_query->query_vars);*/
        }else{
            if(is_page('product-view')){
                add_filter( 'show_admin_bar', '__return_false' );
            }
        }

    }
endif;

if ( ! function_exists( 'project_express_post_thumbnail' ) ) :
    /**
     * Display an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     *
     * @since Product Express 1.0
     */
    function project_express_post_thumbnail() {
        if ( post_password_required() || is_attachment() ) {
            return;
        }

        if(get_field('movie_link')){
            echo product_express_get_movie_thumbnail_by_url(get_field('movie_link'), get_the_title());

        }elseif(! has_post_thumbnail()){
            ?>
            <a href="<?php echo product_express_edit_param(get_field('link')); ?>" target="_blank" data-postid="<?php echo get_the_ID();?>">
                <img width="401" height="264" src="<?php echo get_template_directory_uri(); ?>/img/defaultImg.jpg" class="attachment-thumbnail wp-post-image" alt="default image">
            </a>
        <?php
        }else{
            ?>
            <a href="<?php echo product_express_edit_param(get_field('link')); ?>" target="_blank" data-postid="<?php echo get_the_ID();?>">
                <?php
                the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) );
                ?>
            </a>
            <?
        }
    }
endif;

if ( ! function_exists( 'product_express_author_bio' ) ) :
/**
 * Display an user info.
 *
 *
 * @since Product Express 1.0
 */
    function product_express_author_bio($user_id){

        ?>
        <div class="author <?php echo get_the_author_meta( 'nickname', $user_id ); ?>">
            <a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
                <?php
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                if ( is_plugin_active( 'metronet-profile-picture/metronet-profile-picture.php' ) ) {
                    mt_profile_img( $user_id );
                }else{
                    echo get_avatar( get_the_author_meta( 'user_email', $user_id ) );
                }
                ?>
                <span><?php echo get_the_author_meta( 'display_name', $user_id ); ?></span>
            </a>
        </div>
<?php
    }
endif;


if ( ! function_exists( 'product_express_another_author_bio' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_another_author_bio($writer){
        ?>
        <div class="author <?php echo $writer['nickname']; ?>">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( $writer['ID'] ) ) ); ?>">
                <?php
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                if ( is_plugin_active( 'metronet-profile-picture/metronet-profile-picture.php' ) ) {
                    mt_profile_img( $writer['ID'] );
                }else{
                    echo get_avatar( get_the_author_meta( 'user_email', $writer['ID'] ) );
                }
                ?>
                <span><?php echo $writer['display_name']; ?></span>
            </a>
        </div>
        <?php
    }

endif;


if ( ! function_exists( 'product_express_get_review_count' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_review_count($posts){
        $count = 0;
        foreach($posts as $post){
            $post_id = $post->ID;
            if( get_field('review',$post_id) ) $count++;
            if( get_field('review2',$post_id) ) $count++;
            if( get_field('review3',$post_id) ) $count++;
        }
        return $count;
    }

endif;


if ( ! function_exists( 'product_express_get_frame_link' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_frame_link($link){
        if(get_page_by_path( '/product-view' )) $link = get_home_url()."/product-view?id=".get_the_ID();
        return $link;
    }

endif;


if ( ! function_exists( 'product_express_get_movie_thumbnail_by_url' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_movie_thumbnail_by_url($url, $alt='', $size="hqdefault"){
        $image = '';

        if(strpos($url, 'youtu') !== false) {
            /*size option(http://stackoverflow.com/a/20542029)
            default : Normal Quality Thumbnail (120x90 pixels)
            hqdefault : High Quality Thumbnail (480x360 pixels)
            mqdefault : Medium Quality Thumbnail (320x180 pixels)
            sddefault : Standard Definition Thumbnail (640x480 pixels)
            maxresdefault : Maximum Resolution Thumbnail (1920x1080 pixels)
            */
            $youtube_id = product_express_get_youtube_id($url);
            $image = '<div class="video"><img class="attachment-thumbnail wp-post-image action" width="401" height="264" src="http://img.youtube.com/vi/' . $youtube_id . '/' . $size .'.jpg" alt="'.$alt.'"></div>';
            $image .= '<div class="popup"><i class="fa fa-times close"></i><div class="iframe_wrap"><iframe class="movie-iframe" width="560" height="315" src="https://www.youtube.com/embed/'. $youtube_id .'?wmode=transparent" frameborder="0" allowfullscreen></iframe></div></div>';
        }elseif(strpos($url, 'vimeo') !== false) {
            $vimeo_id = product_express_get_vimeo_info_by_url($url);
            $image = '<iframe src="https://player.vimeo.com/video/'.$vimeo_id.'" width="401" height="264" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }
        return $image;
    }

endif;

if ( ! function_exists( 'product_express_get_movie_iframe_by_url' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_movie_iframe_by_url($url){
        $iframe = '';

        if(strpos($url, 'youtu') !== false) {
            $youtube_id = product_express_get_youtube_id($url);
            $iframe .= '<div class="iframe_wrap"><iframe class="movie-iframe" width="100%" height="315px" src="https://www.youtube.com/embed/'. $youtube_id .'?wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';
        }elseif(strpos($url, 'vimeo') !== false) {
            $vimeo_id = product_express_get_vimeo_info_by_url($url);
            $iframe = '<iframe src="https://player.vimeo.com/video/'.$vimeo_id.'" width="100%" height="315px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        }
        return $iframe;
    }

endif;

if ( ! function_exists( 'product_express_get_vimeo_info_by_url' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_vimeo_info_by_url($vimeo){

        $url = parse_url($vimeo);
        if($url['host'] !== 'vimeo.com' &&
            $url['host'] !== 'www.vimeo.com')
            return false;
        if (preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $vimeo, $match))
        {
            $id = $match[5];
        }
        else
        {
            $id = substr($vimeo,10,strlen($url['path']));
        }
        return $id;
    }

endif;


if ( ! function_exists( 'product_express_get_youtube_id' ) ) :
    /**
     * get youtube video id from url
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_youtube_id($url)
    {
    $video_id = false;
        $url = parse_url($url);
        if (strcasecmp($url['host'], 'youtu.be') === 0)
        {
            #### (dontcare)://youtu.be/<video id>
            $video_id = substr($url['path'], 1);
        }
        elseif (strcasecmp($url['host'], 'www.youtube.com') === 0)
        {
            if (isset($url['query']))
            {
                parse_str($url['query'], $url['query']);
                if (isset($url['query']['v']))
                {
                    #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                    $video_id = $url['query']['v'];
                }
            }
            if ($video_id == false)
            {
                $url['path'] = explode('/', substr($url['path'], 1));
                if (in_array($url['path'][0], array('e', 'embed', 'v')))
                {
                    #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                    $video_id = $url['path'][1];
                }
            }
        }
        return $video_id;
    }

endif;


if ( ! function_exists( 'product_express_custom_excerpts' ) ) :
    /**
     * cutom excerpts
     *
     *
     * @since Product Express 1.0
     */

    add_action( 'save_post', 'product_express_custom_excerpts', 10, 2 );
    function product_express_custom_excerpts($post_id, $post)
    {
        $newpost = get_post( $post_id );
        if ( $newpost->post_status != 'publish' ) {
            return $post_id;
        }

        if ( !current_user_can( 'edit_post', $post_id ) )
            return $post_id;

        if ( empty( $newpost->post_excerpt ) && !empty( $newpost->post_content ) ):
            product_express_set_post_excerpt( $newpost );
            return $post_id;
        endif;

        product_express_set_post_excerpt( $newpost );

        return $post_id;
    }

    function product_express_set_post_excerpt( $post ){
        remove_action( 'save_post', 'product_express_custom_excerpts', 10, 2 );
        //첫 번째 글
        $excerpt = '<p>'.wp_trim_words(wp_strip_all_tags(get_field('review')), 100, '...').'</p>'.product_express_get_profile_img_for_feed( $post->post_author, 'excerpt' );
        //두 번째 글

        if(get_field('review2')) $excerpt .= '<p>'.wp_trim_words(wp_strip_all_tags(get_field('review2')), 100, '...').'</p>'.product_express_get_profile_img_for_feed( get_field('writer2'), 'excerpt' );
        //세 번째 글
        if(get_field('review3')) $excerpt .= '<p>'.wp_trim_words(wp_strip_all_tags(get_field('review3')), 100, '...').'</p>'.product_express_get_profile_img_for_feed( get_field('writer3'), 'excerpt' );
        //구분선
        $excerpt .= '<hr style="min-height:1px;overflow:hidden;border:none;background:#eee;margin:0 0 20px 0">';
        //링크
        if(get_field('link')) $excerpt .= '<span style="display:block; height:15px; border-top:1px solid #ddd; margin-top:15px"></span><a href="'.get_field('link').'" style="font-size:1em; color:#555; text-decoration: none; display:block; padding-bottom:10px;"  target="_blank">'.get_field('link').'</a>';
        //tags
        $excerpt .= product_express_get_tag_link();
        //app link
        $android_link = get_field('android_link');
        $ios_link = get_field('ios_link');
        if($android_link){
            $excerpt .=  '<span style="display:block; height:20px;"></span><a href="'.$android_link.'" style="display:inline-block; width:120px; height:52px; margin-right:7px; padding:0; background:url('.get_template_directory_uri().'/img/badge_android.png) no-repeat; background-size:contain;">  </a>';

        }
        if($ios_link){
            $excerpt .= '<a href="'.$ios_link.'"  style="display:inline-block; width:120px; height:52px; margin-right:10px; padding:0; background-image:url('.get_template_directory_uri().'/img/badge_ios.png);  background-size:cover" > </a>';

        }
        wp_update_post( array('ID'=>$post->ID, 'post_excerpt'=>$excerpt) );
        add_action( 'save_post', 'product_express_custom_excerpts', 10, 2 );
    }

    function product_express_get_post_type( $postData ) {

        if ( 'revision' == $postData->post_type ) {
            $parentPostData = get_post( $postData->post_parent );
            if ( null !== $parentPostData ) {
                return $parentPostData->post_type;
            } else {
                return $postData->post_type;
            }
        } else {
            return $postData->post_type;
        }

    }



endif;

if( ! function_exists( 'product_express_get_tag_link') ) :
    /*
     *
     * */
    function product_express_get_tag_link(){
        $tags = get_the_tags();
        $tag_html = '';
        foreach ( $tags as $tag ) {
            $tag_link = get_tag_link( $tag->term_id );

            $tag_html .= " <a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}' style='color:black!important;font-weight:bold; font-size:16px; padding-right: 10px; '>";
            $tag_html .= "#{$tag->name}</a> ";
        }
        return $tag_html;
    }
endif;




if ( ! function_exists( 'product_express_content_of_feed' ) ) :
    /**
     * content custom for feed
     *
     *
     * @since Product Express 1.0
     */
    function product_express_content_of_feed($content){
        $content = '';

        /**
         * thumbnail
         */
        $categories = get_the_category(get_the_ID());
        if($categories[0]->slug != "article"){
            $content .= '<div class="pe-rss-thumbnail" style="margin-top: 1em;" medium="image">';
            if(get_field('movie_link')){
                $content .= product_express_get_movie_iframe_by_url(get_field('movie_link'));
            }elseif(! has_post_thumbnail()){
                $content .= '<img style="width:100%" src="'.get_template_directory_uri().'/img/defaultImg.jpg" /> ';
            }else{
                global $post;
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                $url = $thumb['0'];
                $content .= '<img style="width:100%" src="'.$url.'" /> ';
            }
            $content .= '</div>';
        }

        /**
         * start .pe-rss-content
         */
        $content .= '<div class="pe-rss-content" style="float: left; width: 100%;">';
        $content .= get_field('review');

        //author
        $content .= product_express_get_profile_img_for_feed( get_the_author_meta('ID') );
        //writer2
        $writer2= get_field('writer2');
        if($writer2) :
            $content .= get_field('review2');
            $content .= product_express_get_profile_img_for_feed($writer2);
        endif;
        //writer3
        $writer3= get_field('writer3');
        if($writer3) :
            $content .= get_field('review3');
            $content .= product_express_get_profile_img_for_feed($writer3);
        endif;

        //link
        $content .= '<hr style="height:1px; overflow:hidden; border:none; background:#eee; margin:0 0 20px 0">';
        $content .= '<a href="'.product_express_get_frame_link(get_field('link')).'" style="font-size:0.8em; color:#999; ">'.get_field('link').'</a>';
        //tags
        $content .= '<br />';
        $tags = get_the_tags();
        $tag_html = '';
        foreach ( $tags as $tag ) {
            $tag_link = get_tag_link( $tag->term_id );

            $tag_html .= " <a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
            $tag_html .= "#{$tag->name}</a> ";
        }
        $content .= $tag_html;
        //store
        $android_link = get_field('android_link');
        $ios_link = get_field('ios_link');
        $content .= '<div style="padding-top:15px;">';
        if($android_link) $content .= '<a href="'.$android_link.'"><img src="http://pe.userstorylab.com/wp-content/themes/project_express/img/badge_android.png" style="width:100px;border:0;outline:none;text-decoration:none;min-height:auto!important" border="0" class="CToWUd"></a>';
        if($ios_link) $content .= '<a href="'.$ios_link.'"><img src="http://pe.userstorylab.com/wp-content/themes/project_express/img/badge_ios.png" style="width:100px;border:0;outline:none;text-decoration:none;min-height:auto!important" border="0" class="CToWUd"></a>';
        $content .= '</div>';

        $content .= '</div>';
        /*end .pe-rss-content*/
        return $content;
    }

    add_filter( "the_content", "product_express_content_of_feed" );
endif;


if ( ! function_exists( 'product_express_get_profile_img_for_feed' ) ) :
    /**
     * content of feed
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_profile_img_for_feed($user, $is_excerpt = ''){
        $profile_html = '';
        if(is_array($user)){
            $user_id = $user['ID'];
            $display_name = $user['display_name'];
        }else{
            $user_id = $user;
            $display_name = get_the_author_meta( 'display_name', $user_id );
        }
        $profile_post_id = absint( get_user_option( 'metronet_post_id', $user_id ) );
        $post_thumbnail_id = get_post_thumbnail_id( $profile_post_id );
        if( !$post_thumbnail_id ) return $profile_html;
        $profile_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        $profile_thumbnail_src = $profile_thumbnail_src[0];

        $profile_html = '<div class="pe-rss-profile" style="height:20px; line-height:30px; padding-bottom:30px;">';
        $profile_html .= '<img src="'.$profile_thumbnail_src.'" style="margin-right:10px;border:0;outline:none;text-decoration:none;width:40px;min-height:auto!important;border-radius:100px;min-height:auto!important" />';
        $profile_html .=  '<span style="font-size:0.9em; line-height:34px; vertical-align:top">'.$display_name.'</span></div>';

        return $profile_html;
    }

endif;

if ( ! function_exists( 'product_express_get_daily_url' ) ) :
    /**
     * return daily url
     *
     *
     * @since Product Express 1.0
     */
    function product_express_get_daily_url($arr_date_vars){
        $daily_url = home_url( '/' );
        $daily_url .= 'archives/date/'.$arr_date_vars['year'].'/'.$arr_date_vars['month'].'/'.$arr_date_vars['day'];
        return $daily_url;
    }

endif;

if ( ! function_exists( 'product_express_wp_title' ) ) :
    /**
     * filter wp_title
     *
     *
     * @since Product Express 1.0
     */
    add_filter( 'wp_title', 'product_express_wp_title', 10, 2 );
    function product_express_wp_title( $title, $sep ){
        global $product_count;
        global $product_title;
        if(is_home()){
            global $blog_posts;
            if($blog_posts->post_count > 0){
                $title = $product_title;
                if($product_count > 1) $title .= ' 외 '.($product_count -1).'건';
                $title .= ', '.get_the_date('Y년 n월 j일 '). $sep . get_bloginfo('name');
            }
        }
        if(is_archive()){
            global $wp_query;
            if($wp_query->post_count > 0) {
                $title = $product_title;
                if($product_count > 1) $title .= ' 외 '.($product_count-1).'건';
                $title .= ', '.get_the_date('Y년 n월 j일 '). $sep . get_bloginfo('name');
            }


        }
        return $title;
    }

endif;

if ( ! function_exists( 'project_express_get_the_archive_permalink' ) ) :
    /**
     * get the archive permalink
     *
     *
     * @since Product Express 1.0
     */
    function project_express_get_the_archive_permalink(){
        global $arr_date;
        $arr_date_var = $arr_date;
        if(is_single()){
            return get_the_permalink();
        }
        if(is_archive()){
            $arr_date_var = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));

        }
        return product_express_get_daily_url($arr_date_var);
    }

endif;

if ( ! function_exists( 'wpseo_canonical_home_url_fix' ) ) :
    /**
     * Simply add a trailing slash if it hasn't one
     *
     *
     * @since Product Express 1.0
     */
    function wpseo_canonical_home_url_fix( $canonical_url ) {

        return trailingslashit( $canonical_url );
    }
    add_filter( 'wpseo_canonical', 'wpseo_canonical_home_url_fix' );

endif;


if ( ! function_exists( 'project_express_get_og_image' ) ) :
    /**
     * get og:image meta value
     *
     *
     * @since Product Express 1.0
     */
    function project_express_get_og_image(){
        $og_image = get_template_directory_uri()."/img/defaultImg.jpg";
        global $post;
        if(is_single() && has_post_thumbnail()){
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
            $og_image = $thumb['0'];
        }
        if(is_archive()){
            global $wp_query;
            if($wp_query->post_count > 0){
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($wp_query->posts[0]->ID), 'thumbnail_size' );
                $og_image = $thumb['0'];
            }
        }
        if(is_home()){
            global $blog_posts;
            if($blog_posts->post_count > 0){
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($blog_posts->posts[0]->ID), 'thumbnail_size' );
                $og_image = $thumb['0'];
            }
        }
        return $og_image;
    }

endif;

if ( ! function_exists( 'product_express_edit_param' ) ) :
    /**
     * Display an user info.
     *
     *
     * @since Product Express 1.0
     */
    function product_express_edit_param($link){
        $parsed_url = parse_url($link);
        if(isset($parsed_url['query'])) {
            if(!strstr($parsed_url['query'], "ref=producthunt")) {
                $parsed_url['query'] = "ref=producthunt&".$parsed_url['query'];
            }

        }else{
            $parsed_url['query'] = "ref=producthunt";
        }
        return unparse_url($parsed_url);
    }

endif;

function unparse_url($parsed_url) {
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
    $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
    $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
    $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
    $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
    $pass     = ($user || $pass) ? "$pass@" : '';
    $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
    $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
    $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
    return "$scheme$user$pass$host$port$path$query$fragment";
}

/**
 * 변수의 구성요소를 리턴받는다.
 */
function get_printr ($var, $title = NULL, $style = NULL, $title_style = NULL) {

    if( ! $style){
        $style = "background-color:#000; color:#00ff00; padding:5px; font-size:14px; margin: 5px 0";
    }

    if( ! $title_style){
        $title_style = "color:#fff";
    }

    $dump = '';
    $dump .= '<div style="text-align: left;">';
    $dump .= "<pre style='$style'>";
    if ($title) {
        $dump .= "<strong style='{$title_style}'>{$title} :</strong> \n";
    }
    if($var === null){
        $dump .= "`null`";
    }else if($var === true){
        $dump .= "`(bool) true`";
    }else if($var === false){
        $dump .= "`(bool) false`";
    }else{
        $dump .= print_r($var, TRUE);
    }
    $dump .= '</pre>';
    $dump .= '</div>';
    return $dump;
}

/**
 * 변수의 구성요소를 출력한다.
 */
function printr ($var, $title = NULL, $style = NULL, $title_style = NULL) {
    $dump = get_printr($var, $title, $style, $title_style);
    echo $dump;
}

/**
 * 변수의 구성요소를 출력하고 멈춘다.
 */
function printr2 ($var, $title = NULL, $style = NULL, $title_style = NULL) {
    printr($var, $title,  $style, $title_style);
    exit;
}

/**
 * printr은 임시로 쓰고 지우는 놈인데 이놈은 코드 안에 남겨 둘 생각으로 만든 놈.
 * @param $var
 * @param null $title
 */
function debug_print($var, $title = NULL)
{
    $style = "background-color: #ddd; color: #000; padding: 5px; font-size: 14px; margin: 5px 0";
    $title_style = "color: darkred;";
    printr($var, $title, $style, $title_style);
}

function get_debug_print($var, $title = NULL)
{
    $style = "background-color: #ddd; color: #000; padding: 5px; font-size: 14px; margin: 5px 0";
    $title_style = "color: darkred;";
    return get_printr($var, $title, $style, $title_style);
}

function is_localhost(){
    $whitelist = array(
        '127.0.0.1',
        '::1',
        'localhost'
    );
    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        return false;
    }else{
        return true;
    }
}