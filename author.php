<?php get_header(); ?>

<?php //SET THE CURAUTH VARIABLE ?>
<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>


<?php $coauthors = get_coauthors(); ?>
<?php foreach( $coauthors as $coauthor ) { ?>
			<div class="banner-image">
				<?php echo get_the_post_thumbnail( $coauthor->ID, 'full-banner' ); ?>
			</div>
<?php } ?>	


<div class="row">

	<div class="span9">
	
	    <div class="row">
	    	<div class="span2 author-page-avatar">
	    		<?php echo get_avatar( $curauth->ID, 200 ); ?>
	    	</div>
	    	
	    	<div class="span7">
	    		<h2><?php echo $curauth->display_name; ?></h2>
	    			<?php echo $curauth->description; ?>
	    		
	    		
	    		<!---START DESCRIPTION SECTION----->
			    <div class="row-fluid author-page-about-container">
			    	<div class="author-page-school-associations">
			    		<?php $terms = wp_get_object_terms( $curauth->ID, 'programs_completed'); ?>
			    		<?php if (!empty($terms)) { ?>
			    			<h5>Programs Completed</h5>
		    					<ul class="author-page-program-list">
								    <?php foreach ($terms as $term) { ?>
									    <li><a href="<?php echo get_bloginfo( 'url' );?>/programs/<?php echo $term->slug; ?>/"><?php echo ucwords(str_replace( '-', ' ', $term->slug )); ?></a></li>
								    <?php } ?>
		    					</ul>
						<?php } ?>
					</div>
					
					<div class="author-page-school-associations">
			    		<?php $terms = wp_get_object_terms( $curauth->ID, 'programs_staffed'); ?>
			    		<?php if (!empty($terms)) { ?>
			    			<h5>Programs Staffed</h5>
			    					<ul class="author-page-program-list">
									    <?php foreach ($terms as $term) { ?>
										    <li><a href="<?php echo get_bloginfo( 'url' );?>/programs/<?php echo $term->slug; ?>/"><?php echo ucwords(str_replace( '-', ' ', $term->slug )); ?></a></li>
									    <?php } ?>
			    					</ul>
						<?php } ?>
					</div>
			    </div>
	    		
	    	</div>
	    	
	    </div><!--row-->
	    
	    
	    
	    
	    
	
	
	
	    <!--------START POSTS BY AUTHOR SECTION------------->
	
	
	    <div class="row archive-content-container">
			<div class="span9 archive-posts-container">
				
				<?php insert_loop('excerpt'); ?>				
				
			</div><!--span9-->
		</div><!--archive-content-container-->
	</div><!--span9-->
</div><!-----ROW------>		
		
		    
	    <div class="row">
			<div class="span9">
				<?php if (function_exists("pagination")) {
				    pagination($additional_loop->max_num_pages);
				} ?>
			</div>
		</div>
	    
<?php get_footer(); ?>