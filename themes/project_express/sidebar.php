
<div class="side pure-u-1   pure-u-md-10-24 pure-u-lg-8-24" data-sticky_parent>

    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
        <div id="primary" class="widget-area"  data-sticky_column>
            <ul class="xoxo">
                <?php dynamic_sidebar( 'primary-widget-area' ); ?>
            </ul>
        </div>
    <?php endif; ?>
	<div class="pure-form request">
		<a href="#" class="action">의뢰하기 <i class="fa fa-paper-plane"></i></a>
		<p>솔직한 서비스 리뷰가 필요하신가요? 프로덕트 익스프레스에 연락해 주세요!</p>
	</div>
</div><!--//.side-->