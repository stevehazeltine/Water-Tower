<?php $program_id = $_GET['programid'];?>
<?php $post_type = $_GET['posttype']; ?>
<?php $program_slug = sanitize_title( get_the_title($program_id), $fallback_title ); ?>

<?php get_header() ?>


	<?php //----- POST POST TYPE -----// ?>
	<?php if ($post_type == 'post') { ?>
		<div class="row">
			<div class="span9 school-main-content-container">
				
				<div class="taxonomy-archive-title-container">
					<h2 style="background: #<?php echo get_program_color($program_id); ?>;"><?php echo get_the_title($program_id); ?>: Blog</h2>
				</div>
				
				<?php $args = array(
					'post_type' => 'post',
					'program_taxo' => $program_slug,
				); ?>
			
			<?php query_posts($args); ?>
			<?php insert_loop( 'excerpt'); ?>
			</div>
		</div>
	<?php } ?>

 <?php get_footer() ?>