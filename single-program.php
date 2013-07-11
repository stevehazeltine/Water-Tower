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
																	<div class="span12 lecture-phase-info-title">
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
															
															//-----PROCEED THROUGH FOR SINGLE-----//
															} else {
																$singles .= $leader_id . ',';
															}
														}											
													}
													$married_couples = explode(',', rtrim($married_couples, ','));
													$singles = explode(',', rtrim($singles, ','));?>
													
													
													<?php //-----DISPLAY MARRIED COUPLES-----//?>
													<?php foreach($married_couples as $married_couple) { ?>
														<?php $spouses = explode('-', $married_couple) ?>
														<div class="school-leader-container">
														
														
															<div class="row-fluid">
																<div class="span3">
																	
																		<?php foreach ($spouses as $spouse) { ?>
																		<div class="row-fluid married-avatar-container">
																			<?php $spouse_object = get_coauthors($spouse); ?>
																			<div class="span12 avatar-container"><?php echo get_the_post_thumbnail($spouse_object[0]->ID, 'thumbnail'); ?></div>
																		</div>
																		<?php } ?>
																	
																</div>
																														
															
																<div class="span9">
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
													
													
													<?php //-----DISPLAY MARRIED COUPLES-----//?>
													<?php foreach($singles as $single) { ?>
														<div class="school-leader-container">
														
														
															<div class="row-fluid">
																<div class="span3 avatar-container">

																	<?php $single_object = get_coauthors($single); ?>
																	<?php echo get_the_post_thumbnail($single_object[0]->ID, 'thumbnail'); ?>

																</div>
																														
															
																<div class="span9">
																	<?php //-----DISPLAY NAMES-----//?>
																	<h5><?php echo $single_object[0]->display_name; ?></h5>
																	<p><?php echo $single_object[0]->description; ?></p>
																</div>
															
															</div>
															
														</div>
													<?php } ?>
													
													
													
												<?php }

											
											
											
											$terms = rwmb_meta( 'leaders', 'type=taxonomy&taxonomy=guest_author_taxo' );
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
							</div>
					</div><!--span9 content container-->
							 
					
					
					
					
					
					<!--PROGRAM SIDEBAR-->							 
					 <div class="span4 sidebar">
					 
					 
						<div  class="row-fluid">
						 	<div class="span12">
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