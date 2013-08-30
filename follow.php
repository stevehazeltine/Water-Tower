<?php /* Template Name: Follow Us */ ?>

<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row">
	
	
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<h1 class="follow-us-title">Follow Us</h1>
				</div>
					
				<div class="col-md-6">
					<h1 class="follow-us-title">
						<span>
							<i class="follow-us-title-icons icon-facebook"></i>
							<i class="follow-us-title-icons icon-twitter"></i>
							<i class="follow-us-title-icons icon-instagram"></i>
						</span>
					</h1>
				</div>
				
			</div>
			<p><?php the_content(); ?><p>
		</div><!--/.col-md-5-->
		
		<div class="col-md-6">
			
			
				<?php get_instagram($insta_args); ?>
				
				
			
			
		</div><!--/.col-md-6-->
	
	</div><!--/.row-->
<?php endwhile; else: endif; ?>
<?php get_footer(); ?>