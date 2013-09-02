<?php /* Template Name: Contact */ ?>

<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row">
	
	
		<div class="col-md-8">
			<h1>Contact Us</h1>
			<p><?php the_content(); ?><p>
			<?php echo do_shortcode('[gravityform id="1" name="Contact Form" title="false" description="false" ajax="true"]'); ?>
		</div><!--/.col-md-5-->
		
		<div class="col-md-4 sidebar">
			<ul>
			<?php get_related_posts(array('posts_per_page'=>5, 'title'=>'Latest Posts')); ?>
			<?php subscribe_widget(); ?>
			</ul>
		</div><!--/.col-md-4-->
	
	</div><!--/.row-->
<?php endwhile; else: endif; ?>
<?php get_footer(); ?>