<?php
if(is_archive() && is_day()){
    //일별로 보여주고 전날/다음날 버튼 출력
    $arr_date = date_parse(get_query_var( 'year', '' ).'-'.get_query_var( 'monthnum', '' ).'-'.get_query_var( 'day', '' ));
    $date_query = array(
        array(
            'year'  => $arr_date['year'],
            'month' => $arr_date['month'],
            'day'   => $arr_date['day'],
        ),
    );
    $blog_posts = new WP_Query( $date_query );
    add_filter('get_the_archive_title', 'project_express_archive_title');
    $daily_url = product_express_get_daily_url($arr_date);

    global $wp_query;
    global $product_count;
    global $product_title;
    if ( have_posts() ) :
        $articles = array();
        $product = array();
        while ( have_posts() ) : the_post();
            $categories = get_the_category(get_the_ID());
            if($categories[0]->slug == "article"){
                $articles[] = get_post();
            }else{
                $product[] = get_post();
            }
        endwhile;
        $product_count = count($product);
        if(count($articles) > 0) $product_title = get_the_title($articles[0]->ID);
        if($product_count > 0) $product_title = get_the_title($product[0]->ID);
    endif;
}
?>

<?php get_header(); ?>

<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1     pure-u-md-14-24  pure-u-lg-16-24   content pure-u-1">
        <!-- 본문 영역 시작 -->
        <div class="pure-g" >



            <?php
            global $wp_query;
            if ( have_posts() ) :
                ?>

                <!-- start product section -->
                <?php
                if($product) :
                ?>

                    <div class="date pure-u-1" >

                        <a href="<?php echo project_express_get_the_archive_permalink(); ?>">
                            <?php
                            the_archive_title();
                            ?>
                        </a>

                        <span class="desc"><span class="product-count"><?php echo count($product); ?></span>건의 서비스, <span class="review-count"><?php echo product_express_get_review_count($product); ?></span>건의 평가.</span>

                        <div class="permalink">
                            <div class="link">
                                <a href="<?php echo project_express_get_the_archive_permalink(); ?>"><i class="fa fa-link"></i> URL</a>
                            </div>

                        </div>
                    </div>
                <?php
                    global $post;
                    foreach($product as $post) :
                        setup_postdata( $post );
                        /*왼쪽 썸네일, URL등 정보*/
                        get_template_part( 'entry', 'info' );
                        /*평가, 코멘트 등*/
                        get_template_part( 'entry', 'product' );
                    endforeach;
                    echo '<div class="sectionSpace"></div>';
                endif;
                ?>
                <!-- end product section -->

                <!-- start article section -->
                <?php
                if($articles) :
                    ?>
                    <div class="articleSection date pure-u-1" >
                        <a href="#">
                            Article
                        </a>
                    <span class="desc">
                        직접 쓰거나, 읽어볼만한 글을 소개합니다.
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
                <!-- end article section -->

            <?php
            endif;
            ?>
            <?php
            project_express_print_daily_arrow($arr_date);
            ?>
        </div>
    </div><!--//.content-->
    <?php
    get_template_part( 'sidebar' );
    ?>
</div>
<?php get_footer(); ?>