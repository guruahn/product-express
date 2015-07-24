<?php
if(is_single()) :
    ?>
    <div class="date pure-u-1" ><?php the_title( sprintf( '<a href="%s" rel="bookmark" target="_blank"><h3>', esc_url( get_permalink() ) ), '</h2></a>' );?></div>
<?php
endif;
?>
<div class="info pure-u-1 pure-u-lg-2-5 l-box">
    <ul>
        <li class="image">
            <?php project_express_post_thumbnail(); ?>
        </li>
        <li class="title">
            <?php
            if ( !is_single() ) :
                the_title( sprintf( '<a href="%s" rel="bookmark" target="_blank"><h3>', esc_url( get_permalink() ) ), '</h2></a>' );
            endif;
            ?>
        </li>
        <?php
        $link = get_field('link');
        if(get_page_by_path( '/product-view' )) $link = get_home_url()."/product-view?id=".get_the_ID();
        ?>
        <li class="url"><a href="<?php echo $link; ?>" target="_blank"><?php the_field('link'); ?></a></li>
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