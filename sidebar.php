<ul id="sidebar">
	<?php if ( ! dynamic_sidebar() ) : ?>
		
		
		<li class="sidebar-about-the-author">
			<?php $coauthors = get_coauthors(); ?>
				<?php foreach( $coauthors as $coauthor ) { ?>
					
								<?php echo get_the_post_thumbnail( $coauthor->ID, 'thumbnail-card' ); ?>

								<h2><?php echo $coauthor->display_name; ?></h2>
								<p><?php echo $coauthor->description; ?></p>

								
				<?php } ?>			
			
		
		</li>
		
		
		
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
			<?php _e('Teaching Types'); ?>
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
		

	<?php endif; ?>
</ul>