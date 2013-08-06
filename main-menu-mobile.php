<div class="navbar navbar-inverse navbar-fixed-top hidden-desktop">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-align-justify"></i>
			</a>
			<a class="brand" href="#"><img src="<?php echo get_bloginfo ('template_directory'); ?>/images/mobile-menu-logo.png" /></a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">About</a>
						<ul class="dropdown-menu">
							
							<?php //-----ABOUT PRIMARY MENU -----// ?>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'				=>  true ,
							'post_type' 	 		=>	'page',
							'page_menu_location' 	=>  'about',
							'order' 				=> 'ASC',
							'orderby'				=> 	'meta_value_num',
							'meta_key' 				=> 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</ul>
					</li>
					
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Training</a>
						<ul class="dropdown-menu">
							
							<?php //-----TRAINING PRIMARY MENU -----// ?>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'				=>  true ,
							'post_type' 	 		=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'training',
							'order' 				=> 'ASC',
							'orderby'				=> 'meta_value_num',
							'meta_key' 				=> 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</ul>
					</li>
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Outreach</a>
						<ul class="dropdown-menu">
							
							<?php //-----TRAINING PRIMARY MENU -----// ?>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'				=>  true ,
							'post_type' 	 		=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'outreach',
							'order' 				=> 'ASC',
							'orderby'				=> 'meta_value_num',
							'meta_key' 				=> 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</ul>
					</li>
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources</a>
						<ul class="dropdown-menu">
							
							<?php //-----TRAINING PRIMARY MENU -----// ?>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'				=>  true ,
							'post_type' 	 		=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'resources',
							'order' 				=> 'ASC',
							'orderby'				=> 'meta_value_num',
							'meta_key' 				=> 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</ul>
					</li>
					
					
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Get Involved</a>
						<ul class="dropdown-menu">
							
							<?php //-----TRAINING PRIMARY MENU -----// ?>

		 					<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
							<?php $args = array(
							'nopaging'				=>  true ,
							'post_type' 	 		=>	array('page', 'focus_ministries'),
							'page_menu_location' 	=>  'get-involved',
							'order' 				=> 'ASC',
							'orderby'				=> 'meta_value_num',
							'meta_key' 				=> 'menu_priority',
							); ?>
							   
							   <?php $my_query = new WP_Query( $args ); ?>
							   <?php if ( $my_query->have_posts() ) { ?>
								   <?php while ( $my_query->have_posts() ) { ?>
									   <?php $my_query->the_post(); ?>

										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									   
								   <?php } ?>
							   <?php } ?>
							   <?php wp_reset_postdata(); ?>
						</ul>
					</li>
					
					
					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	
	<div class="mobile-menu-ribbon">
		
		<?php //----- MENU HIGHLIGHT COLORS -----//
			$classifications = get_terms('program_classification');
			$width = 100*(1/count($classifications));
			foreach ($classifications as $classification) {
				$format = '<div id="%s" style="background: #%s; width:' . $width . '%%;"></div>';
				$slug = $classification->slug;
				$color = get_classification_color($slug);
				
				echo sprintf($format, $slug, $color);
			}
			
		?>
	</div>
	
</div>