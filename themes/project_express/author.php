<?php get_header(); ?>
    <div class="container pure-g">
        <div class="pure-u-1    pure-u-md-14-24  pure-u-lg-16-24   content pure-u-1">
            <!-- 본문 영역 시작 -->
            <div class="pure-g" >



                <?php
                if ( have_posts() ) :
                    ?>
                    <div class="authorTitle pure-u-1" >
                        <p class="profile">
                            <?php
                            $paths = explode('/',$_SERVER['REQUEST_URI']);
                            $author_slug = end($paths);
                            if(is_numeric($author_slug)){
                                prev($paths);prev($paths);
                                $author_slug = current($paths);
                            }
                            $author = get_user_by( 'slug', $author_slug );
                            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                            if ( is_plugin_active( 'metronet-profile-picture/metronet-profile-picture.php' ) ) {
                                mt_profile_img( $author->ID );
                            } else {
                                echo get_avatar( get_the_author_meta( 'user_email', $author->ID ) );
                            }
                            ?>
                            <br>
                            <?php echo $author_slug; ?></p>
                        <?php
                        if ( '' != get_the_author_meta( 'user_description' ) ) {
                            $user_description = get_the_author_meta( 'user_description', $author->ID  );
                            echo apply_filters( 'archive_meta', '<span class="archive-meta"><small>' . $user_description . '</small></span>' );
                        } ?>

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