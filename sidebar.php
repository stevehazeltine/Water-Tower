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

		
		
		
		<?php subscribe_widget(); ?>
		

	<?php endif; ?>
</ul>