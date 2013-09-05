<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/f090b0ab-a29c-44bc-8584-7393a3fd9858.css"/>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_bloginfo ('template_directory'); ?>/css/font-awesome.min.css">
        <!--[if IE 7]><link rel="stylesheet" href="<?php echo get_bloginfo ('template_directory'); ?>/css/font-awesome-ie7.min.css"><![endif]-->
        <link rel="stylesheet" href="<?php echo get_bloginfo ('template_directory'); ?>/royalslider/royalslider.css">
        <link rel="stylesheet" href="<?php echo get_bloginfo ('template_directory'); ?>/royalslider/skins/default/rs-default.css">
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
		<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh1Xcix_zUvT18IoC5ldxWJpYpCXzE9lo&sensor=false"></script>

        <script src="<?php echo get_bloginfo ('template_directory'); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		
		<?php wp_head(); ?>
		
		
		<?php //--------------------------// ?>
		<?php //----- DYNAMIC STYLES -----// ?>
		<?php //--------------------------// ?>
		
		<style>
		<?php //----- PROGRAM ARCHIVE MENU HIGHLIGHT COLORS -----//
			$classifications = get_terms('program_classification');
			foreach ($classifications as $classification) {
				$format = '.%s.active {border-left: 5px solid #%s !important;}';
				$slug = $classification->slug;
				$color = get_classification_color($slug);
				
				echo sprintf($format, $slug, $color);
			}
			
		?>
		</style>
		
		
		
		
    </head>
    <body data-spy="scroll" data-target="#scrollspy-nav">
	Hello World
		<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
	
		<?php include ('main-menu-mobile.php'); ?>
        
        <div class="row page-wrap">
        	<div class="container">
        	
        		<div class="header-bar  row visible-md visible-md visible-md visible-lg" style="margin-bottom: 40px;">
        			<div class="col-md-12">
	        			<div class="header-logo-container">
	        				<a href="<?php echo get_bloginfo ('url'); ?>"><img style="opacity: 100;" src="<?php echo get_bloginfo ('template_directory'); ?>/images/Logo_cleaner.png" /></a>
	        			</div>
						
						<div class="header-functions-container">
							
							<div class="header-functions">
								<div class="header-functions-buttons">
									<a href="<?php bloginfo('rss2_url'); ?>"><i class="icon-rss"></i></a>
								</div>
								
								<div class="search-bar"><?php get_search_form( true ); ?></div>
								<div class="established">EST. 1985</div>
								
		
							</div>
							
							
							
						</div>
        			</div>
        		</div>
        	
        	
        		<?php include ('main-menu-desktop.php') ?>
        		
        		