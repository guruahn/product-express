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


    <div class="container" data-sticky_parent>
        <style>
            body { overflow: hidden; position: relative;}
            header { display: none; }
            #view { width: 100%; height: 100%}
            #view iframe {
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }
            #fixed-header { position: fixed; bottom: 0; height: 50px; width: 100%; background-color: #555555;}

        </style>
        <?php if ( $blog_posts->have_posts() ) :
            // Start the loop.

            while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                $link = get_field('link');
            ?>
                <div id="fixed-header">
                    <h2>Product Express</h2>
                    <div class="fb-like" data-href="<?php echo get_permalink();?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                    <p>좋아요 <span class="fb-comments-count" data-href="<?php echo get_permalink();?>"></span>명</p>
                </div>
                <div id="view" style=""><iframe  src="<?php echo $link;?>" frameborder="0"></iframe></div>

            <?php
            endwhile;
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>


    </div>










<?php get_footer(); ?>