<?php
/*
Template Name: Outreach Locations
*/
?>

<?php get_header(); ?>
<?php //GET STATS
	$countries_visited = wp_count_terms('outreach_locations');
	$outreach_updates = get_category_by_slug('outreach-updates');
	$outreach_updates = $outreach_updates->count;


?>



	
	<?php $args = array (
		'include-gallery' 	=> false,
		'include-map'		=> true,
		'outreach-index'	=> true,
	); ?>
	
	<?php get_banner($args); ?>
		
		
		
		<div class="row outreach-update-archive-post-container">
			<div class="col-md-8">
				<h1>Outreach Updates</h1>
				<div class="outreach-updates-archive-subtitle clearfix">
					<div><?php echo $countries_visited; ?> Outreaches</div>
					<div><?php echo $countries_visited; ?> Countries Visited</div>
					<div><?php echo $outreach_updates; ?> Outreach Stories</div>
				</div>
				
					<?php
					$args = array(
						'post_type' => 'post',
						'category_name' => 'outreach-updates',
						'paged'		=> $paged,
					);
					
					query_posts($args);
					if ( have_posts() ) : while ( have_posts() ) : the_post();
					?>
					
					<div class="row">
						<div class="col-md-3">
							<?php echo the_post_thumbnail('thumbnail-card');  ?>
						</div>
						<div class="col-md-9">
							<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<?php the_excerpt(); ?>
						</div>
					</div>
				
					<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
			</div>
			
			
			
			
			
			<!------------------------------------- SIDEBAR --------------------------------------->
			<div class="col-md-4 sidebar">
			
			<ul>	
			
				<?php 
				$args = array(
					'title' => 'Recent Posts',
					'posts_per_page' => 5,
				);
				
				get_related_posts($args); 
				?>
			

			</ul>
			</div>
		</div>
	
	
		<div class="row">
			<div class="col-md-9">
				<?php if (function_exists("pagination")) {
				    pagination();
				} ?>
			</div>
		</div>
	
	
<?php get_footer(); ?>