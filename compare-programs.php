<?php
/*
Template Name: Compare Programs
*/
?>

<?php get_header(); ?>
	<div class="row">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php $programs = explode('-', $_GET["ids"]); ?>
		<?php $compare_count = count($programs); ?>
		
				<div class="span12">
				<table class="compare-programs-table">
					<tr id="compare-programs-titles">
						<td class="compare-tier-one-bracket-placeholder"><?php //PLACEHOLDER LABEL FOR BLANK CELL AT 0x0 ?></td>
						<td class="compare-tier-two-bracket-placeholder"><?php //PLACEHOLDER FOR BRACKET ?></td>
						<?php foreach ($programs as $program) { ?>
							<td class="title-cell"><h6><?php echo get_the_title($program); ?></h6></td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket-placeholder"><?php //PLACEHOLDER LABEL FOR BLANK CELL AT 0x0 ?></td>
						<td class="compare-tier-two-bracket-placeholder"><?php //PLACEHOLDER FOR BRACKET ?></td>
						<?php foreach ($programs as $program) { ?>
							<td style="padding: 0px;">
								<?php // check if the post has a Post Thumbnail assigned to it.
												if ( has_post_thumbnail($program) ) {
													echo get_the_post_thumbnail( $program, 'xs-mobile-banner');
												} else {
												echo '<img src="http://placehold.it/320x107" />';
											} ?>
							</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"><h6>Basic Info <i class="icon-long-arrow-right"></i></h6></td>
						<td class="compare-tier-two-bracket">Classification<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>
								<?php $classifications = wp_get_post_terms($program, 'program_classification');
									foreach($classifications as $classification) {
										echo $classification->name;
									}
								?>
								
							</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Recommended Age Range<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>
								<?php if (rwmb_meta($program, 'minimum_age_rec', '', $post_id=$program) == '') {
									echo '17+ Years';
								} else {
									echo rwmb_meta('minimum_age_rec', '', $post_id=$program);
									if (rwmb_meta('maximum_age_rec', '', $post_id=$program) != '') {
										echo ' - ' . rwmb_meta('maximum_age_rec', '', $post_id=$program) . ' Years';	
									} else {
										echo '+ Years';
									}
								} ?>
								
							</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Duration<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>
								<?php if (rwmb_meta('program_duration', '', $post_id=$program) != '') { ?>
									<?php echo rwmb_meta('program_duration', '', $post_id=$program) . ' Months'; ?>
								<?php } ?>
							</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Dates & Cost<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>
								<?php $i = 1; ?>
								<?php $start_date = 'start_date'.$i; ?>
								<?php $end_date = 'end_date'.$i; ?>
								<?php $total_cost = 'total_cost'.$i; ?>
								<?php $season = 'season'.$i; ?>
								
								<?php while (rwmb_meta($start_date, null, $program) != '') : ?>
										
										<div>
											<?php echo date("M d", strtotime($start_date));?> - 
											<?php echo date("M d, Y", strtotime(rwmb_meta($end_date, null,$program))); ?>
											<br />
											<?php setlocale(LC_MONETARY,"en_US"); ?>
											<?php echo money_format( '%i', rwmb_meta($total_cost, null, $program)); ?>
										</div>
												
									<?php $i = $i+1 ?>
									<?php $start_date = 'start_date'.$i; ?>
									<?php $end_date = 'end_date'.$i; ?>
									<?php $total_cost = 'total_cost'.$i; ?>
									<?php $season = 'season'.$i; ?>
								<?php endwhile ?>
							</td>
						<?php } ?>
					</tr>
					
					
					
					<!---------------------->
					<!-- SCHEDULE SECTION -->
					<!---------------------->
					
					<tr class="compare-row-placeholder"><td class="compare-tier-one-bracket-placeholder"></td></tr>
					<tr>
						<td class="compare-tier-one-bracket"><h6>Schedule <i class="icon-long-arrow-right"></i></h6></td>
						<td class="compare-tier-two-bracket">Hourly Breakdown<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Cirriculum<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Tracks<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					
					
					<!---------------------->
					<!-- OUTREACH SECTION -->
					<!---------------------->
					
					<tr class="compare-row-placeholder"><td class="compare-tier-one-bracket-placeholder"></td></tr>
					<tr>
						<td class="compare-tier-one-bracket"><h6>Outreach <i class="icon-long-arrow-right"></i></h6></td>
						<td class="compare-tier-two-bracket">Outreach Phase<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Time On Outreach<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Location<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
					<tr>
						<td class="compare-tier-one-bracket"></td>
						<td class="compare-tier-two-bracket">Required<i class="tier-two-arrow icon-caret-up"></i></td>
						<?php foreach ($programs as $program) { ?>
							<td>5 Months</td>
						<?php } ?>
					</tr>
					
				</table>
				</div>
				
		
		
		
		
		<?php endwhile; else: ?>
			<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
		<?php endif; ?>
	
	</div><!-- /.row -->
<?php get_footer(); ?>