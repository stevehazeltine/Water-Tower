<?php
/*
Template Name: Outreach Locations
*/
?>

<?php get_header(); ?>
	
	<?php $args = array (
		'include-gallery' 	=> false,
		'include-map'		=> true,
		'outreach-index'	=> true,
	); ?>
	
	<?php get_banner($args); ?>
		
		
		
		<div class="row">
			<div class="col-lg-8">
				<h1><?php the_title(); ?></h1>
			</div>
			
			
			
			
			
			<!------------------------------------- SIDEBAR --------------------------------------->
			<div class="col-lg-4 sidebar">
			
			<ul>	
			
				<!--RELATED POSTS-->
						   <?php $args = array(
								'posts_per_page' 	=> 5,
								'post_type' 		=> 'post',
								'category_name' => 	'outreach-updates',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
								<li><h2>Outreach Updates</h2>
									<ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
											<li>
											
												<div class="row sidebar-related-post">
													<div class="sidebar-thumbnail-container visible-desktop col-lg-4">
														<?php the_post_thumbnail( 'thumbnail-card' ); ?>
													</div>
													
													<div class="sidebar-related-post-content col-lg-8">
														<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
														<p><?php the_time( 'F j, Y' ); ?></p>
													</div>
												</div>
											</li>
								   <?php } ?>
								   
									<?php $args = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'program_taxo' => $program_slug,
									);
									$num = count( get_posts( $args ) ); ?>
									
										<!--RELATED POST MORE BUTTONS-->
										<li>
											<div class="row sidebar-related-posts-more">
												<div class="sidebar-related-posts-view-all">
													<a href="#_">View All (<?php echo $num; ?>) </a>
												</div>
												
												<div class="sidebar-related-posts-subscribe">
													<a href="<?php bloginfo('rss2_url'); ?>">Subscribe to RSS</a>
												</div>
												<div class="clearfix"></div>
											</div>
										</li>
									</ul>
								</li>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>

			</ul>
			</div>
		</div>
	
	
	
	
	
<?php get_footer(); ?>