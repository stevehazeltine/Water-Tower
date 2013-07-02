<div class="row main-menu-desktop-container visible-desktop">
	<ul class="main-menu-desktop">
		
		<!--ABOUT LINK-->
		<li class="span first-item"><span class="link-wrapper"><a href="#">About</a><i class="icon-caret-up" style="color: #609FCE;"></i></span>
		 	<!--ABOUT DROPDOWN-->
		 	<ul class="dropdown-container">
		 		<div class="span2 primary-menu">
		 			<div>
			 				<!----------ABOUT MENU PRIMARY SECTION------------>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'about',
							'order' => 'ASC',
							'orderby'					=> 	'meta_value_num',
							'meta_key' => 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><i class="icon-chevron-right"></i> <?php the_title(); ?></a></li>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
		 			</div>
		 		</div>
		 		
		 		<div class="span8 menu-related-posts">
			 			
			 			<!--LATEST POSTS--->
						   <?php $args = array(
								'posts_per_page' 	=> 2,
								'post_type' 		=> 'post',
								'orderby'			=> 'date',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   				<div class="related-post">
													<?php // check if the post has a Post Thumbnail assigned to it.
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'menu-banner' );
														} else { ?>
															<img src="http://placehold.it/1200x200" />
													<?php } ?>	
													
													
													<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p class="related-post-excerpt"><?php echo get_the_excerpt(); ?></p>
													
												</div>
												
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
						   
						   
						   
						   
						   
		 		</div>
		 		
		 		
			<div class="related-posts-menu-container">
	   			<ul class="related-posts-menu">
	   				<li class="related-posts-menu-title">Blogroll <i class="icon-rotate-right"></i></li>
	   				<li>1</li>
	   				<li>2</li>
	   				<li>3</li>
	   				<li>4</li>
	   				<li>5</li>
	   				<li>6</li>
	   				<li class="related-posts-menu-archive-link">View All Posts</li>
	   			</ul>
   			</div>
		 		
		 		
		 		
		 		
		 		
		 		
		 		
		 		
		 		
		 		<div class="span2 center-highlight">
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

		 		
		 		
		 	</ul>
		 </li>
		 
		 
		 
		 <!--TRAINING LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Training</a><i class="icon-caret-up"></i></span>
		 	<!--TRAINING DROPDOWN-->
			<ul class="dropdown-container">
		 		<div class="span2 primary-menu">
		 			<div>
			 			<!----------TRAINING MENU PRIMARY SECTION------------>
							
		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE TRAINING SECTION ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'training',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
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
		 		
		 		
		 		
		 		
		 		<!-------- RESOURCES RELATED POSTS --------->
		 		<div class="span3 menu-related-posts">
			 			
			 			<!--LATEST POSTS--->
						   <?php $args = array(
						   		'p'					=> 711,
								'posts_per_page' 	=> 2,
								'post_type' 		=> 'post',
								'orderby'			=> 'date',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   				<div class="related-post">
													<?php // check if the post has a Post Thumbnail assigned to it.
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'xs-mobile-banner' );
														} else { ?>
															<img src="http://placehold.it/1200x400" />
													<?php } ?>	
													
													
													<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p class="related-post-excerpt"><?php echo substr( get_the_content(), 0, 200 ); ?></p>
													<h6 class="related-post-author">Written By <?php coauthors_posts_links() ?></h6>
												</div>
												
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
			 			
			 			
		 		</div>

		 		
		 		<div class="span7 center-highlight center-highlight-programs-menu">
		 			<div>
		 				<div class="sub-main-menu sub-main-menu-two-up">
						
						
							
							<!------------DISCIPLESHIP TRAINING SCHOOLS---------->
						   
							<?php // QUERY SCHOOLS IN DISCIPLESHIP TRAINING CLASS ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'discipleship-training-schools',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Discipleship Training Schools</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>

							   
							   
			 				<!-------------BIBLICAL STUDIES------------>
							
							<?php // QUERY SCHOOLS IN BIBLICAL STUDIES CLASS ?>
			 				<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'biblical-studies',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Biblical Studies</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
			 				
							
							
							<!---------------SEMINARS-------------->
							
							<?php // QUERY SCHOOLS IN SEMINARS CLASS ?>
		 					<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'seminars',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
							       <label>Seminars</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>	
		 				</div>
						
						
						<!-----------LEFT SUBMENU----------->
		 				<div class="sub-main-menu sub-main-menu-two-up">
						
							<!--------------SECONDARY SCHOOLS----------->
							
							<?php // QUERY SCHOOLS IN SECONDARY SCHOOLS CLASS ?>
		 					<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'secondary-schools',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Secondary Schools</label>	
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
							   
							   
							   
			 				<!------------SUMMER PROGRAMS----------->
							
							<?php // QUERY SCHOOLS IN SUMMER PROGRAMS CLASS ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'summer-programs',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Summer Programs</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
			 				
							
							
							<!----------CAREER DISCIPLESHIP------------>
							
		 					<?php // QUERY SCHOOLS IN DISCIPLESHIP TRAINING CLASS ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'program',
							'program_classification' 	=>  'career-discipleship',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <label>Career Discipleship</label>
								   <ul>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>
									   
										<?php // CHECK IF SCHOOL IS RUNNING, AND ECHO LINK IF IT IS ?>
										<?php $status = rwmb_meta( 'running', $post->ID ); ?>
										<?php if ( $status != 0 ) { ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
										<?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a></li>
										<?php } ?>
									   
								   <?php } ?>
								   </ul>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
		 				</div>
		 			</div>
		 		</div>
		 		
		 	</ul>
		 </li>
		 
		 
		 
		 <!--OUTREACH LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Outreach</a><i class="icon-caret-up"></i></span>
		 
		 <!--OUTREACH DROPDOWN-->
		 	<ul class="dropdown-container">
		 		<div class="span2 primary-menu">
		 			<div>
			 			<!----------OUTREACH MENU PRIMARY SECTION------------>
							
		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE OUTREACH SECTION ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'outreach',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
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
		 		
		 		<div class="span8 menu-related-posts">
			 			
			 			<!--LATEST POSTS--->
						   <?php $args = array(
								'posts_per_page' 	=> 2,
								'post_type' 		=> 'post',
								'orderby'			=> 'date',
								'category_name'		=> 'outreach-updates',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   				<div class="sub-main-menu-two-up related-post">
													<?php // check if the post has a Post Thumbnail assigned to it.
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'xs-mobile-banner' );
														} else { ?>
															<img src="http://placehold.it/1200x400" />
													<?php } ?>	
													
													
													<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p class="related-post-excerpt"><?php echo substr( get_the_content(), 0, 200 ); ?></p>
													<h6 class="related-post-author">Written By <?php coauthors_posts_links() ?></h6>
												</div>
												
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
			 			
			 			
		 		</div> 		
		 		
		 		<div class="span2 center-highlight">
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
		 		
		 	</ul>
		 </li>
		 
		 
		 <!--RESOURCES LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Resources</a><i class="icon-caret-up"></i></span>
		 
		 <!--RESOURCES DROPDOWN-->
		 	<ul class="dropdown-container">
		 		<div class="span2 primary-menu">
		 			<div>
			 			<!----------RESOURCES MENU PRIMARY SECTION------------>
							
		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE RESOURCES SECTION ?>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'resources',
							'orderby'					=> 	'meta_value',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
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
		 		
		 		
		 		
		 		<!-------- RESOURCES RELATED POSTS --------->
		 		<div class="span8 menu-related-posts">
			 			
			 			<!--LATEST POSTS--->
						   <?php $args = array(
								'posts_per_page' 	=> 2,
								'post_type' 		=> 'post',
								'orderby'			=> 'date',
								'category_name'		=> 'staff-articles',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   				<div class="sub-main-menu-two-up related-post">
													<?php // check if the post has a Post Thumbnail assigned to it.
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'xs-mobile-banner' );
														} else { ?>
															<img src="http://placehold.it/1200x400" />
													<?php } ?>	
													
													
													<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p class="related-post-excerpt"><?php echo substr( get_the_content(), 0, 200 ); ?></p>
													<h6 class="related-post-author">Written By <?php coauthors_posts_links() ?></h6>
												</div>
												
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
			 			
			 			
		 		</div>
		 		
		 		<div class="span2 center-highlight">
		 			<div class="sub-main-menu">
		 				<label>Post Categories</label>
		 				<ul>
		 					<?php $args = array(
		 							'title_li'   => '',
		 							'exclude'	=> '16',
		 							'hide_empty' => 0,
		 					); ?>
		 				
		 					<?php wp_list_categories($args); ?>
		 				</ul>
		 			</div>
		 		</div>
		 		
		 	</ul>
		 </li>
		 
		 
		 <!--GET INVOLVED LINK-->
		 <li class="span"><span class="link-wrapper"><a href="#">Get Involved</a><i class="icon-caret-up"></i></span>
		 
		 <!--GET INVOLVED DROPDOWN-->
		 	<ul class="dropdown-container">
		 		<div class="span2 primary-menu">
		 			<div>
			 			
			 				<!----------GET INVOLVED MENU PRIMARY SECTION------------>
							<?php $args = array(
							'nopaging'					=>  true ,
							'post_type' 	 			=>	'page',
							'page_menu_location' 	=>  'get-involved',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
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
		 		
		 		<div class="span8 menu-related-posts">
			 			
			 			<!--LATEST POSTS--->
						   <?php $args = array(
								'posts_per_page' 	=> 2,
								'post_type' 		=> 'post',
								'orderby'			=> 'date',
						   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   				<div class="sub-main-menu-two-up related-post">
													<?php // check if the post has a Post Thumbnail assigned to it.
														if ( has_post_thumbnail() ) {
															the_post_thumbnail( 'xs-mobile-banner' );
														} else { ?>
															<img src="http://placehold.it/1200x400" />
													<?php } ?>	
													
													
													<h5 class="related-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p class="related-post-excerpt"><?php echo substr( get_the_content(), 0, 200 ); ?></p>
													<h6 class="related-post-author">Written By <?php coauthors_posts_links() ?></h6>
												</div>
												
							   <?php } ?>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
			 			
			 			
		 		</div>
		 		
		 		<div class="span2 center-highlight">
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
		 		
		 	</ul>
		 </li>
		
	</ul>
</div>