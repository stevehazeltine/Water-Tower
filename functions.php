<?php

	//INCLUDE CUSTOM META FORMS
	include 'custom-meta.php';
	
	
	
	//LOAD ALL JAVASCRIPT INTO WORDPRESS
	add_action ('wp_enqueue_scripts', 'load_theme_scripts');
	
		function load_theme_scripts() {
			
			//TAKE CARE OF JQUERY
			wp_deregister_script('jquery');
		    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
		    wp_enqueue_script('jquery');
			
			
			//BEGIN REGISTERING SCRIPTS
		    wp_register_script('themeuxscripts', get_template_directory_uri().'/js/themeuxscripts.js', array('jquery'), '1.0', true);
		    wp_register_script('smoothscroll', get_template_directory_uri().'/js/smoothscroll.js', array('jquery'), '1.0', true);
		    wp_register_script('royalslider', get_template_directory_uri().'/royalslider/jquery.royalslider.min.js', array('jquery'), '9.4.0', true);
		    wp_register_script('charts', get_template_directory_uri().'/js/Chart.min.js', array('jquery'), '0.2', true);
		    
		    
		    //QUEUE UP YOUR SCRIPTS
		    wp_enqueue_script('jquery');
		    wp_enqueue_script('themeuxscripts');
		    wp_enqueue_script('smoothscroll');
		    wp_enqueue_script('royalslider');
		    wp_enqueue_script('charts');
		}






	//CUSTOM POST TYPE DECLARATIONS
	
		//PROGRAMS
	    function my_custom_post_program() {
			$labels = array(
				'name'               => _x( 'Programs', 'post type general name' ),
				'singular_name'      => _x( 'Program', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Program' ),
				'edit_item'          => __( 'Edit Program' ),
				'new_item'           => __( 'New Program' ),
				'all_items'          => __( 'All Programs' ),
				'view_item'          => __( 'View Program' ),
				'search_items'       => __( 'Search Programs' ),
				'not_found'          => __( 'No programs found' ),
				'not_found_in_trash' => __( 'No programs found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Programs',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our programs and program specific data',
				'public'        => true,
				'menu_position' => 6,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
				'has_archive'   => true,
				'taxonomies' 	=> array('post_tag'),
				'rewrite' => array('slug' => 'programs'), 
			);
			register_post_type( 'program', $args );	
		}
		add_action( 'init', 'my_custom_post_program' );
		
		
					//ADD PROGRAM GROUP TAXONOMY TO PROGRAMS
					function my_taxonomies_program_classification() {
						$labels = array(
							'name'              => _x( 'Classifications', 'taxonomy general name' ),
							'singular_name'     => _x( 'Classification', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Classifications' ),
							'all_items'         => __( 'All Classifications' ),
							'parent_item'       => __( 'Parent Classification' ),
							'parent_item_colon' => __( 'Parent Classification:' ),
							'edit_item'         => __( 'Edit Classification' ), 
							'update_item'       => __( 'Update Classification' ),
							'add_new_item'      => __( 'Add New Classification' ),
							'new_item_name'     => __( 'New Classification' ),
							'menu_name'         => __( 'Classifications' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
							'show_admin_column' => true,
							'slug' => 'program-classification'
						);
						register_taxonomy( 'program_classification', array( 'program' ), $args );
					}
					add_action( 'init', 'my_taxonomies_program_classification', 0 );
		
		
					//ADD PROGRAMS TAXONOMY TO POSTS, VIDEOS, STORIES, & TEACHINGS
					function my_taxonomies_program_taxo() {
						$labels = array(
							'name'              => _x( 'Programs', 'taxonomy general name' ),
							'singular_name'     => _x( 'Program', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Programs' ),
							'all_items'         => __( 'All Programs' ),
							'parent_item'       => __( 'Parent Program' ),
							'parent_item_colon' => __( 'Parent Program:' ),
							'edit_item'         => __( 'Edit Program' ), 
							'update_item'       => __( 'Update Program' ),
							'add_new_item'      => __( 'Add New Program' ),
							'new_item_name'     => __( 'New Program' ),
							'menu_name'         => __( 'Programs' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
							'show_admin_column' => true,
						);
						register_taxonomy( 'program_taxo', array( 'post', 'videos', 'stories', 'teachings', 'user' ), $args );
					}
					add_action( 'init', 'my_taxonomies_program_taxo', 0 );
					
					
					
					//AUTOMATICALLY SAVE AND UPDATE PROGRAM INFORMATION TO LINK TO SCHOOLS IN BLOG
					function post_program_update($post_id){
					  if(wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
						  return $post_id;
					  }
			
					  $post_obj = get_post($post_id);
					  $raw_title = $post_obj->post_title;
					  $post_type = $post_obj->post_type;
					  $slug_title = sanitize_title($raw_title);
			
					  if (($post_type == 'program') && ($slug_title != 'auto-draft') && (!empty($raw_title))) {
						 // get the terms associated with this custom post type
						 $terms = get_the_terms($post_id, 'program_taxo');
						 $term_id = $terms[0]->term_id;
						 // if term exists then update term
						 if ($term_id > 0) {
							 wp_update_term($term_id,
											'program_taxo',
											array(
											  'description' => $raw_title,
											  'slug' => $raw_title,
											  'name' => $raw_title)
											);
						 } else {
							// creates a new term in the program_taxo taxonomy
							wp_set_object_terms($post_id, $raw_title, 'program_taxo', false);
						 }
					  }
					}
			
					add_action('save_post', 'post_program_update');
		
		
		
		
		
		//TARGET NATIONS
	    function my_custom_post_target_nations() {
			$labels = array(
				'name'               => _x( 'Target Nations', 'post type general name' ),
				'singular_name'      => _x( 'Target Nation', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Target Nation' ),
				'edit_item'          => __( 'Edit Target Nation' ),
				'new_item'           => __( 'New Target Nation' ),
				'all_items'          => __( 'All Target Nations' ),
				'view_item'          => __( 'View Target Nation' ),
				'search_items'       => __( 'Search Target Nations' ),
				'not_found'          => __( 'No Target Nations found' ),
				'not_found_in_trash' => __( 'No Target Nations found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Target Nations',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Target Nations specific data',
				'public'        => true,
				'menu_position' => 22,
				'supports'      => array( 'title', 'editor', 'thumbnail' ),
				'has_archive'   => true,
				'hierarchical' 	=> true,
				'taxonomies' 	=> array('post_tag'),
				'rewrite' 		=> array('slug' => 'target-nations'),
			);
			register_post_type( 'target_nations', $args );	
		}
		add_action( 'init', 'my_custom_post_target_nations' );


					//ADD TARGET NATIONS TAXONOMY
					function my_taxonomies_target_nations_taxo() {
						$labels = array(
							'name'              => _x( 'Target Nations', 'taxonomy general name' ),
							'singular_name'     => _x( 'Target Nation', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Target Nations' ),
							'all_items'         => __( 'All Target Nations' ),
							'parent_item'       => __( 'Parent Target Nation' ),
							'parent_item_colon' => __( 'Parent Target Nation:' ),
							'edit_item'         => __( 'Edit Target Nation' ), 
							'update_item'       => __( 'Update Target Nation' ),
							'add_new_item'      => __( 'Add New Target Nation' ),
							'new_item_name'     => __( 'New Target Nation' ),
							'menu_name'         => __( 'Target Nations' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
							'show_admin_column' => true,
						);
						register_taxonomy( 'target_nations_taxo', array( 'post', 'videos'), $args );
					}
					add_action( 'init', 'my_taxonomies_target_nations_taxo', 0 );
					
					
					
					//AUTOMATICALLY SAVE AND UPDATE TARGET NATION INFORMATION TO LINK TO IN BLOG
					function post_program_update_target_nations($post_id){
					  if(wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
						  return $post_id;
					  }
			
					  $post_obj = get_post($post_id);
					  $raw_title = $post_obj->post_title;
					  $post_type = $post_obj->post_type;
					  $slug_title = sanitize_title($raw_title);
			
					  if (($post_type == 'target_nations') && ($slug_title != 'auto-draft') && (!empty($raw_title))) {
						 // get the terms associated with this custom post type
						 $terms = get_the_terms($post_id, 'target_nations_taxo');
						 $term_id = $terms[0]->term_id;
						 // if term exists then update term
						 if ($term_id > 0) {
							 wp_update_term($term_id,
											'target_nations_taxo',
											array(
											  'description' => $raw_title,
											  'slug' => $raw_title,
											  'name' => $raw_title)
											);
						 } else {
							// creates a new term in the program_taxo taxonomy
							wp_set_object_terms($post_id, $raw_title, 'target_nations_taxo', false);
						 }
					  }
					}
			
					add_action('save_post', 'post_program_update_target_nations');


		
		//VIDEOS
	    function my_custom_post_video() {
			$labels = array(
				'name'               => _x( 'Videos', 'post type general name' ),
				'singular_name'      => _x( 'Video', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'video' ),
				'add_new_item'       => __( 'Add New Video' ),
				'edit_item'          => __( 'Edit Video' ),
				'new_item'           => __( 'New Video' ),
				'all_items'          => __( 'All Videos' ),
				'view_item'          => __( 'View Videos' ),
				'search_items'       => __( 'Search Videos' ),
				'not_found'          => __( 'No videos found' ),
				'not_found_in_trash' => __( 'No videos found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Videos'
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Video specific data',
				'public'        => true,
				'menu_position' => 11,
				'supports'      => array( 'title', 'editor', 'thumbnail' ),
				'has_archive'   => true,
			);
			register_post_type( 'videos', $args );	
		}
		add_action( 'init', 'my_custom_post_video' );
		
		
		
		//STORIES
	    function my_custom_post_stories() {
			$labels = array(
				'name'               => _x( 'Stories', 'post type general name' ),
				'singular_name'      => _x( 'Story', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Story' ),
				'add_new_item'       => __( 'Add New Story' ),
				'edit_item'          => __( 'Edit Story' ),
				'new_item'           => __( 'New Story' ),
				'all_items'          => __( 'All Stories' ),
				'view_item'          => __( 'View Stories' ),
				'search_items'       => __( 'Search Stories' ),
				'not_found'          => __( 'No stories found' ),
				'not_found_in_trash' => __( 'No stories found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Stories'
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Story specific data',
				'public'        => true,
				'menu_position' => 7,
				'supports'      => array( 'title', 'editor',  'revisions' ),
				'has_archive'   => true,
			);
			register_post_type( 'stories', $args );	
		}
		add_action( 'init', 'my_custom_post_stories' );
		
		
		
		//FOCUS MINISTRIES
	    function my_custom_post_focus_ministries() {
			$labels = array(
				'name'               => _x( 'Focus Ministries', 'post type general name' ),
				'singular_name'      => _x( 'Focus Ministry', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Focus Ministry' ),
				'edit_item'          => __( 'Edit Focus Ministry' ),
				'new_item'           => __( 'New Focus Ministry' ),
				'all_items'          => __( 'All Focus Ministry' ),
				'view_item'          => __( 'View Focus Ministry' ),
				'search_items'       => __( 'Search Focus Ministries' ),
				'not_found'          => __( 'No Focus Ministries found' ),
				'not_found_in_trash' => __( 'No Focus Ministries found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Focus Ministries',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Focus Ministries specific data',
				'public'        => true,
				'menu_position' => 21,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
				'has_archive'   => true,
				'hierarchical' 	=> true,
				'taxonomies' 	=> array('post_tag'),
				'rewrite' 		=> array('slug' => 'focus-ministries'),
			);
			register_post_type( 'focus_ministries', $args );	
		}
		add_action( 'init', 'my_custom_post_focus_ministries' );
		


					//ADD FOCUS MINISTRY CIRCLE TAXONOMY TO TEACHINGS
					function my_taxonomies_focus_ministry_circle() {
						$labels = array(
							'name'              => _x( 'Focus Ministry Circles', 'taxonomy general name' ),
							'singular_name'     => _x( 'Focus Ministry Circle', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Focus Ministry Circles' ),
							'all_items'         => __( 'All Focus Ministry Circles' ),
							'parent_item'       => __( 'Parent Focus Ministry Circle' ),
							'parent_item_colon' => __( 'Parent Focus Ministry Circles:' ),
							'edit_item'         => __( 'Edit Focus Ministry Circle' ), 
							'update_item'       => __( 'Update Focus Ministry Circle' ),
							'add_new_item'      => __( 'Add New Focus Ministry Circle' ),
							'new_item_name'     => __( 'New Focus Ministry Circle' ),
							'menu_name'         => __( 'Ministry Circle' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'slug' => 'focus-ministry-circles'
						);
						register_taxonomy( 'focus_ministry_circles', array( 'focus_ministries' ), $args );
					}
					add_action( 'init', 'my_taxonomies_focus_ministry_circle', 0 );
		
		
		
		
		
		//PROJECTS
	    function my_custom_post_projects() {
			$labels = array(
				'name'               => _x( 'Projects', 'post type general name' ),
				'singular_name'      => _x( 'Project', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Project' ),
				'edit_item'          => __( 'Edit Project' ),
				'new_item'           => __( 'New Project' ),
				'all_items'          => __( 'All Projects' ),
				'view_item'          => __( 'View Project' ),
				'search_items'       => __( 'Search Projects' ),
				'not_found'          => __( 'No Projects found' ),
				'not_found_in_trash' => __( 'No Projects found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Projects',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Project specific data',
				'public'        => true,
				'menu_position' => 23,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
				'has_archive'   => true,
				'taxonomies' 	=> array('post_tag'),
			);
			register_post_type( 'projects', $args );	
		}
		add_action( 'init', 'my_custom_post_projects' );
		
		
		//ADD PROJECTS TO POSTS, VIDEOS, STORIES, & TEACHINGS
					function my_taxonomies_project_taxo() {
						$labels = array(
							'name'              => _x( 'Projects', 'taxonomy general name' ),
							'singular_name'     => _x( 'Projects', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Projects' ),
							'all_items'         => __( 'All Projects' ),
							'parent_item'       => __( 'Parent Project' ),
							'parent_item_colon' => __( 'Parent Project:' ),
							'edit_item'         => __( 'Edit Project' ), 
							'update_item'       => __( 'Update Project' ),
							'add_new_item'      => __( 'Add New Project' ),
							'new_item_name'     => __( 'New Project' ),
							'menu_name'         => __( 'Projects' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' 		=> array('slug' => 'project-posts'), 
							'show_admin_column' => true,
						);
						register_taxonomy( 'project_taxo', array( 'post', 'videos' ), $args );
					}
					add_action( 'init', 'my_taxonomies_project_taxo', 0 );
					
					
					
					//AUTOMATICALLY SAVE AND UPDATE PROGRAM INFORMATION TO LINK TO SCHOOLS IN BLOG
					function post_project_update($post_id){
					  if(wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
						  return $post_id;
					  }
			
					  $post_obj = get_post($post_id);
					  $raw_title = $post_obj->post_title;
					  $post_type = $post_obj->post_type;
					  $slug_title = sanitize_title($raw_title);
			
					  if (($post_type == 'projects') && ($slug_title != 'auto-draft') && (!empty($raw_title))) {
						 // get the terms associated with this custom post type
						 $terms = get_the_terms($post_id, 'project_taxo');
						 $term_id = $terms[0]->term_id;
						 // if term exists then update term
						 if ($term_id > 0) {
							 wp_update_term($term_id,
											'project_taxo',
											array(
											  'description' => $raw_title,
											  'slug' => $raw_title,
											  'name' => $raw_title)
											);
						 } else {
							// creates a new term in the program_taxo taxonomy
							wp_set_object_terms($post_id, $raw_title, 'project_taxo', false);
						 }
					  }
					}
			
					add_action('save_post', 'post_project_update');
		
		
		
		
		
		
		
		
		
		//STAFF OPPORTUNITIES
	    function my_custom_post_staff_opportunities() {
			$labels = array(
				'name'               => _x( 'Staff Opportunities', 'post type general name' ),
				'singular_name'      => _x( 'Staff Opportunity', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Staff Opportunity' ),
				'edit_item'          => __( 'Edit Staff Opportunity' ),
				'new_item'           => __( 'New Staff Opportunity' ),
				'all_items'          => __( 'All Staff Opportunities' ),
				'view_item'          => __( 'View Staff Opportunities' ),
				'search_items'       => __( 'Search Staff Opportunities' ),
				'not_found'          => __( 'No Staff Opportunities found' ),
				'not_found_in_trash' => __( 'No Staff Opportunities found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Staff Openings',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Staff Opportunity specific data',
				'public'        => true,
				'menu_position' => 24,
				'supports'      => array( 'title', 'editor', 'thumbnail',  'revisions' ),
				'has_archive'   => true,
				'taxonomies' 	=> array('post_tag'),
				'rewrite' 		=> array('slug' => 'staff-opportunities'), 
			);
			register_post_type( 'staff_opportunities', $args );	
		}
		add_action( 'init', 'my_custom_post_staff_opportunities' );
		
		
		
		
		
		//TEACHINGS
	    function my_custom_post_teachings() {
			$labels = array(
				'name'               => _x( 'Teachings', 'post type general name' ),
				'singular_name'      => _x( 'Teaching', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New Teaching' ),
				'edit_item'          => __( 'Edit Teaching' ),
				'new_item'           => __( 'New Teaching' ),
				'all_items'          => __( 'All Teachings' ),
				'view_item'          => __( 'View Teaching' ),
				'search_items'       => __( 'Search Teachings' ),
				'not_found'          => __( 'No teachings found' ),
				'not_found_in_trash' => __( 'No teachings found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Teachings',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our teachings and teaching specific data',
				'public'        => true,
				'menu_position' => 12,
				'supports'      => array( 'title', 'author', 'editor', 'thumbnail', 'comments',  'revisions' ),
				'has_archive'   => true,
				'taxonomies' 	=> array('post_tag'),
			);
			register_post_type( 'teachings', $args );	
		}
		add_action( 'init', 'my_custom_post_teachings' );
		
		
		
					//ADD TEACHING TYPE TAXONOMY TO TEACHINGS
					function my_taxonomies_teaching_types() {
						$labels = array(
							'name'              => _x( 'Teaching Types', 'taxonomy general name' ),
							'singular_name'     => _x( 'Teaching Type', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Teaching Types' ),
							'all_items'         => __( 'All Teaching Types' ),
							'parent_item'       => __( 'Parent Teaching Type' ),
							'parent_item_colon' => __( 'Parent Teaching Types:' ),
							'edit_item'         => __( 'Edit Teaching Type' ), 
							'update_item'       => __( 'Update Teaching Type' ),
							'add_new_item'      => __( 'Add New Teaching Type' ),
							'new_item_name'     => __( 'New Teaching Type' ),
							'menu_name'         => __( 'Teaching Types' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'slug' => 'teaching-types'
						);
						register_taxonomy( 'teaching_types', array( 'teachings' ), $args );
					}
					add_action( 'init', 'my_taxonomies_teaching_types', 0 );
		
		
		

		//ADD MENU LOCATION TAXONOMY TO ALL PAGES
		function my_taxonomies_page_menu_location() {
			$labels = array(
				'name'              => _x( 'Menu Locations', 'taxonomy general name' ),
				'singular_name'     => _x( 'Menu Location', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Menu Locations' ),
				'all_items'         => __( 'All Menu Locations' ),
				'parent_item'       => __( 'Parent Menu Location' ),
				'parent_item_colon' => __( 'Parent Menu Location:' ),
				'edit_item'         => __( 'Edit Menu Location' ), 
				'update_item'       => __( 'Update Menu Location' ),
				'add_new_item'      => __( 'Add New Menu Location' ),
				'new_item_name'     => __( 'New Menu Location' ),
				'menu_name'         => __( 'Menu Locations' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'rewrite' => array('hierarchical' => true ),
				'show_admin_column' => true,
				'slug' => 'menu-location'
			);
			register_taxonomy( 'page_menu_location', array( 'page', 'focus_ministries' ), $args );
		}
		add_action( 'init', 'my_taxonomies_page_menu_location', 0 );
		
		//ADD COUNTRIES VISITED TAXONOMY TO ALL PAGES
		function my_taxonomies_outreach_locations() {
			$labels = array(
				'name'              => _x( 'Outreach Locations', 'taxonomy general name' ),
				'singular_name'     => _x( 'Outreach Location', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Outreach Locations' ),
				'all_items'         => __( 'All Outreach Locations' ),
				'parent_item'       => __( 'Parent Outreach Location' ),
				'parent_item_colon' => __( 'Parent Outreach Locations:' ),
				'edit_item'         => __( 'Edit Outreach Location' ), 
				'update_item'       => __( 'Update Outreach Location' ),
				'add_new_item'      => __( 'Add New Outreach Location' ),
				'new_item_name'     => __( 'New Outreach Location' ),
				'menu_name'         => __( 'Outreach Locations' ),
			);
			$args = array(
				'labels' => $labels,
				'hierarchical' => false,
				'slug' => 'outreach-locations'
			);
			register_taxonomy( 'outreach_locations', array( 'program' ), $args );
		}
		add_action( 'init', 'my_taxonomies_outreach_locations', 0 );

		
		//ADD URL REWRITE RULES FOR CUSTOM POST TYPE ARCHIVES. BOOM!
		add_action('generate_rewrite_rules', 'my_datearchives_rewrite_rules');

			function my_datearchives_rewrite_rules($wp_rewrite) {
			  $rules = my_generate_date_archives('teachings', $wp_rewrite);
			  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
			  return $wp_rewrite;
			}
			
			function my_generate_date_archives($cpt, $wp_rewrite) {
			  $rules = array();
			
			  $post_type = get_post_type_object($cpt);
			  $slug_archive = $post_type->has_archive;
			  if ($slug_archive === false) return $rules;
			  if ($slug_archive === true) {
			    $slug_archive = $post_type->name;
			  }
			
			  $dates = array(
			            array(
			              'rule' => "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",
			              'vars' => array('year', 'monthnum', 'day')),
			            array(
			              'rule' => "([0-9]{4})/([0-9]{1,2})",
			              'vars' => array('year', 'monthnum')),
			            array(
			              'rule' => "([0-9]{4})",
			              'vars' => array('year'))
			        );
			
			  foreach ($dates as $data) {
			    $query = 'index.php?post_type='.$cpt;
			    $rule = $slug_archive.'/'.$data['rule'];
			
			    $i = 1;
			    foreach ($data['vars'] as $var) {
			      $query.= '&'.$var.'='.$wp_rewrite->preg_index($i);
			      $i++;
			    }
			
			    $rules[$rule."/?$"] = $query;
			    $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
			    $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
			    $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index($i);
			  }
			
			  return $rules;
			}



		
		
		
		
		
		
		
		
			
		// GET GALLERY AND MAP FUNCTION
			// $args
			// include-map 			-> true, false | Default = false
			// post_type 			-> post | Default = post
			// category_name 		-> outreach-updates | Default = outreach-updates
			// program_taxo			-> Accepts variable driven by program slug.| Default = null
			// target_nations_taxo	-> Accepts variable driven by target nation slug.| Default = null
			// 
		
		
		function get_banner($banner_args) { 
			
			if (!isset($banner_args["post-id"])){$banner_args["post-id"] = null;}
			if (!isset($banner_args["include-gallery"])){$banner_args["include-gallery"] = true;}
			if (!isset($banner_args["include-map"])){$banner_args["include-map"] = false;}
			if (!isset($banner_args["post-type"])){$banner_args["post-type"] = 'post';}
			if (!isset($banner_args["category-name"])){$banner_args["category-name"] = 'outreach-updates';}
			if (!isset($banner_args["program-taxo"])){$banner_args["program-taxo"] = null;}
			if (!isset($banner_args["target-nations-taxo"])){$banner_args["target-nations-taxo"] = null;}
			if (!isset($banner_args["outreach-index"])){$banner_args["outreach-index"] = false;}
			
		?>
		
		<div class="banner-image <?php if ($banner_args["outreach-index"] == true) { ?>outreach-locations-map <?php } ?> normal-slider">
		
			<?php // CHECK AND DISPLAY GALLERY ?>
			<?php if ($banner_args["include-gallery"] == true) { ?>
				<div id="banner-gallery" class="royalSlider rsDefault royal-slider-banner">
				    <img class="rsImg" src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full-banner'); echo $image[0];?>" />
				    <?php // check if the post has a Post Thumbnail assigned to it.
						$images = rwmb_meta( 'slide_imgs', 'type=image', $post_id = $banner_args["post-id"] );
						foreach ( $images as $image ) { ?>
						    <img class="rsImg" src="<?php echo str_replace( '.jpg', '-1350x450.jpg', $image[full_url]); ?>" />
					<?php } ?> 
				</div>
			<?php } ?>
		
		
		<?php // CHECK AND DISPLAY MAP ?>
		<?php if ($banner_args["include-map"] == true) { ?>
		<script src="<?php echo get_bloginfo ('template_directory'); ?>/js/oms.min.js" type="text/javascript"></script>
		<script src="<?php echo get_bloginfo ('template_directory'); ?>/js/infobox.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			  function initialize() {
			  
			  var gm = google.maps;
			  var minZoomLevel = 2;
				
				map = new google.maps.Map(document.getElementById('map_canvas'), {
				  center: new google.maps.LatLng(27.246933444275317, 318.515625),
				  zoom: minZoomLevel,
				  disableDefaultUI: true,
				  mapTypeId: google.maps.MapTypeId.ROADMAP
				});
				

				var sites = [

				<?php // QUERY PAGES SELECTED TO DISPLAY IN THE ABOUT SECTION ?>
				<?php $args = array(
						'nopaging'		=> 	true,
						'post_type'		=>	$banner_args["post-type"],
						'category_name' => 	$banner_args["category-name"],
						'program_taxo'	=> 	$banner_args["program-taxo"]
				); ?>
				   
				   <?php $my_query = new WP_Query( $args ); ?>
				   <?php if ( $my_query->have_posts() ) { ?>
					   <?php while ( $my_query->have_posts() ) { ?>
						   <?php $my_query->the_post(); ?>
						   
							['<?php echo rwmb_meta('address'); ?>', <?php echo rwmb_meta('longlat'); ?>, '<?php the_post_thumbnail( 'mobile-banner' ); ?><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2><p><?php echo str_replace('"', '', str_replace( "'", '', substr( get_the_excerpt(), 0, 200 ))); ?>   ...</p><div class="infoBox-footer"><i class="icon-map-marker"></i> <?php echo rwmb_meta('address'); ?> <i class="icon-time"></i> <?php the_time('F j, Y'); ?></div>'],
						   
					   <?php } ?>
				   <?php } ?>
				   <?php wp_reset_postdata(); ?>
				   
				];
				
				var boxOptions = {
					infoBoxClearance: new google.maps.Size(120, 100),
					closeBoxMargin: '0px',
					closeBoxURL: '<?php echo get_bloginfo ('template_directory'); ?>/images/remove.png',
				};
				
				var iw = new InfoBox(boxOptions);
				var oms = new OverlappingMarkerSpiderfier(map);
				var image = '<?php echo get_bloginfo ('template_directory'); ?>/images/map_poi.png';
				
				oms.addListener('click', function(marker, event) {
				  iw.setContent(marker.html);
				  iw.open(map, marker);
				});
						
				setMarkers(map, sites);
				
				    function setMarkers(map, markers) {
				
				        for (var i = 0; i < markers.length; i++) {
				            var sites = markers[i];
				            var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);
				            var marker = new google.maps.Marker({
				                position: siteLatLng,
				                map: map,
				                title: sites[0],
				                html: sites[3],
				                icon: image,
				            });
				            oms.addMarker(marker);
				        }
				    }
			
			

							
			// LIMIT ZOOM LEVELS
			   google.maps.event.addListener(map, 'zoom_changed', function() {
				 if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
			   });
			
			// JSON STYLERS
			var styles =
				[
				  {
					featureType: "water",
					stylers: [
					  { visibility: "on" },
					  { color: "#ffffff" }
					]
				  },{
					featureType: "landscape",
					stylers: [
					  { color: "#bebebe" }
					]
				  },{
					featureType: "administrative",
					elementType: "geometry.fill",
					stylers: [
					  { visibility: "off" }
					]
				  },{
					featureType: "administrative.province",
					stylers: [
					  { visibility: "off" }
					]
				  },{
					featureType: "administrative.locality",
					stylers: [
					  { visibility: "on" }
					]
				  }
				]
			map.setOptions({styles: styles});
			
			
			// Initialize the first layer
			 <?php if ($banner_args["outreach-index"] == true) {
				$terms = get_terms("outreach_locations");
				$count = count($terms);
				if ( $count > 0 ){
					foreach ( $terms as $term ) {
					  $result .= "'" . $term->name . "',";	
					}
					$result = rtrim($result,',');
				} 
			 } else {
				 $terms = wp_get_post_terms( $banner_args["post-id"], "outreach_locations");
				 $count = count($terms);
				 if ( $count > 0 ){
					 foreach ( $terms as $term ) {
					   $result .= "'" . $term->name . "',";	
					 }
					 $result = rtrim($result,',');
				 }				 
			 } ?>
			
			var firstLayer = new google.maps.FusionTablesLayer({
			  query: {
				select: "col0",
				from: "1uL8KJV0bMb7A8-SkrIe0ko2DMtSypHX52DatEE4",
				where: "col6 in (<?php echo $result ?>)"
			  },
			  
			  styles: [{
				  polygonOptions: {
					fillColor: "#609FCE",
					fillOpacity: .50,
					strokeColor: "#333333",
					strokeWeight: "1",
					strokeOpacity: .75,
				  },
				}],
			  
			  map: map,
			  suppressInfoWindows: true,
			});
			
			
		  }
		  
		  
		  

		  google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
	
		
		
		<div id="map_canvas" class="visible-desktop <?php if ($banner_args["include-gallery"] == false) { ?>show-map<?php } ?>" style="width: 100%; height: 100%;"></div>
		
		<?php if ($banner_args["include-gallery"] == true) { ?>
			<div class="reveal-map-button visible-desktop">
				<a href="#_"><span class="reveal-map-text">Show Outreach Map<i class="icon-caret-left"></i></span><span class="hide-map-text">Hide Outreach Map<i class="icon-caret-left"></i></span><i class="icon-globe"><span class="map-button-label">Map</span></i> </a>
			</div>
		<?php } ?>
		
		<div class="map-key-container visible-desktop <?php if ($banner_args["include-gallery"] == false) { ?>map-key-map-active<?php } ?>" <?php if ($banner_args["include-gallery"] == false) { ?>style="bottom: 30px !important;"<?php } ?>>
			<div class="map-key">
				<div class="key-outreach-updates">Outreach Story<div class="key-marker"><img src="<?php echo get_bloginfo ('template_directory'); ?>/images/map_poi.png"></div></div>
				<div class="key-countries-visited">Countries Visited<div class="key-visited"></div></div>
			</div>
			
			<div class="map-key-button-container">
				
				<div class="map-key-button-hover">
					<a href="#_"><i class="icon-key"><span class="key-button-label">Key</span></i></a>
				</div>
				
				<div class="map-key-button-extension">
					<div class="map-key-button-extension-text">
						<a href="#_"><span class="map-key-show-text">Show Map Legend</span></a>
						<a href="#_"><span class="map-key-hide-text">Hide Map Legend</span></a>
					</div>
				</div>
				
			</div>
		</div>
		<?php } //ENDIF FOR INCLUDE MAP CHECK ?>
		
	</div>



	<?php } //END GET BANNER FUNCTION


		
		
		
		
		
		
		
		
		
		
		
		
		
		
		



		//THE LOOP FUNCTION
			function insert_loop($post_length='full') { ?>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="row-fluid post-container">
						<div class="span3 visible-desktop post-meta-container">
							
							<?php
							if ($post_length == 'excerpt') {
								if ( has_post_thumbnail() ) {
								  the_post_thumbnail( '16:9-media-thumbnail' );
								} 
							}
							?>
							
							
							
							
							
							<?php if ($post_length == 'full') { ?>
							<div class="entry-meta-left">
							
								<?php // CATEGORIES ?>
								
									<div class="date-container-border">
										<div class="date-container">
												<div class="day"><?php the_time('j') ?></div>
												<div class="month"><?php the_time('M') ?></div>
										</div>
									</div>
								
									
								
								<h4 class="meta-title">Author<?php if ( 1 !== count( get_coauthors( get_the_id() ) ) ) { echo 's'; } ?></h4>
								<ul class="meta-list">
									<?php coauthors_posts_links( ' ', '</li><li><i class="icon-user"></i>', '<li><i class="icon-user"></i>', '</li>', true ); ?>
								</ul>
								
									
									
									
								<?php // CATEGORIES ?>
								
									<?php if ( 'teachings' == get_post_type()) { ?>
										<h4 class="meta-title">Teaching Types</h4>
										<ul class="meta-list">
											<li><i class="icon-plus-sign"></i><?php echo the_terms( $post->ID, 'teaching_types', null, '</li><li><i class="icon-plus-sign"></i>', null ); ?></li>
										</ul>
									<?php } else { ?>
										<h4 class="meta-title">Categories</h4>
										<ul class="meta-list">
											<li><i class="icon-plus-sign"></i><?php the_category('</li><li><i class="icon-plus-sign"></i>'); ?></li>
										</ul>
									
								<?php } ?>
								
								
								<?php // TAGS ?>
									<h4 class="meta-title">Tags</h4>
									<?php the_tags('<ul class="meta-list"><li><i class="icon-tag"></i>','</li><li><i class="icon-tag"></i>','</li></ul>'); ?>
									
								<?php // RELATED PROGRAMS ?>
								
									<?php $related_programs = get_the_terms( $post->ID, 'program_taxo' ); ?>
									<?php if (!empty($related_programs)) { ?>
										<h4 class="meta-title">Related Schools</h4>
										<ul class="meta-list">
										<?php foreach ($related_programs as $program) { ?>
											<?php $program = get_page_by_path($program->slug, OBJECT, 'program'); ?>
												
												<?php if (rwmb_meta('short_name', '', $post_id=$program->ID) == '') {
														$post_title = $program->post_title;
													} else {
														$post_title = rwmb_meta('short_name', '', $post_id=$program->ID);
													} ?>
												
												
												
											<li>
												<a href="<?php echo get_permalink($program->ID); ?>"><i class="icon-location-arrow"></i><?php echo $post_title; ?></a>
											</li>
											
										<?php } ?>
										</ul>
									
								<?php } ?>
							</div>
							<?php } ?>
							
							
						</div>
					 
					 
					 <div class="span9 post loop-content">
						
						
						<h2><a <?php if ($post_length == 'excerpt') { echo 'style="font-size: 24px;"';} ?> href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							 <div class="entry">
							   <?php if ($post_length=='excerpt') {the_excerpt();} else {the_content();} ?>
							   
							   
							   <?php //----- TEACHING MEDIA FILES -----// ?>
							   
							   <?php if (get_post_type() == 'teachings' and $post_length !== 'excerpt') { ?>
							   <div class="teachings-media-container">
							   <?php $files = rwmb_meta( 'media_files', 'type=file' ); ?>
							
									<?php if (empty($files)) { ?>
									<?php } else { ?>
																		
											<?php foreach ( $files as $info ){ ?>
															<?php echo do_shortcode('[audio src="' . $info['url'] . '"]'); ?>

											<?php } ?>
									<?php } ?>
									 </div>
							   <?php } ?>
								
								
								
								
								<!------------COMMENT SECTION----------->
								 <?php comments_template(); ?>
									
							 
							 
							 
							 </div><!-- /.entry -->
							 
					 </div> <!-- /.post -->
					 
				</div>
	 
			 
				<?php endwhile; else: ?>
					<?php no_posts_found( 'posts' ); ?>
				<?php endif;

			}
			
			
			
			
								// FUNCTION TO RETRIEVE VIDEO WIDGET TO DISPLAY ON PAGES
								function get_videos( 
										$program_slug = null, 
										$project_slug = null
										){
			
										//VIDEO SECTION IF NO SUPPLEMENTAL VIDEOS EXIST
									   $featured_video_id = rwmb_meta( 'featured_video');
									   
									   
									   		//COUNT ADDITIONAL VIDEOS AND ASSIGN TO $NUM VARIABLE
											$args = array(
												'post_type' => 'videos',
												'program_taxo' => $program_slug,
												'project_taxo' => $project_slug,
												'post__not_in'		=> array($featured_video_id),
											);
											$num = count( get_posts( $args ) );
											
									   if ($num == 0) {
									   
										   $args = array(
											'p' 		=> $featured_video_id,
											'post_type' =>	'videos',
										   );
										   
											   if ($featured_video_id != '') {
												   $my_query = new WP_Query( $args );
												   if ( $my_query->have_posts() ) { ?>
													   
													   <h4>Videos</h4>
													   <div class="row-fluid school-video-section">
													   
													   <?php while ( $my_query->have_posts() ) { ?>
														   <?php $my_query->the_post(); ?>									   
														   
																<!--POST FEATURED VIDEO TO SMALL SIZE IF ADDITIONAL VIDEOS EXIST, AND USE LARGE SIZE IF ALONE-->
																<div class="<?php if($num == 0) { echo 'span10'; } else { echo 'span9'; } ?> featured-video">
																		<div id="video1" class="royalSlider videoGallery rsDefault">
																		  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media-thumbnail'); echo $image[0];?>"></a>
																		</div>
																</div><!--Video Section Featured Video-->
														   
													   <?php } ?>
													   </div>
												   <?php } ?>
											   <?php } ?>
										   <?php } ?>
										   <?php wp_reset_postdata(); ?>
										  
										  
										  
										  
										  
										  
										  
												  
									<?php // CHECK TO SEE IF SUPLEMENTAL VIDEOS EXIST, IF SO, DISPLAY GALLERY ?>			 
									<?php if ($featured_video_id != ''){ ?> 
										<?php if ($num != 0) { ?>
										   
											<!--SUPPLEMENTAL VIDEOS-->		
											<?php $args = array(
											'post_type' 	 	=>	'videos',
											'post__not_in'		=> array($featured_video_id),
											'program_taxo' 		=>  $program_slug,
											'project_taxo'		=>  $project_slug,
										   ); ?>
											   
											   <?php $my_query = new WP_Query( $args ); ?>
											   <?php if ( $my_query->have_posts() ) { ?>

												<h4>Videos</h4>
												<div id="video-gallery" class="royalSlider videoGallery rsDefault visible-desktop">
															<!--DISPLAY FEATURED VIDEO-->
														   <?php $args = array (
														   	'post_type' => 'videos',
														   	'p'			=> $featured_video_id,
														   ); ?>
														   
														   <?php $featured_video_query = new WP_Query( $args ); ?>
														   		<?php while ( $featured_video_query->have_posts() ) : $featured_video_query->the_post(); ?>
																	<a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media'); echo $image[0];?>">
																      <div class="rsTmb">
																        <h5><?php the_title(); ?></h5>
																        <span>By <?php echo rwmb_meta('production_source'); ?> </span>
																      </div>
																    </a>
														    	<?php endwhile; ?>
											   
												   <?php while ( $my_query->have_posts() ) { ?>
													   <?php $my_query->the_post(); ?>
													   
														   
													   
														<!--LIST SUPPLEMENTAL VIDEOS-->
														<a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>">
													      <div class="rsTmb">
													        <h5><?php the_title(); ?></h5>
													        <span>by <?php echo rwmb_meta('production_source'); ?></span>
													      </div>
													    </a>
													   
												   <?php } ?>
												   </div><!--Video Slider-->

											   <?php } ?>
											   <?php wp_reset_postdata(); ?>
											   
											   
											   
											   
											   
											   <!-- VIDEO MODULE FOR MOBILE DEVICES -->
											   <div class="row-fluid school-video-section hidden-desktop">
											
											
											   <?php $args = array (
											   	'post_type' => 'videos',
											   	'p'			=> $featured_video_id,
											   ); ?>
												   
										       <?php $my_query = new WP_Query( $args ); ?>
											   
											   <?php if ( $my_query->have_posts() ) { ?>
											   <?php while ( $my_query->have_posts() ) { ?>
												   <?php $my_query->the_post(); ?>									   
												   
														<!--POST FEATURED VIDEO TO SMALL SIZE IF ADDITIONAL VIDEOS EXIST, AND USE LARGE SIZE IF ALONE-->
														<div class="<?php if($num == 0) { echo 'span10'; } else { echo 'span9'; } ?> featured-video">
																<div id="video1" class="royalSlider videoGallery rsDefault">
																  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media-thumbnail'); echo $image[0];?>"></a>
																</div>
														</div><!--Video Section Featured Video-->
												   
											   <?php } ?>
											   <?php } ?>
											   <?php wp_reset_postdata(); ?>
											   </div>
											   
											   
											   
											   
											   
											   
										<?php } ?>	
									<?php } ?>
								<?php }
			
			
			
			//----------------------------------------------------//
			//----- DISPLAY PROGRAM IN ARCHIVE MODE FUNCTION -----//
			//----------------------------------------------------//
			
			function get_program_in_archive($program_id, $in_main_archive ) {
			
			$args = array(
				'p'				=> $program_id,
				'post_type' 	=> 'program',
			);
			
			$program_query = new WP_Query($args);
			
			if ( $program_query->have_posts() ) {
	while ( $program_query->have_posts() ) {
		$program_query->the_post(); ?>
			
			<div class=" row-fluid program-archive-school-container" id="<?php echo $program_id; ?>">
						
						<div class="span4 program-archive-featured-media hidden-phone">
							
							<div class="program-archive-featured-image">
								<?php echo the_post_thumbnail('thumbnail-card');  ?>
							</div>
							
						</div>
						
						<div class="span8 program-archive-content">
						
							<?php if ($in_main_archive == true) { ?>
								<div class="program-archive-school-compare-link visible-desktop">
									<span>Compare 
										<i id="compare-programs-checkbox" data-programId="<?php echo program_id; ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
										<a href="#_" id="compare-program-desc-btn-<?php echo $program_id; ?>" data-content="Use our simple compare tool to see all of the basic and relavant information about each school in a clean and easy format.  Just check the schools you want to compare, and click the Compare Schools button in the menu to the right to start comparing. You can compare a maximum of 5 schools at once." data-original-title="Compare <?php echo rwmb_meta( 'acronym', $post_id=$program_id  ); ?> To Other Schools"><i class="icon-question"></i></a>
									</span>
								</div>
							<?php } ?>
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
							<span class="program-archive-acronym"><?php if (rwmb_meta( 'acronym', $post_id=$program_id ) != '') {?> - ( <?php echo rwmb_meta( 'acronym', $post_id=$program_id ); ?> )<?php } ?></span></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									<?php $start_date = rwmb_meta( 'start_date', $post_id=$program_id ); ?>
									<?php echo date("F d, Y", strtotime($start_date));?>
									<?php $custom_value = rwmb_meta( 'end_date', $post_id=$program_id ); if ($custom_value != '') { ?> - <?php echo $custom_value; } ?>
								</div>
								
								<div class="program-archive-school-cost">
									<?php $total_cost = rwmb_meta( 'total_cost', $post_id=$program_id );?> 
									<?php if ($total_cost != '') { ?>
										<?php setlocale(LC_MONETARY, 'en_US'); echo money_format( '%i', $total_cost);?>
									<?php } ?>
								</div>
							</div>
							<div style="clear: both"> </div>
							
							<div class="program-archive-tagline">
								<?php echo substr(get_the_excerpt(), 0, 150); ?>
							</div>
							
						</div>
					</div>
					
			<?php }
}
					
				 wp_reset_postdata();
			 } 
			
			
			
			//----------------------------------------------------------//
			//----- FUNCTION TO RETRIEVE AND DISPLAY RELATED POSTS -----//
			//----------------------------------------------------------//
			
			function get_related_posts($related_args) {
			
			if (!isset($related_args["title"])){$related_args["title"] = 'Related Posts';}
			if (!isset($related_args["posts_per_page"])){$related_args["posts_per_page"] = 3;}
			if (!isset($related_args["post_type"])){$related_args["post_type"] = 'post';}
			if (!isset($related_args["program_taxo"])){$related_args["program_taxo"] = null;}
			if (!isset($related_args["project_taxo"])){$related_args["project_taxo"] = null;}
			if (!isset($related_args["target_nation_taxo"])){$related_args["target_nation_taxo"] = null;}
			if (!isset($related_args["archive_url"])){$related_args["archive_url"] = get_bloginfo(info) . '/blog/';}
			
			?>
			
				
					   <?php $args = array(
							'posts_per_page' 	=> $related_args["posts_per_page"],
							'post_type' 		=> $related_args["post_type"],
							'program_taxo' 		=> $related_args["program_taxo"],
							'project_taxo'		=> $related_args["project_taxo"],
							'target_nation_taxo'=> $related_args["target_nation_taxo"],
					   ); ?>
						   
						   <?php $my_query = new WP_Query( $args ); ?>
						   <?php if ( $my_query->have_posts() ) { ?>
								<li><h2><?php echo $related_args['title']; ?></h2>
								<ul>
							   <?php while ( $my_query->have_posts() ) { ?>
								   <?php $my_query->the_post(); ?>
								   
										<li>
											<div class="row-fluid sidebar-related-post">
												<div class="sidebar-thumbnail-container visible-desktop span4">
													<?php the_post_thumbnail( 'xs-thumbnail-card' ); ?>
												</div>
												
												<div class="sidebar-related-post-content span8">
													<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
													<p><?php the_time( 'F j, Y' ); ?></p>
												</div>
											</div>
										</li>
							   <?php } ?>
							   
								<?php $args = array(
									'post_type' 	=> 'post',
									'program_taxo' 	=> $related_args['program_taxo'],
									'project_taxo' 	=> $related_args['project_taxo'],
									'nopaging'	=> true,
								);
								$num = count( get_posts( $args ) ); ?>
								
									<!--RELATED POST MORE BUTTONS-->
									<li>
										<div class="row-fluid sidebar-related-posts-more">
											<div class="sidebar-related-posts-view-all">
												<a href="<?php echo $related_args['archive_url']; ?>">View All (<?php echo $num; ?>) </a>
											</div>
											
											<div class="sidebar-related-posts-subscribe">
												<a href="<?php bloginfo('rss2_url'); ?>">Subscribe to RSS</a>
											</div>
											<div class="clearfix"></div>
										</div>
									</li>
								</ul>
						   <?php } ?>
						   <?php wp_reset_postdata(); ?>
						   
			<?php } //  END GET RELATED POSTS
			
			
			
			//-------------------------//
			//----- IMAGE CREDITS -----//
			//-------------------------//
			
				//FUNCTION TO RETRIEVE IMAGE CREDITS
					function get_image_credits() {
					
							$image_credits = rwmb_meta( 'image_credits' );
							if (!empty($image_credits)) {
								foreach ($image_credits as $credit) {
						 			$credit_string = $credit_string . ' ' . $credit . ',';
						 		}
					 		}
					 		
					 		if (!empty($image_credits)) {
							 	$credits = '<span class="image-credits">Image Credits:' . rtrim($credit_string, ",") . '</span>';
							}
							  
							return $credits;
					 
					} //END RETREIVE ALL IMAGE CREDITS
					 
				//FUNCTION TO INSERT IMAGE CREDITS AT THE END OF ANY CALL TO the_content() FUNCTION
					function add_image_credits_to_posts($content) {
						if(is_single() && is_main_query() ) {
							return $content . get_image_credits();
						}
						
						return $content;
					}
					add_filter('the_content', 'add_image_credits_to_posts');
			 
			
			
			
			
			
			/** COMMENTS WALKER */
class ywammontana_walker_comment extends Walker_Comment {
	
	// init classwide variables
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	/** CONSTRUCTOR
	 * You'll have to use this if you plan to get to the top of the comments list, as
	 * start_lvl() only goes as high as 1 deep nested comments */
	function __construct() { ?>
		
		
		<ul id="comment-list">
		
	<?php }
	
	/** START_LVL 
	 * Starts the list before the CHILD elements are added. Unlike most of the walkers,
	 * the start_lvl function means the start of a nested comment. It applies to the first
	 * new level under the comments that are not replies. Also, it appear that, by default,
	 * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
	function start_lvl( &$output, $depth = 0, $args = array() ) {		
		$GLOBALS['comment_depth'] = $depth + 1; ?>

		<ul class="children">
		
	<?php }

	/** END_LVL 
	 * Ends the children list of after the elements are added. */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>

		</ul><!-- /.children -->
		
	<?php }
	
	/** START_EL */
	function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment; 
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
		
		<li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
			<div id="comment-body-<?php comment_ID() ?>" class="comment-body row-fluid">
			
				<div class="span2 comment-author vcard author">
					<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
				</div><!-- /.comment-author -->

				<div id="comment-content-<?php comment_ID(); ?>" class="span10 comment-content">
					
					
						
						<!-------- COMMENTS BODY---------->
						<div class="row-fluid">
						
							<div class="span12">
							
								<?php if( !$comment->comment_approved ) : ?>
									<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>	
								<?php else: ?>
									<p><span class="comment-author-name"><?php if (0 != count_user_posts($comment->user_id)) { the_author_posts_link(); } else { echo get_comment_author_link(); } ?></span> - <?php echo str_replace( '<p>' and '</p>', '', get_comment_text()); ?></p>
							</div>
						</div>
						
						
						
						
						<!---------- COMMENTS META --------->
						<div class="row-fluid">						
							
							<div class="span12 comment-footer">
								<div class="comment-meta comment-meta-data">
									<?php comment_date(); ?> at <?php comment_time(); ?> 					
									
									<?php $reply_args = array(
										'add_below' => $add_below, 
										'depth' => $depth,
										'reply_text' => '<i class="icon-reply"></i> Reply',
										'max_depth' => $args['max_depth'] );
										
					
									comment_reply_link( array_merge( $args, $reply_args ) );  ?><?php edit_comment_link( '<i class="icon-pencil"></i> Edit Comment' ); ?>
									
								</div><!-- /.comment-meta -->
							</div>
							
						</div>
					<?php endif; ?>
				</div><!-- /.comment-content -->

				

				
			</div><!-- /.comment-body -->

	<?php }

	function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
		
		</li><!-- /#comment-' . get_comment_ID() . ' -->
		
	<?php }
	
	/** DESTRUCTOR
	 * I just using this since we needed to use the constructor to reach the top 
	 * of the comments list, just seems to balance out :) */
	function __destruct() { ?>
	
	</ul><!-- /#comment-list -->

	<?php }
}	
			






		
		
		//ADD DASHBOARD WIDGET FOR YWAM MONTANA THEME
		
			// add the admin options page
			add_action('admin_menu', 'theme_options_page');
			
			function theme_options_page() {
			add_utility_page('YWAM Montana, Lakeside Theme Options', 'Theme Options', 'manage_options', 'theme_options', 'theme_options_page_display');
			}

			// display the admin options page
			function theme_options_page_display() {
			?>
			<div class="wrap">
			<?php screen_icon(); ?>
			<h2>My custom plugin</h2>
			<p>Options relating to the Custom Plugin.</p>
				<form action="options.php" method="post">
				<?php settings_fields('theme_options'); ?>
				<?php do_settings_sections('theme_options'); ?>
				 
				<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button button-primary" />
				</form>
			</div>
			 
			<?php }
			
			// add the admin settings and such
			add_action('admin_init', 'plugin_admin_init');
			function plugin_admin_init(){
				register_setting( 'theme_options', 'theme_options' );
				add_settings_section('theme_options_main', 'Main Settings', 'theme_options_section_text', 'theme_options');
				add_settings_field('asdfsad', 'Plugin Text Input', 'theme_options_setting_string', 'theme_options', 'theme_options_main');
				add_settings_field('second_one', 'A Text Area', 'theme_options_setting_string2', 'theme_options', 'theme_options_main');
			}
			
			function theme_options_section_text() {
				echo '<p>Main description of this section here.</p>';
			}
			
			function theme_options_setting_string() {
				$options = get_option('theme_options');
				echo "<input id='theme_options_text_string' name='theme_options[asdfsad]' size='40' type='text' value='{$options['asdfsad']}' />";
			}
			
			function theme_options_setting_string2() {
				$options = get_option('theme_options');
				echo "<input id='theme_options_text_string' name='theme_options[second_one]' size='40' type='text' value='{$options['second_one']}' />";
			}
		

		
		
		
					
		
		//--------------------------------------------//
		//----- ADD JESUS TO EVERY POST TAG LIST -----//
		//--------------------------------------------//
		
			function set_jesus_tag_on_publish($post_id,$post) {
			  if ($post->post_type == 'post' or 'program'
				&& $post->post_status == 'publish') {
				  wp_set_post_tags( $post_id, 'Jesus', true );
				}
			  }
			add_action('save_post','set_jesus_tag_on_publish',10,2);
		
		
		
		
		
		//-----------------------------//
		//----- ADD THEME SUPPORT -----// 
		//-----------------------------//
					
			//ADD CUSTOM HEADER FUNCTIONALITY
			add_theme_support( 'custom-header' );
			
			//ADD POST THUMBNAIL FUNCTIONALITY
			if ( function_exists( 'add_theme_support' ) ) {
					add_theme_support( 'post-thumbnails' );
					set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
			}
			
			//DEFINE THUMBNAIL SIZES
			if ( function_exists( 'add_image_size' ) ) { 
				add_image_size( 'full-banner', 1350, 450, true ); //USE FOR FULL LENGTH BANNERS
				add_image_size( 'mobile-banner', 960, 320, true ); //USE FOR MOBILE SIZED BANNERS
				add_image_size( 'xs-mobile-banner', 320, 107, true ); //USE FOR EXTRA SMALL MOBILE SIZED BANNERS
				
				// ARCHIVE BANNERS
				add_image_size( 'archive-banner', 1200, 300, true ); //USE FOR ARCHIVE PAGES
				add_image_size( 'mobile-archive-banner', 600, 150, true ); //USE FOR MOBILE ARCHIVE PAGES
				add_image_size( 'xs-mobile-archive-banner', 320, 80, true ); //USE FOR EXTRA SMALL MOBILE ARCHIVE PAGES
				
				// 2x1 ASPECT RATIO
				add_image_size( 'display-card', 1200, 600, true ); //USE FOR DISPLAY WITHIN A LIST OF POSTS
				add_image_size( 'thumbnail-card', 400, 200, true ); //USE FOR DISPLAY OF THUMBNAIL SIZE CARDS
				add_image_size( 'xs-thumbnail-card', 150, 75, true ); //USE FOR DISPLAY OF EXTRA SMALL THUMBNAIL SIZE CARDS
				
				// 16x9 ASPECT RATIO
				add_image_size( '16:9-media', 1200, 675, true ); //USE FOR DISPLAY OF FEATURED IMAGE ALONGSIDE FEATURED VIDEO
				add_image_size( '16:9-media-thumbnail', 400, 225, true ); //USE FOR DISPLAY OF FEATURED IMAGE ALONGSIDE FEATURED VIDEO
			}
		
		//-----------------------------------------------------//
		//----- ADD SCHOOLS FUNCTIONALITY TO USER PROFILE -----//
		//-----------------------------------------------------//
		
		/**
		 * Add a "Google Plus" field to Co-Authors Plus Guest Author
		 */
		add_filter( 'coauthors_guest_author_fields', 'capx_filter_guest_author_fields', 10, 2 );
		function capx_filter_guest_author_fields( $fields_to_return, $groups ) {
		 
			if ( in_array( 'all', $groups ) || in_array( 'contact-info', $groups ) ) {
				$fields_to_return[] = array(
							'key'      => 'schools_staffed',
							'label'    => 'Schools Staffed',
							'group'    => 'contact-info',
					);
					
			} 
		 
			return $fields_to_return;
		}
		
		
			
		//-------------------------------//
		//----- CUSTOMIZE DASHBOARD -----//
		//-------------------------------//
		
			// CUSTOM ADMIN LOGIN HEADER LOGO
			function my_custom_login_logo() {
			    echo '<style  type="text/css"> h1 a {  background-image:url(' . get_bloginfo('template_directory') . '/images/logo_login.png)  !important;
			    									   background-size: 300px 35px !important;
													   background-position-y: 28px !important; } </style>';
			}
			add_action('login_head',  'my_custom_login_logo');
			
			// ADD CUSTOM ICONS TO CUSTOM POST TYPES
			add_action( 'admin_head', 'cpt_icons' );
			function cpt_icons() {
			    ?>
			    <style type="text/css" media="screen">
			    	<?php // PROGRAMS ?>
			        #menu-posts-program .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/books-stack.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-program:hover .wp-menu-image, #menu-posts-program.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // TARGET NATIONS ?>
			        #menu-posts-target_nations .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/globe-model.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-target_nations:hover .wp-menu-image, #menu-posts-target_nations.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // VIDEOS ?>
			        #menu-posts-videos .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/films.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-videos:hover .wp-menu-image, #menu-posts-videos.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // STORIES ?>
			        #menu-posts-stories .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/user--pencil.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-stories:hover .wp-menu-image, #menu-posts-stories.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // TEACHINGS ?>
			        #menu-posts-teachings .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/microphone.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-teachings:hover .wp-menu-image, #menu-posts-teachings.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // FOCUS MINISTRIES ?>
			        #menu-posts-focus_ministries .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/magnifier.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-focus_ministries:hover .wp-menu-image, #menu-posts-focus_ministries.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // PROJECTS ?>
			        #menu-posts-projects .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/hard-hat.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-projects:hover .wp-menu-image, #menu-posts-projects.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			        
			        <?php // STAFF OPPORTUNITIES ?>
			        #menu-posts-staff_opportunities .wp-menu-image {
			            background: url(<?php bloginfo('template_url') ?>/images/user-business.png) no-repeat 6px -17px !important;
			        }
					#menu-posts-staff_opportunities:hover .wp-menu-image, #menu-posts-staff_opportunities.wp-has-current-submenu .wp-menu-image {
			            background-position:6px 7px!important;
			        }
			    </style>
			<?php }
			
			
		
		
		//----------------------------//
		//----- INSTAGRAM WIDGET -----//
		//----------------------------//
		
		function get_instagram($insta_args) {
			
				if (!isset($insta_args["rows"])){$insta_args["rows"] = 3;}
				if (!isset($insta_args["cols"])){$insta_args["cols"] = 3;}//OPTIONS 2,3,4,6,12
				if (!isset($insta_args["resolution"])){$insta_args["resolution"] = 'low_resolution';}//OPTIONS: low_resolution, thumbnail, standard_resolution
				if (!isset($insta_args["feed"])){$insta_args["feed"] = 'hashtag';} //OPTIONS: base, hashtag
				if (!isset($insta_args["tag"])){$insta_args["tag"] = 'ywammontana';}
				
				if ($insta_args['feed'] == 'base') {
					$feed_url = 'https://api.instagram.com/v1/users/231333075/media/recent?access_token=231333075.26c3a2f.8f32564f07c64424b28191ee96825254';
				} else {
					$feed_url = 'https://api.instagram.com/v1/tags/' . $insta_args['tag'] . '/media/recent?access_token=231333075.26c3a2f.8f32564f07c64424b28191ee96825254';
				}
				
				
				global $span, $resolution, $cols, $rows, $title_prefix;
					$title_prefix = $insta_args['title_prefix'];
					$resolution = $insta_args['resolution'];
					$cols = $insta_args['cols'];
					$rows = $insta_args['rows'];
					$span = 12/$cols;
				
				
				
			  function fetchData($url){
				$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_TIMEOUT, 20);
				$result = curl_exec($ch);
					curl_close($ch); 
				return $result;
			  }
			  $result = fetchData($feed_url);
			  $result = json_decode($result);
			  
			  $col_i = 1;
			  $row_i = 1;
			  ?>
			  
			  
			  <?php function get_instagram_post($post) { ?>
			  <?php global $span, $resolution; ?>
			   
			  
		  		<div class="span<?php echo $span; ?> instagram-container">
		  			<a href="<?php echo $post->link; ?>" target="_blank">
						<img src="<?php echo $post->images->$resolution->url; ?>" />
					
						<div class="instagram-meta">	
							<div class="instagram-social">
								<i class="icon-heart"></i> <?php echo $post->likes->count; ?>
								<i class="icon-comment"></i> <?php echo $post->comments->count; ?>
							</div>
						</div>
					</a>
				</div>
			  <?php } ?>
			  
			  <?php if (!empty($result->data)) { ?>
			  <h4><?php echo $title_prefix; ?> Instagram Feed</h4>
			  <div class="row-fluid instarow">
				  <?php foreach ($result->data as $post) { ?>
					  <?php if ($row_i <= $rows) { ?> 
							  	<?php if ($col_i <= $cols) { ?>
									<?php get_instagram_post($post); ?>
									<?php $col_i = ++$col_i; ?>
								<?php } else { ?>
								  </div>
								  <?php $row_i = ++$row_i; ?>
								  <div class="row-fluid instarow">
						  
						  			<?php if ($row_i <= $rows) { get_instagram_post($post);} ?>
									<?php $col_i = 2; ?>
								<?php } ?>
					  <?php } ?>
				  <?php } ?>
								  </div>
								  <?php } ?>
		<?php } 
			
			

		




		//FUNCTION TO RETRIEVE AND DISPLAY POST OR PAGE SLUG
		function the_slug() {
		    $post_data = get_post($post->ID, ARRAY_A);
		    $slug = $post_data['post_name'];
		    return $slug; 
		}


		//PAGINATION FOR BLOG
		function pagination($pages = '', $range = 4)
		{  
		     $showitems = ($range * 2)+1;  
		 
		     global $paged;
		     if(empty($paged)) $paged = 1;
		 
		     if($pages == '')
		     {
		         global $wp_query;
		         $pages = $wp_query->max_num_pages;
		         if(!$pages)
		         {
		             $pages = 1;
		         }
		     }   
		 
		     if(1 != $pages)
		     {
		         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
		         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
		         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
		 
		         for ($i=1; $i <= $pages; $i++)
		         {
		             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		             {
		                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
		             }
		         }
		 
		         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
		         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
		         echo "</div>\n";
		     }
		}

	
	
	//NO POSTS FOUND FUNCTION
	function no_posts_found ($post_type) { ?>
		<div class="row no_posts_found">
			
			<div class="span3">
				<h1>Ooops,</h1>
				<p>We searched our whole database and couldn't find any <?php echo $post_type; ?> like that, or by that name.  But we did manage to find these guy's in there. <a href="http://www.youtube.com/watch?v=6qsH_LFRr6k">No wonder it's been slow lately...</a></p>
			</div>
			
			<div class="span7">
				<img src="<?php echo get_bloginfo ('template_directory'); ?>/images/no-posts.jpg" />
			</div>
			
		</div>
	<?php }