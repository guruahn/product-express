
<div class="side pure-u-1   pure-u-md-10-24 pure-u-lg-8-24" data-sticky_column>




    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
        <div id="primary" class="widget-area">
            <ul class="xoxo">
                <?php dynamic_sidebar( 'primary-widget-area' ); ?>
            </ul>
        </div>
    <?php endif; ?>
</div><!--//.side-->