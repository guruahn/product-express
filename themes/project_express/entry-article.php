<div class="article pure-u-1 pure-u-lg-3-5 l-box" >

    <div class="comment">
        <?php the_field('review'); ?>
    </div>
    <div class="author <?php echo get_the_author(); ?>">
        <?php
        // Author bio.
        get_template_part( 'author-bio' );
        ?>

    </div>

    <div class="comment">
        뮤직비디오를 만들어 인스타그램에 자신만의 컨텐츠를 올리는 서비스<br>
        슬로모션, 타임랩스 등이 효과등을 가미해서 제작할수 있다. <br>
        인스타그램이라는 15초 영상안에서 짧고 강렬하게 만들수 있고 (아마 저작권에도 안걸릴것 같은데..)<br>
        인스타그램에 올라온 영상들을 보니 엄청 매력적인 뮤직비디오는 없지만<br>
        동영상촬영을 통해 립싱크를 하기도 하고 한번쯤 재미삼아해보는것정도 ? <br>
    </div>
    <div class="author danb">
        <img src="<?php echo get_template_directory_uri(); ?>/img/profile_borah.jpg" > <span><a href="#_">bora.h</a></span>
    </div>

    <div class="comment">
        surkus 이벤트 및 브랜드 관련 행사에 적합한 군중들을 캐스팅 할 수 있도록 돕는 앱 입니다.<br>
        시사회, 파티, 브랜드 이벤트 등의 경우 참여 군중을 모으는 것이 쉽지가 않은데요.<br><br>

        surkus 는 이벤트에 참석하고자 하는 사람들과 군중을 모아야 하는 집단과의 연결을 돕는 중계 역할을 합니다.<br>
        이벤트에 참석할 경우 약 50달러의 돈을 지급 받을 수 있다는 것이 특징인데요. 이벤트에 따라 베니핏은 조정이 가능할 것으로 보입니다.<br><br>

        참여자의 경우 좋아하는 지역 행사에 참여하며 돈도 벌수 있고, 주최측의 경우 광고비로 불확실하게 군중을 섭외하는 것보다 명확한 금액으로 행사에 어울리는 타겟군중을 섭외할 수 있다는 것이 본 서비스의 매력인 듯 합니다.<br><br>

        다방면으로 사업 확장이 가능 한 모델이네요. 국내에서 적용한다면 아르바이트 모집, 서포터즈 모집 등 다양한 곳에 활용 니즈가 있을 듯 합니다.<br><br>

        안드로이드, ios 제공.
    </div>
    <div class="author danb">
        <a href="#_"><img src="<?php echo get_template_directory_uri(); ?>/img/profile_jerrykim.jpg" /> <span>Jerry Kim</span></a>
    </div>


    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <div class="fbcomment">
        <div class="fb-comments" data-href="http://developers.facebook.com/docs/plugins/comments/" data-numposts="3" style="width:100%;" data-width="100%"></div>
    </div>
</div><!--//.article-->