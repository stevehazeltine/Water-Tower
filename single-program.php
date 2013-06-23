<?php get_header() ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php $school_title = get_the_title(); ?>
				
				<!--RETRIEVE PROGRAM SLUG, USED FOR CUSTOM PROGRAM TAXONOMY-->
				<?php $program_id = get_the_ID(); ?>
				<?php $program_slug = sanitize_title( get_the_title(), $fallback_title ); ?>
				<?php if (rwmb_meta('display_map') == 1) {$display_map = true;} else {$display_map = false;} ?>
				
	<?php $args = array(
			'post-id' 			=> $program_id,
			'include-map'		=> $display_map,
			'program-taxo'		=> $program_slug,
	); ?>
	
	<?php get_banner($args); ?>
		
	<div class="row">
	
	
		
	
		 
				
					
					<div class="span8 school-main-content-container">
							<div class="school-title-container">
								<h2 class="school-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
									<span class="school-long-title"><?php the_title(); ?></span>
								</a></h2>
							</div>
					
				 		
				 		 <!--MAIN CONTENT FOR PROGRAM PAGE-->
				 		 		<div class="row">
								 <div class="span post school-main-content">
														
										 <!--OVERVIEW OF THE SCHOOL-->
										 <div class="entry">
										 	<?php remove_filter('the_content', 'add_image_credits_to_posts'); ?>
											<?php the_content(); ?>
											
											
											<?php get_videos($program_slug, null); ?>	
											
											     

											
											
											
						   
									   										   
										   
										   
										   
										   
										   
										   
										    
												 <?php// LECTURE SECTION ?>										 
													 <h4><?php echo rwmb_meta( 'lecture_phase_title' ); ?></h4>
													 <p><?php echo rwmb_meta( 'lecture_phase_desc' ) ?></p> 
													 
													 <div class="lecture-phase-info-container">
														 <?php $i = 1; ?>
														 <?php $title = 'activity_title'.$i; ?>
														 <?php $desc = 'activity_description'.$i; ?>
														 <?php $hours = 'hours_per_week'.$i; ?>
														 
														 <?php while (rwmb_meta($title) != '') :?>
														   
														   		<div class="row-fluid lecture-phase-info">
																	<div class="span4 lecture-phase-info-title">
																		<h6><?php echo rwmb_meta($title); ?></h6>
																		<p><?php echo rwmb_meta($hours); ?> Hours/Week</p>
																	</div><!--------/.lecture-phase-info-title------->
																	
																	<div class="span8 lecture-phase-info-desc">
																		<p>
																			<?php echo rwmb_meta($desc); ?>
																			<?php $lecture_block = rwmb_meta('lecture_block_num'); ?>
																			
																			<?php //CHECK FOR LECTURE BLOCK, IF IT IS, POST THE LECTURE TOPICS ?>
																				<?php if ($i == $lecture_block) { ?>
																					<?php $lecture_topics = rwmb_meta ('lecture_topics'); ?>
																					<?php foreach ($lecture_topics as $topic) { ?>
																							   
																							   <?php $num_of_posts = 0 ?>
																							   <?php $is_tag = false; ?>
																							   <?php $my_query = new WP_Query('post_type=post&nopaging=true'); ?>
																						   		<?php if ( $my_query->have_posts() ) { ?>
																						   			<?php while ( $my_query->have_posts() ) { ?>
																						   				<?php $my_query->the_post(); ?>
																						   				<?php if (has_tag($topic)) { ?>
																							   				<?php $is_tag = true; ?>
																							   				<?php $num_of_posts = $num_of_posts+1; ?>
																						   				<?php } ?>
																						   			<?php } ?>
																						   		<?php } ?>
																						   		<?php wp_reset_postdata(); ?>
																						   		
																						   	<?php if ($is_tag == true) { ?>
																							   	<?php $tag_url = get_bloginfo('url').'/tag/'.str_replace( "'", '', str_replace(' ', '-', strtolower($topic))); ?>
																							   	<?php $tag_text = $topic . ' ' . '(' . $num_of_posts . ')'; ?>
															
																								
																							   	<?php $topic_string = $topic_string . sprintf('<a href="%s">%s</a>, ', $tag_url, $tag_text); ?>
																							<?php } else { ?>
																								<?php $topic_string = $topic_string . $topic . ', '; ?>
																							<?php } ?>
																					<?php } ?>
																					
																					<?php echo rtrim($topic_string, ', ') . '.'; ?>
																					
																				<?php } ?>
																		</p>
																	</div><!-------/.lecture-phase-info-desc------>
																</div><!-------/.lecture-phase-info----->
														   
														   <?php $i = $i+1; ?>
														   <?php $title = 'activity_title'.$i; ?>
														   <?php $desc = 'activity_description'.$i; ?>
														   <?php $hours = 'hours_per_week'.$i; ?>
														 <?php endwhile ?>
													 </div><!--------/.lecture-phase-info-container------->
										   
										   
											<?php if (rwmb_meta( 'outreach_phase_desc' ) != '') { ?>
												 <?php// OUTREACH SECTION ?>										 
													 <h4>Outreach</h4>
													 <p><?php echo rwmb_meta( 'outreach_phase_desc' ) ?></p> 
											 <?php } ?>
											 
											 
											 
											 
											 
											 
										<!--------- SCHOOL LEADERS ----------->
										<h4>Leaders</h4>
										
										<?php $i = 1; ?>
										<?php $start_date = 'start_date'.$i; ?>
										<?php $season = 'season'.$i; ?>
										
										<?php while (rwmb_meta($start_date) != '') : ?>
										
											 
											<div class="program-leaders">
												<div class="leaders-season-title">
													<?php echo rwmb_meta($season); ?>
												</div>
												
												<?php $leader_id = 'leader_id'.$i; ?>
												<?php $leaders = rwmb_meta($leader_id); ?>
													<?php foreach ($leaders as $leader) {?>
														
											 	
														<div class="row-fluid">
															<div class="span3 leader-avatar">
																<?php echo get_avatar( $leader, 120 ); ?>
															</div>
															<div class="span9">
																<h5><?php echo the_author_meta( 'display_name', $leader ); ?></h5>
																<?php echo the_author_meta( 'description', $leader ); ?>
			
															</div>
														</div>
														
												<?php } ?>
												
											</div>
										
										<?php $i = $i+1; ?>
										<?php $start_date = 'start_date'.$i; ?>
										<?php $season = 'season'.$i; ?>
										<?php endwhile ?>
									
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
										
										
										<!-- INTERNATIONAL STUDENTS -->
										<h4>International Students</h4><p>Applications for Canadian citizens should be completed no later than 1 month prior to the start of the school. For all other international applicants, completed applications should be received 4 months prior to the start of the school (Africans at least 6 months.) You must have a passport that is still valid up to six months after completion of the school. Each family member coming must have their own passport, including each child.</p>
										
										
										
										<?php $custom_value = rwmb_meta( 'accreditation' ); if ($custom_value != '') { ?><h4>Accreditation</h4>
										<p><?php echo $custom_value;?></p><?php } ?>
										

										 <?php if (rwmb_meta( 'prerequisites' ) != '') { ?>
											 <?php// PREREQUISITES SECTION ?>										 
												 <h4>Prerequisites</h4>
												 <p><?php echo rwmb_meta( 'prerequisites' ) ?></p>
										 <?php } ?>

										 </div><!-- .entry -->
								 </div> <!-- .post -->
							</div>
					</div><!--span9 content container-->
							 
					
					
					
					
					
					<!--PROGRAM SIDEBAR-->							 
					 <div class="span4 sidebar">
					 
					 
						<div  class="row-fluid">
						 	<div class="span12">
						 		<div class="apply-button-window">
						 			
						 			
						 			<div class="apply-button-container">
						 				<div class="apply-button-hover">
						 					<a href="#_"><h4>Apply Now</h4></a>
						 				</div>
						 				
						 				<div class="apply-button-icon">
						 					<i class="icon-arrow-right"></i>
						 				</div>
						 				
						 				<div class="apply-button-active">
						 					<span><a href="#"><i class="icon-globe"></i> Online</a></span>
											<span><a href="#"><i class="icon-pencil"></i> PDF</a></span>
						 				</div>
						 			</div>
						 			
						 		</div>
						 	</div>
						</div>

						
						
						<ul class="school-sidebar">	
							<li><h2>Program Details</h2>
								<ul>
								
									<?php $i = 1; ?>
									<?php $start_date = 'start_date'.$i; ?>
									<?php $end_date = 'end_date'.$i; ?>
									<?php $total_cost = 'total_cost'.$i; ?>
									<?php $season = 'season'.$i; ?>
									
									<?php while (rwmb_meta($start_date) != '') : ?>
											<li class="sidebar-info-item">
												<div class="sidebar-info-title">
													<h6><?php echo rwmb_meta($season); ?></h6>
												</div>
												<div class="sidebar-info-details">
													<div>
														<?php echo date("M d", strtotime($start_date));?> - 
														<?php echo date("M d, Y", strtotime(rwmb_meta($end_date))); ?>
													</div>
													<div>
														<?php setlocale(LC_MONETARY,"en_US"); ?>
														<?php echo money_format( '%i', rwmb_meta($total_cost)); ?>
													</div>
												</div>
												<div class="clearfix"></div>
											</li>
										<?php $i = $i+1 ?>
										<?php $start_date = 'start_date'.$i; ?>
										<?php $end_date = 'end_date'.$i; ?>
										<?php $total_cost = 'total_cost'.$i; ?>
										<?php $season = 'season'.$i; ?>
									<?php endwhile ?>
						
								</ul>
							</li>
							
							
							<?php // RETRIEVE RELATED POSTS ?>
							<?php get_related_posts( 3, $program_slug, null); ?> 
							
						   
							
							
							
							
							
							<!--STORIES-->
							<?php $args = array(
								'post_type' 	 	=>	'stories',
								'program_taxo' 		=>  $program_slug,
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							<li><h2>Stories</h2>
								<ul>
						   
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>

								   
								   <li>
									   <div class="row-fluid sidebar-stories-container">
									   		<div class="span3 sidebar-stories-image">
									   			<?php echo get_avatar( get_the_author_meta('ID'), 55 ); ?>
									   		</div>
									   		
									   		<div class="span9 sidebar-stories-content">
									   			<h5><a href="<?php the_permalink() ?>?programid=<?php echo $program_id; ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h5>
									   			<p><?php the_time( 'F j, Y' ); ?></p>
									   		</div>
									   </div>
								   </li>
								   
							   <?php } ?>
							   
									<?php $args = array(
										'post_type' => 'stories',
										'program_taxo' => $program_slug,
									);
									$num = count( get_posts( $args ) ); ?>
									
									
									<!--STORY MORE BUTTONS-->
									<li>
										<div class="row-fluid sidebar-related-posts-more">
											<div class="sidebar-related-posts-view-all">
												<a href="#_">View All (<?php echo $num; ?>) </a>
											</div>
											
											<div class="sidebar-related-posts-subscribe sidebar-share-your-story">
												<a href="<?php bloginfo('rss2_url'); ?>">Share Your Testimony</a>
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
								</ul>
							</li>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
							
							
							
							
						<!--RESOURCES-->
							<?php $files = rwmb_meta( 'file', 'type=file' ); ?>
							
							<?php if (empty($files)) { ?>
							<?php } else { ?>
							<li><h2>Resources</h2>
								<ul>									
									<?php foreach ( $files as $info ){						
											echo "<li><a href='{$info['url']}' target='_blank' title='{$info['title']}'>{$info['title']}</a></li>";
										} ?>
								</ul>
							</li>
							<?php } ?>
							
							
						<!-- IMAGE CREDITS -->
							<li><?php echo get_image_credits(); ?></li>	
					
							
							
						</ul>
					</div><!--sidebar-container-->
							 

			<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>
	</div>
		<div class="clearfix"> </div>
			
 
 <?php get_footer() ?>