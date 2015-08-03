<?php get_header(); ?>
<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1     pure-u-md-14-24  pure-u-lg-16-24  content pure-u-1">
        <!-- 본문 영역 시작 -->
        <div class="pure-g" >
            <?php
            //echo phpinfo();
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */
                    /*왼쪽 썸네일, URL등 정보*/
                    get_template_part( 'entry', 'info' );
                    /*평가, 코멘트 등*/
                    get_template_part( 'entry', 'article' );

                    // End the loop.
                endwhile;
            ?>

            <hr />
            <?php
            else :
            get_template_part( 'content', 'none' );

            endif;
            ?>
            <!-- 프로덕 소개 끝 이후 반복 -->
        </div>
    </div><!--//.content-->
    <?php
    get_template_part( 'sidebar' );
    ?>
</div>

<?php get_footer(); ?>