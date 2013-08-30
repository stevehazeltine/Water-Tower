<?php get_header(); ?>

<?php //SET THE CURAUTH VARIABLE ?>
<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
<?php $post_object = get_page_by_path('cap-' . $author_name, OBJECT, 'guest-author'); ?>
<?php $coauthor_object = get_coauthors($post_object->ID); ?>


<?php
$args = array(
	'post-id' => $coauthor_object[0]->ID,
	'post-type' => 'guest-author',
);
 
get_banner($args); 
?>


<div class="row">

	<div class="col-sm-8 author-page-content-container">
		<h2><?php echo $coauthor_object[0]->display_name; ?></h2>
		<div class="row">
			<div class="col-md-6 author-description">
				<?php echo $coauthor_object[0]->description; ?>
			</div>
			<div class="col-md-6 schools-staffed">
				<?php $schools_staffed = rwmb_meta('schools_staffed', 'type=taxonomy&taxonomy=program_taxo', $post_id=$coauthor_object[0]->ID); ?>
				<?php if (!empty($schools_staffed)) { ?>
					<h6>Programs Staffed</h6>
					<?php foreach ($schools_staffed as $school) { ?>
						<div><a href="<?php echo get_permalink(get_page_by_path($school->slug, OBJECT, 'program')); ?>"><i class="icon-location-arrow"></i> <?php echo $school->name; ?></a></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		

		<?php if ( have_posts() ) {
				echo '<h2>Posts by ' . $coauthor_object[0]->first_name . '</h2>';
				while ( have_posts() ) {
					the_post(); ?>
			<?php display_loop_excerpt($post->ID); ?>
		<?php } // end while
		} ?>

	</div>
	
	<div class="col-sm-4 sidebar">
		<?php get_sidebar(); ?>
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