<?php get_header() ?>

	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
		
			<?php get_banner($banner_args); ?>
		    
		    
		    <div class="row">
			    <div class="col-md-12">
			    	<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
			    </div>
		    </div>
            
			<?php	} // end while ?>
	<?php } // end if ?>
 <?php get_footer() ?>