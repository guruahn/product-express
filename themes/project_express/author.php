<?php get_header(); ?>
    <div class="container pure-g" data-sticky_parent>
        <div class="pure-u-1    pure-u-md-20-24  pure-u-lg-16-24   content pure-u-1">
            <!-- 본문 영역 시작 -->
            <div class="pure-g" >



                <?php
                if ( have_posts() ) :
                    ?>
                    <div class="date pure-u-1" >
                        <?php _e( 'Author Archives', 'project_express' ); ?>: <?php the_author_link(); ?>
                        <?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<span class="archive-meta"><small>' . get_the_author_meta( 'user_description' ) . '</small></span>' ); ?>
                    </div>

                    <?php rewind_posts(); ?>
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