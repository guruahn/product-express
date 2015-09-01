<footer class="copyright">
    <p>(C)2015 <a href="http://userstorylab.com/">Userstory Lab</a></p>
    <p class="contact">
        <a href="mailto:biz@userstorylab.com">biz@userstorylab.com</a>
    </p>
</footer>


<!--email subscription modal-->
<div class="modal-email-subscripton" style="display: none;">

    <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
        <div id="footer-widget" class="widget-area">
            <?php dynamic_sidebar( 'footer-widget-area' ); ?>
        </div>
    <?php endif; ?>
</div><!--//.side-->


<div class="popup request">

<i class="fa fa-times close">
</i>
    <?php wd_form_maker(4); ?>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/waypoints/jquery.waypoints.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/waypoints/inview.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sticky-kit.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.tooltipster.min.js"></script>



<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<?php
if(!is_localhost()){
    ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-65880784-1', 'auto');
        ga('send', 'pageview');

    </script>
    <?php
}
?>
<script>
$("#primary").stick_in_parent();
            $('.tooltip').tooltipster({

            	theme: 'my-custom-theme',
            	contentAsHTML: true
            });
</script>

<?php wp_footer(); ?>
</body>
</html>