<div class="info pure-u-1 pure-u-lg-2-5 l-box">
    <ul>
        <li class="image">
            <?php project_express_post_thumbnail(); ?>
        </li>
        <li class="title">
            <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( sprintf( '<a href="%s" rel="bookmark" target="_blank"><h3>', esc_url( get_permalink() ) ), '</h2></a>' );
            endif;
            ?>
        </li>
        <li class="url"><a href="<?php the_field('link'); ?>" target="_blank"><?php the_field('link'); ?></a></li>
        <li class="tag"><?php the_tags('#', ' #'); ?></li>

    </ul>
    <br><br>
    <div class="shareBox">
        <span>Recommend &amp; Share this review</span>
        <i class="fa fa-facebook-official fa-2x"></i>
        <i class="fa fa-twitter fa-2x"></i>
        <i class="fa fa-envelope fa-2x"></i>

    </div>
</div><!--//.info-->