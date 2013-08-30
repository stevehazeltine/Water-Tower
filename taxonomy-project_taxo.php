<?php get_header() ?>

	<div class="row archive-content-container">
		<div class="col-md-9">
			<?php insert_loop('excerpt'); ?>
		</div><!--col-md-10-->

		<div class="col-md-3 sidebar">
			<?php get_sidebar(); ?>
		</div><!--sidebar-container-->

	</div><!--archive-content-container-->
			
		<div class="row">
			<div class="col-md-9">
				<?php if (function_exists("pagination")) {
				    pagination($additional_loop->max_num_pages);
				} ?>
			</div>
		</div>
 
 <?php get_footer() ?>