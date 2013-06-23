<ul id="sidebar">
	<?php if ( ! dynamic_sidebar() ) : ?>
		
		
		
		
		<!-------------------CATEGORIES----------------->
		<li id="categories">
		<?php if ( 'teachings' == get_post_type()) { ?>
			<?php _e('Teaching Types'); ?>
			<ul>
				<?php wp_list_categories('title_li=&taxonomy=teaching_types'); ?>
			</ul>
		<?php } else { ?>
			<?php _e('Categories:'); ?>
			<ul>
				<?php wp_list_categories('title_li='); ?>
			</ul>
			
		<?php }?>
		</li>
		
		
		<!--------------------ARCHIVES---------------------->
		<!--<li id="archives">
		     
		     <?php if ( 'teachings' == get_post_type()) { ?>
		     	<?php _e('Archives'); ?>
			    <ul>
			     	<?php wp_get_archives('type=yearly&post_type=teachings'); ?>
			    </ul>
			 <?php } else { ?>
			 	<?php _e('Archives'); ?>
			 	<ul>
			   		<?php wp_get_archives('type=yearly&limit=10'); ?>
			 	</ul>
			 <?php } ?>
		</li>-->
		
		<li>Subscribe
			<ul>
				<li><a href="#">Email Alerts</a></li>
				<li><a href="#">Posts RSS Feed</a></li>
				<li><a href="#">Comments RSS Feed</a></li>
				<li><a href="#">Monthly Newsletter</a></li>
			</ul>
		</li>

	<?php endif; ?>
</ul>