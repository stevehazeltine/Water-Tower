<?php /* Template Name: Contact */ ?>

<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row">
	
	
		<div class="col-md-6">
			<h1>Contact Us</h1>
			<p><?php the_content(); ?><p>
		</div><!--/.col-md-5-->
		
		<div class="col-md-6">
			<?php echo do_shortcode('[gravityform id="1" name="Contact Form" title="false" description="false" ajax="true"]'); ?>
		</div><!--/.col-md-7-->
	
	</div><!--/.row-->
<?php endwhile; else: endif; ?>
<?php get_footer(); ?>