<div class="article pure-u-1 pure-u-lg-3-5 l-box" >

    <div class="comment">
        <?php the_field('review'); ?>
    </div>
    <?php
    // Author bio.
    product_express_author_bio(get_current_user_id());
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
    ?>

    <div class="fb-like" data-href="<?php echo get_permalink();?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <div class="fbcomment">
        <div class="fb-comments" data-href="<?php echo get_permalink();?>" data-numposts="3" style="width:100%;" data-width="100%"></div>
    </div>
</div><!--//.article-->