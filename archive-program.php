<?php get_header() ?>
	<div class="row">
		
		

		
		<div class="span8 program-archive-container">
		
			<h1>Schools</h1>
			<div class="row-fluid">
				<div class="span12">
				Mauris ac libero vitae tortor varius venenatis vel at lectus. Morbi ornare nisl eu est placerat id ultricies massa viverra. Sed suscipit porttitor nulla, et elementum urna volutpat a. Etiam imperdiet faucibus venenatis. Donec lacus est, convallis ut euismod at, iaculis ac felis. Aliquam erat volutpat. Pellentesque molestie blandit nisl. Aliquam iaculis enim vitae mauris tincidunt in malesuada felis fringilla. Phasellus ante quam, vulputate non sollicitudin at, sollicitudin a magna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc ac metus quis sem viverra cursus. Maecenas non dolor eu ante ultrices tristique eu ac orci.
				</div>
			</div>
		
		
		
		
		
		

		<!------------DISCIPLESHIP TRAINING SCHOOLS---------->
						   
		<?php // QUERY SCHOOLS IN DISCIPLESHIP TRAINING CLASS ?>
		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'discipleship-training-schools',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="discipleship-training-schools">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Discipleship Training Schools</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link visible-desktop">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare tool to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing. You can compare a maximum of 5 schools at once." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
							<span class="program-archive-acronym"><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></span></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		
		
		
		
		
		
		<!--------------------------->
		<!----- BIBLICAL STUDIES ----->
		<!--------------------------->

		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'biblical-studies',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="biblical-studies">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Biblical Studies</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link hidden-phone">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare feature to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		   
		   
		   
		<!-------------------->
		<!----- SEMINARS ----->
		<!-------------------->

		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'seminars',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="seminars">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Seminars</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link hidden-phone">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare feature to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		   
		   
		   
		   
		<!----------------------------->
		<!----- SECONDARY SCHOOLS ----->
		<!----------------------------->

		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'secondary-schools',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="secondary-schools">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Secondary Schools</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link hidden-phone">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare feature to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		   
		   
		<!--------------------------->
		<!----- SUMMER PROGRMAS ----->
		<!--------------------------->

		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'summer-programs',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="summer-programs">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Summer Programs</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link hidden-phone">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare feature to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		   
		   
		   
		   
		<!------------------------------->
		<!----- CAREER DISCIPLESHIP ----->
		<!------------------------------->

		<?php $args = array(
		'nopaging'					=>  true ,
		'post_type' 	 			=>	'program',
		'program_classification' 	=>  'career-discipleship',
		'orderby'					=> 	'meta_value',
		); ?>
		   
		   <div id="career-discipleship">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4>Career Discipleship</h4>
			   <?php while ( $my_query->have_posts() ) { ?>
				   <?php $my_query->the_post(); ?>
				   
					<div class=" row-fluid program-archive-school-container" id="<?php echo $post->ID; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php // check if the post has a Post Thumbnail assigned to it.
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'thumbnail-card' );
								} else { ?>
								<img src="http://placehold.it/1200x600" />
								<?php } ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<div class="program-archive-school-compare-link hidden-phone">
								<span>Compare 
									<i id="compare-programs-checkbox" data-programId="<?php echo get_the_id(); ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									<a href="#_" id="compare-program-desc-btn-<?php echo get_the_ID(); ?>" data-content="Use our simple compare feature to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing." data-original-title="Compare <?php echo rwmb_meta( 'acronym' ); ?> To Other Schools"><i class="icon-question"></i></a>
								</span>
							</div>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if (rwmb_meta( 'acronym' ) != '') {?> - ( <?php echo rwmb_meta( 'acronym' ); ?> )<?php } ?></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date' ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date' ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost' );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
				   
			   <?php } ?>
		   <?php } ?>
		   </div>
		   <?php wp_reset_postdata(); ?>
		   
		   
		</div>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div class="span4 program-archive-nav visible-desktop" >
			<div data-spy="affix" data-offset-top="210" id="scrollspy-nav" class="program-archive-menu">
				<ul class="span4 nav">
					<li><i class="icon-caret-right"></i><a href="#discipleship-training-schools">Discipleship Training Schools</a></li>
					<li><i class="icon-caret-right"></i><a href="#biblical-studies">Biblical Studies</a></li>
					<li><i class="icon-caret-right"></i><a href="#seminars">Seminars</a></li>
					<li><i class="icon-caret-right"></i><a href="#secondary-schools">Secondary Schools</a></li>
					<li><i class="icon-caret-right"></i><a href="#summer-programs">Summer Programs</a></li>
					<li><i class="icon-caret-right"></i><a href="#career-discipleship">Career Discipleship</a></li>
					<li class="compare-programs-list-container">
						
						<h6>Compare Schools</h6>
						<ul id="compare-programs-list">
							
						</ul>
						<a id="compare-programs-link" href="<?php echo get_bloginfo ('url'); ?>/compare-programs?ids=">Compare Schools</a>
					</li>
				</ul>
			</div>
		</div>
		   
		   
	</div>
	<div class="clearfix"> </div>
			
 
 <?php get_footer() ?>