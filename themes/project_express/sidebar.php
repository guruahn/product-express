
<div class="side pure-u-1   pure-u-md-10-24 pure-u-lg-8-24" data-sticky_column>
    <div class="Email">
        <h4>PRODUCT EXPRESS의 글을 구독하세요!</h4>
        <form class="pure-form email">
            <input type="text" class="pure-input-rounded" placeholder="E-MAIL 주소를 입력해 주세요."><button type="submit" class="pure-button"><i class="fa fa-envelope"></i></button>
        </form>



    </div>



    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
        <div id="primary" class="widget-area">
            <ul class="xoxo">
                <?php dynamic_sidebar( 'primary-widget-area' ); ?>
            </ul>
        </div>
    <?php endif; ?>
</div><!--//.side-->