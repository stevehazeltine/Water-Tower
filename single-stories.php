<!--RETRIEVE PROGRAM SLUG, USED FOR CUSTOM PROGRAM TAXONOMY-->
<?php $program_id = $_GET['programid'];?>
<?php $program_name = ucwords(str_replace( '-', ' ', $program_slug)); ?>

<?php $program_slug = sanitize_title( get_the_title($program_id), $fallback_title ); ?>

<?php get_header() ?>
		
	<div class="row">
		<div class="span9 school-main-content-container">
			<?php insert_loop(); ?>
		</div><!--span9 content container-->
							 
					 <!--PROGRAM SIDEBAR-->							 
					 <div class="span3 sidebar-container school-sidebar-container">
						<ul class="school-sidebar">
			
							<li class="apply-container">
								<div style="position: relative; height: 25px;"><a class="apply-for-school-link" href="<?php echo get_bloginfo ('url'); ?>/apply/">Apply <i class="icon-signin"> </i></a></div>
							</li>	
							
							<?php $start_date = rwmb_meta( 'start_date', $program_slug, $program_id ); ?>
							<?php if ($start_date != '') { ?>
							<li><h5>Dates<i class="icon-calendar"> </i></h5>
								<ul>
									<li>Start: <?php echo $start_date;?></li>
									<?php $custom_value = rwmb_meta( 'end_date', $program_slug, $program_id  ); if ($custom_value != '') { ?><li>Finish: <?php echo $custom_value;?></li><?php } ?>
								</ul>
							</li>
							<?php } ?>
			
							
							<?php $total_cost = rwmb_meta( 'total_cost', $program_slug, $program_id  );?> 
							<?php if ($total_cost != '') { ?>
							<li><h5>Cost<i class="icon-money"> </i></h5>
								<ul>
									<?php $custom_value = rwmb_meta( 'lecture_cost', $program_slug, $program_id  ); if ($custom_value != '') { ?><li>Lecture: <?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $custom_value);?></li><?php } ?>
									<?php $custom_value = rwmb_meta( 'outreach_cost', $program_slug, $program_id  ); if ($custom_value != '') { ?><li>Outreach: <?php setlocale(LC_MONETARY, 'en_US'); echo money_format('%i', $custom_value);?></li><?php } ?>
									<li>Total Cost: <?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?></li>
								</ul>
							</li>
							<?php } ?>
							
							<!--RESOURCES-->
							<?php $files = rwmb_meta( 'file', 'type=file', $program_id  ); ?>
							
							<?php if (empty($files)) { ?>
							<?php return 0; ?>
							<?php } else { ?>
							<li><h5>Resources<i class="icon-download-alt"> </i></h5>
								<ul>									
									<?php foreach ( $files as $info ){						
											echo "<li><a href='{$info['url']}' target='_blank' title='{$info['title']}'>{$info['title']}</a></li>";
										} ?>
								</ul>
							</li>
							<?php } ?>
							
							
							 <!--RELATED POSTS-->
						   <?php $args = array(
								'posts_per_page' 	=> 5,
								'post_type' 		=> 'post',
								'program_taxo' 		=>  $program_slug,
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
								<li><h5>Related Posts<i class="icon-pencil"> </i></h5>
								<ul>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   
										<li>
											<div>
												<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</div>
										</li>
							   <?php } ?>
							   
								<?php $args = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'program_taxo' => $program_slug,
								);
								$num = count( get_posts( $args ) ); ?>
							   
								<li class="view-all-testimonies" style="margin-top: 15px;"><a href="#_">View All Posts (<?php echo $num; ?>) </a></li>
								<li class="share-your-testimony"><a href="<?php bloginfo('rss2_url'); ?>">Subscribe to RSS</a></li>
								</ul>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
							
						</ul>
					</div><!--sidebar-container-->
							 

			
	</div>
		<div class="clearfix"> </div>
			
 
 <?php get_footer() ?>