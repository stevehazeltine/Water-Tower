<?php get_header() ?>

	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>



			<?php $banner_args = array(); ?>
			
			<?php get_banner($banner_args); ?>
		    
		    
		    <div class="row">
			    <div class="span12">
			    	<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
			    </div>
		    </div>
            
			<?php	} // end while ?>
	<?php } // end if ?>
 <?php get_footer() ?>