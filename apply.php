<?php
/*
Template Name: Apply
*/
?>

<?php get_header() ?>

<div class="row" style="margin-bottom: 45px;">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			 <div class="col-md-9 post">
	
					 <h2><?php the_title(); ?></h2>		
			
					 <div class="entry">
					   <?php the_content(); ?>
					 </div><!-- .entry -->

			 </div> <!-- .post -->
		 
			<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>
 
	<div class="col-md-3">
		<p>Application Process</p>
		<p>Privacy Policy</p>
		<p>Reference Forms</p>
		<p>Application Fees</p>
	</div>
 
</div><!--.row-->



	<?php if ( is_user_logged_in() ) { ?>
		<!--DISPLAY APPLICATION SPLASH PAGE IF USER IS LOGGED IN-->
			
			<div class="row">
				<div class="col-md-12">
				
					<?php global $current_user;
					      get_currentuserinfo();
					?>
					
					<?php $myrows = $wpdb->get_results( "SELECT id FROM wp_rg_lead WHERE created_by=$current_user->ID" ); ?>
					<?php foreach ($myrows as $row) {
							
							$lead_id = $row->id;
							
							
							$name = $wpdb->get_results( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = '$row->id' AND CAST(field_number AS DECIMAL) = CAST(1.6 AS DECIMAL) AND form_id = '1'" );
							foreach ($name as $option) {
								echo $option->value;
							}
							
					}?>
				
				
					<!--SHOW THE USER THE DIRECTORY OF THEIR PREVIOUS APPLICATIONS-->
					<?php echo do_shortcode('[directory form="1" search="false" lightboxsettings=""]'); ?>
				</div>
			</div><!--.row-->
		
		
		<?php } else { ?>
		<!--REQUEST USER LOGS IN TO CONTINUE FILLING OUT APPLICATION, OR REGISTERS TO BEGIN A NEW APPLICATION-->
		
		    <div class="row">
		    	<div class="col-md-6">
		    		<h4>Log in to continue your application or start a new one.</h4>
					
					<?php $args = array(
				        'echo' => true,
				        'redirect' => site_url( $_SERVER['REQUEST_URI'] ), 
				        'form_id' => 'loginform',
				        'label_username' => __( 'Username' ),
				        'label_password' => __( 'Password' ),
				        'label_remember' => __( 'Remember Me' ),
				        'label_log_in' => __( 'Log In' ),
				        'id_username' => 'user_login',
				        'id_password' => 'user_pass',
				        'id_remember' => 'rememberme',
				        'id_submit' => 'wp-submit',
				        'remember' => true,
				        'value_username' => NULL,
				        'value_remember' => false ); 
				    ?> 
		    		
		    		<?php wp_login_form( $args ); ?>
		    	</div><!--col-md-6-->
		    	
		    	<div class="col-md-6">
		    		<h4>Register to start a new application</h4>
		    		<?php gravity_form_enqueue_scripts(2, true); ?>
		    		<?php gravity_form(2, $display_title=true, $display_description=true, $display_inactive=false, $field_values=null, $ajax=false, $tabindex); ?>
		    	</div><!--col-md-6-->
		    </div><!--.row-->
			
	<?php } ?>


 <?php get_footer() ?>