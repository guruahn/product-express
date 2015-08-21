<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) { ?>
    <div class="more pure-u-1" role="navigation">
        <?php previous_posts_link('<i class="fa fa-chevron-left"></i><span class="date">Next</span>' ) ?>
        <?php next_posts_link('<i class="fa fa-chevron-right"></i><span class="date">Prev</span>' ) ?>
    </div>
<?php } ?>

