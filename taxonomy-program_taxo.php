<!--RETRIEVE PROGRAM SLUG, USED FOR CUSTOM PROGRAM TAXONOMY-->
<?php $program_id = $_GET['programid'];?>
<?php $post_type = $_GET['posttype'];?>
<?php $program_name = ucwords(str_replace( '-', ' ', $program_slug)); ?>
<?php $program_slug = sanitize_title( get_the_title($program_id), $fallback_title ); ?>

<?php get_header() ?>

	<?php //END CHECK FOR POST POST TYPE, BEGIN CHECK FOR TESTIMONY POST TYPE ?>
	<?php if ($post_type = 'testimonies') { ?>
	
				<div class="row">
					<!--BREADCRUMB BAR FOR ADDED USABILITY WHEN DEEP IN PAGE NAVIGATION THROUGH CUSTOM POST TYPES-->
					<div class="span12 breadcrumb-bar">
						<div class="span2" style="margin-left: 0px"><a href="<?php echo get_permalink( $program_id ); ?>"><i class="icon-reply" style="margin-right: 15px;"></i> Back to <?php echo rwmb_meta( 'acronym', $program_slug, $program_id ); ?></a></div>
						<div class="span10">
						
						<?php //GET LINK TO PREVIOUS POST OF SAME POST TYPE AND TAXONOMY ?>
						<?php $prev_post = be_get_previous_post( true, '', 'program_taxo'); ?>
						<?php if (!empty( $prev_post )) { ?>
							<a href="<?php echo get_permalink( $prev_post->ID ); ?>?programid=<?php echo $program_id; ?>"><i class="icon-arrow-left" style="margin-right: 10px;"></i><?php echo $prev_post->post_title; ?></a>
						<?php } ?>
						
						<?php //GET LINK TO NEXT POST OF SAME POST TYPE AND TAXONOMY ?>
						<?php $next_post = be_get_next_post( true, '', 'program_taxo'); ?>
						<?php if (!empty( $next_post )) { ?>
							<a href="<?php echo get_permalink( $next_post->ID ); ?>?programid=<?php echo $program_id; ?>"><?php echo $next_post->post_title; ?><i class="icon-arrow-right" style="margin-left: 10px;"></i></a>
						<?php } ?>
						
						</div>
					</div>
				</div>
					
				<div class="row">
				
						
								
								<div class="span9 school-main-content-container">
								
								<?php query_posts(array(
									'program_taxo' => $program_slug,
									'post_type' => $post_type,
								) ); ?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php $school_title = get_the_title(); ?>	
								
								
									<div class="row">
								
									<div class="span2 visible-desktop entry-meta-left-container">
										<div class="entry-meta-left">
										
										<div class="date-container">
											<div class="year"><?php the_time('Y') ?></div>
											<div class="day"><?php the_time('j') ?></div>
											<div class="month"><?php the_time('M') ?></div>
										</div>
										
											<div class="tags-container">
												<span class="tags-title"><h5>Tags</h5></span>
												<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
											</div>
										
										</div>
									</div>
								
									
									 <!--MAIN CONTENT FOR PROGRAM PAGE-->						 
										 <div class="row">
											 <div class="span7 post school-main-content">
											 
											 <?php //GET ANONYMOUS SETTING FROM POST ?>
											<?php $anonymous = rwmb_meta( 'testimony_anonymous' ); ?>
													
													<h3 class="testimony-title"><span class="school-long-title"><?php the_title(); ?></span></h3>
													
													<?php //CHECK IF USER WISHES TO BE ANONYMOUS, IF SO ECHO ANONYMOUS STUDENT ?>
													<span class="testimony-meta">Testimony By: <?php if ($anonymous != 1) { echo rwmb_meta( 'testimony_f_name' ); } else { echo 'Anonymous Student'; } ?></span>
													 <!--BODY OF THE TESTIMONY-->
													 <div class="entry">
														
														<?php // FORMAT CONTENT TO SHOW EXCERPT OF TESTIMONY, ALONG WITH LINK THAT CAN HAVE VARIABLES PASSED THROUGH ?>
														<?php $content = get_the_content(); ?>
														<?php $content = strip_tags($content); ?>
														<?php $content = strip_shortcodes($content); ?>
														
														<?php //FORMAT READ MORE LINK, AND PASS VARIABLE THROUGH IT TO SINGLE PAGE ?>
														
														<?php echo substr($content, 0, 450); ?>
														<a href="<?php the_permalink() ?>?programid=<?php echo $program_id; ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">Read Full Testimony</a>
					   
											 </div><!-- .entry -->
											 </div> <!-- .post -->
										</div>
									</div><!--row content container-->
									
									<?php endwhile; else: ?>
									<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
								<?php endif; ?>
									
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
	
	<?php //END CHECK FOR TESTIMONIES POST TYPE ?>
	<?php } ?>
 <?php get_footer() ?>