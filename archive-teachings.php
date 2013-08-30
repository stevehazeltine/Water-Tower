<?php get_header() ?>
	<div class="row">
		
		<div class="col-md-8 teaching-archive-container">
		
			<h1>Teachings</h1>
			<div class="row" style="margin-bottom: 35px;">
				<div class="col-md-12">
				Mauris ac libero vitae tortor varius venenatis vel at lectus. Morbi ornare nisl eu est placerat id ultricies massa viverra. Sed suscipit porttitor nulla, et elementum urna volutpat a. Etiam imperdiet faucibus venenatis. Donec lacus est, convallis ut euismod at, iaculis ac felis. Aliquam erat volutpat. Pellentesque molestie blandit nisl. Aliquam iaculis enim vitae mauris tincidunt in malesuada felis fringilla. Phasellus ante quam, vulputate non sollicitudin at, sollicitudin a magna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ac metus quis sem viverra cursus. Maecenas non dolor eu ante ultrices tristique eu ac orci.
				</div>
			</div>			   
	
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php display_loop_excerpt($post->ID); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>


		</div><!--teaching-archive-container-->
		
		
		<div class="col-md-4 sidebar" >
											
				<?php get_sidebar(); ?>
			
		</div><!--/.program-archive-nave-->
		   
		   
	</div>
	<div class="clearfix"> </div>
			
 
 <?php get_footer() ?>