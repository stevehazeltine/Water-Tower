
	
				<!-------------BREADCRUMB ROW ---------->
						<div class="row visible-desktop">
						<div class="col-lg-12 breadcrumb-bar-container">
							<div class="breadcrumb-bar">
								<?php if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb('<p id="breadcrumbs"><span class="breadcrumb-title">You Are Here <i class="icon-arrow-right"></i></span><span style=
									"margin-right: 10px;">/</span>','</p>');
								} ?>
							</div>
						</div>
						</div>
				
		
			<div class="row global-footer">
				<div class="col-lg-12 footer-container">
				
			



				


			<!------------------SOCIAL MEDIA --------------->
			
			
				
				<!--------UPCOMING SCHOOLS---------->
				<div class="row footer-info">
		
					
					<div class="col-lg-4 footer-upcoming-schools-container hidden-phone">
						<h5>Upcoming Schools</h5>
						
						<?php //GET THE UPCOMING SCHOOLS BY COMPARING ALL SCHOOL DATES ?>
						
						<?php // GET ALL PROGRAMS ?>
								<?php
	
								$currentdate = date("Ymd");
								echo $currentdate;
								
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
										
											
											
											<div class="col-lg-3 footer-upcoming-school-thumbnail" style="border-right: 3px solid #<?php echo get_program_color($post->ID); ?> ">
												<?php // check if the post has a Post Thumbnail assigned to it.
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'xs-thumbnail-card' );
												} else { ?>
													<img src="http://placehold.it/400x200" />
												<?php } ?>
											</div>
											
											
											
												<div><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
												<div class="footer-start-date"><?php echo date("F d, Y", strtotime(rwmb_meta( 'start_date' )));?> - <?php echo rwmb_meta( 'end_date'); ?></div>
											</div> <!--- /UPCOMING SCHOOL ---->
										
										<?php wp_reset_postdata(); ?>
								  <?php endwhile ?>
						
					</div> <!---- /SPAN 6 ----->						
			
	
				
				<!------ RECENT POSTS ---->
				
				<div class="col-lg-4 visible-desktop">
					<h5>Recent Posts</h5>
						<?php $query = new WP_Query( array('posts_per_page'=>'4', 'post_type'=>'post')); ?>
						
						<ul class="footer-recent-posts">
							<?php while ( $query->have_posts() ) : $query->the_post();?>
							
								<div class="row footer-related-post-container">
									<div class="col-lg-3 footer-related-post-thumbnail">
										<?php the_post_thumbnail( 'xs-thumbnail-card' ); ?>
									</div><!-- /.footer-related-post-thumbnail -->
									
									<div class="col-lg-9 footer-related-post-title">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
									</div><!-- /.footer-related-post-title -->
								</div><!-- /.footer-related-post-container -->
								
							<?php endwhile ?>
						</ul>
				</div> <!----   /RECENT POSTS ------>
				
				
				
				
				
				<!---- USER OPTIONS ----->
				<div class="col-lg-4 footer-user-options">
				
				<div class="footer-social-media">
					<img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/facebook-128.png" />
					<img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/twitter-128.png" />
					<img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/instagram-128.png" />
					<img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/vimeo-128.png" />
					<img src="<?php echo get_bloginfo ('template_directory'); ?>/img/social-media/rss-128.png" />
				</div><!-- /.footer-social-media -->
				
				
				<ul>
				
					<a href="<?php echo get_bloginfo ('url'); ?>/apply"><li>Apply Online</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/contact"><li>Contact Us</li></a>
					<a href="<?php echo get_bloginfo ('url'); ?>/staff-opportunities"><li>Staff Opportunities</li></a>
				
					
					
					<li class="user-login-options">
						<?php if ( is_user_logged_in() ) { ?>
							<a href="<?php echo wp_logout_url(); ?>" title="Logout">Logout <i class="icon-signout"></i></a>
							<span class="footer-login-separator">|</span> 
							<a href="<?php echo get_bloginfo('url'); ?>/wp-admin.php">Dashboard <i class="icon-cogs"></i></a>
							
						<?php } else { ?>
							<a href="<?php echo wp_login_url(); ?>">Login <i class="icon-signin"></i></a>
							<span class="footer-login-separator">|</span> 
							<?php wp_register( '', ' <i class="icon-key"></i>', true); ?>
						<?php } ?>
					</li>
				</ul>
				
				</div> <!---- /USER OPTIONS ---->
				
				
            
			</div>

        </div> 
			</div>
        
        
				<!------- LINK FOOTER ------>
					<div class="row">
						<div class="col-lg-12 link-footer-container"> 
							<div class="link-footer">
								 
								<a href="#_">© YWAM Montana-Lakeside 2013</a>
								<a href="#_">Contact</a>
								<a href="#_">Staff Opportunities</a>
								<a href="#_">Privacy Policy</a>
								<a href="#_">Terms of Use</a>
								<a href="#_">Support Us</a>
								<a href="#_">Site Feedback</a>
								<a href="#_">YWAM.org</a>
								

							</div>
						</div>
					</div>
						
        
        
        
        </div><!--#container-->
        </div> <!--#page-wrap-->
		
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
		<?php wp_footer(); ?>
    </body>
</html>
