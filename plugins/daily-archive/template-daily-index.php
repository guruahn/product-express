<?php
/**
 * Daily Page Template
 *
 * Template Name: Daily Page
 *
 * @package    Daily
 * @copyright  2015 Daily - guruahn
 * @version    1.0
 */
?>

<?php
get_header();


?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php if ( $blog_posts->have_posts() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php echo date(get_option('date_format'), strtotime($arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day']));?></h1>
                </header>

                <?php
                // Start the loop.

                while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'content', get_post_format() );

                    // End the loop.
                endwhile;


            // If no content, include the "No posts found" template.
            else :
                get_template_part( 'content', 'none' );

            endif;
            daily_print_daily_arrow($arr_date);
            ?>

        </main><!-- .site-main -->
    </section><!-- .content-area -->

<?php get_footer(); ?>