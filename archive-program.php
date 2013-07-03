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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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
				   
					<?php get_program_in_archive( $post->ID, true); ?>
				   
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