<?php
/*
Template Name: Our Story
*/
?>

<?php get_header() ?>

<div class="row" style="margin-bottom: 45px;">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			 <div class="col-lg-9 post">
	
					 <h2><?php the_title(); ?></h2>		
			
					 <div class="entry">
					   <?php the_excerpt(); ?>
					 </div><!-- .entry -->

			 </div> <!-- .post -->
		 
			<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>
 
	<div class="col-lg-3">
		<p>How do you want to view our story</p>
		<p>Surprise Me</p>
		<p>Start from the beginning</p>
		<p>Show me what your up to now</p>
	</div>
 
 </div><!--.row-->



<div class="row timeline-container">

	
	
	<div class="col-lg-9 timeline-content-container">
	
			<!--QUERY POSTS FOR ANY WITH CATEGORY 'TIMELINE', AND DISABLE PAGING-->
			<?php query_posts( 'cat=16&nopaging=1' ); ?>
				<?php $prev_year = null; ?>
				<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
					  
					  <?php $this_year = get_the_date('Y'); ?>
					  
					  <!--CHECK IF CURRENT YEAR IS DIFFERENT THAN THE LAST-->
					  <?php if ($prev_year != $this_year) { ?>
						
							<!--IF IS NEW YEAR, THEN CLOSE PREVIOUS YEAR'S DIV-->
							<?php if (!is_null($prev_year)) { ?>
							<?php echo '</div>'; ?>
							<?php } ?>
							
						  <div id="<?php echo $this_year; ?>">
						  <div class="row year-label-container">
						  
							<div class="col-lg-2">
								<h3 class="year-label"><?php echo $this_year; ?></h3>
							</div>
						  
						  <!-- POPULATE YEAR HORIZONTAL RULE WITH POSTS REPRESENTING TIMELINE-->
							<div class="col-lg-7" style="margin-left: 0px;">
							<ul class="year-timeline-bullets">
							<i class="icon-caret-right timeline-arrow"></i>
							<?php
								$args = array(
									'cat'      => 16,
									'year'     => $this_year,
									'nopaging' => 1,
								); ?>
						  
							<?php $timeline_query = new WP_Query( $args ); ?>
							<?php if ( $timeline_query->have_posts() ) { ?>
								<?php while ( $timeline_query->have_posts() ) { ?>
								   <?php $timeline_query->the_post(); ?>
									
									<!--CALCULATE LEFT PERCENTAGE FOR TIMELINE BULLETS-->
									<?php $bullet_month = get_the_time('n') ?>
									<?php $bullet_day = get_the_time('j') ?>
									
									<!--CALCULATE BASED ON ALL MONTHS HAVING 31 DAYS TO KEEP THINGS SIMPLE-->
									<?php $left_percentage = (((($bullet_month*31)+$bullet_day)/372)*100) ?>
										
										<li style="left: <?php echo $left_percentage; ?>% ;">
											<a class="smoothScroll" href="#<?php echo $post->ID; ?>"><div class="year-timeline-bullet"><i class="icon-circle-blank"></i>
												<div class="year-timeline-post-title"><p><?php the_title(); ?></p></div>
											</div></a>
											
										</li>
									
								<?php } ?>
							<?php } ?>
							</ul>
							</div>
						  </div>
						<?php wp_reset_postdata(); ?>
							
					  <?php } ?>
						  
						  
						  
					  
					  <div class="row timeline-post" id="<?php echo $post->ID; ?>">
						
							<div class="col-lg-2 timeline-date entry-left">
								<div class="date-container">
									<div class="year"><?php the_time('Y') ?></div>
									<div class="day"><?php the_time('j') ?></div>
									<div class="month"><?php the_time('M') ?></div>
								</div>
								
								<div class="tags-container">
									<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
								</div>
							</div><!--.timeline-date-->

						<div class="col-lg-7 timeline-content">
								
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'archive-banner' );
								} ?>
								
								<h3><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
							</div><!--.timeline-content-->
						
					  </div><!--.timeline-post-->
					  
					  <?php $prev_year = $this_year; ?>
				
				
						<?php } ?>
				   </div>
				<?php } ?>		
				
	</div>
	
	
	
	<div class="col-lg-3 timeline-menu-container">
	
		<ul class="timeline-nav">
			<li>By Year
				<ul>
					<?php query_posts( 'cat=16&nopaging=1'); ?>
					<?php $prev_date = null; ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
						
						<?php $current_date = get_the_date('Y'); ?>
					
						<?php if ($prev_date != $current_date) { ?>
							<?php echo '<a class="smoothScroll" href="#' . get_the_date('Y') . '">'; ?>
							<?php echo '<li>' . get_the_date('Y') . '</li></a>'; ?>
						<?php } ?>
						<?php $prev_date = get_the_date('Y'); ?> 
					
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</ul>
			</li>
			
			<li>By Event
				<ul>
					<li>Built The Slab</li>
					<li>Acquired The Bayshore</li>
					<li>Ran First School</li>
					<li>We Bought The Base</li>
				</ul>
			</li>
				
		</ul>
	
	</div>

</div>


 <?php get_footer() ?>