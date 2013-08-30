<?php get_header() ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php $args = array(
			'post-id'			=> get_the_ID(),
			'include-gallery' 	=> true,
			
	); ?>

	<?php get_banner($args); ?>
	
	<div class="row target-nations-container">
		
		
		<!-------- TARGET NATION CONTENT ------->
		<div class="col-md-8 content-container">
	
			<div class="target-nations-title">
				<h1><?php the_title(); ?></h1>
			</div>
			
			<?php the_content(); ?>
						
		</div><!-----/.content-container------->
		
		
		<!------- TARGET NATION SIDEBAR ------->
		
		<div class="col-md-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
		
		
	</div><!------/.target-nations-container------>

<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>

<?php get_footer() ?>