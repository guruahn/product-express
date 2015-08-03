<?php
/**
 * Iframe View Template
 *
 * Template Name: Iframe View
 *
 * @package    Product Express
 * @copyright  2015 userstorylab
 * @version    1.0
 */
?>
<?php get_header(); ?>

<?php

$post_id = $_GET['id'];
$query = array(
    'post_type'           => 'post',
    'p'      => $post_id,
);
$blog_posts = new WP_Query( $query );

?>


    <div class="container iframe">
        <style>
            body { overflow: hidden; position: relative;}
            header { display: none; }
            footer {display: none !important;}
        </style>
        <?php if ( $blog_posts->have_posts() ) :
            // Start the loop.

            while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                $link = get_field('link');
            ?>
                <div id="fixed-header">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2>Product Express</h2></a>

                    <div class="comments"><a href="<?php echo get_permalink();?>"><i class="fa fa-comment"></i> 댓글 <span class="fb-comments-count" data-href="<?php echo get_permalink();?>"></span>개</a> <span class="spacer">/</span>

                    <div class="fb-like" data-href="<?php echo get_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                    </div>
                </div>
                <div id="view" style=""><iframe  src="<?php echo $link;?>" class="iframeView" frameborder="0"></iframe></div>

            <?php
            endwhile;
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>


    </div>










<?php get_footer(); ?>