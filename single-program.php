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
	
	
		
	
		 
				
					
					<div class="col-lg-8 school-main-content-container">
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
												
												
												
													<div class="col-lg-4">
														<div class="chart-container">
															<canvas id="lecture-overview" class="chart" width="800" height="800"></canvas>
														
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
																	segmentStrokeWidth : 10,
																	percentageInnerCutout : 65,
																	animation: false,
																}
																var ctx = document.getElementById("lecture-overview").getContext("2d");
																var myNewChart = new Chart(ctx).Doughnut(lectureOverview, options);
																	
																		
																});			
															</script>
															<div class="lecture-overview-chart-hours">
																<?php echo $total_hours; ?><br />
																<span class="lecture-overview-hours-title">Hours/Week</span>
															</div>
														</div>
													</div>
												
												
													<div class="col-lg-8">
														<ul class="lecture-phase-overview-key">
														<?php $i = 1 ?>
														
														<?php $activity_title = 'activity_title' . $i; ?>
														<?php $activity_hours = 'hours_per_week' . $i; ?>
														<?php while (rwmb_meta($activity_title) !== '') { ?>
																<li>
																	<div class="lecture-phase-overview-color-block" style="background: #<?php echo $colors_10[$i]; ?>;">
																	<i class="icon-plus"></i>
																	 <span class="lecture-overview-color-block-hours"><?php echo rwmb_meta($activity_hours); ?></span>
																	<i class="icon-long-arrow-right" style="color: #<?php echo $colors_10[$i]; ?>;"></i></div>
																	<?php echo rwmb_meta($activity_title); ?>
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
															<div class="col-9 col-lg-10">
																<h6><?php echo rwmb_meta($activity_title); ?></h6>
																<?php echo rwmb_meta($activity_desc); ?>
															</div>
														
														
															<div class="col-3 col-lg-2">
															<div class="lecture-phase-activity-detail-chart">
																<div class="chart-container">
																	<div class="lecture-phase-activity-detail-chart-hours"><?php echo rwmb_meta($activity_hours); ?></div>
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
																	<div class="col-lg-12 lecture-phase-info-title">
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
											 
					
					
					
					<?php $prereqs = wp_get_post_terms($post->ID, 'prereqs_taxo'); ?>
					<?php foreach($prereqs as $prereq) {
						print_r($prereq);
					} ?>
					
											 
											 
										<!--------- SCHOOL LEADERS ----------->
										<h4>Leaders</h4>
										<?php  
											
											
											function get_school_leaders($leader_string) {
												$leaders = explode(',', $leader_string);
												$skip_leaders = array();
												
													
													//----- SEPARATE MARRIED COUPLES FROM SINGLES -----//
													foreach($leaders as $leader) {
														
														
														//-----CHECK CURRENT LEADER AGAINST KNOWN SPOUSES-----//
														if (!in_array($leader, $skip_leaders)) {
														
															//-----DEFINE LEADER ID-----//
															$leader_object = get_page_by_path('cap-' . $leader, OBJECT, 'guest-author');
															$leader_id = $leader_object->ID;
															
															//-----CHECK IF SPOUSE EXISTS-----//
															if (rwmb_meta('has_spouse', '', $post_id=$leader_id) == 1) {
																$terms =  rwmb_meta( 'spouse', 'type=taxonomy&taxonomy=guest_author_taxo', $post_id=$leader_id );
																
																
																//-----SPOUSE ACTIVATED BUT NO SPOUSE SELECTED FAILSAFE-----//
																if (!empty($terms)) {
																
																	//-----GET SPOUSE ID-----//
																	foreach ($terms as $term) {
																		$spouse_raw_slug = $term->slug;
																		$spouse_slug = 'cap-' . $term->slug;
																		$spouse = get_page_by_path($spouse_slug, OBJECT, 'guest-author');
																		$spouse_id = $spouse->ID;
																		}
																		
																	//-----CHECK IF SPOUSE IS PRESENT-----//
																	foreach ($leaders as $i_spouse) {
																		$i_spouse_object = get_page_by_path('cap-' . $i_spouse, OBJECT, 'guest-author');
																		$i_spouse_id = $leader_object->ID;
																		
																		if ($i_spouse_id == $spouse_id) {
																			$spouse_present = true;
																		}  else {
																			$spouse_present = false;
																		}
																	}
																	
																	//-----IF SPOUSE IS PRESENT APPEND ID'S TOGETHER-----//
																	if ($spouse_present = true) {
																		$married_couples .= $leader_id . '-' . $spouse_id . ',';
																		$skip_leaders[] = $spouse_raw_slug;
																	
																	//-----ADD TO SINGLES LIST IF SPOUSE IS NOT PRESENT-----//
																	} else {
																		$singles .= $leader_id . ',';
																	}
																
																} else {
																	$singles .= $leader_id . ',';
																}
															
															//-----PROCEED THROUGH FOR SINGLE-----//
															} else {
																$singles .= $leader_id . ',';
															}
														}											
													}
													
													if (!empty($married_couples)) {
														$married_couples = explode(',', rtrim($married_couples, ','));
													}
													
													$singles = explode(',', rtrim($singles, ','));?>
													
													
													<?php //-----DISPLAY MARRIED COUPLES-----//?>
													<?php if (isset($married_couples)) { ?>
														<?php foreach($married_couples as $married_couple) { ?>
															<?php $spouses = explode('-', $married_couple) ?>
															<div class="school-leader-container">
															
															
																<div class="row">
																	<div class="col-lg-3">
																		
																			<?php foreach ($spouses as $spouse) { ?>
																			<div class="row married-avatar-container">
																				<?php $spouse_object = get_coauthors($spouse); ?>
																				<div class="col-lg-12 avatar-container"><?php echo get_the_post_thumbnail($spouse_object[0]->ID, 'thumbnail'); ?></div>
																			</div>
																			<?php } ?>
																		
																	</div>
																															
																
																	<div class="col-lg-9">
																		<?php //-----DISPLAY NAMES-----//?>
																		<h5>
																		<?php $n = 1; ?>
																		<?php foreach ($spouses as $spouse) { ?>
																			<?php $spouse_object = get_coauthors($spouse); ?>
																			<?php if ($n==1) { 
																					echo $spouse_object[0]->first_name . ' & ';
																					$coutner = ++$n;
																				} else {
																					echo $spouse_object[0]->display_name;
																				} ?>
																		<?php } ?>
																		</h5>
																		
																		<p>
																			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel auctor ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam in tempor dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris ac risus ac mauris convallis tincidunt. Curabitur quis venenatis neque, vel vulputate magna. Donec suscipit arcu sit amet enim condimentum, nec semper odio venenatis. Fusce dictum risus sed dolor malesuada cursus. In commodo, leo nec vehicula lacinia, neque risus cursus purus, malesuada feugiat est nunc non quam. Suspendisse pellentesque nulla est.
																		</p>
																	</div>
																
																</div>
																
															</div>
														<?php } ?>
													<?php } ?>
													
													
													<?php //-----DISPLAY SINGLES-----//?>
													<?php foreach($singles as $single) { ?>
														<div class="school-leader-container">
														
														
															<div class="row">
																<div class="col-lg-3 avatar-container">

																	<?php $single_object = get_coauthors($single); ?>
																	<?php echo get_the_post_thumbnail($single_object[0]->ID, 'thumbnail'); ?>

																</div>
																														
															
																<div class="col-lg-9">
																	<?php //-----DISPLAY NAMES-----//?>
																	<h5><?php echo $single_object[0]->display_name; ?></h5>
																	<p><?php echo $single_object[0]->description; ?></p>
																</div>
															
															</div>
															
														</div>
													<?php } ?>
													
													
													
												<?php }

											
											
											
											$terms = rwmb_meta( 'leaders', 'type=taxonomy&taxonomy=guest_author_taxo', $post_id=$program_id );
												foreach ( $terms as $term ) {
												   $leader_string .= $term->slug . ',';
												}
												
												$leader_string = rtrim($leader_string, ',');
												get_school_leaders($leader_string);
												
												
												
												
											
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
					</div><!--col-lg-8 content container-->
							 
					
					
					
					
					
					<!--PROGRAM SIDEBAR-->							 
					 <div class="col-lg-4 sidebar">
					 
					 
						<div  class="row">
						 	<div class="col-lg-12">
						 		<div class="apply-button-window">
						 			
						 			
						 			<div class="apply-button-container">
						 				<div class="apply-button-hover">
						 					<a href="#_"><h4>Apply Now <i class="icon-chevron-right"></i></h4></a>
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
							<?php $archive_url = get_bloginfo('url') . '/program_taxo/' . $program_slug . '?posttype=post&programid=' . $program_id; ?>

							<?php $related_args = array (
									'posts_per_page' 	=> 5,
									'post_type' 		=> 'post',
									'program_taxo'		=> $program_slug,
									'archive_url'		=> $archive_url,
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