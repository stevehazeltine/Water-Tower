<?php get_header() ?>
	<div class="row">
		
		<div class="span9 teaching-archive-container">
		
			<h1>Teachings</h1>
			<div class="row-fluid" style="margin-bottom: 35px;">
				<div class="span12">
				Mauris ac libero vitae tortor varius venenatis vel at lectus. Morbi ornare nisl eu est placerat id ultricies massa viverra. Sed suscipit porttitor nulla, et elementum urna volutpat a. Etiam imperdiet faucibus venenatis. Donec lacus est, convallis ut euismod at, iaculis ac felis. Aliquam erat volutpat. Pellentesque molestie blandit nisl. Aliquam iaculis enim vitae mauris tincidunt in malesuada felis fringilla. Phasellus ante quam, vulputate non sollicitudin at, sollicitudin a magna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ac metus quis sem viverra cursus. Maecenas non dolor eu ante ultrices tristique eu ac orci.
				</div>
			</div>			   
	
		<?php insert_loop('excerpt') ?>
		
		</div><!--teaching-archive-container-->
		
		
		<div class="span3" >
											
				<?php
				$args = array(
				    'post_type'    => 'teachings',
				    'type'         => 'monthly',
				    'echo'         => 0
				);
				echo '<ul>'.wp_get_archives($args).'</ul>'; ?>
			
		</div><!--/.program-archive-nave-->
		   
		   
	</div>
	<div class="clearfix"> </div>
			
 
 <?php get_footer() ?>