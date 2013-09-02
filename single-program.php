<?php get_header() ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php $school_title = get_the_title(); ?>
				
				<!--RETRIEVE PROGRAM SLUG, USED FOR CUSTOM PROGRAM TAXONOMY-->
				<?php $program_id = get_the_ID(); ?>
				<?php $program_slug = sanitize_title( get_the_title(), $fallback_title ); ?>
				<?php if (rwmb_meta('display_map') == 1) {$display_map = true;} else {$display_map = false;} ?>
				
	<?php $banner_args = array(
			'post-id' 			=> $program_id,
			'include-map'		=> $display_map,
			'program-taxo'		=> $program_slug,
	); ?>
	
	<?php get_banner($banner_args); ?>
		
	<div class="row">
	
	
		
	
		 
				
					
					<div class="col-md-8 school-main-content-container">
							<div class="school-title-container">
								<h2 class="school-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
									<span class="school-long-title"><?php the_title(); ?></span>
								</a></h2>
								
							</div>
					
				 		
				 		 <!--MAIN CONTENT FOR PROGRAM PAGE-->
				 		 		
								 <div class="post school-main-content">
														
														
										 <!--OVERVIEW OF THE SCHOOL-->
										 <div class="entry">
										 	<?php remove_filter('the_content', 'add_image_credits_to_posts'); ?>
											<?php the_content(); ?>
											
											
											<?php get_videos($program_slug, null); ?>	
											
											     

											
											
											
											
											
											
											
											
											
											
											<?php // LECTURE SECTION V2 ?>
												<h4><?php echo rwmb_meta('lecture_phase_title'); ?></h4>
												<p><?php echo rwmb_meta('lecture_phase_desc'); ?></p>
												<?php // LECTURE PHASE OVERVIEW ?>
												
												<div class="lecture-phase-overview-container row">
												
												
												
													<div class="hidden-xs col-xs-8 col-md-4 col-sm-4">
														<div class="chart-container">
															<canvas id="lecture-overview" class="chart" width="320" height="320"></canvas>
														
															<script>
																jQuery(document).ready(function($) {
																
																var lectureOverview = [
																
																
																//LOOP THROUGH CHART DATA
																<?php $i = 1; ?>
																
																<?php $activity_title = 'activity_title' . $i; ?>
																<?php $activity_hours = 'hours_per_week' . $i; ?>
																<?php $colors_10 = array( 
																	'1' => 'FDB813',
																	'2' => 'F37021', 
																	'3' => 'ED1C24', 
																	'4' => '00AABC', 
																	'5' => '00A99D', 
																	'6' => '35BBAD',
																	'7' => '8DC73F', 
																	'8' => '5C2E90', 
																	'9' => 'F1729D', 
																	'10'=> 'ED0080',
																); ?>
																
																
																<?php $total_hours = rwmb_meta($activity_hours); ?>
																<?php while (rwmb_meta($activity_title) !== '') { ?>
																		{value : <?php echo rwmb_meta($activity_hours); ?>, color : "#<?php echo $colors_10[$i]; ?>" },	
																		
																	<?php $i = $i + 1; ?>
																	<?php $activity_title = 'activity_title' . $i; ?>
																	<?php $activity_hours = 'hours_per_week' . $i; ?>
																	<?php $total_hours = $total_hours + rwmb_meta($activity_hours); ?>
																<?php } ?>
																
																	]
																var options = {
																	segmentStrokeWidth : 2,
																	percentageInnerCutout : 65,
																	animation: false,
																}
																var ctx = document.getElementById("lecture-overview").getContext("2d");
																var myNewChart = new Chart(ctx).Doughnut(lectureOverview, options);
																	
																		
																});			
															</script>
															<div class="lecture-overview-chart-hours hidden-xs hidden-sm">
																<?php echo $total_hours; ?>
																<div class="lecture-overview-hours-title">Hours/Week</div>
															</div>
														</div>
													</div>
												
												
													<div class="hidden-xs col-md-8 col-sm-8 lecture-overview-chart-key-container">
														<ul class="lecture-phase-overview-key">
														<?php $i = 1 ?>
														
														<?php $activity_title = 'activity_title' . $i; ?>
														<?php $activity_hours = 'hours_per_week' . $i; ?>
														<?php while (rwmb_meta($activity_title) !== '') { ?>
																<li>
																
																	<div class="key-item">
																		<i class="icon-circle-blank" style="color: #<?php echo $colors_10[$i]; ?>;"></i><?php echo rwmb_meta($activity_title); ?>
																	</div>
																</li>	
																
															<?php $i = $i + 1; ?>
															<?php $activity_title = 'activity_title' . $i; ?>
															<?php $activity_hours = 'hours_per_week' . $i; ?>
														<?php } ?>
														</ul>
													</div>
												</div>
												
												
												
												
												
												
												<?php // LECTURE PHASE DETAILS ?>
												<div class="lecture-phase-detail-container">
																								
													<div class="lectture-phase-details">
														<?php $n = 1; ?>
														<?php $activity_title = 'activity_title' . $n; ?>
														<?php $activity_hours = 'hours_per_week' . $n; ?>
														<?php $activity_desc = 'activity_description' . $n; ?>
													
														<?php while (rwmb_meta($activity_title) !== '') { ?>
														<div class="lecture-phase-activity-details-container row">
															<div class="col-xs-9 col-md-10">
																<h6><?php echo rwmb_meta($activity_title); ?></h6>
																<?php echo rwmb_meta($activity_desc); ?>
															</div>
														
														
															<div class="col-xs-3 col-md-2">
															<div class="lecture-phase-activity-detail-chart">
																<div class="chart-container">
																	<div class="lecture-phase-activity-detail-chart-hours hidden-xs"><?php echo rwmb_meta($activity_hours); ?></div>
																	<canvas id="activity-detail-<?php echo $n; ?>" class="chart" width="150" height="150"></canvas>
																	
																	<script>
																		jQuery(document).ready(function($) {
																		
																		var lectureOverview = [
																		
																		
																		//LOOP THROUGH TOTAL CHART DATA
																		<?php $i = 1; ?>
																		<?php $activity_title = 'activity_title' . $i; ?>
																		<?php $activity_hours = 'hours_per_week' . $i; ?>
																		<?php $activity_desc = 'activity_description' . $i; ?>
																		<?php $hours_before = 0; ?>
																		<?php $hours_after = $total_hours - rwmb_meta($activity_hours); ?>
		
																		<?php while (rwmb_meta($activity_title) !== '') { ?>
	
																				<?php if ($n == $i) { ?>
																					{value : <?php echo $hours_before; ?>, color : "#EFEFEF"},
																					{value : <?php echo rwmb_meta($activity_hours); ?>, color : "#<?php echo $colors_10[$i]; ?>" },
																					{value : <?php echo $hours_after; ?>, color : "#EFEFEF"},
																				<?php } ?>
																				
																			<?php $hours_before = $hours_before + rwmb_meta($activity_hours); ?>
																			
																				
																			<?php $i = $i + 1; ?>
																			<?php $activity_title = 'activity_title' . $i; ?>
																			<?php $activity_hours = 'hours_per_week' . $i; ?>
																			<?php $activity_desc = 'activity_description' . $i; ?>
																			<?php $hours_after = $total_hours - (rwmb_meta($activity_hours)+$hours_before); ?>
																			
																		<?php } ?>
																		
																			]
																		var options = {
																			segmentStrokeWidth : 3,
																			percentageInnerCutout : 65,
																			animation: false,
																		}
																		var ctx = document.getElementById("activity-detail-<?php echo $n; ?>").getContext("2d");
																		var myNewChart = new Chart(ctx).Doughnut(lectureOverview, options);
																			
																				
																		});			
																	</script>
																	
																</div>
															</div>
															</div>
														
														</div><!--/.lecture-phase-detail-container-->
														
														<?php $n = $n + 1; ?>
														<?php $activity_title = 'activity_title' . $n; ?>
														<?php $activity_hours = 'hours_per_week' . $n; ?>
														<?php $activity_desc = 'activity_description' . $n; ?>
														<?php } ?>
														
													</div>
												</div>
											
											
											
											
											
											
											
											
											
											
											
											
											
											
						   
									   										   
										   
										   
										   
										   
										   
										   <!--
										    
												 <?php// LECTURE SECTION ?>										 
													 <h4><?php echo rwmb_meta( 'lecture_phase_title' ); ?></h4>
													 <p><?php echo rwmb_meta( 'lecture_phase_desc' ) ?></p> 
													 
													 <div class="lecture-phase-info-container">
														 <?php $i = 1; ?>
														 <?php $title = 'activity_title'.$i; ?>
														 <?php $desc = 'activity_description'.$i; ?>
														 <?php $hours = 'hours_per_week'.$i; ?>
														 
														 <?php while (rwmb_meta($title) != '') :?>
														   
														   		<div class="row lecture-phase-info">
																	<div class="col-md-12 lecture-phase-info-title">
																		<h6><?php echo rwmb_meta($title); ?> <i class="icon-long-arrow-right" style="margin: 0px 10px;"></i><?php echo rwmb_meta($hours); ?> Hours/Week</h6>
																		
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
																					
																					<?php $topic_string = rtrim($topic_string, ', '); ?>
																					
																					<?php // DISPLAY TOPIC STRING IN TABLE ?>
																					<?php $topics = explode( ',', $topic_string); ?>
																					<?php $cell_count = 0 ?>
																					<table class="lecture-phase-topics-table">
																						<tr>
																						<?php foreach($topics as $topic) { ?>
																							<?php if ($cell_count < 2) { ?>
																								<td><i class="icon-minus"></i> <?php echo $topic; ?></td>
																								<?php $cell_count = $cell_count + 1; ?>
																							<?php } else { ?>
																						</tr>
																						<tr>
																								<td><i class="icon-minus"></i> <?php echo $topic; ?></td>
																								<?php $cell_count = 1; ?>
																							<?php } ?>

																						<?php } ?>
																					</table>
																					
																					
																				<?php } ?>
																		</p>
																	</div>
																</div>
														   
														   <?php $i = $i+1; ?>
														   <?php $title = 'activity_title'.$i; ?>
														   <?php $desc = 'activity_description'.$i; ?>
														   <?php $hours = 'hours_per_week'.$i; ?>
														 <?php endwhile ?>
													 </div>
										   
										   -->
										   
										   
										   
										   
										   
										   
											<?php if (rwmb_meta( 'outreach_phase_desc' ) != '') { ?>
												 <?php// OUTREACH SECTION ?>										 
													 <h4>Outreach</h4>
													 <p><?php echo rwmb_meta( 'outreach_phase_desc' ) ?></p> 
											 <?php } ?>
											 
					
	
					
											 
											 
										<!--------- SCHOOL LEADERS ----------->
										<?php									
											
											
											$terms = rwmb_meta( 'leaders', 'type=taxonomy&taxonomy=guest_author_taxo', $post_id=$program_id );
											
											if (!empty($terms)) {
												foreach ( $terms as $term ) {
													$author_object = get_page_by_path('cap-' . $term->slug, OBJECT, 'guest-author');
												   $leader_string[] = $author_object->ID;
												}
												display_authors($program_id, $leader_string);
											}
												
												
												
											
											?>								
									
									
									
									<?php //--------------------------//?>
									<?php //----- INSTAGRAM FEED -----//?>
									<?php //--------------------------//?>
									
									
										<?php // SET HASHTAG ?>
										<?php if (rwmb_meta('insta_tag') == '') {
										
													if (rwmb_meta('acronym') != '') {
														$hashtag = 'ywammontana' . rwmb_meta('acronym');
													} else {
														$hashtag = 'ywammontana' . str_replace( '-', '', $program_slug);
													}
													
											  } else { 
												$hashtag = rwmb_meta('insta_tag');
											  } ?>
										
										<?php // SET PREFIX FOR TITLE ?>
										<?php if (rwmb_meta('acronym') != '') {
											$insta_prefix = rwmb_meta('acronym');
										} else {
											$insta_prefix = $school_title;
										} ?>
										
										<?php $insta_args = array(
												'cols' 				 => 6,
												'rows' 				 => 2,
												'title_prefix' 		 => $insta_prefix,
												'tag'			 	 => $hashtag,
										); ?>
										
										<?php get_instagram($insta_args); ?>
											 
											 
											 
											 
											 
											 
											 
											 
											 
										
										
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
					</div><!--col-md-8 content container-->
							 
					
					
					
					
					
					<!--PROGRAM SIDEBAR-->							 
					 <div class="col-12 col-md-4 sidebar">
					 
					 	<?php //----- APPLY BUTTON -----// ?>
						 	<div class="apply-button-container">
						 		<a href="http://<?php echo get_apply_link(); ?>" target="_new"><div class="apply-button-text">Apply Online</div></a>
						 		<div class="apply-button-dropdown-button"><i class="icon-caret-down"></i></div>
						 		
						 		<ul>
					 				<li class="apply-button-dropdown-item">Online and offline versions of our application are available, however, we highly recommend our online option as it has been optimized for efficiency and ease of use for you, as the applicant, and our staff.  Please contact Registrar if you prefer a downloaded version or have any questions concerning the online application process. Otherwise, click on the 'Apply Online' button above.</li>
									<a href="<?php echo get_bloginfo('url'); ?>/contact"><li class="apply-button-dropdown-item-button">Contact Registrar</li></a>
								</ul>
						 		
						 	</div>

						
						
						<ul class="school-sidebar">	
								<ul class="program-info">
									
									<?php
									/*
									 *	Display all of the program information from the $program_info object
									 *
									 */
									 
									 	$program_info = new programInfo($program_id);
									 	$i = 1; 
									 	
											// Loop through schedule information
											if (isset($program_info->schedule)) {
												foreach ($program_info->schedule as $instance) {
												
													// CHECK IF SCHOOL IS ONGOING OR NOT
													if (rwmb_meta('ongoing_status') != 1){
													
													
														$dropdown_class = $i == 1 ? 'dropped-down' : '';
														$active_info_section = $i == 1 ? 'active-info-section' : '';
													
														echo '<li id="' . $instance['start_date'] . '" class="program-info-section-title ' . $active_info_section . '">' . '<a class="title-link" href="#_" data-quarter="' . $instance['start_date'] . '">' . $instance['quarter'] . ' <i class="icon-caret-down"></i></a>';
														echo '<span class="application-status">Applications: ' . ucfirst($instance['app_status']);
														echo '<i style="color: #' . $instance['app_status_color'] . '" class="icon-circle-blank"></i></span>' . '<ul class="program-info-dropdown ' . $dropdown_class . '">';
														echo '<li>' . '<span class="program-info-section-subtitle">Start</span>' . date("F d, Y", strtotime($instance["start_date"])) . '</li>';
														echo '<li>' . '<span class="program-info-section-subtitle">Finish</span>' . date("F d, Y", strtotime($instance["end_date"])) . '</li>';
														
														if ($instance['total_cost'] != '') {
															echo '<li>' . '<span class="program-info-section-subtitle">Program Cost</span>' . $instance["total_cost"] . '</li>';
														}
															
														echo '<li>' . '<span class="program-info-section-subtitle">Application Deadline</span>' . date("F d, Y", strtotime($instance["app_deadline"])) . '</li>';
														echo '<li class="international-deadline">' . '<span class="program-info-section-subtitle">Canadian App Deadline</span>' . date("F d, Y", strtotime($instance["canadian_app_deadline"])) . '</li>';
														
														echo '<li class="international-deadline">' . '<span class="program-info-section-subtitle">African App Deadline</span>' . date("F d, Y", strtotime($instance["african_app_deadline"])) . '</li>';
														
														echo '<li class="international-deadline">' . '<span class="program-info-section-subtitle">International App Deadline</span>' . date("F d, Y", strtotime($instance["international_app_deadline"])) . '</li>';
														
														
														echo '<li class="program-info-more-deadlines"><a href="#_" data-quarter="' . $instance['start_date'] . '"><i class="icon-caret-down"></i>International Deadlines</a></li>';
														echo '</ul>';
														
														echo '</li>';
														
														$i = ++$i; ?>
														
														
														
													<?php // DISPLAY ONGOING SECTION FOR SCHOOLS WITH ONGOING SCHEDULES
													} else { ?>
													<li id="ongoing-info-section" class="program-info-section-title active-info-section">
														<a class="title-link" data-quarter="ongoing-info-section" href="#_">Ongoing Schedule <i class="icon-caret-down"></i></a>
														<span class="application-status">Applications: <?php echo ucfirst($instance['app_status']); ?><i style="color: #<?php echo $instance['app_status_color']; ?>;" class="icon-circle-blank"></i></span>
															<ul class="program-info-dropdown dropped-down">
																<li class="ongoing-desc"><?php echo $instance['ongoing_desc']; ?></li>
																<li><span class="program-info-section-subtitle">Approx. Startup Costs</span><?php echo $instance['ongoing_startup_cost']; ?></li>
																<li><span class="program-info-section-subtitle">Approx. Cost of Living</span><?php echo $instance['ongoing_monthly_cost']; ?>/Month</li>
																
																<?php if ($instance['ongoing_min_support_single'] != null) { ?>
																<li><span class="program-info-section-subtitle">Support (Single)</span><?php echo $instance['ongoing_min_support_single']; ?>/Month</li>
																<?php } ?>
																
																<?php if ($instance['ongoing_min_support_married'] != null) { ?>
																<li><span class="program-info-section-subtitle">Support (Married)</span><?php echo $instance['ongoing_min_support_married'] ?>/Month</li> 
																<?php } ?>
																
																<li class="ongoing-support-desc"><?php echo $instance['ongoing_support_desc']; ?></li>
															</ul>
													</li>
	
												<?php } ?>
												
											<?php } ?>
										<?php } else { ?>
											<li id="no-info-section" class="program-info-section-title active-info-section">
														<a class="title-link" data-quarter="no-info-section" href="#_">Dates Not Available <i class="icon-caret-down"></i></a>
															<ul class="program-info-dropdown dropped-down">
																<li class="ongoing-desc">Sorry, but we don't have any dates for this school yet.</li>
															</ul>
													</li>
										<?php } ?>
										
										
									
									
									
									
									
										<li id="additional-info-section" class="program-info-section-title">
											<a class="title-link" data-quarter="additional-info-section" href="#_">Additional Information <i class="icon-caret-down"></i></a>
												<ul class="program-info-dropdown">
													<li><span class="program-info-section-subtitle">Duration</span><?php echo $program_info->academic_info['program_duration'];?> Weeks</li>
													
													
													
													<li>
														<span class="program-info-section-subtitle">Outreach</span>
														<?php 
														if ($program_info->academic_info['has_outreach'] == 'yes') { 
															echo 'Yes <i class="icon-check"></i>';
														} elseif ($program_info->academic_info['has_outreach'] == 'as-god-allows') {
															echo 'As God Allows <i class="icon-check"></i>';
														} else {
															echo 'No <i class="icon-check-empty"></i>'; 
														}
														?>
													</li>
													
													
													<?php //----- CHECK FOR OUTREACH BEFORE CONTINUING -----// ?>
													<?php if ($program_info->academic_info['has_outreach'] == 'yes' || $program_info->academic_info['has_outreach'] == 'as-god-allows') { ?>
														
														<?php if ($program_info->academic_info['has_outreach'] != 'as-god-allows') { ?>
															<li>
																<span class="program-info-section-subtitle">Outreach Duration</span>
																<?php echo $program_info->academic_info['outreach_duration']; ?> Weeks
															</li>
														<?php } ?>
														
														<li>
															<span class="program-info-section-subtitle">Outreach Locale</span>
															<?php $i = 1; ?>
															<?php foreach($program_info->academic_info['outreach_locale'] as $outreach_locale) { ?>
																<?php $comma = $i != 1 ? ', ': null; ?> 
																<?php echo $comma . ucwords($outreach_locale); ?>
																<?php ++$i; ?>
															<?php } ?>
														</li>
													<?php } ?>
													
													
													<li class="clearfix"><span class="program-info-section-subtitle">Prerequisites</span></li>
													
												
													<?php 
													if (!is_null($program_info->academic_info['program_prereqs'])) {
														foreach ($program_info->academic_info['program_prereqs'] as $program_prereqs) {
															echo '<li class="program-info-sub-desc">';
															echo '<a href="' . get_permalink( get_page_by_path( $program_prereqs['slug'], OBJECT, 'program' ) ) . '"><i class="icon-location-arrow"></i>' . $program_prereqs['name'] . '</a>';
															echo '</li>';
														}
													}
														
													?>

													<?php
													if (!is_null($program_info->academic_info['recommended_prereqs'])) {
														foreach ($program_info->academic_info['recommended_prereqs'] as $recommended_prereq) {
															echo '<li class="program-info-sub-desc">';
															echo $recommended_prereq;
															echo '</li>';
														}
													}
													?>
													
													
													
												</ul>
										</li>
									
						
								</ul>
							</li>
							
							
							<?php // RETRIEVE RELATED POSTS ?>
							<?php $related_args = array (
									'posts_per_page' 	=> 5,
									'post_type' 		=> 'post',
									'program_taxo'		=> $program_slug,
							) ?>
							
							<?php get_related_posts($related_args); ?> 
							
						   
							
							
							
							
							
													   

							
							
							
							
							
						<!--RESOURCES-->
							<?php $files = rwmb_meta( 'file', 'type=file' ); ?>
							
							<?php if (empty($files)) { ?>
							<?php } else { ?>
							<li><h2>Resources</h2>
								<ul>									
									<?php foreach ( $files as $info ){						
											echo "<li><a href='{$info['url']}' target='_blank' title='{$info['title']}'><i class='icon-file-text'></i> {$info['title']}</a></li>";
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