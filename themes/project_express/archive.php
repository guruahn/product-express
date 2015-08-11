<?php get_header(); ?>
<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1     pure-u-md-14-24  pure-u-lg-16-24   content pure-u-1">
        <!-- 본문 영역 시작 -->
        <div class="pure-g" >



            <?php
            global $wp_query;
            if ( have_posts() ) :
                ?>
                <div class="date pure-u-1" >

                    <a href="<?php get_the_permalink(); ?>">
                        <?php
                        the_archive_title();
                        ?> 
                    </a>

                    <span class="desc"><span class="product-count"><?php echo $wp_query->post_count; ?></span>건의 서비스, <span class="review-count"><?php echo product_express_get_review_count($wp_query->posts); ?></span>건의 평가.</span>
              
                    <div class="permalink">
                        <a href="<?php get_the_permalink(); ?>">
                            <div class="link"><i class="fa fa-link"></i> URL</div>
                        </a>
                    </div>
                </div>
                <?php
                while ( have_posts() ) : the_post(); ?>
                <?php
                    /*왼쪽 썸네일, URL등 정보*/
                    get_template_part( 'entry', 'info' );
                    /*평가, 코멘트 등*/
                    get_template_part( 'entry', 'article' );
                ?>
                <?php
                endwhile;
            endif;
            ?>
            <?php get_template_part( 'nav', 'below' ); ?>
        </div>
    </div><!--//.content-->
    <?php
    get_template_part( 'sidebar' );
    ?>
</div>
<?php get_footer(); ?>