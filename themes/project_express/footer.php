<footer class="copyright">
    <p>(C)2015 <a href="http://userstorylab.com/">Userstory Lab</a></p>
    <p class="contact">
        <a href="mailto:biz@userstorylab.com">biz@userstorylab.com</a>
    </p>
</footer>


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