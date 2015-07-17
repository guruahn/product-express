<footer>
    <p>(C)2015 <a href="http://userstorylab.com/">Userstory Lab</a></p>
    <p class="contact">
        <a href="mailto:biz@userstorylab.com">biz@userstorylab.com</a>
        <a href="#">서비스 의뢰문의</a>
        <a href="#">플랫폼 이용문의</a>
    </p>
</footer>


<div class="popup request">
    <form class="box pure-form pure-form-aligned">
        <fieldset class="pure-group">
            <div class="pure-control-group">
                <label for="name">Username</label>
                <input id="name" type="text" placeholder="Username">
            </div>

            <div class="pure-control-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" placeholder="Email Address">
            </div>


            <div class="pure-control-group">
                <label for="service">URL</label>
                <input id="service" type="text" placeholder="URL">
            </div>

            <div class="pure-control-group">
                <textarea class="pure-input-1-1"></textarea>
            </div>



        </fieldset>

        <button type="submit" class="pure-button pure-button-primary submit">내용을 전송합니다.</button>
    </form>
    <i class="fa fa-times close"></i>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/jquery.sticky-kit.min.js"></script>
<script src="js/main.js"></script>
<?php wp_footer(); ?>
</body>
</html>