<?php
/*
 * Creates custom widgets
 *
 * @package Sparks
 * @sub-package Steel
 *
 */
function sparks_events_widgets() {
    register_widget( 'Link_Widget' );
}

class Link_Widget extends WP_Widget {

  function Link_Widget() {
		$widget_ops = array( 'classname' => 'link-widget', 'description' => __('A widget that displays upcoming events', 'link-widget') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'link-widget' );
		
		$this->WP_Widget( 'link-widget', __('Link Widget', 'link-widget'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$href = $instance['href'];
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title ) {
			echo '<a href=' . $href . '>';
			echo $before_title . $title . $after_title;
			echo '</a>';
		}

		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['href'] = strip_tags( $new_instance['href'] );
		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Upcoming Events', 'link-widget'), 'show_info' => true );
		$defaults = array( 'href' => __('3', 'link-widget'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'link-widget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'href' ); ?>"><?php _e('Number of Events:', 'link-widget'); ?></label>
			<input id="<?php echo $this->get_field_id( 'href' ); ?>" name="<?php echo $this->get_field_name( 'href' ); ?>" value="<?php echo $instance['href']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>
