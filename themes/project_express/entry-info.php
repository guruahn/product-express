
    <div class="productTitle pure-u-1" ><?php the_title( sprintf( '<a href="%s" rel="bookmark" target="_blank"><h3>', esc_url( get_permalink() ) ), '</h2></a>' );?></div>

<div class="info pure-u-1 pure-u-lg-2-5 l-box">
    <ul>
        <li class="image">
            <?php project_express_post_thumbnail(); ?>
        </li>
        <!-- li class="title">
            <?php
            if ( !is_single() ) :
                the_title( sprintf( '<a href="%s" rel="bookmark" target="_blank"><h3>', esc_url( get_permalink() ) ), '</h2></a>' );
            endif;
            ?>
        </li -->
        <li class="url"><a href="<?php the_field('link'); ?>" target="_blank"><?php the_field('link'); ?></a></li>
        <li class="tag"><?php the_tags('#', ' #'); ?></li>

    </ul>
    <br><br>
    <div class="shareBox">
        <!-- span>Recommend &amp; Share this review</span -->
        <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/badge_ios.png" style="width:100px; height:auto;"></a>
        <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/badge_android.png" style="width:100px; height:auto;"></a>
    </div>
</div><!--//.info-->