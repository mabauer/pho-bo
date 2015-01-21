<?php
/*-----------------------------------------------------------------------------------*/
/* pho bo Social Links Widget */
/*-----------------------------------------------------------------------------------*/

class pho_sociallinks extends WP_Widget {

	function pho_sociallinks() {
		$widget_ops = array('description' => __( 'Show icons with links to your social profiles' , 'pho') );

		parent::WP_Widget(false, __('Social Links (pho)', 'pho'),$widget_ops);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$appnet = $instance['appnet'];
		$flickr = $instance['flickr'];
		$instagram = $instance['instagram'];
		$picasa = $instance['picasa'];
		$fivehundredpx = $instance['fivehundredpx'];
		$youtube = $instance['youtube'];
		$vimeo = $instance['vimeo'];
		$dribbble = $instance['dribbble'];
		$ffffound = $instance['ffffound'];
		$pinterest = $instance['pinterest'];
		$behance = $instance['behance'];
		$deviantart = $instance['deviantart'];
		$squidoo = $instance['squidoo'];
		$slideshare = $instance['slideshare'];
		$lastfm = $instance['lastfm'];
		$grooveshark = $instance['grooveshark'];
		$soundcloud = $instance['soundcloud'];
		$foursquare = $instance['foursquare'];
		$github = $instance['github'];
		$linkedin = $instance['linkedin'];
		$xing = $instance['xing'];
		$wordpress = $instance['wordpress'];
		$tumblr = $instance['tumblr'];
		$rss = $instance['rss'];
		$rsscomments = $instance['rsscomments'];

		echo $before_widget; ?>
		<?php if($title != '')
			echo '<h3 class="widget-title"><span>'. esc_html($title) .'</span></h3>'; ?>

        <ul class="sociallinks">
			<?php
			if($twitter != ''){
				echo '<li><a href="'.esc_url( $twitter ).'" class="twitter" title="' . __( 'Twitter', 'pho' ) . '">' . __( 'Twitter', 'pho' ) . '</a></li>';
			}
			?>

			<?php
			if($facebook != '') {
				echo '<li><a href="'.esc_url( $facebook ).'" class="facebook" title="' . __( 'Facebook', 'pho' ) . '">' . __( 'Facebook', 'pho' ) . '</a></li>';
			}
			?>

			<?php
			if($googleplus != '') {
				echo '<li><a href="'.esc_url( $googleplus ).'" class="googleplus" title="' . __( 'Google+', 'pho' ) . '">' . __( 'Google+', 'pho' ) . '</a></li>';
			}
			?>

			<?php
			if($appnet != '') {
				echo '<li><a href="'.esc_url( $appnet ).'" class="appnet" title="' . __( 'App.net', 'pho' ) . '">' . __( 'App.net', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($flickr != '') {
				echo '<li><a href="'.esc_url( $flickr ).'" class="flickr" title="' . __( 'Flickr', 'pho' ) . '">' . __( 'Flickr', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($instagram != '') {
				echo '<li><a href="'.esc_url( $instagram ).'" class="instagram" title="' . __( 'Instagram', 'pho' ) . '">' . __( 'Instagram', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($picasa != '') {
				echo '<li><a href="'.esc_url( $picasa ).'" class="picasa" title="' . __( 'Picasa', 'pho' ) . '">' . __( 'Picasa', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($fivehundredpx != '') {
				echo '<li><a href="'.esc_url( $fivehundredpx ).'" class="fivehundredpx" title="' . __( '500px', 'pho' ) . '">' . __( '500px', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($youtube != '') {
				echo '<li><a href="'.esc_url( $youtube ).'" class="youtube" title="' . __( 'YouTube', 'pho' ) . '">' . __( 'YouTube', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($vimeo != '') {
				echo '<li><a href="'.esc_url( $vimeo ).'" class="vimeo" title="' . __( 'Vimeo', 'pho' ) . '">' . __( 'Vimeo', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($dribbble != '') {
				echo '<li><a href="'.esc_url( $dribbble ).'" class="dribbble" title="' . __( 'Dribbble', 'pho' ) . '">' . __( 'Dribbble', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($ffffound != '') {
				echo '<li><a href="'.esc_url( $ffffound ).'" class="ffffound" title="' . __( 'Ffffound', 'pho' ) . '">' . __( 'Ffffound', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($pinterest != '') {
				echo '<li><a href="'.esc_url( $pinterest ).'" class="pinterest" title="' . __( 'Pinterest', 'pho' ) . '">' . __( 'Pinterest', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($behance != '') {
				echo '<li><a href="'.esc_url( $behance ).'" class="behance" title="' . __( 'Behance Network', 'pho' ) . '">' . __( 'Behance Network', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($deviantart != '') {
				echo '<li><a href="'.esc_url( $deviantart ).'" class="deviantart" title="' . __( 'deviantART', 'pho' ) . '">' . __( 'deviantART', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($squidoo != '') {
				echo '<li><a href="'.esc_url( $squidoo ).'" class="squidoo" title="' . __( 'Squidoo', 'pho' ) . '">' . __( 'Squidoo', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($slideshare != '') {
				echo '<li><a href="'.esc_url( $slideshare ).'" class="slideshare" title="' . __( 'Slideshare', 'pho' ) . '">' . __( 'Slideshare', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($lastfm != '') {
				echo '<li><a href="'.esc_url( $lastfm ).'" class="lastfm" title="' . __( 'Lastfm', 'pho' ) . '">' . __( 'Lastfm', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($grooveshark != '') {
				echo '<li><a href="'.esc_url( $grooveshark ).'" class="grooveshark" title="' . __( 'Grooveshark', 'pho' ) . '">' . __( 'Grooveshark', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($soundcloud != '') {
				echo '<li><a href="'.esc_url( $soundcloud ).'" class="soundcloud" title="' . __( 'Soundcloud', 'pho' ) . '">' . __( 'Soundcloud', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($foursquare != '') {
				echo '<li><a href="'.esc_url( $foursquare ).'" class="foursquare" title="' . __( 'Foursquare', 'pho' ) . '">' . __( 'Foursquare', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($github != '') {
				echo '<li><a href="'.esc_url( $github ).'" class="github" title="' . __( 'GitHub', 'pho' ) . '">' . __( 'GitHub', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($linkedin != '') {
				echo '<li><a href="'.esc_url( $linkedin ).'" class="linkedin" title="' . __( 'LinkedIn', 'pho' ) . '">' . __( 'LinkedIn', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($xing != '') {
				echo '<li><a href="'.esc_url( $xing ).'" class="xing" title="' . __( 'Xing', 'pho' ) . '">' . __( 'Xing', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($wordpress != '') {
				echo '<li><a href="'.esc_url( $wordpress ).'" class="wordpress" title="' . __( 'WordPress', 'pho' ) . '">' . __( 'WordPress', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($tumblr != '') {
				echo '<li><a href="'.esc_url( $tumblr ).'" class="tumblr" title="' . __( 'Tumblr', 'pho' ) . '">' . __( 'Tumblr', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($rss != '') {
				echo '<li><a href="'.esc_url( $rss ).'" class="rss" title="' . __( 'RSS Feed', 'pho' ) . '">' . __( 'RSS Feed', 'pho' ) . '</a></li>';
			}
			?>

			<?php if($rsscomments != '') {
				echo '<li><a href="'.esc_url( $rsscomments ).'" class="rsscomments" title="' . __( 'RSS Comments', 'pho' ) . '">' . __( 'RSS Comments', 'pho' ) . '</a></li>';
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
		$title = esc_attr($instance['title']);
		$twitter = esc_attr($instance['twitter']);
		$facebook = esc_attr($instance['facebook']);
		$googleplus = esc_attr($instance['googleplus']);
		$appnet = esc_attr($instance['appnet']);
		$flickr = esc_attr($instance['flickr']);
		$instagram = esc_attr($instance['instagram']);
		$picasa = esc_attr($instance['picasa']);
		$fivehundredpx = esc_attr($instance['fivehundredpx']);
		$youtube = esc_attr($instance['youtube']);
		$vimeo = esc_attr($instance['vimeo']);
		$dribbble = esc_attr($instance['dribbble']);
		$ffffound = esc_attr($instance['ffffound']);
		$pinterest = esc_attr($instance['pinterest']);
		$behance = esc_attr($instance['behance']);
		$deviantart = esc_attr($instance['deviantart']);
		$squidoo = esc_attr($instance['squidoo']);
		$slideshare = esc_attr($instance['slideshare']);
		$lastfm = esc_attr($instance['lastfm']);
		$grooveshark = esc_attr($instance['grooveshark']);
		$soundcloud = esc_attr($instance['soundcloud']);
		$foursquare = esc_attr($instance['foursquare']);
		$github = esc_attr($instance['github']);
		$linkedin = esc_attr($instance['linkedin']);
		$xing = esc_attr($instance['xing']);
		$wordpress = esc_attr($instance['wordpress']);
		$tumblr = esc_attr($instance['tumblr']);
		$rss = esc_attr($instance['rss']);
		$rsscomments = esc_attr($instance['rsscomments']);

		?>

		 <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('googleplus'); ?>" value="<?php echo $googleplus; ?>" class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" />
        </p>

		  <p>
            <label for="<?php echo $this->get_field_id('appnet'); ?>"><?php _e('App.net URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('appnet'); ?>" value="<?php echo $appnet; ?>" class="widefat" id="<?php echo $this->get_field_id('appnet'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
        </p>

		 <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('instagram'); ?>" value="<?php echo $instagram; ?>" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('picasa'); ?>"><?php _e('Picasa URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('picasa'); ?>" value="<?php echo $picasa; ?>" class="widefat" id="<?php echo $this->get_field_id('picasa'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('fivehundredpx'); ?>"><?php _e('500px URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('fivehundredpx'); ?>" value="<?php echo $fivehundredpx; ?>" class="widefat" id="<?php echo $this->get_field_id('fivehundredpx'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>" value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('dribbble'); ?>"><?php _e('Dribbble URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('dribbble'); ?>" value="<?php echo $dribbble; ?>" class="widefat" id="<?php echo $this->get_field_id('dribbble'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('ffffound'); ?>"><?php _e('Ffffound URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('ffffound'); ?>" value="<?php echo $ffffound; ?>" class="widefat" id="<?php echo $this->get_field_id('ffffound'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>" value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('behance'); ?>"><?php _e('Behance Network URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('behance'); ?>" value="<?php echo $behance; ?>" class="widefat" id="<?php echo $this->get_field_id('behance'); ?>" />
        </p>

		 <p>
            <label for="<?php echo $this->get_field_id('deviantart'); ?>"><?php _e('deviantART URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('deviantart'); ?>" value="<?php echo $deviantart; ?>" class="widefat" id="<?php echo $this->get_field_id('deviantart'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('squidoo'); ?>"><?php _e('Squidoo URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('squidoo'); ?>" value="<?php echo $squidoo; ?>" class="widefat" id="<?php echo $this->get_field_id('squidoo'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('slideshare'); ?>"><?php _e('Slideshare URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('slideshare'); ?>" value="<?php echo $slideshare; ?>" class="widefat" id="<?php echo $this->get_field_id('slideshare'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('lastfm'); ?>"><?php _e('Last.fm URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('lastfm'); ?>" value="<?php echo $lastfm; ?>" class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('grooveshark'); ?>"><?php _e('Grooveshark URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('grooveshark'); ?>" value="<?php echo $grooveshark; ?>" class="widefat" id="<?php echo $this->get_field_id('grooveshark'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('soundcloud'); ?>"><?php _e('Soundcloud URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('soundcloud'); ?>" value="<?php echo $soundcloud; ?>" class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('foursquare'); ?>"><?php _e('Foursquare URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('foursquare'); ?>" value="<?php echo $foursquare; ?>" class="widefat" id="<?php echo $this->get_field_id('foursquare'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('github'); ?>"><?php _e('GitHub URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('github'); ?>" value="<?php echo $github; ?>" class="widefat" id="<?php echo $this->get_field_id('github'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('linkedin'); ?>" value="<?php echo $linkedin; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('xing'); ?>"><?php _e('Xing URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('xing'); ?>" value="<?php echo $xing; ?>" class="widefat" id="<?php echo $this->get_field_id('xing'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('wordpress'); ?>"><?php _e('WordPress URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('wordpress'); ?>" value="<?php echo $wordpress; ?>" class="widefat" id="<?php echo $this->get_field_id('wordpress'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e('Tumblr URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>" value="<?php echo $tumblr; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS-Feed URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rss'); ?>" value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('rsscomments'); ?>"><?php _e('RSS for Comments URL:','pho'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('rsscomments'); ?>" value="<?php echo $rsscomments; ?>" class="widefat" id="<?php echo $this->get_field_id('rsscomments'); ?>" />
        </p>

		<?php
	} // form
}

register_widget('pho_sociallinks');