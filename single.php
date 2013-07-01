<?php get_header() ?>

		<?php get_banner($banner_args); ?>
		
		<div class="row single-post-container">
			<div class="span9">
				<?php insert_loop(); ?>		
			</div>
			
			<div class="span3 sidebar">
				<?php get_sidebar(); ?>
			</div><!--sidebar-container-->
		</div>
		
			
		<div class="row">
			<div class="span7 offset2 pagination">
				<div class="alignleft">
				     <?php next_posts_link('&laquo; Previous Entries') ?>
				</div>
				<div class="alignright">
				     <?php previous_posts_link('Next Entries &raquo;') ?>
				</div>
			</div>
		</div>
 
 <?php get_footer() ?>