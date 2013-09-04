<?php get_header() ?>

	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
		
			<?php get_banner($banner_args); ?>
		    
		    
		    <div class="row">
			    <div class="col-md-8">
			    	<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
			    </div>
			    
			    <div class="col-md-4 sidebar">
			    	<ul>
			    		<?php get_related_posts(); ?>
			    		<?php subscribe_widget(); ?>
			    	</ul>
			    </div>
		    </div>
            
			<?php	} // end while ?>
	<?php } // end if ?>
 <?php get_footer() ?>