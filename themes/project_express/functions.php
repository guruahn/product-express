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

function project_express_print_daily_arrow($arr_date){

    if(is_object($arr_date)) {
        if( !$arr_date->is_archive ) return;
        $arr_date = date_parse($arr_date->query_vars['year'].'-'.$arr_date->query_vars['monthnum'].'-'.$arr_date->query_vars['day']);
    }
    $str_date = $arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day'];
    $prev_daily = date_parse(date('Y/m/d', strtotime('-1 day', strtotime($str_date))));
    $next_daily = date_parse(date('Y/m/d', strtotime('+1 day', strtotime($str_date))));
    $url_prev = home_url().'?year='.$prev_daily['year'].'&monthnum='.$prev_daily['month'].'&day='.$prev_daily['day'].'&is_daily=1';
    $url_next = home_url().'?year='.$next_daily['year'].'&monthnum='.$next_daily['month'].'&day='.$next_daily['day'].'&is_daily=1';
    ?>

    <nav class="navigation post-navigation" role="navigation">
        <h2 class="screen-reader-text">_e('Daily Navigation', 'daily-archive')</h2>
        <div class="nav-links">
            <div class="nav-previous">
                <a href="<?php echo $url_prev; ?>" rel="prev"><span class="meta-nav" aria-hidden="true"><?php _e('Previous day', 'daily-archive'); ?></span> <span class="screen-reader-text"><?php _e('Previous day', 'daily-archive') ?>:</span> <span class="post-title"><?php echo date(get_option('date_format'), strtotime($prev_daily['year'].'/'.$prev_daily['month'].'/'.$prev_daily['day']));?></span>
                </a>
            </div>
            <?php
            if( $next_daily != date_parse(date('Y/m/d', strtotime('+1 day', strtotime(date('Y/m/d'))))) ){;
                ?>
                <div class="nav-next">
                    <a href="<?php echo $url_next; ?>" rel="next"><span class="meta-nav" aria-hidden="true"><?php _e('Next day', 'daily-archive') ?></span> <span class="screen-reader-text"><?php _e('Next day', 'daily-archive') ?>:</span> <span class="post-title"><?php echo date(get_option('date_format'), strtotime($next_daily['year'].'/'.$next_daily['month'].'/'.$next_daily['day']));?></span>
                    </a>
                </div>
            <?php }?>
        </div>
    </nav>
<?php
}

function project_express_archive_title($title=null){

    $title = date(get_option('date_format'), strtotime(get_query_var('year').'-'.get_query_var('monthnum').'-'.get_query_var('day')));

    return $title;
}

function project_express_custom_archive_page($args){

    $is_daily = false;
    if(isset($_GET['is_daily']) && $_GET['is_daily']) $is_daily = true;
    if(is_archive() && $is_daily){

        //일별로 보여주고 전날/다음날 버튼 출력
        $arr_date = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));
        $date_query = array(
            array(
                'year'  => $arr_date['year'],
                'month' => $arr_date['month'],
                'day'   => $arr_date['day'],
            ),
        );
        set_query_var( 'date_query', $date_query );
        add_action('loop_end','project_express_print_daily_arrow');
        add_filter('get_the_archive_title', 'project_express_archive_title');
        if($args->post_count == 0) add_filter('404_template','daily_404');
    }
}

if ( ! function_exists( 'project_express_post_thumbnail' ) ) :
    /**
     * Display an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     *
     * @since Twenty Fifteen 1.0
     */
    function project_express_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a href="<?php the_permalink(); ?>" target="_blank">
                <?php
                the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) );
                ?>
            </a>

        <?php endif; // End is_singular()
    }
endif;