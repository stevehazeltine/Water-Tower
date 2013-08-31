
	
				<!-------------BREADCRUMB ROW ---------->
					<div class="row visible-md visible-lg">
							<div class="breadcrumb-bar stretch-fullscreen">
								<?php if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p id="breadcrumbs"><span class="breadcrumb-title">You Are Here <i class="icon-arrow-right"></i></span><span style=
									"margin-right: 10px;">/</span>','</p>');
								} ?>
							</div>
					</div>
				
		
			<div class="row global-footer">
				<div class="footer-container stretch-fullscreen">
				
			



				


			<!------------------SOCIAL MEDIA --------------->
			
			
				
				<!--------UPCOMING SCHOOLS---------->
				<div class="row footer-content">
		
					
					<div class="col-xs-5 col-md-4 hidden-xs">
						<h5>Upcoming Schools</h5>
						
						<?php //GET THE UPCOMING SCHOOLS BY COMPARING ALL SCHOOL DATES ?>
						
						<?php // GET ALL PROGRAMS ?>
								<?php
	
								$currentdate = date("Ymd");
								
								 $args = array(
								   'posts_per_page' => '4',
								   'post_type' => 'program',
								   'meta_key' => 'start_date',
								   'orderby' => 'meta_value_num',
								   'order' => 'ASC',
								   'meta_query' => array(
									   array(
										   'key' => 'start_date',
										   'value' => $currentdate,
										   'compare' => '>=',
										   'type' => 'DATE',
									   ),
								   )
								 );
								 $query = new WP_Query($args);
								
								
								
								?>
								
								<?php while ( $query->have_posts() ) : ?>
								<?php $query->the_post(); ?>
										<div class="upcoming-school row">			
										
											
											
											<div class="col-xs-4 col-md-4" style="border-right: 2px solid #<?php echo get_program_color($post->ID); ?> ">
												<?php the_post_thumbnail( 'xs-thumbnail-card' ); ?>
											</div>
											
											
											<div class="col-xs-8 col-md-8">
												<div><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
												<div class="footer-start-date">Starts: <?php echo date("F d, Y", strtotime(rwmb_meta( 'start_date' )));?></div>
											</div>
										</div> <!--- /UPCOMING SCHOOL ---->
										
										<?php wp_reset_postdata(); ?>
								  <?php endwhile ?>
						
					</div> <!---- /SPAN 6 ----->						
			
	
				
				<!------ RECENT POSTS ---->
				
				<div class="col-md-4 visible-md visible-lg">
					<h5>Recent Posts</h5>
						<?php $query = new WP_Query( array('posts_per_page'=>'4', 'post_type'=>'post')); ?>
						
						<ul class="footer-recent-posts">
							<?php while ( $query->have_posts() ) : $query->the_post();?>
							
								<div class="row footer-related-post-container">
									<div class="col-md-4 footer-related-post-thumbnail">
										<?php the_post_thumbnail( 'xs-thumbnail-card' ); ?>
										<?php $ribbon = new PostRibbon($post->ID); ?>
										<?php $ribbon->build_ribbon('vertical', 2); ?>
									</div><!-- /.footer-related-post-thumbnail -->
									
									<div class="col-md-8 footer-related-post-title">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
										<div class="footer-start-date"><?php the_time('F j, Y') ?></div>
									</div><!-- /.footer-related-post-title -->
								</div><!-- /.footer-related-post-container -->
								
							<?php endwhile ?>
						</ul>
				</div> <!----   /RECENT POSTS ------>
				
				
				
				
				
				<!---- USER OPTIONS ----->
				<div class="col-12 col-sm-7 col-md-4 footer-user-options">
				
				<div class="footer-social-media">
					<a href="<?php echo get_social_media_link('facebook_url'); ?>"><img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/facebook-128.png" /></a>
					<a href="<?php echo get_social_media_link('twitter_url'); ?>"><img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/twitter-128.png" /></a>
					<a href="<?php echo get_social_media_link('instagram_url'); ?>"><img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/instagram-128.png" /></a>
					<a href="<?php echo get_social_media_link('vimeo_url'); ?>"><img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/vimeo-128.png" /></a>
					<a href="<?php bloginfo('atom_url'); ?>"><img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/rss-128.png" /></a>
				</div><!-- /.footer-social-media -->
				
				
				
				<ul>
					<a href="<?php echo get_bloginfo ('url'); ?>/programs"><li>Programs</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/apply"><li>Apply Online</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/contact"><li>Contact Us</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/staff-opportunities"><li>Staff Opportunities</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/contact"><li>Site Feedback</li></a>
					
				</ul>
				
				</div> <!---- /USER OPTIONS ---->
				
				
            
			</div>

        </div> 
			</div>
        
        
				<!------- LINK FOOTER ------>
					<div class="row">
						<div class="col-md-12 stretch-fullscreen link-footer-container"> 
							<div class="link-footer">
								
								<span class="user-access-point" style="float: right;"><?php wp_loginout(); ?></span>
								<a href="<?php echo get_bloginfo('url'); ?>">© YWAM Montana-Lakeside 2013</a>
								<a href="https://github.com/YWAM-Montana-Lakeside/Water-Tower/issues?state=open">Report A Bug</a>
								<a href="http://www.ywam.org">Youth With A Mission</a>
								
								
							</div>
						</div>
					</div>
						
        
        
        
        </div><!--#container-->
        </div> <!--#page-wrap-->
		<?php wp_footer(); ?>
    </body>
</html>
