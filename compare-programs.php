<?php
/*
Template Name: Compare Programs
*/
?>

<?php $programs_to_compare = explode('-', $_GET["ids"]); ?>
<?php $compare_count = count($programs_to_compare); ?>
<?php $column_width = $compare_count == 2 ? 'col-md-4' : 'col-md-3'; ?>

<?php //----- POPULATE PROGRAM INFO OBJECTS -----//
	foreach($programs_to_compare as $program_id) {
		$program_info[] = new programInfo($program_id);
	}
?>

<?php //----- POPULATE & SORT PROGRAM SCHEDULE QUARTERS USED ARRAY -----// 
	$quarters_in_use = array();
	
	foreach ($program_info as $program) {
		if (!$program->ongoing_status) {
			foreach ($program->schedule as $date) {
				if (!array_key_exists($date['quarter'], $quarters_in_use)) {
					$quarters_in_use[$date['quarter']] = array(
						'start_date' => $date['start_date'],
						'quarter'	=> $date['quarter'],
					); 
				}
			}
		}
	}
	
	function sort_by_date($a, $b) {
		return ($a['start_date'] < $b['start_date']) ? -1 : 1;
	}
	usort($quarters_in_use, 'sort_by_date');
?>

<?php get_header(); ?>

	<div class="row compare-programs-container">
	
		<div class="col-xs-12 visible-xs visible-sm">
			<img src="<?php echo get_bloginfo('template_directory'); ?>/images/created-a-monster.jpg" />
			<h1>Whoa!!!</h2>
			<p>It looks like we created a monster. We tried our best to contain it, but we just couldn't fit all of that information on a tiny screen like this one.  If you are on an Ipad, try rotating it to the landscape mode, otherwise, you may have to try again on a computer with a larger monitor.</p>
		</div>
	
	
	
	
	
		<div class="col-md-12 col-lg-9 visible-md visible-lg">
			<div class="compare-programs-content-container">
		
				
				
				<?php //----- PROGRAM THUMBNAIL -----// ?>
				<div class="row">
				<div class="<?php echo $column_width; ?> compare-label" style="background: white;"></div>
				<?php foreach($program_info as $program_object) { ?>
					<div class="<?php echo $column_width; ?> compare-info-available compare-thumbnail">
						<?php echo get_the_post_thumbnail($program_object->program_id, '16:9-media-thumbnail'); ?>
					</div>
				<?php } ?>
				</div>
				
				
				<?php //----- PROGRAM TITLE -----// ?>
				<div id="compare-programs-title-row" class="row" data-spy="affix" data-offset-top="385">
				<div class="<?php echo $column_width; ?> compare-label"><h6>Program Name</h6></div>
				<?php foreach($program_info as $program_object) { ?>
					<div id="compare-program-title" class="<?php echo $column_width; ?> compare-info-available" style="border-top: 3px solid #<?php echo get_program_color($program_object->program_id); ?>">
						<?php $title = $program_object->program_short_name ? $program_object->program_short_name : get_the_title($program_object->program_id); ?>
						<a href="<?php echo get_permalink(get_page_by_path($program_object->program_slug, OBJECT, 'program')); ?>"><?php echo $title; ?></a>
					</div>
				<?php } ?>
				</div>
				
				
				<?php //----- CLASSIFICATION -----// ?>
				<div class="row">
				<div class="<?php echo $column_width; ?> compare-label"><h6>Classification</h6></div>
				<?php foreach($programs_to_compare as $program_id) { ?>
					<div class="<?php echo $column_width; ?> compare-info-available">
						<?php $classification = wp_get_post_terms($program_id, 'program_classification') ?>
						<?php echo $classification[0]->name; ?>
					</div>
				<?php } ?>
				</div>
				
				<?php //----- PROGRAM DURATION -----// ?>
				<div class="row">
				<div class="<?php echo $column_width; ?> compare-label"><h6>Program Duration</h6></div>
				<?php foreach($program_info as $program) { ?>
					<div class="<?php echo $column_width; ?> compare-info-available">
						<?php echo $program->academic_info['program_duration']; ?> Weeks
					</div>
				<?php } ?>
				</div>
				
				
				<?php //----- PROGRAM PREREQUISITES -----// ?>
				<div class="row">
					<div class="<?php echo $column_width; ?> compare-label"><h6>Prerequisite Programs</h6></div>
					
					<?php foreach($program_info as $program_object) { ?>
						<?php if (isset($program_object->academic_info['program_prereqs'])) { ?>
							<div class="<?php echo $column_width; ?> compare-info-available">
								<?php foreach ($program_object->academic_info['program_prereqs'] as $prereq) { ?>
									<div><a href="<?php echo get_permalink(get_page_by_path($prereq['slug'], OBJECT, 'program')); ?>"><i class="icon-location-arrow"></i> <?php echo $prereq['name']; ?></a></div>
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
				
				
				
				<?php //----- PREREQUISITES -----// ?>
				<div class="row">
					<div class="<?php echo $column_width; ?> compare-label"><h6>Prerequisites</h6></div>
					
					<?php foreach($program_info as $program_object) { ?>
						<?php if (isset($program_object->academic_info['recommended_prereqs'])) { ?>
							<div class="<?php echo $column_width; ?> compare-info-available">
								<ul>
								<?php foreach($program_object->academic_info['recommended_prereqs'] as $prereq) { ?>
									<li><?php echo $prereq; ?></li>
								<?php } ?>
								</ul>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
				
				
				
				<?php //----- ACCREDITATION -----// ?>
				<div class="row">
				<div class="<?php echo $column_width; ?> compare-label"><h6>Accreditation</h6></div>
				<?php foreach($program_info as $program) { ?>
					<?php if ($program->academic_info['accreditation'] != '') { ?>
						<div class="<?php echo $column_width; ?> compare-info-available">
							<ul>
							<li><?php echo $program->academic_info['accreditation']; ?></li>
							</ul>
						</div>
					<?php } ?>
				<?php } ?>
				</div>
				

				
				<?php //----- HAS OUTREACH -----// ?>
				<div class="row">
				<div class="<?php echo $column_width; ?> compare-label"><h6>Outreach Phase</h6></div>
				<?php foreach($program_info as $program_object) { ?>
					<div class="<?php echo $column_width; ?> compare-info-available">
						<?php 
						if ($program_object->academic_info['has_outreach'] == 'yes') {
							echo '<i class="icon-check"></i>';
						} elseif ($program_object->academic_info['has_outreach'] == 'as-god-allows') {
							echo '<i class="icon-check"></i>';
						} else {
							echo '<i class="icon-check-empty"></i>';
						}
						?>
						<?php echo ucwords(str_replace( '-', ' ', $program_object->academic_info['has_outreach'])); ?>
					</div>
				<?php } ?>
				</div>
				
				
				
					<?php //----- OUTREACH DURATION -----// ?>
					<div class="row">
					<div class="<?php echo $column_width; ?> compare-label"><h6>Outreach Duration</h6></div>
					<?php foreach($program_info as $program_object) { ?>
						<?php if ($program_object->academic_info['has_outreach'] == 'yes') { ?>
							<div class="<?php echo $column_width; ?> compare-info-available">
								<?php echo $program_object->academic_info['outreach_duration']; ?> Weeks
							</div>
						<?php } else { ?>
							<div class="<?php echo $column_width; ?> compare-info-not-available"></div>
						<?php } ?>
					<?php } ?>
					</div>
					
					<?php //----- OUTREACH DURATION -----// ?>
					<div class="row">
					<div class="<?php echo $column_width; ?> compare-label"><h6>Outreach Locale</h6></div>
					<?php foreach($program_info as $program_object) { ?>
						<?php if ($program_object->academic_info['has_outreach'] == 'yes'  || $program_object->academic_info['has_outreach'] == 'as-god-allows') { ?>
							<div class="<?php echo $column_width; ?> compare-info-available">
								<?php $i = 1; ?>
								<?php foreach($program_object->academic_info['outreach_locale'] as $outreach_locale) { ?>
									<?php $comma = $i != 1 ? ', ': null; ?> 
									<?php echo $comma . ucwords($outreach_locale); ?>
									<?php ++$i; ?>
								<?php } ?>
							</div>
						<?php } else { ?>
							<div class="<?php echo $column_width; ?> compare-info-not-available"></div>
						<?php } ?>
					<?php } ?>
					</div>
				
				
				<?php //----- ONGOING STATUS -----// ?>
				<div class="row">
				
					<?php //----- LABELS FOR ONGOING SCHEDULE -----// ?>
						<div class="<?php echo $column_width; ?> compare-label"><h6>Ongoing Schedule</h6>
						
							<div class="compare-programs-sub-label">Startup Costs</div>
							<div class="compare-programs-sub-label">Cost of Living</div>
							<div class="compare-programs-sub-label">Support(Single)</div>
							<div class="compare-programs-sub-label">Support (Married)</div>
						
						</div>
					
				<?php foreach($program_info as $program_object) { ?>
					<div class="<?php echo $column_width; ?> compare-info-available">
						<?php if ($program_object->ongoing_status) { ?>
							<div><i class="icon-check"></i> Yes</div>
							<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Applications</span><?php echo ucwords($program_object->schedule[0]['app_status']); ?> <i class="icon-circle-blank" style="color: #<?php echo $program_object->schedule[0]['app_status_color']; ?>;"></i></div>
							<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Startup Costs</span><?php echo $program_object->schedule[0]['ongoing_startup_cost']; ?></div>
							<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Cost of Living</span><?php echo $program_object->schedule[0]['ongoing_monthly_cost']; ?>/Mo.</div>
							<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Support (Single)</span><?php echo $program_object->schedule[0]['ongoing_min_support_single']; ?>/Mo.</div>
							<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Support (Married)</span><?php echo $program_object->schedule[0]['ongoing_min_support_married']; ?>/Mo.</div>
						<?php } else { ?>
							<div><i class="icon-check-empty"></i> No</div>
						<?php } ?>
						
					</div>
				<?php } ?>
				</div>
				
				
				
				
				
				<?php 
				//----- SCHEDULE SECTION -----// 
				/*
				 *	Loop through each quarter, and within each quarter check
				 *	for an existing instance of the school or program within
				 *	that particular quarter.
				 *
				 */
				?>
				
				<?php foreach($quarters_in_use as $quarter) { ?>
				
					<?php //----- DISPLAY QUARTER INFORMATION -----// ?>
					<div class="row">
					
						<?php //----- LABELS FOR SCHEDULE INFORMATION -----// ?>
						<div class="<?php echo $column_width; ?> compare-label"><h6><?php echo $quarter['quarter']; ?></h6>
						
							<div class="compare-programs-sub-label">Start</div>
							<div class="compare-programs-sub-label">Finish</div>
							<div class="compare-programs-sub-label">Program Cost</div>
							<div class="compare-programs-sub-label">Application Deadline</div>
						
						</div>
					
					<?php
					//----- FIND OUT IF PROGRAM OBJECT HAS SCHEDULED DATES IN QUARTER -----//
					/*
					 *	Unfortunately this is the best way to figure out whether or not to display
					 *	the blank box, or actually display an info box.  Since each object could have
					 *	up to four entries, there needs to be a preliminary check to see if one of
					 *	them fits into the quarter.  At which point, you can loop through again, and
					 *	find the exact quarter information.
					 */
					?>
					<?php foreach($program_info as $program_object) { ?>
						<?php if (!$program_object->ongoing_status) { ?>
							<?php $date_exists_for_quarter = false; ?>
							<?php foreach ($program_object->schedule as $instance) { ?>
								<?php if ($instance['quarter'] == $quarter['quarter']) { ?>
									<?php $date_exists_for_quarter = true; ?>
								<?php } ?>
							<?php } ?>
							
							<?php //----- DISPLAY INFORMATION IF DATE EXISTS FOR QUARTER -----// ?>
							<?php if ($date_exists_for_quarter) { ?>

								<?php foreach ($program_object->schedule as $instance) { ?>
									<?php if ($instance['quarter'] == $quarter['quarter']) { ?>
										<div class="<?php echo $column_width; ?> compare-info-available">
											<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Applications</span><?php echo ucwords($instance['app_status']); ?> <i class="icon-circle-blank" style="color: #<?php echo $instance['app_status_color']; ?>;"></i></div>
											<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Start</span><?php echo date("F d, Y", strtotime($instance['start_date'])); ?></div>
											<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Finish</span><?php echo date("F d, Y", strtotime($instance['end_date'])); ?></div>
											<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Cost</span><?php echo $instance['total_cost']; ?></div>
											<div class="compare-programs-sub-info"><span class="compare-programs-sub-info-label">Deadline</span><?php echo date("F d, Y", strtotime($instance['app_deadline'])); ?></div>
										</div>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<div class="<?php echo $column_width; ?> compare-info-not-available"></div>
							<?php } ?>
						<?php } ?>
						
					<?php } ?>
					</div>

				<?php } // END QUARTER CHECK ?>
				
				
				
				</div><!-- /.compare-programs-container -->
			</div>
		
		
		<div class="col-md-12 col-lg-3 sidebar">
			<h2>Comparing Programs</h2>
			<p>While we value all of our programs here at YWAM Montana - Lakeside, our top priority is directing students to the programs that can best equip them for the passions God has placed in their lives.</p>
			<div>
				<a href="<?php echo get_bloginfo('url'); ?>/contact/?destination=registrar"><div class="compare-programs-button col-md-3 col-lg-12">Contact Registrar</div></a>
				<a href="<?php echo get_bloginfo('url'); ?>/programs/"><div class="compare-programs-button col-md-3 col-lg-12">Program Archive</div></a>
			</div>
		</div>
		
		
		</div>

<?php get_footer(); ?>