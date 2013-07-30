<?php
/*
Template Name: Front Page
*/
?>

<?php get_header() ?>

<?php //GET ALL VARIABLES FOR THE PAGE FROM THE MAIN LOOP  ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

            
            <?php //----- HOME PAGE BANNER -----// ?>
            <div class="banner-image normal-slider frontpage-slider">
				<div id="homepage-banner-gallery" class="royalSlider rsDefault royal-slider-banner">
				
						<?php $featuredschool = get_upcoming_schools(1, true); ?>
						<?php $featuredschool = $featuredschool->schools; ?>
						
							<div class="rsContent">
								<?php echo get_the_post_thumbnail( $featuredschool[0]['program_id'], 'full-banner'); ?>
								
								<div class="rsABlock frontpage-slider-content-title frontpage-slider-content-left" style="background: #<?php echo get_program_color($featuredschool[0]['program_id']); ?>;" data-move-effect="left" data-move-offset="800" data-easing="easeOutSine">
									<h2><?php echo get_the_title($featuredschool[0]['program_id']); ?></h2>
									<p>Starts <?php echo date("F d, Y", strtotime($featuredschool[0]['start_date']));?></p>
								</div>
								
							</div>
						   
						   
					
					
					
					<?php $args = array(
					'post_type' 	 			=>	'videos',
					'posts_per_page'			=>  1,
					); ?>
					
					
					   <?php $my_query = new WP_Query( $args ); ?>
					   <?php if ( $my_query->have_posts() ) { ?>
						   <?php while ( $my_query->have_posts() ) { ?>
							   <?php $my_query->the_post(); ?>
							   <div class="rsContent">
									  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-banner'); echo $image[0];?>"></a>
									  
									  <div class="rsABlock frontpage-slider-content-title frontpage-slider-content-right frontpage-video" 
																								  data-move-effect="right" data-move-offset="800" data-easing="easeOutSine">
												<h2><?php the_title(); ?></h2>
												<p><?php the_content(); ?></p>
												
												<?php $obj = new PostRibbon($post->ID); ?>
												<?php print_r($obj); ?>
												<?php $obj->build_ribbon('horizontal', 3); ?>
											</div>
							   </div>
						   <?php } ?>
					   <?php } ?>
					   <?php wp_reset_postdata(); ?>

				</div>

            </div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
            
            <!---------------- UPCOMING SCHOOLS ----------------->
            
            <?php $upcomingschools = get_upcoming_schools(4, true); ?>
            <?php $upcomingschools = $upcomingschools->schools; ?>
  			
  			<div class="row">
            	<div class="span12 home-page-blogroll">
	            	<h4>Upcoming Schools</h4>
				
					<div class="row">
					
								<?php foreach($upcomingschools as $school) { ?>					
									<div class="blogroll-upcoming-school span3">
										
										<div class="blogroll-upcoming-school-image">
											<?php echo get_the_post_thumbnail( $school['program_id'], 'thumbnail-card'); ?>
											<div class="blogroll-upcoming-school-rollover" style="background: #<?php echo get_program_color($school['program_id']); ?>">
												<div class="blogroll-upcoming-school-rollover-meta">
													<p class="blogroll-upcoming-school-meta-title">Starts</p>
													<p><?php echo date("F d, Y", strtotime($school['start_date'])); ?></p>
												</div>
											</div>
										</div>
																				
										<a href="<?php echo get_permalink($school['program_id']); ?>" rel="bookmark">
										<h2 style="background: #<?php echo get_program_color($school['program_id']); ?>;"><?php if (rwmb_meta('shortname', '', $post_id=$school['program_id']) == '') {echo get_the_title($school['program_id']);} else {echo rwmb_meta('short-name', '', $post_id=$school['program_id']);} ?></h2></a>
									</div>

								<?php } ?>

					</div>
				</div>
			</div>
          
            
            
            
            
            
            
            
            
            
            
            
            
             <!---------------- FEATURED VIDEOS ----------------->
            <div class="row">
            	<div class="span12 home-page-blogroll">
	            	<h4>Featured Videos</h4>
            	
            	
            	
            	<div class="row">
            	<?php //IF ALERT STATUS IS ACTIVATED FOR SLIDER PUSH LATEST POST TO FRONT, OTHERWISE EXCLUDE IT TO PREVENT DUPLICATION ?>
				<?php if (rwmb_meta('alert_slider_activation') == 1) { $offset_posts = 0; } else { $offset_posts = 1; } ?>
	            
	            	<?php $args = array(
					'post_type' 	 			=>	'videos',
					'posts_per_page'			=>  3,
					); ?>
					   
					   <?php $i = 1; ?>
					   <?php $my_query = new WP_Query( $args ); ?>
					   <?php if ( $my_query->have_posts() ) { ?>
						   <?php while ( $my_query->have_posts() ) { ?>
							   <?php $my_query->the_post(); ?>
	
							    <div class="span4">
									<div id="video<?php echo $i; ?>" class="royalSlider videoGallery rsDefault">
									  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media-thumbnail'); echo $image[0];?>"></a>
									</div>
									
									<?php $obj = new PostRibbon($post->ID); ?>
									<?php $obj->build_ribbon('horizontal', 3); ?>
									
									<h2><?php the_title(); ?></h2>
				            	</div>
							   
							   <?php $i=$i+1; ?>
						   <?php } ?>
					   <?php } ?>
					   <?php wp_reset_postdata(); ?>
				</div>
            	</div>
            </div>

            
            
            
            

            <!---------------- RECENT POSTS ----------------->
            <div class="row">
            	<div class="span12 home-page-blogroll">
	            	<h4>Recent Posts</h4>
            	
            	
						            	
            	
            	
            	
						<div class="row">
						<?php //IF ALERT STATUS IS ACTIVATED FOR SLIDER PUSH LATEST POST TO FRONT, OTHERWISE EXCLUDE IT TO PREVENT DUPLICATION ?>
						<?php if (rwmb_meta('alert_slider_activation') == 1) { $offset_posts = 0; } else { $offset_posts = 1; } ?>
						
							<?php $args = array(
							'post_type' 	 			=>	'post',
							'posts_per_page'			=>  4,
							'offset'					=>  $offset_posts,
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<div class="span3">
											
											<?php // check if the post has a Post Thumbnail assigned to it.
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail-card');
												} else {
												echo '<img src="http://placehold.it/1200x600" />';
											} ?>
											
											
											
											<?php $obj = new PostRibbon($post->ID); ?>
											<?php $obj->build_ribbon('vertical', 3); ?>
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
										</div>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</div>
			</div>
		</div>
		<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>
            
            
<?php get_footer(); ?>
