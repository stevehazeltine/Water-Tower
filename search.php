<?php $search_string = $_GET['s']; ?>
<?php get_header(); ?>

<?php global $wp_query; ?>

<div class="row">
<div class="col-lg-9">
	<h2>Search For: <?php echo $search_string; ?></h2>
	
	<?php 
	$args = array(
  'post_type'=> 'videos',
  's' => $search_string,
);
$videos = get_posts( $args );
foreach( $videos as $post ) : setup_postdata($post);
    the_title();
endforeach;
	?>
	

	
</div>


<div class="col-lg-3">
sdfasdf
</div>
</div>

<?php get_footer(); ?>