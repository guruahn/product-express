<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Product Express
 * @since Product Express 1.0
 */
?>
<?php
/**
 * Filter the author bio avatar size.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param int $size The avatar height and width size in pixels.
 */
$author_bio_avatar_size = apply_filters( 'twentyfifteen_author_bio_avatar_size', 56 );

$avatar = get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
?>
<?php echo $avatar; ?>
<span>
    <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
        <?php echo get_the_author(); ?>
    </a>
</span>

