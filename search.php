


<?php $search_string = $_GET['s']; ?>
<?php $post_type = ($_GET['t'] == '' ? null : $_GET['t']); ?>
<?php global $wp_query; ?>

<?php 
 /*
  *	Declare all of the post type colors
  *$phase_colors = array ('C1D9EC', '92BDDD', '609FCE', '3A83BB', '2B628C');
  *
  */
	$post_type_colors = array(
		'program'	=> 'C1D9EC',
		'post'		=> '92BDDD',
		'teachings'	=> '609FCE',
		'projects'	=> '3A83BB',
	);
	
?>

<?php
/*
 *	Initiate all WP_Query objects
 *	Gether information regarding total number of posts found in each type
 *
 */

 
 // PROGRAMS QUERY
$program_args = array(
	's'			=>	$search_string,
	'posts_per_page' => 4,
	'post_type'	=> 'program',
);

$programs_found = new WP_Query( $program_args );
$num_programs_found = $programs_found->found_posts;
wp_reset_postdata();


// POSTS QUERY
$post_args = array(
	's'			=>	$search_string,
	'posts_per_page' => 5,
	'post_type'	=> 'post',
);

$posts_found = new WP_Query( $post_args );
$num_posts_found = $posts_found->found_posts;
wp_reset_postdata();

// TEACHINGS QUERY
$teaching_args = array(
	's'			=>	$search_string,
	'posts_per_page' => 4,
	'post_type'	=> 'teachings',
);

$teachings_found = new WP_Query( $teaching_args );
$num_teachings_found = $teachings_found->found_posts;
wp_reset_postdata();


// PROJECT QUERY
$project_args = array(
	's'			=>	$search_string,
	'posts_per_page' => 3,
	'post_type'	=> 'projects',
);

$projects_found = new WP_Query( $project_args );
$num_projects_found = $projects_found->found_posts;
wp_reset_postdata();


//GET TOTAL NUMBER OF SEARCH RESULTS
$total_search_results = $num_programs_found + $num_posts_found + $num_teachings_found + $num_projects_found + $num_videos_found;


/*
 *	Function to output the title informaiton for each post type section
 *
 *	@output HTML
 */
	
	function display_result_title( $title, $slug, $posts_per_page, $posts_found) {
		global $post_type_colors;
		global $search_string;
		
		echo '<div class="search-result-cpt-title" style="border-left: 3px solid #' . $post_type_colors[$slug] . ';">';
		echo '<h3>' . $title . ' Found</h3>';
		echo '<div class="search-results-sub-title">' . $posts_per_page . ' Displayed | '. $posts_found . ' Found | <a href="' . get_bloginfo('url') . '?s=' . $search_string . '&t=' . $slug . '">View All Found Programs</a></div>';
		echo '</div>';
	}
	
	
	
/*
 *	Function to output the results of the search
 *
 *	@output HTML
 */
 
	function display_results() { ?>
	<div class="col-xs-12">
		<div class="row">
			<div class="col-md-3">
				<?php echo the_post_thumbnail('thumbnail-card');  ?>
			</div>
			<div class="col-md-9">
				<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
	<?php }



?>
<?php get_header(); ?>

<div class="row">
<div class="col-md-9 search-results">
	<h2>Search For: <span class="filter-string"><?php echo $search_string; ?></span></h2>
	
	<div class="search-results-ribbon">
		<div class="search-results-ribbon-bar" style="width: <?php echo 100*($num_programs_found/$total_search_results); ?>%; background: #<?php echo $post_type_colors['program']; ?>;"></div>
		<div class="search-results-ribbon-bar" style="width: <?php echo 100*($num_posts_found/$total_search_results); ?>%; background: #<?php echo $post_type_colors['post']; ?>;"></div>
		<div class="search-results-ribbon-bar" style="width: <?php echo 100*($num_teachings_found/$total_search_results); ?>%; background: #<?php echo $post_type_colors['teachings']; ?>;"></div>
		<div class="search-results-ribbon-bar" style="width: <?php echo 100*($num_projects_found/$total_search_results); ?>%; background: #<?php echo $post_type_colors['projects']; ?>;"></div>
	
	
	
	</div>
	

	<?php 
	/*
	 *	Start check whether $post_type is null or not
	 *	If $post_type is Null, display all search results without pagination 
	 *	If $post_type is set, then use $post_type to alter the $wp_query Object, and only display one post_type with pagination
	 *
	 */
		if ($post_type == null) {
	?>

		<div class="row search-content">
		
		<?php // DISPLAY PROGRAMS
		if ( $programs_found->have_posts() ) {
			
			//Title, Slug, Posts Per Page, Posts Found
			$programs_displayed = $num_programs_found < $programs_found->query_vars['posts_per_page'] ? $num_programs_found : $programs_found->query_vars['posts_per_page'];
			display_result_title('Programs', 'program', $programs_displayed, $num_programs_found);
			
			while ( $programs_found->have_posts() ) {
				$programs_found->the_post(); ?>
				
				<?php display_results(); ?>
				
			<?php }
		}
		?>
		
		
		<?php // DISPLAY POSTS
		if ( $posts_found->have_posts() ) {
			
			//Title, Slug, Posts Per Page, Posts Found
			$posts_displayed = $num_posts_found < $posts_found->query_vars['posts_per_page'] ? $num_posts_found : $posts_found->query_vars['posts_per_page'];
			display_result_title('Posts', 'post', $posts_displayed, $num_posts_found);
			
			while ( $posts_found->have_posts() ) {
				$posts_found->the_post(); ?>
				
				<?php display_results(); ?>
				
			<?php }
		}
		?>
		
		
		
		<?php // DISPLAY TEACHINGS
		if ( $teachings_found->have_posts() ) {
			
			//Title, Slug, Posts Per Page, Posts Found
			$posts_displayed = $num_teachings_found < $teachings_found->query_vars['posts_per_page'] ? $num_teachings_found : $teachings_found->query_vars['posts_per_page'];
			display_result_title('Teachings', 'teachings', $posts_displayed , $num_teachings_found);
			
			while ( $teachings_found->have_posts() ) {
				$teachings_found->the_post(); ?>
				
				<?php display_results(); ?>
				
			<?php }
		}
		?>
		
		<?php // DISPLAY PROJECTS
		if ( $projects_found->have_posts() ) {
			
			//Title, Slug, Posts Per Page, Posts Found
			$posts_displayed = $num_projects_found < $projects_found->query_vars['posts_per_page'] ? $num_projects_found : $projects_found->query_vars['posts_per_page'];
			display_result_title('Projects', 'projects', $posts_displayed , $num_projects_found);
			
			while ( $projects_found->have_posts() ) {
				$projects_found->the_post(); ?>
				
				<?php display_results(); ?>
				
			<?php }
		}
		?>
		
		
		</div>
	
	
	
	<?php 
	/* 
	 *	Start displaying filtered search results by post type
	 *
	 */
		} else {
	?>
	
	<div class="filter-label"><i class="icon-filter"></i> Filtered By <?php echo ucwords($post_type); ?> <a href="?s=<?php echo $search_string; ?>"><i class="icon-remove"></i></a></div>
	
	
	<div class="row filtered search-content">
	<?php 
	$main_loop_args = array(
		'post_type' => $post_type,
		's'			=> $search_string,
		'paged'		=> $paged,
	);

	query_posts( $main_loop_args );
	
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			//
			display_results();
			//
		} // end while
	} // end if
	?>
	</div>
	
	<?php pagination(); ?>
	
	
	
	
	
	
	<?php
	/*
	 * End check for $post_type variable
	 *
	 */
		} 
	?>
		
		
		
		
	
	
	
	

	
</div>


	<div id="scrollspy-nav" class="search-results-sidebar col-md-3">
		<div class="chart-container">
			<canvas id="search-results-chart" class="chart-responsive" width="270" height="270"></canvas>
			<script>
				jQuery(document).ready(function($) {
				
				var searchResults = [
						{value : <?php echo $num_programs_found; ?>, color : "#<?php echo $post_type_colors['program']; ?>" },
						{value : <?php echo $num_posts_found; ?>, color : "#<?php echo $post_type_colors['post']; ?>" },
						{value : <?php echo $num_teachings_found; ?>, color : "#<?php echo $post_type_colors['teachings']; ?>" },
						{value : <?php echo $num_projects_found; ?>, color : "#<?php echo $post_type_colors['projects']; ?>" },
					]
				var options = {
				}
				var ctx = document.getElementById("search-results-chart").getContext("2d");
				var myNewChart = new Chart(ctx).PolarArea(searchResults, options);
					
						
				});			
			</script>
		</div>
		<div class="col-md-12">
		<ul class="nav search-results-nav">
			<li>Database Results</li>
			<li><?php echo $num_programs_found; ?> Programs<span class="sidebar-filter-search" style="background: #<?php echo $post_type_colors['program']; ?>;"><a href="?s=<?php echo $search_string; ?>&t=program">View All</a></span></li>
			<li><?php echo $num_posts_found; ?> Posts<span class="sidebar-filter-search" style="background: #<?php echo $post_type_colors['post']; ?>;"><a href="?s=<?php echo $search_string; ?>&t=post">View All</a></span></li>
			<li><?php echo $num_teachings_found; ?> Teachings<span class="sidebar-filter-search" style="background: #<?php echo $post_type_colors['teachings']; ?>;"><a href="?s=<?php echo $search_string; ?>&t=teachings">View All</a></span></li>
			<li><?php echo $num_projects_found; ?> Projects<span class="sidebar-filter-search" style="background: #<?php echo $post_type_colors['projects']; ?>;"><a href="?s=<?php echo $search_string; ?>&t=projects">View All</a></span></li>
		</ul>
		</div>
	</div>
</div>

<?php get_footer(); ?>