<?php

//Query setup
$query = array(
    //'post_type'           => 'post',
    'posts_per_page'      => 100,
);
$add = 0;$loop = true;
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

$daily_url = product_express_get_daily_url($arr_date);
?>

<?php get_header(); ?>




<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1    pure-u-md-14-24  pure-u-lg-16-24   content pure-u-1">

        <!-- 본문 영역 시작 -->
        <div class="pure-g" >
            <?php //printr($blog_posts);?>
            <?php if ( $blog_posts->have_posts() ) : ?>
            <!-- 날짜 표기 -->
            <div class="date pure-u-1" >
                <a href="<?php echo $daily_url;?>">
                    <?php echo date(get_option('date_format'), strtotime($arr_date['year'].'-'.$arr_date['month'].'-'.$arr_date['day']));?>
                </a>
                <span class="desc">
                    <span class="product-count">
                        <?php echo $blog_posts->post_count; ?>
                    </span>건의 서비스,
                    <span class="review-count">
                        <?php echo product_express_get_review_count($blog_posts->posts); ?>
                    </span>건의 평가.
                </span>
                <div class="permalink">
                    <div class="link"><a href="<?php echo project_express_get_the_archive_permalink(); ?>"><i class="fa fa-link"></i> URL</a></div>
                    <?
                    //echo '<input  type="hidden"  id="toClipboard" value="'. project_express_get_the_archive_permalink().'"/>';
                    ?>
                </div>
            </div>
            <?php
            // Start the loop.
            $articles = [];
            while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
                $categories = get_the_category(get_the_ID());
                if($categories[0]->slug == "article"){
                    $articles[] = get_post();
                }else{
                    /*왼쪽 썸네일, URL등 정보*/
                    get_template_part( 'entry', 'info' );
                    /*평가, 코멘트 등*/
                    get_template_part( 'entry', 'product' );
                }


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

            <?php
            if($articles) :
            ?>
                <!-- article section -->
                <div class="sectionSpace"></div>
                <div class="articleSection date pure-u-1" >
                    <a href="#">
                        Article
                    </a>
                    <span class="desc">
                        읽어볼만한 제품 리뷰를 소개합니다.
                    </span>
                </div>
                <?php
                global $post;
                foreach($articles as $post) :
                    setup_postdata( $post );
                    get_template_part( 'entry', 'article' );

                endforeach;
                ?>

            <?php
            endif;
            ?>
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