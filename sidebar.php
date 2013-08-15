<ul id="sidebar">
	<?php if ( !dynamic_sidebar() ) : ?>
		
		
		<?php if (is_singular()) { ?>
		
		
		
		<li class="sidebar-about-the-author">
			<?php $coauthors = get_coauthors(); ?>
				<?php foreach( $coauthors as $coauthor ) { ?>
					
								<?php echo get_the_post_thumbnail( $coauthor->ID, 'thumbnail-card' ); ?>

								<h2><?php echo $coauthor->display_name; ?></h2>
								<p><?php echo $coauthor->description; ?></p>
								<div class="author-meta">View Stacey's Posts</div>

								
				<?php } ?>			
			
		
		</li>
		
		<?php } ?>
		
		
		
		<?php //----- RECENT POSTS -----// ?>
		<li>
			<?php $args = array(
				'title' => 'Latest Posts',
			) ?>
		
			<?php get_related_posts($args); ?>
		</li>
		
		
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
		
		
		
		<?php //----- SUBSCRIBE WIDGET -----// ?>
		<li class="subscribe-widget-container">
			<h2><?php _e('Subscribe'); ?></h2>
			
			<p>Want us to send you an email every time we post new content to the site?  Fill out the form below and we'll be sure to keep you updated</p>
			
			<div>
				<?php echo do_shortcode('[gravityform id="2" name="Subscribe Form" title="false" description="false" ajax="true"]'); ?>
			</div>
			<div class="subscribe-widget-footer">
				<ul>
					<li><i class="icon-rss"></i>RSS</li>
					<li><i class="icon-facebook"></i></li>
					<li><i class="icon-twitter"></i></li>
					<li><i class="icon-instagram"></i></li>
				</ul>
			</div>
		</li>
		

	<?php endif; ?>
</ul>