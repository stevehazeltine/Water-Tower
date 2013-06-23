<?php get_header() ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php $args = array(
			'post-id'			=> get_the_ID(),
			'include-gallery' 	=> true,
			
	); ?>

	<?php get_banner($args); ?>
	
	<div class="row target-nations-container">
		
		
		<!-------- TARGET NATION CONTENT ------->
		<div class="span8 content-container">
	
			<div class="target-nations-title">
				<h1><?php the_title(); ?></h1>
			</div>
			
			<?php the_content(); ?>
						
		</div><!-----/.content-container------->
		
		
		<!------- TARGET NATION SIDEBAR ------->
		
		<div class="span4 sidebar">
			
			
			
			
			
			<ul class="target-nation-sidebar">
				<?php get_related_posts(5, '', '', get_the_title()); ?>
			</ul>		
			
			
			<!------GLOBAL PARTNERS -------->
			<div class="row-fluid target-nations-global-partners">
				<div class="span12">
				<h2>Global Partners</h2>
					
					<div class="row-fluid tn-global-partner-group-container">
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
					</div>
					
					<div class="row-fluid tn-global-partner-group-container">
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
						<div class=" span3 target-nations-global-partner">
							<img src="http://placehold.it/150x150" />
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
		
		
	</div><!------/.target-nations-container------>

<?php endwhile; else: ?>
				<p>Oh man, we seriously need to work on this.  It appears that we have lead you astray somehow, you may want to try back later.  Sorry about that.</p>
			<?php endif; ?>

<?php get_footer() ?>