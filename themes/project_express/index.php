<?php get_header(); ?><!--
<section id="content" role="main">
<?php /*if ( have_posts() ) : while ( have_posts() ) : the_post(); */?>
<?php /*get_template_part( 'entry' ); */?>
<?php /*comments_template(); */?>
<?php /*endwhile; endif; */?>
<?php /*get_template_part( 'nav', 'below' ); */?>
</section>-->
<?php /*get_sidebar(); */?>

<?php

//Query setup
$query = array(
    'post_type'           => 'post',
    'posts_per_page'      => 100,
    'paged'               => 1,
    'ignore_sticky_posts' => true,
);
$add = 0;$loop = true;
$daily_year = (isset($_GET['y']) ? $_GET['y'] : '');
$daily_month = (isset($_GET['m']) ? $_GET['m'] : '');
$daily_day = (isset($_GET['d']) ? $_GET['d'] : '');

if(empty($daily_year) || empty($daily_month) || empty($daily_day) ){
    //날짜 세팅 안되있을 경우 (홈) 자동으로 최신 포스트의 날짜를 기준으로 한다.
    while($loop){
        $today = date('Y-m-d G:i:s');
        if($add !== 0 ) $today = date('Y-m-d', strtotime($add.' day', strtotime($today)));
        $date = $today;
        $arr_date = date_parse($date);
        $query['date_query'] = array(
            array(
                'year'  => $arr_date['year'],
                'month' => $arr_date['month'],
                'day'   => $arr_date['day'],
            ),
        );
        $blog_posts = new WP_Query( $query );

        if(!$blog_posts->have_posts()){
            $add -= 1;
        }else{
            $loop = false;
        }
    }
}else{
    $arr_date = date_parse($daily_year.'-'.$daily_month.'-'.$daily_day);
    $query['date_query'] = array(
        array(
            'year'  => $arr_date['year'],
            'month' => $arr_date['month'],
            'day'   => $arr_date['day'],
        ),
    );
    $blog_posts = new WP_Query( $query );

}

?>


<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1    pure-u-md-20-24  pure-u-lg-16-24   content pure-u-1">

        <!-- 본문 영역 시작 -->
        <div class="pure-g" >

            <?php if ( $blog_posts->have_posts() ) : ?>
            <!-- 날짜 표기 -->
            <div class="date pure-u-1" ><?php echo date(get_option('date_format'), strtotime($arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day']));?></div>

            <?php
            // Start the loop.

            while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                /*왼쪽 썸네일, URL등 정보*/
                get_template_part( 'entry', 'info' );
                /*평가, 코멘트 등*/
                get_template_part( 'entry', 'article' );

                // End the loop.
            endwhile;
            ?>

            <hr />
            <?php
            else :
                get_template_part( 'content', 'none' );

            endif;
            ?>
            <!-- 프로덕 소개 끝 이후 반복 -->


            <!-- 날짜 묶음 공유 -->
            <div class="dateShareBox pure-u-1">
                <h4>5월 10일의 리스트를 공유하세요.</h4>
                <p>10개의 서비스, 24개의 패널 코멘트</p>
            </div>


            <?php
            project_express_print_daily_arrow($arr_date);
            ?>


        </div>
        <!-- 본문 영역 끝 -->
    </div><!--//.content-->

    <?php
    get_template_part( 'sidebar' );
    ?>

</div>










<?php get_footer(); ?>