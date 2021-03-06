
<div class="productTitle pure-u-1" ><?php the_title( sprintf( '<a href="%s" rel="bookmark" ><h3>', esc_url( get_permalink() ) ), '</h2></a>' );?></div>
<div class="info"></div>

<div class="article pure-u-1 pure-u-lg-11-12 l-box" >

    <div class="comment">
        <?php the_field('review'); ?>
    </div>
    <?php


    // Author bio.
    product_express_author_bio(get_the_author_meta('ID'));
    ?>

    <div class="comment">
        <?php the_field('review2'); ?>
    </div>
    <?php
    $writer2= get_field('writer2');
    if($writer2) :
        product_express_another_author_bio($writer2);
    endif;
    ?>

    <div class="comment">
        <?php the_field('review3'); ?>
    </div>
    <?php
    $writer3= get_field('writer3');
    if($writer3) :
        product_express_another_author_bio($writer3);
    endif;

    edit_post_link('Edit Product', '<div class="edit-link">', '</div>');
    ?>
    <div class="userComment">
        <?php
        if(is_single() && get_post_type() != 'wysijap'){
            ?>

            <div class="fb-like" data-href="<?php echo get_permalink();?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <div class="fbcomment">
                <div class="fb-comments" data-href="<?php echo get_permalink();?>" data-numposts="3" style="width:100%;" data-width="100%"></div>
            </div>
        <?php
        }elseif(get_post_type() != 'wysijap'){
            ?>
            <div class="fb-like" data-href="<?php echo get_permalink();?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            <a href="<?php echo get_permalink();?>" class="no"><i class="fa fa-comment"></i> <span class="fb-comments-count" data-href="<?php echo get_permalink();?>"></span> Comments</a>
        <?php
        }
        ?>
    </div>
</div><!--//.article-->