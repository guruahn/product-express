<?php
add_action( 'after_setup_theme', 'project_express_setup' );
function project_express_setup()
{
    load_theme_textdomain( 'project_express', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    global $content_width;
    if ( ! isset( $content_width ) ) $content_width = 640;
    register_nav_menus(
        array( 'main-menu' => __( 'Main Menu', 'project_express' ) )
    );
}

function register_my_theme_styles(){
    if ( ! is_admin() ){

    }
}

add_action( 'wp_enqueue_scripts', 'project_express_load_scripts' );
function project_express_load_scripts()
{
    wp_enqueue_style( 'normalize-stylesheet', get_template_directory_uri().'/css/normalize.min.css', array(), '20150717' );
    wp_enqueue_style( 'grid-stylesheet', get_template_directory_uri().'/css/grid.css', array(), '20150717' );
    wp_enqueue_style( 'main-stylesheet', get_template_directory_uri().'/css/main.css', array(), '20150717' );
    wp_enqueue_style( 'style-stylesheet', get_template_directory_uri().'/css/style.css', array(), '20150717' );
    //wp_enqueue_script( 'jquery' );
}

add_action( 'comment_form_before', 'project_express_enqueue_comment_reply_script' );
function project_express_enqueue_comment_reply_script()
{
    if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'project_express_title' );
function project_express_title( $title ) {
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