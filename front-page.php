<?php
/*
Template Name: Front Page
*/
?>

<?php get_header() ?>

<?php //GET ALL VARIABLES FOR THE PAGE FROM THE MAIN LOOP  ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

	<?php //SLIDER VARIABLES ?>
	<?php $slider_post_text_location = rwmb_meta( 'post_text_location' ); ?>
	<?php $slider_post_override_id = rwmb_meta( 'override_post_id' ); ?>
	
	
	<?php $terms = rwmb_meta( 'feat_program', 'type=taxonomy&taxonomy=program_taxo' ); ?>
		<?php foreach ($terms as $term) {
			$slider_featured_program = $term->slug;
		}?>
	<?php $slider_program_text_location = rwmb_meta( 'program_text_location' ); ?>
	
	
	<?php $slider_featured_video = rwmb_meta( 'feat_video' ); ?>
	
            
            
            
            <!---------------- UPCOMING SCHOOLS ----------------->
            <div class="row">
            	<div class="span12 home-page-blogroll">
	            	<h4>Upcoming Schools</h4>
				
					<div class="row">
					<?php //IF ALERT STATUS IS ACTIVATED FOR SLIDER PUSH LATEST POST TO FRONT, OTHERWISE EXCLUDE IT TO PREVENT DUPLICATION ?>
					<?php if (rwmb_meta('alert_slider_activation') == 1) { $offset_posts = 0; } else { $offset_posts = 1; } ?>
					
						<?php 
						
							$currentdate = date("Ymd");
										
							 $args = array(
							   'posts_per_page' => '3',
							   'post_type' => 'program',
							   'meta_key' => 'start_date',
							   'orderby' => 'meta_value_num',
							   'order' => 'ASC',
							   'meta_query' => array(
								   array(
									   'key' => 'start_date',
									   'compare' => '>=',
									   'value' => $currentdate,
								   ),
							   )
							 ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>

									<div class="span4">
										
										<?php // check if the post has a Post Thumbnail assigned to it.
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'thumbnail-card');
											} else {
											echo '<img src="http://placehold.it/1200x600" />';
										} ?>
										
										
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
										<?php if (rwmb_meta( 'sub_title') !== '') { ?>
											<h5><?php echo rwmb_meta( 'sub_title' ); ?></h5>
										<?php } ?>
									</div>
								   
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
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
							'posts_per_page'			=>  3,
							'offset'					=>  $offset_posts,
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<div class="span4">
											
											<?php // check if the post has a Post Thumbnail assigned to it.
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'thumbnail-card');
												} else {
												echo '<img src="http://placehold.it/1200x600" />';
											} ?>
											
											
											<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
											<?php if (rwmb_meta( 'sub_title') !== '') { ?>
												<h5><?php echo rwmb_meta( 'sub_title' ); ?></h5>
											<?php } ?>
										</div>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</div>
						
				<div class="home-page-blogroll-more-options">
					<ul>
						<li>View All <i class="icon-double-angle-right" style="font-size: 20px;"></i></li>
						<li><a href="<?php echo get_bloginfo ('template_directory'); ?>/blog/">Posts<i class="icon-pencil"></i></a></li>
						<li><a href="<?php echo get_bloginfo ('template_directory'); ?>">Outreach Updates<i class="icon-globe"></i></a></li>
						<li><a href="<?php echo get_bloginfo ('template_directory'); ?>">Project Updates<i class="icon-wrench"></i></a></li>
					</ul>		
				</div>
			</div>
		</div>
		<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>
            
            
<?php get_footer(); ?>
