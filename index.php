<?php get_header() ?>

	<div class="row archive-content-container">
		<div class="col-lg-9">
		
				<?php //----- BEGIN CHECK FOR DIFFERENT POST TYPES -----// ?>
					
					
					
					<?php //----- BEGIN PROJECTS POST TYPE INDEX -----// ?>
						<?php if ('projects' == get_post_type()) { ?>

								<?php get_active_project_index() ?>
						
					<?php //----- EVERYTHING ELSE'S POST TYPE INDEX -----// ?>
					<?php } else { ?>
						<?php insert_loop('excerpt'); ?>
					
					<?php } ?>
				<?php //----- END CHECK FOR DIFFERENT POST TYPES -----// ?>
		</div><!--col-lg-10-->
		
		
		
		
		<div class="col-lg-3 sidebar">
			<?php get_sidebar(); ?>
		</div><!--sidebar-container-->

	</div><!--archive-content-container-->
			
		<div class="row">
			<div class="col-lg-9">
				<?php if (function_exists("pagination")) {
				    pagination($additional_loop->max_num_pages);
				} ?>
			</div>
		</div>
 
 <?php get_footer() ?>