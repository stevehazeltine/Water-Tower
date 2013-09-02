<?php get_header() ?>

	<div class="row archive-content-container">
		<div class="col-md-8">
			<?php get_active_project_index() ?>
		</div><!--col-md-10-->
		
		
		
		
		<div class="col-md-4 sidebar">
			<ul>
				<?php 
				get_related_posts(array(
					'title'=>'Project Updates',
					'category_name'=>'project-updates',
				));
				
				subscribe_widget();
				?>
			</ul>
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