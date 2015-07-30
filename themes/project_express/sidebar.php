
<div class="side pure-u-1   pure-u-md-10-24 pure-u-lg-8-24" style="display:block !important;" data-sticky_parent>


    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
        <div id="primary" class="widget-area"  data-sticky_column>
            <ul class="xoxo">
                <?php dynamic_sidebar( 'primary-widget-area' ); ?>
            </ul>
        </div>
    <?php endif; ?>
</div><!--//.side-->