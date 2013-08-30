<?php
/*
Template Name: Vacation With A Purpose
*/
?>

<?php get_header() ?>

	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
	
			<?php get_banner($banner_args); ?>
		    
		    <div class="row">
			    <div class="col-md-9">
			    	<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					
					<h2>Active Projects</h2>
					<p>Below are all of the major building projects that are currently underway. Vacation With A Purpose teams have proved crucial in our ability to use the short summers we have to get as much work done as possible before winter rolls back into the valley.  By participating in VWAP, you can leave your mark on YWAM Montana - Lakeside by helping us provide facilities to train and send missionaries out into the nations. If you can't participate in VWAP, but would still like to partner with us in our ministry through these projects, please visit the project pages to learn how you can best go about doing that.</p>
					<?php get_active_project_index(); ?>
			    </div>
			    
			    <div class="sidebar col-md-3">
			    	<?php get_sidebar(); ?>
			    </div>
		    </div>
            
			<?php	} // end while for loop ?>
	<?php } // end if for loop ?>

<?php get_footer() ?>