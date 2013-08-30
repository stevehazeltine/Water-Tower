<ul id="sidebar">
	<?php if ( !dynamic_sidebar() ) : ?>
		
		
		
		
		<!-------------------CATEGORIES----------------->
		<li id="categories">
		<?php if ( 'teachings' == get_post_type()) { ?>
			<h2><?php _e('Teaching Types'); ?></h2>
			<ul>
				<?php wp_list_categories('title_li=&taxonomy=teaching_types'); ?>
			</ul>
		<?php } else { ?>
			<h2><?php _e('Categories'); ?></h2>
			<ul>
				<?php wp_list_categories('title_li='); ?>
			</ul>
			
		<?php }?>
		</li>
		
		
		
		
		
		<?php //----- RECENT POSTS -----// ?>
		<?php 
		$args = array(
			'title' => 'Latest Posts',
			'posts_per_page' => 3,
		);
		get_related_posts($args); 
		?>

		
		
		
		<?php //----- SUBSCRIBE WIDGET -----// ?>
		<li class="subscribe-widget-container">
			<h2><?php _e('Subscribe'); ?></h2>
			
			<p>Want us to send you an email every time we post new content to the site?  Fill out the form below and we'll be sure to keep you updated</p>
			
			<div>
				<?php echo do_shortcode('[gravityform id="2" name="Subscribe Form" title="false" description="false" ajax="true"]'); ?>
			</div>
			<div class="subscribe-widget-footer">
				<ul>
					<li><a href="<?php bloginfo('rss2_url'); ?>"><i class="icon-rss"></i>RSS</a></li>
					<li><a href="<?php echo get_social_media_link('facebook_url'); ?>"><i class="icon-facebook"></i></a></li>
					<li><a href="<?php echo get_social_media_link('twitter_url'); ?>"><i class="icon-twitter"></i></a></li>
					<li><a href="<?php echo get_social_media_link('instagram_url'); ?>"><i class="icon-instagram"></i></a></li>
				</ul>
			</div>
		</li>
		

	<?php endif; ?>
</ul>