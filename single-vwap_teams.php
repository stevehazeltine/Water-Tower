<?php get_header(); ?>

<?php get_banner($banner_args); ?>

<div class="row">
	<div class="span8">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
	
	<div class="span4 sidebar">
		<ul>
			<li>
				<?php get_related_posts($related_args); ?>
			</li>
		</ul>
	</div>
</div>


<?php get_footer(); ?>