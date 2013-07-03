<?php get_header(); ?>


<?php //START PRIMARY LOOP ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<!--RETRIEVE PROGRAM SLUG, USED FOR CUSTOM PROJECT TAXONOMY-->
				<?php $project_id = get_the_ID(); ?>
				<?php $project_slug = sanitize_title( get_the_title(), $fallback_title ); ?>

	<div class="banner-image normal-slider">
		<div id="banner-gallery" class="royalSlider rsDefault royal-slider-banner">
		    <img class="rsImg" src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-banner'); echo $image[0];?>" />
		    <?php // check if the post has a Post Thumbnail assigned to it.
				$images = rwmb_meta( 'slide_imgs', 'type=image' );
				foreach ( $images as $image ) { ?>
				    <img class="rsImg" src="<?php echo str_replace( '.jpg', '-1350x450.jpg', $image[full_url]); ?>" />
			<?php } ?>
		    
		</div>
	</div>
	
	<div class="row">
		<div class="span8">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<?php get_videos( null ,$project_slug); ?>
			
			
			
			
			
			<!--------------------------------->
			<!----- PROJECT STATUS CHART ------>
			<!--------------------------------->
			
			
			<h4>Project Status</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac ullamcorper dui, a vulputate diam. Morbi a metus vulputate, lobortis lacus lacinia, faucibus nisi. Duis at diam sagittis, fermentum felis at, vulputate mauris. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam erat lorem, ultrices et justo in, ullamcorper tincidunt neque. Ut pharetra massa justo, a dignissim odio egestas ac. Nunc tincidunt auctor velit sed malesuada. Aenean ac rhoncus eros, tempus condimentum dolor. Donec tristique viverra leo. Duis mauris turpis, vehicula et odio eget, posuere commodo mauris. Nulla quis lacus ligula.</p>
			
			<div class="row-fluid">
				<div class="span5">
					<div class="project-status-chart">
						<canvas id="project-status-all" width="800" height="800"></canvas>
						<canvas id="project-status-actual" width="800" height="800"></canvas>
						
						<script>
						jQuery(document).ready(function($) {
						
						var projectStatusAll = [
						
						
						//LOOP THROUGH TOTAL CHART DATA
						<?php $i = 1; ?>
						
						<?php $phase_title = 'phase' . $i . '_title'; ?>
						<?php $phase_total = 'phase' . $i . '_total_comp'; ?>
						<?php $phase_color = 'phase' . $i . '_color'; ?>
						<?php while (rwmb_meta($phase_title) !== '') { ?>
						
								{value : <?php echo rwmb_meta($phase_total); ?>, color : "#<?php echo rwmb_meta($phase_color); ?>" },	
								
							<?php $i = $i + 1; ?>
							<?php $phase_title = 'phase' . $i . '_title'; ?>
							<?php $phase_total = 'phase' . $i . '_total_comp'; ?>
							<?php $phase_color = 'phase' . $i . '_color'; ?>
						<?php } ?>
						
							]
						var options = {}
						var ctx = document.getElementById("project-status-all").getContext("2d");
						var myNewChart = new Chart(ctx).Doughnut(projectStatusAll, options);

						//START ACTUAL GRAPH
						var projectStatusActual = [
						
						
						//LOOP THROUGH ACTUAL CHART DATA
						<?php $i = 1; ?>
						
						<?php $phase_title = 'phase' . $i . '_title'; ?>
						<?php $phase_total = 'phase' . $i . '_total_comp'; ?>
						<?php $phase_actual = 'phase' . $i . '_actual_comp'; ?>
						<?php $phase_tbc = rwmb_meta($phase_total) - rwmb_meta($phase_actual); ?>
						<?php $phase_color = 'phase' . $i . '_color'; ?>
						<?php while (rwmb_meta($phase_title) !== '') { ?>
						
								<?php if ($phase_tbc !== '0') { ?>
									{value : <?php echo rwmb_meta($phase_actual); ?>, color : "#<?php echo rwmb_meta($phase_color); ?>" },	
									{value : <?php echo $phase_tbc; ?>, color : "#FFFFFF" },	
								<?php } else { ?>
									{value : <?php echo rwmb_meta($phase_actual); ?>, color : "#<?php echo rwmb_meta($phase_color); ?>" },	
								<?php } ?>
								
							<?php $i = $i + 1; ?>
							<?php $phase_title = 'phase' . $i . '_title'; ?>
							<?php $phase_total = 'phase' . $i . '_total_comp'; ?>
							<?php $phase_actual = 'phase' . $i . '_actual_comp'; ?>
							<?php $phase_tbc = rwmb_meta($phase_total) - rwmb_meta($phase_actual); ?>
							<?php $phase_color = 'phase' . $i . '_color'; ?>
						<?php } ?>
							]
							
						var options = {}
						var ctx = document.getElementById("project-status-actual").getContext("2d");
						var myNewChart = new Chart(ctx).Doughnut(projectStatusActual, options);
							
								
							});			
						</script>
					</div>
				</div>
				<div class="span7 project-status-chart-key">
				
					<?php //LOOP THROUGH PHASE TITLES, COLORS & DESCRIPTIONS ?>
					<?php $i = 1; ?>
					
					<?php $phase_title = 'phase' . $i . '_title'; ?>
					<?php $phase_color = 'phase' . $i . '_color'; ?>
					<?php $phase_desc = 'phase' . $i . '_desc'; ?>
					<?php while (rwmb_meta($phase_title) !== '') { ?>
					
							<div class="project-status-chart-key-item">
									<div style="background: #<?php echo rwmb_meta($phase_color); ?>;" class="chart-key-color-container" onClick="expandPhaseDesc(<?php echo 'phase'.$i.'desc'; ?>)"><i id="<?php echo 'phase'.$i.'descIcon'; ?>" class="icon-plus"></i></div>
									<h5><?php echo rwmb_meta($phase_title); ?></h5>
									<div id="<?php echo 'phase'.$i.'desc'; ?>" class="project-phase-description">
										<p><?php echo rwmb_meta($phase_desc); ?></p>
									</div>
							</div>
							
						<?php $i = $i + 1; ?>
						<?php $phase_title = 'phase' . $i . '_title'; ?>
						<?php $phase_color = 'phase' . $i . '_color'; ?>
						<?php $phase_desc = 'phase' . $i . '_desc'; ?>
					<?php } ?>
				
					<div class="project-status-chart-key-item">
							<div style="background: #EFEFEF;" class="chart-key-color-container"></div>
							<h5>To Be Completed</h5>
					</div>
				</div>
			</div><!--/.row-fluid-->
			
			
			<div class="row-fluid project-funds">
				<div class="span12">
					<div class="row-fluid" style="position: relative;">
						<div class="span10 project-funds-meter-container">
						
						<h4>Project Funds Raised</h4>
						
							<div class="project-funds-meter">
								<div class="project-funds-meter-inner" style="width: 45%;"></div>
							</div>
						</div><!--/.project-funds-raised-container-->
						<div class="span2 project-funds-percentage">
							<h5>45%</h5>
						</div>
					</div>
				</div>
			</div><!--/.row-fluid-->
			
			
			<!----- END PROJECT STATUS CHART ----->
			
		</div>
		
		
		<!------------------->
		<!----- SIDEBAR ----->
		<!------------------->
		
		<div class="span4 sidebar">
			<ul>
				<?php $related_args = array (
						'posts_per_page' 	=> 3,
						'project_taxo'		=> $project_slug,
				) ?>
				<?php get_related_posts($related_args); ?>
			</ul>
			
			
			
		</div>
	</div>

	<?php // CLOSE OFF THE MAIN LOOP ?>
	<?php endwhile; else: ?>
	<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
<?php endif; ?>

<?php get_footer(); ?>