<?php get_header() ?>
<?php
$term_slug = get_query_var( 'term' );
$taxonomyName = get_query_var( 'taxonomy' );
$program_term = get_term_by( 'slug', $term_slug, $taxonomyName );
$program_object = get_page_by_path( $program_term->slug, OBJECT, 'program');
$program_id = $program_object->ID;
print_r($current_term); 
?>


		<div class="row">
			<div class="col-md-8 school-main-content-container">
				
				<div class="taxonomy-archive-title-container">
					<h2 style="border-left: 3px solid #<?php echo get_program_color($program_id); ?>;"><?php echo get_the_title($program_id); ?>: Blog</h2>
				</div>
			
			
			<?php $args = array(
				$taxonomyName => $term_slug,
				'post_type'	=> 'post',
			); ?>
			
			<?php query_posts( $args); ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="row loop-excerpt">
					<div class="col-md-3 loop-thumbnail">
						<?php echo the_post_thumbnail('thumbnail-card');  ?>
					</div>
					<div class="col-md-9 loop-content">
						<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
			
			
			</div>
			
			<div class="col-md-4 sidebar">
				<?php get_sidebar(); ?>
			</div>
			
		</div>

 <?php get_footer() ?>