<?php

get_header();
printr($GLOBALS['wp_query']->request);
$arr_date = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));

?>
    <div class="container pure-g" data-sticky_parent>
        <div class="pure-u-1    pure-u-md-20-24  pure-u-lg-16-24   content pure-u-1">
            <!-- 본문 영역 시작 -->
            <div class="pure-g" >
                <div class="date pure-u-1" ><?php echo project_express_archive_title(null); ?></div>

                <div class="article pure-u-1 pure-u-lg-3-5 l-box" >

                    <p><?php _e('There are no posts.', 'project-express'); ?></p>

                </div>
            </div>
            <?php project_express_print_daily_arrow($arr_date);?>
        </div><!-- .content -->

        <?php
        get_template_part( 'sidebar' );
        ?>

    </div>

<?php

get_footer();

?>