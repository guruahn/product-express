<?php
/**
 * Adds Product_Express_Writers widget.
 */
class Product_Express_Writers extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'Product_Express_Writers', // Base ID
            __( 'Product Express Writers Widget', 'project-express' ), // Name
            array( 'description' => __( 'Product Express Writers Widget', 'project-express' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        $blogusers = get_users( 'blog_id=1&orderby=nicename&role=editor' );
        // Array of WP_User objects.
        if($blogusers){
            echo '<ul class="author">';
            foreach ( $blogusers as $user ) {
                ?>
                <li>
                    <a href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>">
                        <?php
                        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                        if ( is_plugin_active( 'metronet-profile-picture/metronet-profile-picture.php' ) ) {
                            mt_profile_img( $user->ID );
                        }else{
                            echo get_avatar( get_the_author_meta( 'user_email', $user->ID ) );
                        }
                        ?>
                        <?php echo $user->data->display_name; ?>
                    </a>
                </li>
            <?php
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }



} // class Foo_Widget