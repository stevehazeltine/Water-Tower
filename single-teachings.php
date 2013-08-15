<?php get_header() ?>
		<div class="row">
			<div class="col-lg-9">
				<?php insert_loop(); ?>
			</div>
		
		
			<div class="col-lg-3 sidebar">
				<?php get_sidebar(); ?>
			</div><!--sidebar-container-->
		</div>
		
			
		<div class="row">
			<div class="col-lg-7 offset2 pagination">
				<div class="alignleft">
				     <?php next_posts_link('&laquo; Previous Entries') ?>
				</div>
				<div class="alignright">
				     <?php previous_posts_link('Next Entries &raquo;') ?>
				</div>
			</div>
		</div>
 
 <?php get_footer() ?>