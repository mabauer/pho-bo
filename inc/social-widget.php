<?php
/*-----------------------------------------------------------------------------------*/
/* pho bo Social Links Widget */
/*-----------------------------------------------------------------------------------*/

class pho_sociallinks extends WP_Widget {

	private $sociallinks = array(
		'twitter' => array('Twitter', 'fa-twitter'),
		'facebook' => array('Facebook', 'fa-facebook'),
		'googleplus' => array('Google+', 'fa-google-plus'),
		'flickr' => array('Flickr', 'fa-flickr'),
		'instagram' => array('Instagram', 'fa-instagram'),
		'fivehundredpx' => array('500px.com', 'fa-500px'),
		'youtube' => array('Youtube', 'fa-youtube'),
		'vimeo' => array('Vimeo', 'fa-vimeo-square'),
		'pinterest' => array('Pinterest', 'fa-pinterest'),
		'github' => array('GitHub', 'fa-github-square'),
		'linkedin' => array('Linkedin.com', 'fa-linkedin'),
		'xing' => array('Xing', 'fa-xing'),
		'tumblr' => array('Tumblr', 'fa-tumblr'),
		'foursquare' => array('Foursquare', 'fa-foursquare'),
		'rss' => array('Flickr', 'fa-rss'),
		);

	function pho_sociallinks() {
		$widget_ops = array('description' => __( 'Show icons with links to your social profiles' , 'pho') );

		parent::__construct(false, __('Social Links (pho)', 'pho'),$widget_ops);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];



		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'. esc_html($title) .'</span></h3>'; ?>

        <ul class="sociallinks">
			<?php

			foreach ($this->sociallinks as $key => $linkprops) {

				$link = ! empty( $instance[$key] ) ? esc_attr($instance[$key]) : '';

				if ($link != '') {
					echo '<li><a href="'.esc_url( $link ).'" title="' . __( $linkprops[0], 'pho' ) . '">'
						. '<i class="fa ' . $linkprops[1] .'"></i>' . '</a></li>';
				}
			}
			?>

		</ul><!-- end .sociallinks -->

	   <?php
	   echo $after_widget;

	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();

   } // widget

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {
		$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';

		echo '<label for="' . $this->get_field_id('title') . '">' . __('Title:','pho') . '</label>';
		echo '<input type="text" name="' . $this->get_field_name('title') . '" value="'
			. esc_attr($title) . '" class="widefat" id="' . $this->get_field_id('title') . '"/>';

		/*
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        */

		foreach ($this->sociallinks as $key => $linkprops) {

			$link = ! empty( $instance[$key] ) ? esc_attr($instance[$key]) : '';
			echo '<label for="' . $this->get_field_id('link') . '">' . __($linkprops[0], 'pho')
					. /* '<i class="fa ' . $linkprops[1] . '"></i>' . */ '</label>';

			echo '<input type="text" name="' . $this->get_field_name($key) . '" value="'
					. esc_attr($link) . '" class="widefat" id="' . $this->get_field_id($key) . '"/>';
			}

	} // form
}

register_widget('pho_sociallinks');
