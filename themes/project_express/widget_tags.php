<?php
/**
 * Adds Product_Express_Tags widget.
 */
class Product_Express_Tags extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'Product_Express_Tags', // Base ID
            __( 'Product Express Tags Widget', 'project-express' ), // Name
            array( 'description' => __( 'Product Express Tags Widget', 'project-express' ), ) // Args
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
        $posttags = get_the_tags();
        if ($posttags) {
            echo '<ul class="taglist">';
            foreach($posttags as $tag) {
                echo  '<li><a href="#">#'.$tag->name.'</a></li>';
            }
            echo '</ul>';
        }
        echo $args['after_widget'];
    }


} // class Foo_Widget