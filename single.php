<?php get_header() ?>

		<?php get_banner($banner_args); ?>
		
		<div class="row single-post-container">
			<div class="col-md-9">
				<?php insert_loop(); ?>		
			</div>
			
			<div class="col-md-3 sidebar">
				<?php get_sidebar(); ?>
			</div><!--sidebar-container-->
		</div>
 
 <?php get_footer() ?>