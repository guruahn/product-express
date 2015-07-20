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

// register Product_Express_Tags widget
include_once('widget_tags.php');
function register_product_express_tags() {
    register_widget( 'Product_Express_Tags' );
}
add_action( 'widgets_init', 'register_product_express_tags' );

// register Product_Express_Writers widget
include_once('widget_writers.php');
function register_product_express_writers() {
    register_widget( 'Product_Express_Writers' );
}
add_action( 'widgets_init', 'register_product_express_writers' );

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

    <div class="more pure-u-1" role="navigation">
        <a href="<?php echo $url_prev; ?>" class="prev" rel="prev">
            <i class="fa fa-chevron-left"></i>
            <span class="date"><?php echo date(get_option('date_format'), strtotime($prev_daily['year'].'/'.$prev_daily['month'].'/'.$prev_daily['day']));?></span>
            <span class="text"><?php _e('Previous day', 'project-express'); ?></span>
        </a>
        <?php
        if( $next_daily != date_parse(date('Y/m/d', strtotime('+1 day', strtotime(date('Y/m/d'))))) ){;
        ?>
        <a href="<?php echo $url_next; ?>" class="next" rel="next">
            <i class="fa fa-chevron-right"></i>
            <span class="date"><?php echo date(get_option('date_format'), strtotime($next_daily['year'].'/'.$next_daily['month'].'/'.$next_daily['day']));?></span>
            <span class="text"><?php _e('Next day', 'project-express') ?></span>
        </a>
        <?php
        }
        ?>
    </div>
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
     * @since Product Express 1.0
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

if ( ! function_exists( 'product_express_author_bio' ) ) :
/**
 * Display an user info.
 *
 *
 * @since Product Express 1.0
 */
    function product_express_author_bio($user_id){
        $avatar = get_avatar( get_the_author_meta( 'user_email', $user_id ) );
        ?>
        <div class="author <?php echo get_the_author_meta( 'nickname', $user_id ); ?>">
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( $user_id ) ) ); ?>">
                <?php echo $avatar; ?>
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
                <?php echo $writer['user_avatar']; ?>
                <span><?php echo $writer['display_name']; ?></span>
            </a>
        </div>
        <?php
    }

endif;

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