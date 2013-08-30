<?php
/*
 *	Function to display the related posts widget in Main Menu
 *
 *	@param string $category
 *	@param string $title
 *	@outputs HTML
 */

 	function main_menu_latest_posts($section_slug, $category = null, $title = 'Blogroll') { ?>
	<?php global $post; ?>
	
	   <?php $blogroll_args = array(
			'posts_per_page' 	=> 6,
			'post_type' 		=> 'post',
			'category_name'		=> $category,
			'orderby'			=> 'date',
	   ); ?>
	   
	   <?php $blogroll = new WP_Query( $blogroll_args ); ?>
	   <?php if ( $blogroll->have_posts() ) { ?>
	   <?php $i = 1; ?>
		   <?php while ( $blogroll->have_posts() ) { ?>
			   <?php $blogroll->the_post(); ?>
	   				<div id="related-post-<?php echo $post->ID; ?>" class="related-post <?php if($i==1) {echo 'active-related-post';} ?>">
						
						<?php the_post_thumbnail( 'menu-banner' );?>
						<?php $ribbon = new PostRibbon($post->ID); ?>
						<?php $ribbon->build_ribbon('horizontal', 3); ?>
						
						
						<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
						<p class="related-post-excerpt"><?php echo get_the_excerpt(); ?></p>
						
					</div>
		   <?php $i = ++$i; ?>
		   <?php } ?>
	   <?php } ?>
	   <?php wp_reset_postdata(); ?>
	   
	<div class="related-posts-menu-container">
		<ul class="related-posts-menu">
			<li id="related-posts-menu-title"><?php echo $title; ?></li>
			   <?php $blogroll = new WP_Query( $blogroll_args ); ?>
			   <?php if ( $blogroll->have_posts() ) { ?>
			   <?php $i = 1; ?>
			   
				   <?php while ( $blogroll->have_posts() ) { ?>
					   <?php $blogroll->the_post(); ?>
					   
					   		<li id="related-post-menu-item-<?php echo $post->ID; ?>" data-section="<?php echo $section_slug ?>-dropdown" data-id="<?php echo $post->ID; ?>" <?php if($i==1) { ?>class="active-related-post-menu-item"<?php } ?> >
					   			<?php echo $i; ?>
					   		</li>
					   <?php $i = ++$i; ?>
				   <?php } ?>
			   <?php } ?>
			   <?php wp_reset_postdata(); ?>
			<li class="related-posts-menu-archive-link">View All Posts</li>
		</ul>
	</div>
 <?php } ?>



<?php
/*
 *	Function to display Primary Menu Contents
 *
 *	@param string $menu_location
 *	@outputs HTML
 */

 	function disp_primary_menu($menu_location) {
		$args = array(
			'nopaging'				=>  true ,
			'post_type' 	 		=>	'page',
			'page_menu_location' 	=>  $menu_location,
			'order' 				=>  'ASC',
			'orderby'				=> 	'meta_value_num',
			'meta_key' 				=>  'menu_priority',
		);
	   
	   $my_query = new WP_Query( $args );
	   if ( $my_query->have_posts() ) {
		   
		   echo '<ul>'; 
		   
		   while ( $my_query->have_posts() ) {
			   $my_query->the_post();
			   echo '<a href="' . get_permalink() . '" rel="bookmark" title="' . the_title_attribute(array('echo' => FALSE)) . '"><li>' . get_the_title() . '</li></a>';
		   }
		   
		   echo '</ul>';
	   }
	   wp_reset_postdata();
	}


?>



<?php //----- START DESKTOP MENU -----// ?>

<div class="row main-menu-desktop-container visible-md visible-md visible-md visible-lg">
	<ul class="main-menu-desktop">
		
		<?php //----- ABOUT MENU -----// ?>
		<li class="span first-item"><span class="link-wrapper"><a href="#">About</a><i class="icon-caret-up"></i></span>
		 	<!--ABOUT DROPDOWN-->
		 	<ul id="about-dropdown" class="dropdown-container stretch-fullscreen clearfix">
		 		
		 		
		 		<div class="col-md-3 primary-menu">
			 		<?php disp_primary_menu('about'); ?>		
		 		</div>
		 		
		 		
		 		<div class="col-md-2 center-highlight">
		 			<div class="sub-main-menu">
						
						
						
							<!--------------WORSHIP ARTS----------->
							
							<?php // QUERY FOCUS MINISTRIES IN WORSHIP ARTS ?>
		 					<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'focus_ministries',
							'focus_ministry_circles' 	=>  'worship-arts',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Worship Arts</label>	
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>		
							
							
							
							<!--------------GLOBAL SERVICES----------->
							
							<?php // QUERY FOCUS MINISTRIES IN GLOBAL SERVICES ?>
		 					<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'focus_ministries',
							'focus_ministry_circles' 	=>  'global-services',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Global Services</label>	
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						
		 			</div>
		 		</div>
		 		
		 		
		 		<div class="col-md-7 menu-related-posts">
			 		<?php main_menu_latest_posts('about')	; ?>	   
		 		</div>
		 	</ul>
		 </li>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 <!--TRAINING LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Training</a><i class="icon-caret-up"></i></span>
		 	
			
			<!--TRAINING DROPDOWN-->
			<ul class="dropdown-container stretch-fullscreen clearfix">
		 		<div class="col-md-3 primary-menu">
		 			<?php disp_primary_menu('training'); ?>
		 		</div>
		 		
		 		
		 		<div class="col-md-9 center-highlight">
		 				<div class="row sub-main-menu">
							
							
							<?php
							/*
							 * Builds Each Section of the Programs Menu According to Classification
							 *
							 *	@param array $class
							 *	@outputs HTML
							 */
							?>
							<?php function build_program_class_menu($class, $programs_in_class) { ?>
								<label><?php echo $class->name; ?></label>
							   <ul style="border-left: 2px solid #<?php echo get_classification_color($class->slug); ?>; padding-left: 5px;">
							   <?php while ( $programs_in_class->have_posts() ) { ?>
								   <?php $programs_in_class->the_post(); ?>
								   
									<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
									<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
								   
							   <?php } ?>
							   </ul>
							<?php } ?>
						
							<?php // LARGE SCREEN FORMAT DISPLAY ?>
							<?php $i = 1; ?>
							
							<?php // DETERMINE ORDER OF PROGRAM CLASSIFICATIONS
								$program_classifications_order = array(
									'discipleship-training-schools',
									'biblical-studies',
									'career-discipleship',
									'summer-programs',
									'seminars',
									'secondary-schools',
								); 
							?>
							
							<?php // POPULATE PROGRAM CLASSIFICATION OBJECT
								$order = 1;
								foreach($program_classifications_order as $classification){
									$program_classifications[$order] = get_term_by('slug', $classification, 'program_classification');
									$order = ++$order;
								}
							?>
								
								<div class="row xl-programs-menu-row">
									<?php foreach ($program_classifications as $class) { ?>				
										<div class="col-md-4">							
											<?php 
											$args = array(
												'nopaging'					=>  true ,
												'post_type' 	 			=>	'program',
												'program_classification' 	=>  $class->slug,
											); 
											?>
											   
										   <?php $programs_in_class = new WP_Query( $args ); ?>
										   <?php if ( $programs_in_class->have_posts() ) { ?>
											   <?php build_program_class_menu($class, $programs_in_class); ?>
										   <?php } ?>
										   <?php wp_reset_postdata(); ?>
										</div>
									<?php if ($i == 3){echo '</div><div class="row xl-programs-menu-row">';}?>
									<?php $i = ++$i; ?>
									<?php } ?>
								</div>
						
						
							<?php // NORMAL SCREEN FORMAT DISPLAY ?>
								<?php $i = 1; ?>
								
								<div class="row programs-menu-row">
									<?php foreach ($program_classifications as $class) { ?>				
										<div class="col-md-6">							
											<?php 
											$args = array(
												'nopaging'					=>  true ,
												'post_type' 	 			=>	'program',
												'program_classification' 	=>  $class->slug,
											); 
											?>
											   
										   <?php $programs_in_class = new WP_Query( $args ); ?>
										   <?php if ( $programs_in_class->have_posts() ) { ?>
											   <?php build_program_class_menu($class, $programs_in_class); ?>
										   <?php } ?>
										   <?php wp_reset_postdata(); ?>
										</div>
									<?php if ($i == 2 || $i == 4){echo '</div><div class="row programs-menu-row">';}?>
									<?php $i = ++$i; ?>
									<?php } ?>
								</div>
						
						
							
		 			</div>
		 		</div>
		 		
		 	</ul>
		 </li>
		 
		 
		 
		 
		 
		 
		 
		 
		 <!--OUTREACH LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Outreach</a><i class="icon-caret-up"></i></span>
		 
		 <!--OUTREACH DROPDOWN-->
		 	<ul id="outreach-dropdown" class="dropdown-container  stretch-fullscreen clearfix">
		 		
		 		<div class="col-md-3 primary-menu">
		 			<?php disp_primary_menu('outreach'); ?>
		 		</div>

		 		<div class="col-md-2 center-highlight">
		 			<div class="sub-main-menu">
		 			
		 						<!----------TARGET NATIONS------------>
							
		 					<?php // QUERY SCHOOLS IN DISCIPLESHIP TRAINING CLASS ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'target_nations',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Target Nations</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
				
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
							   
							   
							   
							<!---------- COMMUNITY EVENTS ------------>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'page',
							'page_menu_location'			=> 	'community-events',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Community Events</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
				
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>	 				
		 			</div>
		 		</div>
		 		
		 		<div class="col-md-7 menu-related-posts">
					<?php main_menu_latest_posts('outreach', 'outreach-updates', 'Outreach Updates')	; ?>
				</div>	
		 		
		 	</ul>
		 </li>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 <!--RESOURCES LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Resources</a><i class="icon-caret-up"></i></span>
		 
		 <!--RESOURCES DROPDOWN-->
		 	<ul id="resources-dropdown" class="dropdown-container stretch-fullscreen clearfix">
		 		
		 		<div class="col-md-3 primary-menu">
		 			<?php disp_primary_menu('resources'); ?>
		 		</div>			
							 		
		 		<div class="col-md-2 center-highlight">
		 			<div class="sub-main-menu">
		 				<label>Post Categories</label>
		 				<ul>
		 					<?php $args = array(
		 							'title_li'   => '',
		 							'exclude'	=> '16',
		 					); ?>
		 				
		 					<?php wp_list_categories($args); ?>
		 				</ul>
		 			</div>
		 		</div>
		 		
		 		<div class="col-md-7 menu-related-posts">
					<?php main_menu_latest_posts('resources', 'staff-articles', 'Staff Articles')	; ?>
				</div>
		 		
		 	</ul>
		 </li>
		 
		 
		 
		 
		 
		 <!--GET INVOLVED LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Get Involved</a><i class="icon-caret-up"></i></span>
		 
		 <!--GET INVOLVED DROPDOWN-->
		 	<ul id="get-involved-dropdown" class="dropdown-container stretch-fullscreen clearfix">
		 		
		 		<div class="col-md-3 primary-menu">
		 			<?php disp_primary_menu('get-involved'); ?>
		 		</div>
		 		
		 		<div class="col-md-2 center-highlight">
		 			<div class="sub-main-menu">
		 					<!---------- COMMUNITY EVENTS ------------>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'page',
							'page_menu_location'			=> 	'ways-to-serve',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Ways To Serve</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
				
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
							   
							   
							<!---------- PROJECTS ------------>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'projects',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Projects</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
				
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>

							   
		 			</div>
		 		</div>
		 		
		 		<div class="col-md-7 menu-related-posts">
					<?php main_menu_latest_posts('get-involved', 'project-updates', 'Project Updates')	; ?>
				</div>
		 		
		 	</ul>
		 </li>
		
	</ul>
</div>