<?php get_header() ?>
	<div class="row">
		
		

		
		<div class="span8 program-archive-container">
			<h1>Schools</h1>
			<div class="row-fluid">
				<div class="span12">
					<?php //----- USE PROGRAM ARCHIVE PAGE IN BACKEND TO PULL INFO FROM -----// ?>
					<?php $program_archive_content = get_post('1282'); ?>
					<?php echo $program_archive_content->post_content; ?>
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
		   
		   <div id="discipleship-training-schools" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('discipleship-training-schools'); ?>;">Discipleship Training Schools</h4>
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
		   
		   <div id="biblical-studies" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('biblical-studies'); ?>;">Biblical Studies</h4>
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
		   
		   <div id="seminars" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('seminars'); ?>;">Seminars</h4>
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
		   
		   <div id="secondary-schools" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('secondary-schools'); ?>;">Secondary Schools</h4>
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
		   
		   <div id="summer-programs" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('summer-programs'); ?>;">Summer Programs</h4>
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
		   
		   <div id="career-discipleship" class="program-archive-class-container">
		   <?php $my_query = new WP_Query( $args ); ?>
		   <?php if ( $my_query->have_posts() ) { ?>
		   		<h4 style="background: #<?php echo get_classification_color('career-discipleship'); ?>;">Career Discipleship</h4>
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
					<li id="discipleship-training-schools"><i class="icon-caret-right"></i><a href="#discipleship-training-schools">Discipleship Training Schools</a></li>
					<li id="biblical-studies"><i class="icon-caret-right"></i><a href="#biblical-studies">Biblical Studies</a></li>
					<li id="seminars"><i class="icon-caret-right"></i><a href="#seminars">Seminars</a></li>
					<li id="secondary-schools"><i class="icon-caret-right"></i><a href="#secondary-schools">Secondary Schools</a></li>
					<li id="summer-programs"><i class="icon-caret-right"></i><a href="#summer-programs">Summer Programs</a></li>
					<li id="career-discipleship"><i class="icon-caret-right"></i><a href="#career-discipleship">Career Discipleship</a></li>
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