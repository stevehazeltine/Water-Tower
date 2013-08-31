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
		    
		    //TAKE CARE OF BOOTSTRAP
		    wp_register_script('bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js', array('jquery'), '2.3.2', true);
			
			//BEGIN REGISTERING SCRIPTS
		    wp_register_script('themeuxscripts', get_template_directory_uri().'/js/themeuxscripts.js', array('jquery'), '1.0', true);
		    wp_register_script('royalslider', get_template_directory_uri().'/royalslider/jquery.royalslider.min.js', array('jquery'), '9.4.0', true);
		    wp_register_script('charts', get_template_directory_uri().'/js/Chart.min.js', array('jquery'), '0.2', true);
		    
		    
		    //QUEUE UP YOUR SCRIPTS
		    wp_enqueue_script('jquery');
		    wp_enqueue_script('bootstrap');
		    wp_enqueue_script('royalslider');
		    wp_enqueue_script('charts');
			wp_enqueue_script('themeuxscripts');
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
				'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
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
							'rewrite' => array(
								'hierarchical' => true,
								'slug'	=> 'program-blogs'
							),
							'show_admin_column' => true,
						);
						register_taxonomy( 'program_taxo', array( 'post', 'videos', 'teachings', 'user' ), $args );
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
					
					
					
					
					//ADD PROGRAMS PRE REQUISITE TAXONOMY
					function my_taxonomies_prereqs() {
						$labels = array(
							'name'              => _x( 'Pre Requisite', 'taxonomy general name' ),
							'singular_name'     => _x( 'Pre Requisite', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Pre Requisites' ),
							'all_items'         => __( 'All Pre Requisites' ),
							'parent_item'       => __( 'Parent Pre Requisite' ),
							'parent_item_colon' => __( 'Parent Pre Requisite:' ),
							'edit_item'         => __( 'Edit Pre Requisite' ), 
							'update_item'       => __( 'Update Pre Requisite' ),
							'add_new_item'      => __( 'Add New Pre Requisite' ),
							'new_item_name'     => __( 'New Pre Requisite' ),
							'menu_name'         => __( 'Pre Requisites' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
						);
						register_taxonomy( 'prereqs_taxo', array( 'program' ), $args );
					}
					add_action( 'init', 'my_taxonomies_prereqs', 0 );
					
					
					
					//AUTOMATICALLY SAVE AND UPDATE PROGRAM INFORMATION TO LINK TO SCHOOLS IN BLOG
					function post_prereqs_update($post_id){
					  if(wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
						  return $post_id;
					  }
			
					  $post_obj = get_post($post_id);
					  $raw_title = $post_obj->post_title;
					  $post_type = $post_obj->post_type;
					  $slug_title = sanitize_title($raw_title);
			
					  if (($post_type == 'program') && ($slug_title != 'auto-draft') && (!empty($raw_title))) {
						 // get the terms associated with this custom post type
						 $terms = get_the_terms($post_id, 'prereqs_taxo');
						 $term_id = $terms[0]->term_id;
						 // if term exists then update term
						 if ($term_id > 0) {
							 wp_update_term($term_id,
											'prereqs_taxo',
											array(
											  'description' => $raw_title,
											  'slug' => $raw_title,
											  'name' => $raw_title)
											);
						 } else {
							// creates a new term in the program_taxo taxonomy
							wp_set_object_terms($post_id, $raw_title, 'prereqs_taxo', false);
						 }
					  }
					}
			
					add_action('save_post', 'post_prereqs_update');
					
				
		
		
		
		
		
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
					function post_target_nations($post_id){
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
			
					add_action('save_post', 'post_target_nations');


		
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
		
		
		
		
		//VWAP TEAMS
	    function my_custom_post_vwap_teams() {
			$labels = array(
				'name'               => _x( 'VWAP Teams', 'post type general name' ),
				'singular_name'      => _x( 'VWAP Team', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'book' ),
				'add_new_item'       => __( 'Add New VWAP Team' ),
				'edit_item'          => __( 'Edit VWAP Team' ),
				'new_item'           => __( 'New VWAP Team' ),
				'all_items'          => __( 'All VWAP Teams' ),
				'view_item'          => __( 'View VWAP Team' ),
				'search_items'       => __( 'Search VWAP Teams' ),
				'not_found'          => __( 'No VWAP Teams found' ),
				'not_found_in_trash' => __( 'No VWAP Teams found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'VWAP Teams',
			);
			$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our VWAP Teams specific data',
				'public'        => true,
				'menu_position' => 22,
				'supports'      => array( 'title', 'editor', 'thumbnail' ),
				'has_archive'   => true,
				'hierarchical' 	=> true,
				'rewrite' 		=> array('slug' => 'vwap-teams'),
			);
			register_post_type( 'vwap_teams', $args );	
		}
		add_action( 'init', 'my_custom_post_vwap_teams' );


					//ADD LOCATIONS TAXONOMY
					function my_taxonomies_vwap_groups_taxo() {
						$labels = array(
							'name'              => _x( 'VWAP Groups', 'taxonomy general name' ),
							'singular_name'     => _x( 'VWAP Group', 'taxonomy singular name' ),
							'search_items'      => __( 'Search VWAP Groups' ),
							'all_items'         => __( 'All VWAP Groups' ),
							'parent_item'       => __( 'Parent VWAP Group' ),
							'parent_item_colon' => __( 'Parent VWAP Group:' ),
							'edit_item'         => __( 'Edit VWAP Group' ), 
							'update_item'       => __( 'Update VWAP Group' ),
							'add_new_item'      => __( 'Add New VWAP Group' ),
							'new_item_name'     => __( 'New VWAP Group' ),
							'menu_name'         => __( 'VWAP Groups' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
							'show_admin_column' => true,
						);
						register_taxonomy( 'vwap_groups_taxo', array('vwap_teams'), $args );
					}
					add_action( 'init', 'my_taxonomies_vwap_groups_taxo', 0 );

		
		
		
				
		
		
		
		
		
		
		
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

		
		//ADD GUEST AUTHOR TAXONOMY
					function my_taxonomies_guest_author_taxo() {
						$labels = array(
							'name'              => _x( 'Guest Authors', 'taxonomy general name' ),
							'singular_name'     => _x( 'Guest Author', 'taxonomy singular name' ),
							'search_items'      => __( 'Search Guest Authors' ),
							'all_items'         => __( 'All Guest Authors' ),
							'parent_item'       => __( 'Parent Guest Author' ),
							'parent_item_colon' => __( 'Parent Guest Author:' ),
							'edit_item'         => __( 'Edit Guest Author' ), 
							'update_item'       => __( 'Update Guest Author' ),
							'add_new_item'      => __( 'Add New Guest Author' ),
							'new_item_name'     => __( 'New Guest Author' ),
							'menu_name'         => __( 'Guest Authors' ),
						);
						$args = array(
							'labels' => $labels,
							'hierarchical' => true,
							'rewrite' => array('hierarchical' => true ),
							'show_admin_column' => true,
						);
						register_taxonomy( 'guest_author_taxo', '', $args );
					}
					add_action( 'init', 'my_taxonomies_guest_author_taxo', 0 );
					
					
					
					//AUTOMATICALLY SAVE AND UPDATE TARGET NATION INFORMATION TO LINK TO IN BLOG
					function post_guest_author_taxo($post_id){
					  if(wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
						  return $post_id;
					  }
			
					  $post_obj = get_post($post_id);
					  $raw_title = $post_obj->post_title;
					  $post_type = $post_obj->post_type;
					  $slug_title = sanitize_title($raw_title);
			
					  if (($post_type == 'guest-author') && ($slug_title != 'auto-draft') && (!empty($raw_title))) {
						 // get the terms associated with this custom post type
						 $terms = get_the_terms($post_id, 'guest_author_taxo');
						 $term_id = $terms[0]->term_id;
						 // if term exists then update term
						 if ($term_id > 0) {
							 wp_update_term($term_id,
											'guest_author_taxo',
											array(
											  'description' => $raw_title,
											  'slug' => $raw_title,
											  'name' => $raw_title)
											);
						 } else {
							// creates a new term in the program_taxo taxonomy
							wp_set_object_terms($post_id, $raw_title, 'guest_author_taxo', false);
						 }
					  }
					}
						
					add_action('save_post', 'post_guest_author_taxo');	
		
		
		
		
		
		
		
		
		//-----------------------------------------------//
		//----- PROJECT POST TYPE/CLASSES/FUNCTIONS -----//
		//-----------------------------------------------//
		
		
			//----- DECLARE POST TYPE AND TAXONOMY -----//
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
						
						
						
			//----- AUTOMATICALLY UPDATE PROJECT TAXONOMY BASED ON POSTS IN POST TYPE -----//
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
			
			//----- PROJECT STATUS CLASS -----//
			class projectStatus {
				var $project_phases;
				var $project_completion;
				var $project_finances;
				var $project_updates;
								
				
				function __construct($post_id) {
				
						//----- POPULATE PHASE COLORS VARIABLE -----//
						$phase_colors = array ('C1D9EC', '92BDDD', '609FCE', '3A83BB', '2B628C');

						//----- DECLARE PROJECT PHASES -----//
						$i = 1;
						$phase_title = 'phase' . $i . '_title';
						$phase_total = 'phase' . $i . '_total_comp';
						$phase_actual = 'phase' . $i . '_actual_comp';
						$phase_tbc = rwmb_meta($phase_total, '', $post_id) - rwmb_meta($phase_actual, '', $post_id);
						$phase_color = 'phase' . $i . '_color';
						while (rwmb_meta($phase_title, '', $post_id) !== '') {
						
								$this->project_phases[rwmb_meta($phase_title, '', $post_id)] = array(
									'phase_total'	=>	rwmb_meta($phase_total, '', $post_id),
									'phase_actual'	=>	rwmb_meta($phase_actual, '', $post_id),
									'phase_tbc'		=>	$phase_tbc,
									'phase_color'	=>	$phase_colors[$i-1],
								);
								
								$global_completeness = $global_completeness + rwmb_meta($phase_actual, '', $post_id);
								
							$i = $i + 1;
							$phase_title = 'phase' . $i . '_title';
							$phase_total = 'phase' . $i . '_total_comp';
							$phase_actual = 'phase' . $i . '_actual_comp';
							$phase_tbc = rwmb_meta($phase_total, '', $post_id) - rwmb_meta($phase_actual, '', $post_id);
							$phase_color = 'phase' . $i . '_color';
						}
						
						$this->project_completion = $global_completeness;
						
						
						//----- DECLARE PROJECT FINANCES -----//
						$this->project_finances = array(
							'project_budget' 	=> rwmb_meta('project_total_funds_needed', '', $post_id),
							'funds_acquired'	=> rwmb_meta('project_total_funds_acquired', '', $post_id),
							'percent_raised'	=> 100*(rwmb_meta('project_total_funds_acquired', '', $post_id)/rwmb_meta('project_total_funds_needed', '', $post_id)),
							'funds_needed'		=> rwmb_meta('project_total_funds_needed', '', $post_id)-rwmb_meta('project_total_funds_acquired', '', $post_id),
						);
						
						//----- DELCARE PROJECT UPDATES -----//
						$this->project_updates = array (
						
						);
						
						
				}
			}
			
			//----- GET PROJECT STATUS FUNCTION -----//
			function get_project_status($post_id) {
				$project_status = new projectStatus($post_id);
				
				return $project_status;
			}
			
			
			//----- GET ACTIVE PROJECT INDEX -----//
			function get_active_project_index() { ?>
				<div class="project-index">
					<?php $args = array (
							'post_type' => 'projects',
					); ?>
					
					<?php $projects = new WP_Query( $args ); ?>
					<?php while ( $projects->have_posts() ) { ?>
					<?php $projects->the_post(); ?>
					
					<?php //----- RETRIEVE PROJECT STATUS -----// ?>
					<?php $project_status = get_project_status($post->ID); ?>

					<?php //----- DISPLAY CONTENT -----// ?>
					<div class="row project-container">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3 project-thumbnail">
									<?php the_post_thumbnail( '16:9-media' ); ?>
								</div>
								
								<div class="hidden-md hidden-lg project-mobile-thumbnail">
										<?php the_post_thumbnail('full-banner'); ?>
								</div>
								
								<div class="col-md-9 project-content-container">
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
																				
									<span class="project-funds"><?php echo number_format($project_status->project_finances['percent_raised']); ?>% Funded</span>
									
									<?php the_excerpt(); ?>
									
									
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 project-status-meter">
									<div class="project-finances-title">
										<h6><?php echo $project_status->project_completion; ?>% Complete</h6>
									</div>
									<div class="project-status-outer-meter">
										
										<?php foreach ($project_status->project_phases as $phase) {
											echo '<div class="project-status-inner-actual" style="width: ' . $phase['phase_actual'] . '%; background: #' . $phase['phase_color'] . '"></div>';
											echo '<div class="project-status-inner-tbc" style="width: ' . $phase['phase_tbc'] . '%;"></div>';
										} ?>
										
									
									</div>
								</div>
							</div>
						</div>
					</div>	
					<?php } ?>
			</div>
		
		<?php }
		
		
		
		
		
		
		
		
		
		
		
		//----- FUNCTION TO RETRIEVE AND DISPLAY POST OR PAGE SLUG -----//
		function the_slug() {
		    $post_data = get_post($post->ID, ARRAY_A);
		    $slug = $post_data['post_name'];
		    return $slug; 
		}
		
		
		//----- FUNCTION TO GET THE PROGRAMS CLASS AND RETURN OBJECT -----//
		function get_program_class($program_id) {
			$program_class = wp_get_post_terms($program_id, 'program_classification');
			return $program_class;
		}
		
		
		
		//-----------------------------//
		//----- POST RIBBON CLASS -----//
		//-----------------------------//
		
		class PostRibbon {
			var $post_id;						
			var $post_color_info;
			var $total_terms;
			
			//----- GENERATE AND DECLARE POST COLOR INFORMAITON -----//
			public function post_color_info() {
				$this->post_color_info = array();
				$this->total_terms = 0;
				
				//----- LOOP THROUGH RELATED PROGRAMS -----//
				$related_programs = wp_get_post_terms($this->post_id, 'program_taxo');
				foreach ($related_programs as $program) {
					$program = get_page_by_path($program->slug, OBJECT, 'program');
					
					//----- GET COLOR DATA BASED ON PROGRAMS CLASSIFICATION -----//
					$program_class = get_program_class($program->ID);
					foreach ($program_class as $classification) {
						$class_slug = $classification->slug;

						if (array_key_exists($classification->slug, $this->post_color_info)) {
							$this->post_color_info[$class_slug][count] = ++$this->post_color_info[$class_slug][count]; 
						} else {
							$this->post_color_info[$class_slug] = array('slug' => $class_slug, 'count' => 1, 'color' => get_program_color($program->ID));
						}
						
						//----- UPDATE TOTAL TERMS EVERYTIME TERM IN FOUND -----//
						$this->total_terms = ++$this->total_terms;
					}
				}
				
				usort($this->post_color_info, array($this, 'sort_by_count'));
			}
			
			//----- SORT CLASSIFICATIONS BASED ON COUNT -----//
			public function sort_by_count($a, $b) {
				return ($a['count'] > $b['count']) ? -1 : 1;
			}
			
			//----- DISPLAY POST RIBBON -----//
			public function build_ribbon($orientation, $thickness) {
				
				//----- DEFINE STYLES -----//
				if ($orientation == 'vertical') {
					$styles = 'width:' . $thickness . 'px;';
					$container_class = 'vertical';
				} else {
					$styles = 'height:' . $thickness . 'px;';
					$container_class = 'horizontal';
				}
				
				//----- BUILD THE RIBBON -----//
				echo '<div style="' . $styles . '" class="post-ribbon-container ' . $container_class . '">';
					foreach ($this->post_color_info as $ribbon) {
						if ($orientation == 'vertical') {
							echo '<div style="height: ' . (($ribbon['count']/$this->total_terms)*100) . '%; background: #' . $ribbon['color'] . ';" class="post-ribbon"></div>';
						} else {
							echo '<div style="width: ' . (($ribbon['count']/$this->total_terms)*100) . '%; background: #' . $ribbon['color'] . ';" class="post-ribbon"></div>';
						}
					}
				echo '</div>';
			}
	
			function __construct($post_id) {
				$this->post_id = $post_id;
				$this->post_color_info();
			}
			
		}

		
		
		//-----------------------------------------------------------------//
		//----- FUNCTIONS TO GET PROGRAM COLOR BASED ON CLASSIFICATION -----//
		//-----------------------------------------------------------------//
		
		function get_program_color($post_id) {

			$terms = get_program_class($post_id); 
			$program_slug = str_replace('-', '_', $terms[0]->slug) . '_color';
	
			$program_colors = get_option('display_options');
			
			$program_color = $program_colors[$program_slug];
			return $program_color;	
		}
		
		function get_classification_color ($classification) {
			$classification = str_replace('-', '_', $classification) . '_color';			
		
			$program_colors = get_option('display_options');
			$program_color = $program_colors[$classification];
			return $program_color;
		}
		
		
		//-----------------------------------------------------------------//
		//----- FUNCTION TO GET COLOR RIBBON WITH ALL CLASSIFICATIONS -----//
		//-----------------------------------------------------------------//
		
		function all_class_ribbon($height) {
		
			echo '<div class="all-class-ribbon" style="height: ' . $height . 'px";>';
			$classifications = get_terms('program_classification');
			$width = 100*(1/count($classifications));
			foreach ($classifications as $classification) {
				$format = '<div class="%s" style="background: #%s; width:' . $width . '%%; float: left; height: 100%%"></div>';
				$slug = $classification->slug;
				$color = get_classification_color($slug);
				
				echo sprintf($format, $slug, $color);
			}
			echo '</div>';
		}
		
		
		
		//---------------------------------------------------------------//
		//----- CLASS TO RETIRVE AND RETURN UPCOMING SCHOOLS OBJECT -----//
		//---------------------------------------------------------------//
		
		class ProgramDates {
			var $cur_date;
			var $schools;
			var $featured;
			
			//---- BUILD UPCOMING SCHOOLS OBJECT -----//
			public function get_schools() {
				
				//----- STORE ALL INSTANCES OF SCHOOLS IN ARRAY BASED ON SCHOOL ID -----//
				$raw_programs = new WP_Query( 'post_type=program&nopaging=true' );
				
				if ( $raw_programs->have_posts() ) {
					while ( $raw_programs->have_posts() ) {
						$raw_programs->the_post();
						
						$i = 1;
						$start_date = 'start_date' . $i;
						while (rwmb_meta($start_date) != '') {
						
							//GET PROGRAM CLASSIFICATION
							$program_class = get_the_terms($raw_programs->post->ID, 'program_classification');
							reset($program_class);
							$program_class_key = key($program_class);
							
							if (rwmb_meta($start_date) >= $this->cur_date) {
								$raw_program_dates[] = array(
									'slug'			=>	$raw_programs->post->post_name,
									'program_id'	=>	$raw_programs->post->ID,
									'program_class' =>	$program_class[$program_class_key]->name,
									'start_date'	=>	rwmb_meta($start_date),
								);
							}
							$i = ++$i;
							$start_date = 'start_date' . $i;
						}
					}
				$this->schools = $raw_program_dates;
				usort($this->schools, array($this, 'sort_by_date'));

				}
			}
			
			
			//----- SORT UPCOMING SCHOOLS BY DATE -----//
			public function sort_by_date($a, $b) {
				return ($a['start_date'] < $b['start_date']) ? -1 : 1;
			}
				
			
			
			function __construct() {
				$this->cur_date = date('Ymd');
				$this->get_schools();
			}
		}
		
		//------------------------------------------------//
		//----- PROGRAM DATES CLASS HELPER FUNCTIONS -----//
		//------------------------------------------------//
		
			//----- GET UPCOMING SCHOOLS -----//
			function get_upcoming_schools($num_requested) {
				$programs = new ProgramDates();
				
				//----- RANDOMIZE SCHOOLS WITH SAME DATE FOR FEATURED PROGRAM -----//
				if ($programs->schools[0]['start_date'] == $programs->schools[1]['start_date']) {
					
					//----- FIND OUT HOW MANY SCHOOLS HAVE THE SAME DATE -----//
					$cur_key = 0;
					$cmp_key = 1;
					$num_same_date = 1;
					
						//----- START BY COMPARING KEY 1 to KEY 2 -----//
							while ($programs->schools[$cur_key]['start_date'] == $programs->schools[$cmp_key]['start_date']) {
								$num_same_date = ++$num_same_date;
								$cur_key = ++$cur_key;
								$cmp_key = ++$cmp_key;
							}
							
						
					//----- ONCE NUMBER OF SAME DATES IS FOUND, SHUFFLE THE RANGE -----/
					$programs_with_same_date = array_slice($programs->schools, 0, $num_same_date);
					shuffle($programs_with_same_date);
					
					//----- REASSIGN ITEMS TO ARRAY -----//
					$key = 0;
					foreach ($programs_with_same_date as $shuffled_program) {
						$programs->schools[$key] = $shuffled_program;
						$key = ++$key;
					}
				}
				
				$programs->schools = array_slice($programs->schools, 0, $num_requested);
				return $programs;
			}
		

/**
 * Get Quarter of Program
 *
 * @param string date_string
 * @return string quarter_string
 */

 function define_quarter($date_string) {
 
	$program_year = substr($date_string, 0, 4);
 
	if (preg_match('^[0-9]{4}[0]{1}[1-2]{1}[0-9]{2}$^', $date_string)) {
		$quarter_string = 'Winter ' . $program_year;
		return $quarter_string;
	} elseif (preg_match('^[0-9]{4}[0]{1}[3-5]{1}[0-9]{2}$^', $date_string)) {
		$quarter_string = 'Spring ' . $program_year;
		return $quarter_string;
	} elseif (preg_match('^[0-9]{4}[0]{1}[6-8]{1}[0-9]{2}$^', $date_string)) {
		$quarter_string = 'Summer ' . $program_year;
		return $quarter_string;
	} elseif (preg_match('^[0-9]{4}[0-1][0-2,9][0-9]{2}$^', $date_string)) {
		$quarter_string = 'Fall ' . $program_year;
		return $quarter_string;
	} else {
		return 0;
	}
 }



/**
 * Get Program Information Class
 *
 * @param string program_id
 * @return object programInfo
 */		

	class programInfo {
		var $cur_date;
		var $program_id;
		var $program_slug;
		var $program_short_name;
		var $schedule;
		var $ongoing_status;
		var $academic_info;
		
		public function populate_schedule() {
			
			$i = 1;
			$start_date = 'start_date' . $i;
			$end_date = 'end_date' . $i;
			$total_cost = 'total_cost' . $i;
			$app_open_date = 'app_open_date' . $i;
			$app_deadline = 'app_deadline' . $i;
			$canadian_app_deadline = 'canadian_app_deadline' . $i;
			$african_app_deadline = 'african_app_deadline' . $i;
			$international_app_deadline = 'international_app_deadline' . $i;
			$this->cur_date = date('Ymd');
			
			
			$app_color_settings = get_option('program_options');
			$open_app_color = $app_color_settings['program_open_app_color'];
			$closed_app_color = $app_color_settings['program_closed_app_color'];
			
			while (rwmb_meta($start_date, '', $program_id=$this->program_id) != '') {
				
				//----- ONLY DISPLAY FUTURE SCHOOLS -----//
				if (rwmb_meta($start_date, '', $program_id=$this->program_id) >= $this->cur_date) {
					$this->schedule[$i] = array(
						'start_date' => rwmb_meta($start_date, '', $program_id=$this->program_id),
						'end_date'	 => rwmb_meta($end_date, '', $program_id=$this->program_id),
						'total_cost' => rwmb_meta($total_cost, '', $program_id=$this->program_id) == '' ? null : money_format( '%i', rwmb_meta($total_cost, '', $program_id=$this->program_id)),
						'app_open_date'	=> rwmb_meta($app_open_date, '', $program_id=$this->program_id),
						'app_deadline'	=> rwmb_meta($app_deadline, '', $program_id=$this->program_id),
						'canadian_app_deadline'	=> rwmb_meta($canadian_app_deadline, '', $program_id=$this->program_id),
						'african_app_deadline'	=> rwmb_meta($african_app_deadline, '', $program_id=$this->program_id),
						'international_app_deadline'	=> rwmb_meta($international_app_deadline, '', $program_id=$this->program_id),
					);
					
					$this->schedule[$i]['quarter'] = define_quarter(rwmb_meta($start_date, '', $program_id=$this->program_id)); 
					
					//----- DEFINE AMERICAN APP STATUS -----//
					if ($this->cur_date > rwmb_meta($app_open_date, '', $program_id=$this->program_id) && $this->cur_date < rwmb_meta($app_deadline, '', $program_id=$this->program_id)) {
						$this->schedule[$i]['app_status'] = 'open';
						$this->schedule[$i]['app_status_color'] = $open_app_color;
					} else {
						$this->schedule[$i]['app_status'] = 'closed';
						$this->schedule[$i]['app_status_color'] = $closed_app_color;
					}
					
					//----- DEFINE CANADIAN APP STATUS -----//
					if ($this->cur_date > rwmb_meta($app_open_date, '', $program_id=$this->program_id) && $this->cur_date < rwmb_meta($canadian_app_deadline, '', $program_id=$this->program_id)) {
						$this->schedule[$i]['canadian_app_status'] = 'open';
						$this->schedule[$i]['canadian_app_status_color'] = $open_app_color;
					} else {
						$this->schedule[$i]['canadian_app_status'] = 'closed';
						$this->schedule[$i]['canadian_app_status_color'] = $closed_app_color;
					}
					
					//----- DEFINE AFRICAN APP STATUS -----//
					if ($this->cur_date > rwmb_meta($app_open_date, '', $program_id=$this->program_id) && $this->cur_date < rwmb_meta($african_app_deadline, '', $program_id=$this->program_id)) {
						$this->schedule[$i]['african_app_status'] = 'open';
						$this->schedule[$i]['african_app_status_color'] = $open_app_color;
					} else {
						$this->schedule[$i]['african_app_status'] = 'closed';
						$this->schedule[$i]['african_app_status_color'] = $closed_app_color;
					}
					
					//----- DEFINE AMERICAN APP STATUS -----//
					if ($this->cur_date > rwmb_meta($app_open_date, '', $program_id=$this->program_id) && $this->cur_date < rwmb_meta($international_app_deadline, '', $program_id=$this->program_id)) {
						$this->schedule[$i]['international_app_status'] = 'open';
						$this->schedule[$i]['international_app_status_color'] = $open_app_color;
					} else {
						$this->schedule[$i]['international_app_status'] = 'closed';
						$this->schedule[$i]['international_app_status_color'] = $closed_app_color;
					}
				}
				
				$i = ++$i;
				$start_date = 'start_date' . $i;
				$end_date = 'end_date' . $i;
				$total_cost = 'total_cost' . $i;
				$app_open_date = 'app_open_date' . $i;
				$app_deadline = 'app_deadline' . $i;
				$canadian_app_deadline = 'canadian_app_deadline' . $i;
				$african_app_deadline = 'african_app_deadline' . $i;
				$international_app_deadline = 'international_app_deadline' . $i;
			}
		
			if (isset($this->schedule)) {
				usort($this->schedule, array($this, 'sort_by_date'));
			}
			
		}
		
		
		public function populate_academic_info() {
		
			$raw_prereqs = get_the_terms( $this->program_id, 'prereqs_taxo', '', $program_id=$this->program_id);
			foreach ($raw_prereqs as $prereq) {
				if ($prereq->slug != $this->program_slug) {
					$filtered_prereqs[] = array(
						'slug' => $prereq->slug,
						'name' => $prereq->name,
					);
				}
			}
			
			$this->academic_info = array(
				'short_name' => rwmb_meta('short_name', '', $program_id=$this->program_id),
				'program_acronym' => rwmb_meta('acronym', '', $program_id=$this->program_id),
				'program_duration' => rwmb_meta('program_duration', '', $program_id=$this->program_id),
				'min_age_wo_ged' => rwmb_meta('min_age_woged_prereqs', '', $program_id=$this->program_id),
				'program_prereqs' => $filtered_prereqs != '' ? $filtered_prereqs : null,
				'recommended_prereqs' => rwmb_meta('custom_prereqs', '', $program_id=$this->program_id),
				'accreditation' => rwmb_meta('accreditation', '', $program_id=$this->program_id),
				'has_outreach' => rwmb_meta('has_outreach_phase', '', $program_id=$this->program_id),
				'outreach_duration' => rwmb_meta('outreach_phase_duration', '', $program_id=$this->program_id),
				'outreach_locale' => rwmb_meta('outreach_locale', 'type=checkbox_list', $program_id=$this->program_id),
			);
			
		}
		
		
		//----- SORT DATES IN SCHEDULE -----//
		public function sort_by_date($a, $b) {
			return ($a['start_date'] < $b['start_date']) ? -1 : 1;
		}
		
		
		function __construct($program_id) {
			$this->program_id = $program_id;
			$post_object = get_post($this->program_id);
			$this->program_slug = $post_object->post_name;
			$this->program_short_name = rwmb_meta( 'short_name', '', $post_id=$this->program_id);
			setlocale(LC_MONETARY,"en_US");
		
			// Populate Schedule if Ongoing Status is False
			// Set App Status to Open if True
			$this->ongoing_status = rwmb_meta('ongoing_status', '', $program_id=$this->program_id);
			if ($this->ongoing_status == 0) {
				$this->populate_schedule();
			} else {
			
				//Get ongoing program description
				$program_settings = get_option('program_options');
				$ongoing_desc = $program_settings['ongoing_program_message'];
				$ongoing_support_desc = $program_settings['ongoing_support_desc'];
				
				$app_color_settings = get_option('program_options');
				$open_app_color = $app_color_settings['program_open_app_color'];
				$closed_app_color = $app_color_settings['program_closed_app_color'];
				$app_status_color = rwmb_meta('ongoing_app_status', '', $program_id=$this->program_id) == 'open' ? $open_app_color : $closed_app_color;
			
				$this->schedule[] = array(
					'app_status' => 'open',
					'app_status_color' => $app_status_color,
					'ongoing_desc' => $ongoing_desc,
					'ongoing_support_desc' => $ongoing_support_desc,
					'ongoing_app_status' => rwmb_meta('ongoing_app_status', '', $program_id=$this->program_id),
					'ongoing_startup_cost' => rwmb_meta('ongoing_startup_cost', '', $program_id=$this->program_id) != '' ? money_format( '%i', rwmb_meta('ongoing_startup_cost', '', $program_id=$this->program_id)) : null,
					'ongoing_monthly_cost' => rwmb_meta('ongoing_monthly_cost', '', $program_id=$this->program_id) != '' ? money_format( '%i', rwmb_meta('ongoing_monthly_cost', '', $program_id=$this->program_id)) : null,
					'ongoing_min_support_single' => rwmb_meta('ongoing_min_support_single', '', $program_id=$this->program_id) != '' ? money_format( '%i', rwmb_meta('ongoing_min_support_single', '', $program_id=$this->program_id)) : null,
					'ongoing_min_support_married' => rwmb_meta('ongoing_min_support_married', '', $program_id=$this->program_id) != '' ? money_format( '%i', rwmb_meta('ongoing_min_support_married', '', $program_id=$this->program_id)) : null,
				);
			}
			
			// Populate Academic Info
			$this->populate_academic_info();
		}
		
	}	
	
	
	
//---------------------------------------//
//----- GET TEACHING FEATURED IMAGE -----//
//---------------------------------------//
/*
 *	Function to get and echo the featured image attached to a teaching.
 *	Featured images used for teachings are referenced from the first related school of the teaching.
 *	We do this to add a sense of dynamicness to our teachings, and also to make adding them low maintenance.
 *
 *	@param string $teaching_id
 */
	function get_teaching_featured_image($teaching_id) {
		$related_programs = get_the_terms($teaching_id, 'program_taxo');
		
		// Get the first related program's slug
		reset($related_programs);
		$first_program_key = key($related_programs);
		$program_slug = $related_programs[$first_program_key]->slug;
		
		$program_object = get_page_by_path($program_slug, OBJECT, 'program');
		echo get_the_post_thumbnail($program_object->ID, '16:9-media-thumbnail'); 
	}
	
	
	
	
//--------------------------------------//
//----- SOCIAL MEDIA URL FUNCTIONS -----//
//--------------------------------------//

	function get_social_media_link($network) {
		$social_media_urls = get_option('social_options');
		
		return $social_media_urls[$network];
	}
	
	
	
	
	
//--------------------------------//
//----- DISPLAY LOOP CONTENT -----//
//--------------------------------//
/*
 *	Function that displays the content in a loop.
 *	This function must be performed from within the loop to work properly.
 *
 *	@returns HTML
 */
	
	function display_loop_excerpt($post_id) { ?>
	
		<div class="row loop-excerpt">
			<div class="col-md-3 hidden-xs hidden-sm loop-thumbnail">
				
				<?php // GET FEATURED IMAGE OF POST 
				if (get_post_type() == 'teachings') {
					echo get_teaching_featured_image($post_id);
				} else {
					echo the_post_thumbnail('thumbnail-card');
				}
				
				$teaching_ribbon = new PostRibbon($post_id);
				$teaching_ribbon->build_ribbon('horizontal', 3);
				
				
				?>
				
			</div>
			
			
			<div class="col-md-9 loop-content">
				<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<?php the_excerpt(); ?>
			</div>
		</div>
		
	<?php }
	
		
		
		
		
		
			
		// GET GALLERY AND MAP FUNCTION
		
		
		function get_banner($banner_args) { 
			
			if (!isset($banner_args["post-id"])){$banner_args["post-id"] = $post->ID;}
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
				
				<?php //----- CHECK FOR ALTERNATE IMAGES -----// ?>
				<?php $alt_images = rwmb_meta( 'slide_imgs', 'type=image', $post_id = $banner_args["post-id"] ); ?>
				<?php if ($alt_images != '') { ?>
				
					<?php //----- GET PROGRAM COLOR IF NECESSARY -----//?>
					<?php if ($banner_args['program-taxo'] != null) {
						$color = get_program_color($banner_args['post-id']);
						$color = 'style="border-bottom: 3px solid #' . $color . ';"';
					} ?>
				
					<div id="banner-gallery" class="royalSlider rsDefault royal-slider-banner" <?php echo $color; ?>>
						<img class="rsImg" src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($banner_args['post-id']), '16:9-media'); echo $image[0];?>" />
						<?php // check if the post has a Post Thumbnail assigned to it.
							foreach ( $alt_images as $image ) { ?>
								<img class="rsImg" src="<?php $img = wp_get_attachment_image_src( $image[ID] , '16:9-media'); echo $img[0];?>" />
						<?php } ?> 
					</div>
				
				<?php //----- IF NO ALTERNATE IMAGES EXIST, DISPLAY SINGLE IMAGE -----// ?>
				<?php } else { ?>
					<div class="royal-slider-banner">
						<img class="rsImg" src="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media'); echo $image[0];?>" />
					</div>
				<?php } ?>
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
						   
							['<?php echo rwmb_meta('address'); ?>', <?php echo rwmb_meta('longlat'); ?>, '<?php the_post_thumbnail( 'mobile-banner' ); ?><?php $obj = new PostRibbon(get_the_ID()); ?><?php $obj->build_ribbon('horizontal', 3); ?><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2><p><?php echo str_replace('"', '', str_replace( "'", '', substr( get_the_excerpt(), 0, 200 ))); ?>   ...</p><div class="infoBox-footer"><i class="icon-map-marker"></i> <?php echo rwmb_meta('address'); ?> <i class="icon-time"></i> <?php the_time('F j, Y'); ?></div>'],
						   
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
		
	
		
		
		<div id="map_canvas" class="hidden-sm <?php if ($banner_args["include-gallery"] == false) { ?>show-map<?php } ?>" style="width: 100%; height: 100%;"></div>
		
		<?php if ($banner_args["include-gallery"] == true) { ?>
			
			
			
			<div class="map-reveal-button-container hidden-xs hidden-sm">
				<div class="map-reveal-button">
						<a href="#_"><span class="show-map-text"><i class="icon-globe"></i> Show Map</span></a>
						<a href="#_"><span class="hide-map-text"><i class="icon-remove-circle"></i> Hide Map</span></a>
				</div>
				
			</div>

			
			
			
			
		<?php } ?>
		<?php } //ENDIF FOR INCLUDE MAP CHECK ?>
		
	</div>



	<?php } //END GET BANNER FUNCTION


		
		
		
		
		
		
		
		
		
		
		
		
		
		
		



		//THE LOOP FUNCTION
			function insert_loop($post_length='full') { ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
				<div class="row post-container">
						<div class="col-sm-3 visible-sm visible-md visible-lg post-meta-container">
							
							<?php
							if ($post_length == 'excerpt') {
								if ( has_post_thumbnail() ) {
								  the_post_thumbnail( '16:9-media-thumbnail' );
								} 
							}
							?>

							<?php if (is_single()) { ?>
								<?php $ribbon = new PostRibbon(get_the_ID()); ?>
								<?php $ribbon->build_ribbon('vertical', 2); ?>
							<?php } else { ?>
								<?php $ribbon = new PostRibbon(get_the_ID()); ?>
								<?php $ribbon->build_ribbon('horizontal', 3); ?>
							<?php } ?>
							
							
							
							
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
									<?php coauthors_posts_links( '</li><li><i class="icon-user"></i>', '</li><li><i class="icon-user"></i>', '<li><i class="icon-user"></i>', '</li>', true ); ?>
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
					 
					 
					 <div class="col-sm-9 post loop-content">
						
						
						<h2><a <?php if ($post_length == 'excerpt') { echo 'style="font-size: 24px;"';} ?> href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							 <div class="entry">
							   <?php if ($post_length=='excerpt') {the_excerpt();} else {the_content();} ?>
							   <?php if ($post_length!='excerpt') {wp_link_pages();} ?>
							   
							   
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
								
								<?php if ($post_length != 'excerpt') { ?>
								<?php //-----DISPLAY AUTHOR SECTION -----// ?>
									<?php $post_id = get_the_ID(); ?>
									<?php display_authors($post_id, null); ?>
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
													   <div class="row school-video-section">
													   
													   <?php while ( $my_query->have_posts() ) { ?>
														   <?php $my_query->the_post(); ?>									   
														   
																<!--POST FEATURED VIDEO TO SMALL SIZE IF ADDITIONAL VIDEOS EXIST, AND USE LARGE SIZE IF ALONE-->
																<div class="<?php if($num == 0) { echo 'col-md-10'; } else { echo 'col-md-9'; } ?> featured-video">
																		<div id="video1" class="royalSlider videoGallery rsDefault">
																		  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media'); echo $image[0];?>"></a>
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
												<div id="video-gallery" class="royalSlider videoGallery rsDefault visible-md visible-lg">
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
																		<span><?php the_date(); ?></span>
																		<div class="is-now-playing">Currently<br />Playing</div>
																      </div>
																    </a>
														    	<?php endwhile; ?>
											   
												   <?php while ( $my_query->have_posts() ) { ?>
													   <?php $my_query->the_post(); ?>
													   
														   
													   
														<!--LIST SUPPLEMENTAL VIDEOS-->
														<a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>">
													      <div class="rsTmb">
													        <h5><?php the_title(); ?></h5>
															<span><?php the_date(); ?></span>
															<div class="is-now-playing">Currently<br />Playing</div>
													      </div>
													    </a>
													   
												   <?php } ?>
												   </div><!--Video Slider-->

											   <?php } ?>
											   <?php wp_reset_postdata(); ?>
											   
											   
											   
											   
											   
											   <!-- VIDEO MODULE FOR MOBILE DEVICES -->
											   <div class="row school-video-section hidden-md hidden-lg">
											
											
											   <?php $args = array (
											   	'post_type' => 'videos',
											   	'p'			=> $featured_video_id,
											   ); ?>
												   
										       <?php $my_query = new WP_Query( $args ); ?>
											   
											   <?php if ( $my_query->have_posts() ) { ?>
											   <?php while ( $my_query->have_posts() ) { ?>
												   <?php $my_query->the_post(); ?>									   
												   
														<!--POST FEATURED VIDEO TO SMALL SIZE IF ADDITIONAL VIDEOS EXIST, AND USE LARGE SIZE IF ALONE-->
														<div class="<?php if($num == 0) { echo 'col-md-10'; } else { echo 'col-md-9'; } ?> featured-video">
																<div id="video1" class="royalSlider videoGallery rsDefault">
																  <a class="rsImg" data-rsVideo="<?php echo rwmb_meta('video_id'); ?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '16:9-media'); echo $image[0];?>"></a>
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
			
			<div class=" row program-archive-school-container" id="<?php echo $program_id; ?>">
						
						<div class="col-sm-4 col-md-4 program-archive-featured-media hidden-xs">
							
							<div class="program-archive-featured-image">
								<?php echo the_post_thumbnail('thumbnail-card');  ?>
							</div>
							
						</div>
						
						<div class="col-sm-8 col-md-8 program-archive-content">
						
						<?php //----- POPULATE PROGRAM INFO OBJECT -----// ?>
							
							<?php // Check for ongoing status before initializing $program_info Object
								$ongoing_status = rwmb_meta('ongoing_status');
								$program_info = new programInfo($program_id, $ongoing_status); 
							?>
							
						
							<a class="program-archive-school-title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>
							<span class="program-archive-acronym"><?php if (rwmb_meta( 'acronym', $post_id=$program_id ) != '') {?> - ( <?php echo rwmb_meta( 'acronym', $post_id=$program_id ); ?> )<?php } ?></span></a>
							
							<div class="program-archive-school-meta">
								<div class="program-archive-school-date">
									
									<?php // Check Ongoing Status and Dispaly Correct Date Information For Next Upcoming School
										if (rwmb_meta('ongoing_status') == '1') {
											echo 'Ongoing Schedule';
										} else {
											echo date("F d, Y", strtotime($program_info->schedule[0]['start_date'])) . ' - ';
											echo date("F d, Y", strtotime($program_info->schedule[0]['end_date']));
										}
									?>
									
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
								<?php the_excerpt(); ?>
							</div>
							
						</div>
					</div>
					
					<div class="row program-archive-school-footer">
						<div class="program-archive-school-footer-menu clearfix">
							
							
							
							<?php if ($in_main_archive == true) { ?>
								<div class="program-archive-school-compare-link visible-md visible-lg">
									<span>Compare 
										<i id="compare-programs-checkbox" data-programId="<?php echo $program_id; ?>" data-programTitle="<?php the_title(); ?>" class="icon-check-empty"></i>
									</span>
								</div>
							<?php } ?>
							
							<div class="program-archive-school-footer-button" data-target-container="dates-<?php echo $program_info->program_id; ?>"><i class="icon-calendar"></i><span class="hidden-sm"> All Dates</span></div>
							<div class="program-archive-school-footer-button" data-target-container="info-<?php echo $program_info->program_id; ?>"><i class="icon-info"></i><span class="hidden-sm"> Program Info</span></div>
							<div class="program-archive-app-status-container" style="float: left;">Applications: 
								<?php 
								if ($program_info->schedule[0]['app_status'] == 'open') {
									echo '<span class="application-status app-open">Open <i class="icon-circle-blank"></i></span>';
								} else {
									echo '<span class="application-status app-closed">Closed <i class="icon-circle-blank"></i></span>';
								}
								?>
								
							</div>
							
						</div>
						
						<div class="program-archive-school-footer-content">
								<div class="row" id="dates-<?php echo $program_info->program_id; ?>">
									<div class="program-archive-footer-dropdown-content-container col-md-12">
										
										<?php //----- CHECK FOR ONGOING STATUS BEFORE ANYTHING ELSE ----- ?>
										<?php if (rwmb_meta('ongoing_status') == 1) { ?>
											<p class="program-archive-disclaimer"><?php echo $program_info->schedule[0]['ongoing_desc']; ?></p>
											
											<?php if ($program_info->schedule[0]['ongoing_startup_cost'] != '') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Startup Costs
													<span><?php echo $program_info->schedule[0]['ongoing_startup_cost']; ?></span>
												</h6>
												</div>
											<?php } ?>
											
											<?php if ($program_info->schedule[0]['ongoing_monthly_cost'] != '') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Cost of Living
													<span><?php echo $program_info->schedule[0]['ongoing_monthly_cost']; ?></span>
												</h6>
												</div>
											<?php } ?>
											
											<?php if ($program_info->schedule[0]['ongoing_min_support_single'] != '') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Support (Single)
													<span><?php echo $program_info->schedule[0]['ongoing_min_support_single']; ?>/Month</span>
												</h6>
												</div>
											<?php } ?>
											
											<?php if ($program_info->schedule[0]['ongoing_min_support_married'] != '') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Support (Married)
													<span><?php echo $program_info->schedule[0]['ongoing_min_support_married']; ?>/Month</span>
												</h6>
												</div>
											<?php } ?>
											
											
										
										<?php // Begin schedule for programs that are NOT ongoing ?>
										<?php } else { ?>
										
										
										
											<?php //----- PROGRAM SCHEDULE TABLE HEADER -----//?>
											<div class="program-archive-footer-dropdown-content program-archive-footer-dropdown-header row hidden-xs">
												<div class="col-sm-2">Quarter<i class="icon-angle-down"></i></div>
												<div class="col-sm-4">Dates<i class="icon-angle-down"></i></div>
												<div class="col-sm-2">Nationality<i class="icon-angle-down"></i></div>
												<div class="col-sm-2">Apply Deadline<i class="icon-angle-down"></i></div>
												<div class="col-sm-2">Applications<i class="icon-angle-down"></i></div>
											</div>
											
											<?php //----- PROGRAM SCHEDULE INFO LOOP -----// ?>
											
											<?php foreach($program_info->schedule as $program_instance) { ?>
											
												<div class="program-archive-footer-dropdown-content row">
													<div class="col-sm-2 col-md-2 col-12"><?php echo $program_instance['quarter']; ?></div>
													<div class="col-sm-4 col-md-4 col-12"><?php echo date("M d, Y", strtotime($program_instance['start_date'])) ?> - <?php echo date("M d, Y", strtotime($program_instance['end_date'])); ?></div>
													
													
													
													<div class="col-xs-4 col-sm-2 col-md-2">
														<?php echo '<div><i class="icon-location-arrow"></i> American</div>'; ?>
														<?php echo '<div><i class="icon-location-arrow"></i> Canadian</div>'; ?>
														<?php echo '<div><i class="icon-location-arrow"></i> African</div>'; ?>
														<?php echo '<div><i class="icon-location-arrow"></i> International</div>'; ?>
													</div>
													
													<div class="col-xs-5 col-sm-2 col-md-2">
														<?php echo date("M d, Y", strtotime($program_instance['app_deadline'])) ?><br />
														<?php echo date("M d, Y", strtotime($program_instance['canadian_app_deadline'])); ?><br />
														<?php echo date("M d, Y", strtotime($program_instance['african_app_deadline'])); ?><br />
														<?php echo date("M d, Y", strtotime($program_instance['international_app_deadline'])); ?>
													</div>
													
													
													
													<div class="col-xs-3 col-sm-2 col-md-2">
													
														<?php 
														$application_status = array(
															'app_status',
															'canadian_app_status',
															'african_app_status',
															'international_app_status',
														);

														?>
														
														<?php 
															foreach ($application_status as $application) {
																$application_status_color = $application . '_color';
																echo '<div>' . ucwords($program_instance[$application]) . '<i class="icon-circle-blank" style="color: #' . $program_instance[$application_status_color] . '"></i></div>';
															}
														?>
													</div>
												</div>
											
											<?php } ?>
										<?php } ?>
									</div>
								</div>
								
								
								
								
								
								<?php // PROGRAM INFO ?>
								<div class="row" id="info-<?php echo $program_info->program_id; ?>">
									<div class="program-archive-footer-dropdown-content-container col-md-12">
										<div class="row">
											<div class="col-xs-12 program-info-block"><h6>Program Duration<span><?php echo $program_info->academic_info['program_duration']; ?> Weeks</span></h6></div>

											<?php if (isset($program_info->academic_info['program_prereqs'])) { ?>
												<div class="col-xs-12 program-info-block">
													<h6>Prerequisites</h6>
													<?php foreach ($program_info->academic_info['program_prereqs'] as $prereq) { ?>
														<div><a href="<?php echo get_permalink(get_page_by_path($prereq['slug'], OBJECT, 'program')); ?>"><i class="icon-location-arrow"></i> <?php echo $prereq['name']; ?></a></div>
													<?php } ?>
												</div>
											<?php } ?>
											
											
											<?php if (isset($program_info->academic_info['recommended_prereqs'])) { ?>
												<div class="col-xs-12 program-info-block">
													<?php if (!isset($program_info->academic_info['program_prereqs'])) { ?>
														<h6>Prerequisites</h6>
													<?php } ?>
													
													<ul>
													<?php foreach($program_info->academic_info['recommended_prereqs'] as $prereq) { ?>
														<li><?php echo $prereq; ?></li>
													<?php } ?>
													</ul>
												</div>
											<?php } ?>
											
											
											<?php if ($program_info->academic_info['accreditation'] != '') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Accreditation</h6>
													<ul>
													<li><?php echo $program_info->academic_info['accreditation']; ?></li>
													</ul>
												</div>
											<?php } ?>
											
											
											
											
											<?php //HAS OUTREACH ?>
											<div class="col-xs-12 program-info-block">
											<h6>Outreach<span>
												<?php 
												if ($program_info->academic_info['has_outreach'] == 'yes') {
													echo '<i class="icon-check"></i>';
												} elseif ($program_info->academic_info['has_outreach'] == 'as-god-allows') {
													echo '<i class="icon-check"></i>';
												} else {
													echo '<i class="icon-check-empty"></i>';
												}
												?>
												<?php echo ucwords(str_replace( '-', ' ', $program_info->academic_info['has_outreach'])); ?>
											</span></h6>
											</div>
											
											
											<?php // OUTREACH DURATION ?>
											<?php if ($program_info->academic_info['has_outreach'] == 'yes') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Outreach Duration
													<span><?php echo $program_info->academic_info['outreach_duration']; ?> Weeks</span>
												</h6>
												</div>
											<?php } ?>
											
											
											<?php // OUTREACH LOCALE ?>
											<?php if ($program_info->academic_info['has_outreach'] == 'yes'  || $program_info->academic_info['has_outreach'] == 'as-god-allows') { ?>
												<div class="col-xs-12 program-info-block">
												<h6>Outreach Locale<span>
													<?php $i = 1; ?>
													<?php foreach($program_info->academic_info['outreach_locale'] as $outreach_locale) { ?>
														<?php $comma = $i != 1 ? ', ': null; ?> 
														<?php echo $comma . ucwords($outreach_locale); ?>
														<?php ++$i; ?>
													<?php } ?>
												</span></h6>
												</div>
											<?php } ?>
											
											

										</div>
									</div>
								
								
								</div>
							</div>
					</div>
					
			<?php }
}

				 wp_reset_postdata();
			 } 
			
						
//------------------------//
//----- AUTHOR CLASS -----//
//------------------------//
/*
 *
 *	Class to retrieve author information
 *	Should author's profile be set to private, no information will be passed through.
 *	The term married indicates that an author is married, and their spouse is also present in the list.
 *	If someone who is married is present, but their spouse is not, they will be put in the singles category.
 *
 *	@param string $author_ids Should be a comma separated string of all of the author's IDs.
 *	@returns object $authors Returns an object of all of the authors that have a public profile.
 *
 */
	class authorInfo {
		var $post_id;
		var $author_ids;
		var $spouse_ids = array();
		var $married;
		var $single;
	
		private function get_authors() {
			$authors = get_coauthors($this->post_id);
			
			foreach ($authors as $author) {
				if ($this->author_status($author->ID)) {
					$this->author_ids[] = $author->ID;
				}
			}
			
		}
	
	
		//Take author's ID, and run it through a private function to find out if profile is public
		private function author_status($author_id) {
				if (rwmb_meta('profile_status', '', $post_id=$author_id) == 'public') {
					return true;
				} else {
					return false;
				}
			}
	
	
	
		private function family_oriented() {
				
				//----- SEPARATE MARRIED COUPLES FROM SINGLES -----//
				foreach($this->author_ids as $author_id) {
					
					//-----CHECK CURRENT LEADER AGAINST KNOWN SPOUSES-----//
					if (!in_array($author_id, $this->spouse_ids)) {

						//-----CHECK IF SPOUSE EXISTS-----//
						if (rwmb_meta('has_spouse', '', $post_id=$author_id) == 1) {
							$terms = rwmb_meta( 'spouse', 'type=taxonomy&taxonomy=guest_author_taxo', $post_id=$author_id );
							
							//-----SPOUSE ACTIVATED BUT NO SPOUSE SELECTED FAILSAFE-----//
							if (!empty($terms)) {
							
								//-----GET SPOUSE ID-----//
								foreach ($terms as $term) {
									$spouse_raw_slug = $term->slug;
									$spouse_slug = 'cap-' . $term->slug;
									$spouse = get_page_by_path($spouse_slug, OBJECT, 'guest-author');
									$spouse_id = $spouse->ID;
								}
									
								//----- CHECK IF SPOUSE IS PRESENT -----//
								foreach ($this->author_ids as $i_spouse_id) {
									if ($spouse_present != true) {
										if ($spouse_id != $i_spouse_id) {
											$spouse_present = false;
										}  else {
											$spouse_present = true;
										}
									}
								}
								
								//-----IF SPOUSE IS PRESENT APPEND ID'S TOGETHER-----//
								if ($spouse_present) {
								
									//-----SORT USING HEAD OF HOUSEHOLD CHECKBOX -----//
									if (rwmb_meta('head_household', '', $post_id=$author_id)) {
										$couple = array(array('ID' => $author_id), array('ID' => $spouse_id));
									} else {
										$couple = array(array('ID' => $spouse_id), array('ID' => $author_id));
									}
								
									$this->married[] = $couple;
									$this->spouse_ids[] = $spouse_id;
								
								//-----ADD TO SINGLES LIST IF SPOUSE IS NOT PRESENT-----//
								} else {
									echo 'heres your problem';
									$this->single[] = array('ID' => $author_id);
								}
							
							} else {
								$this->single[] = array('ID' => $author_id);
							}
						
						//-----PROCEED THROUGH FOR SINGLE-----//
						} else {
							$this->single[] = array('ID' => $author_id);
						}
					}											
				}
			}
	
		
		//If public, fill up information
		private function populate_author_info($user_id) {
					$user_object = get_coauthors($user_id);
					$user_post_count = count_user_posts($user_id);
					
					//get associated author taxonomy term to grab post count
					$author_terms = wp_get_post_terms($user_id, 'author');
					
					$link_active = $author_terms[0]->count > 0 ? true : false;
					
					return array(
						'test' => 'some stuff',
						'display_name'	=> $user_object[0]->display_name,
						'first_name'	=> $user_object[0]->first_name,
						'last_name'		=> $user_object[0]->last_name,
						'description'	=> $user_object[0]->description,
						'post_count'	=> $author_terms[0]->count,
						'link_active'	=> $link_active,
						);
				}
		
		
		//Construct Class using string of author IDs
		function __construct($post_id, $author_ids=null) {
		
			if (is_null($author_ids)) {
				$this->post_id = $post_id;
				$this->get_authors();
			} else {
				$this->author_ids = $author_ids;
			}

			//separate married couples from singles
			$this->family_oriented();
			
			//fill information for married couples
			if (isset($this->married)) {
				foreach ($this->married as $couples_key => $couple) {
					foreach ($couple as $spouse_key => $spouse) {
						$this->married[$couples_key][$spouse_key]['author_info'] = $this->populate_author_info($spouse['ID']);
					}
				}
			}
				
			//fill information for singles
			if (isset($this->single)) {
				foreach ($this->single as $single_key => $single) {
					$this->single[$single_key]['author_info'] = $this->populate_author_info($single['ID']);
				}
			}
		}
	}
	
//---------------------------//
//----- DISPLAY AUTHORS -----//
//---------------------------//
/*
 *	Function to display authors for a post
 *
 */
 
	function display_authors($post_id, $author_ids) {
	$authors = new authorInfo($post_id, $author_ids); ?>
		<?php // MARRIED COUPLES ?>
		<?php if (isset($authors->married)) { ?>
			<?php foreach($authors->married as $couple){ ?>
			<div class="school-leader-container">								
				<div class="row">
					<div class="col-sm-3 col-md-3 clearfix">
						<?php foreach ($couple as $author_info) { ?>
							<div class="row married-avatar-container">
								<div class="col-md-12 avatar-container"><?php echo get_the_post_thumbnail($author_info['ID'], 'thumbnail'); ?></div>
							</div>
						<?php } ?>
					</div>
																			
				
					<div class="col-sm-9 col-md-9">
						<h5>
						<?php $n = 1; ?>
						<?php foreach ($couple as $author_info) { ?>
							<?php if ($n == 1) { 
									echo $author_info['author_info']['first_name'] . ' & ';
									$n = ++$n;
								} else {
									echo $author_info['author_info']['display_name'];
								} ?>
						<?php } ?>
						</h5>
						
							<?php foreach ($couple as $author_info) { ?>
								<p><?php echo $author_info['author_info']['description']; ?></p>
							<?php } ?>
				
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		
		<?php // SINGLES ?>
		<?php if (isset($authors->single)) { ?>
			<?php foreach($authors->single as $single) { ?>
				<div class="school-leader-container">
					<div class="row">
						<div class="col-md-3 avatar-container">
							<?php echo get_the_post_thumbnail($single['ID'], 'thumbnail'); ?>
						</div>
					
						<div class="col-md-9">
							<h5><?php echo $single['author_info']['display_name']; ?></h5>
							<p><?php echo $single['author_info']['description']; ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>

	<?php }








					
			
			//----------------------------------------------------------//
			//----- FUNCTION TO RETRIEVE AND DISPLAY RELATED POSTS -----//
			//----------------------------------------------------------//
			/*
			 *	Function retrieves related posts based on post type, and 
			 *	also displays a link to the post type archive using the 
			 *	term used in the taxonomy, auto populated by the post type.
			 *
			 *	The only improvement at this point would be to make the 
			 *	archive URL auto generate itself based on getting the post
			 *	type, and the term of the auto populated taxonomy.
			 *
			 *	@input array $related_args
			 *	@returns HTML
			 *
			 */
			
			function get_related_posts($related_args) {
			
			
			
			if (!isset($related_args["title"])){$related_args["title"] = 'Related Posts';}
			if (!isset($related_args["posts_per_page"])){$related_args["posts_per_page"] = 3;}
			if (!isset($related_args["program_taxo"])){$related_args["program_taxo"] = null;}
			if (!isset($related_args["project_taxo"])){$related_args["project_taxo"] = null;}
			if (!isset($related_args["target_nation_taxo"])){$related_args["target_nation_taxo"] = null;}
			if (!isset($related_args["archive_url"])){
			
				if (get_post_type() == 'program') {
					$related_args["archive_url"] = get_bloginfo('url') . '/' . 'program-blogs' . '/' . the_slug();
					$related_args['program_taxo'] = the_slug();
				} elseif (get_post_type() == 'projects') {
					$related_args["archive_url"] = get_bloginfo('url') . '/' . 'project-blogs' . '/' . the_slug();
					$related_args['project_taxo'] = the_slug();
				} elseif (get_post_type() == 'target_nations') {
					$related_args["archive_url"] = get_bloginfo('url') . '/' . 'target-nation-blogs' . '/' . the_slug();
					$related_args['target_nation_taxo'] = the_slug();
				} else {
					$related_args['archive_url'] = get_bloginfo('url') . '/' . 'blog';
				}
			}
			?>
				
		   <?php $args = array(
				'posts_per_page' 	=> $related_args["posts_per_page"],
				'post_type' 		=> 'post',
				'program_taxo' 		=> $related_args["program_taxo"],
				'projects_taxo'		=> $related_args["project_taxo"],
				'target_nations_taxo'=> $related_args["target_nation_taxo"],
		   ); ?>
			   
			   <?php $my_query = new WP_Query( $args ); ?>
			   <?php if ( $my_query->have_posts() ) { ?>
					<li><h2><?php echo $related_args['title']; ?></h2>
					<ul>
				   <?php while ( $my_query->have_posts() ) { ?>
					   <?php $my_query->the_post(); ?>
					   
							<li>
								<div class="row sidebar-related-post">
									<div class="sidebar-thumbnail-container visible-md visible-lg col-md-4">
										<?php the_post_thumbnail( 'xs-thumbnail-card' ); ?>
									</div>
									
									<div class="sidebar-related-post-content col-md-8">
										<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
										<p><?php the_time( 'F j, Y' ); ?></p>
									</div>
								</div>
							</li>
				   <?php } ?>
				   
					<?php $args = array(
						'post_type' 	=> 'post',
						'program_taxo' 	=> $related_args['program_taxo'],
						'projects_taxo' 	=> $related_args['project_taxo'],
						'target_nations_taxo'	=> $related_args['target_nation_taxo'],
						'nopaging'	=> true,
					);
					$num = count( get_posts( $args ) ); ?>
					
						<!--RELATED POST MORE BUTTONS-->
						<li>
							<div class="sidebar-related-posts-more">
								<div class="sidebar-related-posts-view-all">
									<a href="<?php echo $related_args['archive_url']; ?>">View All (<?php echo $num; ?>) </a>
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
			<div id="comment-body-<?php comment_ID() ?>" class="comment-body row">
			
				<div class="col-md-2 comment-author vcard author">
					<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
				</div><!-- /.comment-author -->

				<div id="comment-content-<?php comment_ID(); ?>" class="col-md-10 comment-content">
					
					
						
						<!-------- COMMENTS BODY---------->
						<div class="row">
						
							<div class="col-md-12">
							
								<?php if( !$comment->comment_approved ) : ?>
									<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>	
								<?php else: ?>
									<p><span class="comment-author-name"><?php if (0 != count_user_posts($comment->user_id)) { the_author_posts_link(); } else { echo get_comment_author_link(); } ?></span> - <?php echo str_replace( '<p>' and '</p>', '', get_comment_text()); ?></p>
							</div>
						</div>
						
						
						
						
						<!---------- COMMENTS META --------->
						<div class="row">						
							
							<div class="col-md-12 comment-footer">
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
			

		/*
		 *	Function to get the apply link
		 *
		 *	@Returns $apply_link_url
		 */
		 
		 function get_apply_link() {
			 $social_options = get_option('social_options');
			 return $social_options['apply_link_url'];
		 }




		
		//----------------------------------------//
		//----- ADD WATER TOWER OPTIONS PAGE -----//
		//----------------------------------------//
		
		
			//----- ADD THEME OPTIONS LINK UNDER APPEARANCE TAB -----//
			function theme_options_page() {
			add_options_page('Water Tower Options', 'Water Tower', 'manage_options', 'theme_options', 'theme_options_page_display');
			}
			add_action('admin_menu', 'theme_options_page');

			// display the admin options page
			function theme_options_page_display() {
			?>
			<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Water Tower Settings</h2>
			
			<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'display_options'; ?> 
			
			<h2 class="nav-tab-wrapper">  
	            <a href="?page=theme_options&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>">Display</a>
	            <a href="?page=theme_options&tab=front_page_options" class="nav-tab <?php echo $active_tab == 'front_page_options' ? 'nav-tab-active' : ''; ?>">Front Page</a>  
	            <a href="?page=theme_options&tab=program_options" class="nav-tab <?php echo $active_tab == 'program_options' ? 'nav-tab-active' : ''; ?>">Programs</a>
	            <a href="?page=theme_options&tab=social_options" class="nav-tab <?php echo $active_tab == 'social_options' ? 'nav-tab-active' : ''; ?>">Social</a>
	            <a href="#" class="nav-tab">Authors</a>  
	        </h2>
			
			<p>Options relating to the Custom Plugin.</p>
				<form action="options.php" method="post">
					
					<?php 
					if ( $active_tab == 'display_options' ) {
						settings_fields('display_options');
						do_settings_sections('display_options');
					
					} elseif ( $active_tab == 'front_page_options' ) {
						settings_fields('front_page_options');
						do_settings_sections('front_page_options');
					
					} elseif ( $active_tab == 'program_options' ) {
						settings_fields('program_options');
						do_settings_sections('program_options');
					
					} elseif ( $active_tab == 'social_options' ) {
						settings_fields('social_options');
						do_settings_sections('social_options');
						
					} else {

					} 
					?>
					 
					<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button button-primary" />
				</form>
			</div>
			 
			<?php }
			
			
			//----- REGISTER ALL SETTINGS -----//			
			function water_tower_admin_init(){
				
			
				//----- REGISTER GENERAL SETTINGS -----//
				register_setting( 'general_options', 'general_options');
				
					//----- PROGRAM SETTINGS -----//
					add_settings_section('program_settings', 'Program Settings', 'program_settings_text', 'program_options');
							add_settings_field('ongoing_program_message', 'Ongoing Program Message', 'get_ongoing_program_message', 'program_options', 'program_settings');
							add_settings_field('program_open_app_color', 'Open Application Color', 'get_program_settings_open_app_color', 'program_options', 'program_settings');
							add_settings_field('program_closed_app_color', 'Closed Application Color', 'get_program_settings_closed_app_color', 'program_options', 'program_settings');
			
				//----- REGISTER DISPLAY OPTIONS SETTINGS -----//
				register_setting( 'display_options', 'display_options' );
				
					//----- CLASSIFICATION COLOR SETTINGS -----//	
					add_settings_section('classification_colors', 'Color Settings', 'classification_colors_text', 'display_options');
						add_settings_field('discipleship_training_schools_color', 'Discipleship Training School Color', 'display_options_dts_color', 'display_options', 'classification_colors');
						add_settings_field('biblical_studies_color', 'Biblical Studies Color', 'display_options_biblical_studies_color', 'display_options', 'classification_colors');
						add_settings_field('secondary_schools_color', 'Secondary Schools Color', 'display_options_secondary_schools_color', 'display_options', 'classification_colors');
						add_settings_field('seminars_color', 'Seminars Color', 'display_options_seminars_color', 'display_options', 'classification_colors');
						add_settings_field('summer_programs_color', 'Summer Programs Color', 'display_options_summer_programs_color', 'display_options', 'classification_colors');
						add_settings_field('career_discipleship_color', 'Career Discipleship Color', 'display_options_career_discipleship_color', 'display_options', 'classification_colors');
			
			
				//----- REGISTER FRONT PAGE SETTINGS -----//
				register_setting( 'front_page_options', 'front_page_options');
				
					//----- FRONT PAGE BANNER SETTINGS -----//
					add_settings_section('front_page_banner_settings', 'Banner Settings', 'banner_settings_text', 'front_page_options');
							add_settings_field('alert_status', 'Alert Status', 'get_alert_status', 'front_page_options', 'front_page_banner_settings');
							add_settings_field('alert_status_message', 'Alert Status Message', 'get_alert_status_message', 'front_page_options', 'front_page_banner_settings');
					
					//----- FRONT PAGE MODULES -----//
			
				
				
				//----- REGISTER PROGRAM SETTINGS -----//
				register_setting( 'program_options', 'program_options');
				
					//----- PROGRAM SETTINGS -----//
					add_settings_section('program_settings', 'Program Settings', 'program_settings_text', 'program_options');
							add_settings_field('ongoing_program_message', 'Ongoing Program Message', 'get_ongoing_program_message', 'program_options', 'program_settings');
							add_settings_field('ongoing_support_desc', 'Ongoing Support Description', 'get_ongoing_support_desc', 'program_options', 'program_settings');
							add_settings_field('program_open_app_color', 'Open Application Color', 'get_program_settings_open_app_color', 'program_options', 'program_settings');
							add_settings_field('program_closed_app_color', 'Closed Application Color', 'get_program_settings_closed_app_color', 'program_options', 'program_settings');
				
				//----- SOCIAL MEDIA SETTINGS -----//
				register_setting( 'social_options', 'social_options');
					
					//-----SOCIAL MEDIA SETTINGS -----//
					add_settings_section('application_options', 'Application Settings', 'application_settings_text', 'social_options');
						add_settings_field('apply_link_url', 'Application Link URL', 'get_apply_link_url', 'social_options', 'application_options');
						
					add_settings_section('social_media_options', 'Social Media Settins', 'social_media_settings_text', 'social_options');
						add_settings_field('facebook_url', 'Facebook Page URL', 'get_facebook_url', 'social_options', 'social_media_options');
						add_settings_field('twitter_url', 'Twitter Page URL', 'get_twitter_url', 'social_options', 'social_media_options');
						add_settings_field('instagram_url', 'Instagram Page URL', 'get_instagram_url', 'social_options', 'social_media_options');
						add_settings_field('vimeo_url', 'Vimeo Page URL', 'get_vimeo_url', 'social_options', 'social_media_options');
				
			}
			add_action('admin_init', 'water_tower_admin_init');
			
			
			
			//----- GENERAL SETTINGS MARKUP -----//
			function general_settings_text() {
				echo '<p>Below are all of the general settings of the website.</p>';
			}
			
			
			
			
			//----- PROGRAM CLASSIFICATION COLOR SETTINGS MARKUP -----//
			function classification_colors_text() {
				echo '<p>Select the colors for each program classification.  These will be displayed in various places on the site and should only be changed after careful consideration.  These colors tie into the design, layout, and overall look and feel of the website.</p>';
			}
			
				function display_options_dts_color() {
					$options = get_option('display_options');
					echo "<input id='display_options_text_string' style='color: white; font-weight: bold; background: #{$options['discipleship_training_schools_color']};' name='display_options[discipleship_training_schools_color]' name='display_options[discipleship_training_schools_color]' size='40' type='text' value='{$options['discipleship_training_schools_color']}' />";
				}
				
				function display_options_biblical_studies_color() {
					$options = get_option('display_options');
					echo "<input id='biblical_studies_color' style='color: white; font-weight: bold; background: #{$options['biblical_studies_color']};' name='display_options[biblical_studies_color]' name='display_options[biblical_studies_color]' size='40' type='text' value='{$options['biblical_studies_color']}' />";
				}
				
				function display_options_secondary_schools_color() {
					$options = get_option('display_options');
					echo "<input id='secondary_schools_color' style='color: white; font-weight: bold; background: #{$options['secondary_schools_color']};' name='display_options[secondary_schools_color]' size='40' type='text' value='{$options['secondary_schools_color']}' />";
				}
				
				function display_options_seminars_color() {
					$options = get_option('display_options');
					echo "<input id='seminars_color' style='color: white; font-weight: bold; background: #{$options['seminars_color']};' name='display_options[seminars_color]' name='display_options[seminars_color]' size='40' type='text' value='{$options['seminars_color']}' />";
				}
				
				function display_options_summer_programs_color() {
					$options = get_option('display_options');
					echo "<input id='summer_programs_color' style='color: white; font-weight: bold; background: #{$options['summer_programs_color']};' name='display_options[summer_programs_color]' name='display_options[summer_programs_color]' size='40' type='text' value='{$options['summer_programs_color']}' />";
				}
				
				function display_options_career_discipleship_color() {
					$options = get_option('display_options');
					echo "<input id='career_discipleship_color' style='color: white; font-weight: bold; background: #{$options['career_discipleship_color']};' name='display_options[career_discipleship_color]' name='display_options[career_discipleship_color]' size='40' type='text' value='{$options['career_discipleship_color']}' />";
				}
			
			
			
			
			//----- FRONT PAGE SETTINGS MARKUP -----//
			function banner_settings_text() {
				echo '<p>Use this section to alter how the banner on the front page functions.  Through this section you can do things like activate the alert status that allows you to relay a message through our front page banner, or you can simply override slides by activating the override and selecting the ID of the post you would like to display in its place.</p>';
			}
				function get_alert_status() {
					$options = get_option('front_page_options');
					echo "<input id='alert_status' name='front_page_options[alert_status]' type='checkbox' value='0' " . checked(0, $options['alert_status'], false) . "/>";
				}
				
				function get_alert_status_message() {
					$options = get_option('front_page_options');
					echo "<textarea id='alert_status_message' name='front_page_options[alert_status_message]' rows='5' cols='50'>";
					echo $options['alert_status_message'];
					echo '</textarea>';
				}
				
				
				
				
			//----- PROGRAM SETTINGS MARKUP -----//
			function program_settings_text() {
				echo '<p>Use this section to make changes to the functionality of our programs pages and archive page.  These settings may or may not effect all programs depending on which setting is changed.  Settings found here will be propagated throughout the website in multiple places, so make changes wisely, and sparingly.</p>';
			}
			
				function get_ongoing_program_message() {
					$options = get_option('program_options');
					echo "<textarea id='ongoing_program_message' name='program_options[ongoing_program_message]' rows='5' cols='50'>";
					echo $options['ongoing_program_message'];
					echo '</textarea>';
				}
				
				function get_ongoing_support_desc() {
					$options = get_option('program_options');
					echo "<textarea id='ongoing_support_desc' name='program_options[ongoing_support_desc]' rows='5' cols='50'>";
					echo $options['ongoing_support_desc'];
					echo '</textarea>';
				}
				
				function get_program_settings_open_app_color() {
					$options = get_option('program_options');
					echo "<input id='program_open_app_color' style='color: white; font-weight: bold; background: #{$options['program_open_app_color']};' name='program_options[program_open_app_color]' name='program_options[program_open_app_color]' size='40' type='text' value='{$options['program_open_app_color']}' />";
				}
				
				function get_program_settings_closed_app_color() {
					$options = get_option('program_options');
					echo "<input id='program_closed_app_color' style='color: white; font-weight: bold; background: #{$options['program_closed_app_color']};' name='program_options[program_closed_app_color]' name='program_options[program_closed_app_color]' size='40' type='text' value='{$options['program_closed_app_color']}' />";
				}
		
		
		
		//----- SOCIAL SETTINGS MARKUP -----//
			function social_settings_text() {
				echo '<p>Below are all of the general settings of the website.</p>';
			}
			
			function application_settings_text() {
				echo '<p>These settings will affect the way anything related to our application process behave</p>';
			}
				
				function get_apply_link_url() {
					$options = get_option('social_options');
					echo "<input id='apply_link_url' name='social_options[apply_link_url]' name='social_options[apply_link_url]' size='40' type='text' value='{$options['apply_link_url']}' />";
				}
			
			//----- SOCIAL MEDIA SECTION -----//	
			function social_media_settings_text() {
				echo '<p>Below are all of the social media settings for the website including links to our existing profiles on social media sites, along with API keys to the sites so that we can interact with the data stored on the servers of those sites.  API keys should only be changed by those who have access to, and understand how Water Tower is programmed to work.  API keys should not be changed frequently, if ever.</p>';
			}
			
				function get_facebook_url() {
					$options = get_option('social_options');
					echo "<input id='facebook_url' name='social_options[facebook_url]' name='social_options[facebook_url]' size='40' type='text' value='{$options['facebook_url']}' />";
				}
				
				function get_twitter_url() {
					$options = get_option('social_options');
					echo "<input id='twitter_url' name='social_options[twitter_url]' name='social_options[twitter_url]' size='40' type='text' value='{$options['twitter_url']}' />";
				}
				
				function get_instagram_url() {
					$options = get_option('social_options');
					echo "<input id='instagram_url' name='social_options[instagram_url]' name='social_options[instagram_url]' size='40' type='text' value='{$options['instagram_url']}' />";
				}
				
				function get_vimeo_url() {
					$options = get_option('social_options');
					echo "<input id='vimeo_url' name='social_options[vimeo_url]' name='social_options[vimeo_url]' size='40' type='text' value='{$options['vimeo_url']}' />";
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
				add_image_size( 'menu-banner', 1200, 200, true ); //USE FOR ARCHIVE PAGES
				add_image_size( 'mobile-menu-banner', 600, 100, true ); //USE FOR MOBILE ARCHIVE PAGES
				
				// 2x1 ASPECT RATIO
				add_image_size( 'display-card', 1200, 600, true ); //USE FOR DISPLAY WITHIN A LIST OF POSTS
				add_image_size( 'thumbnail-card', 400, 200, true ); //USE FOR DISPLAY OF THUMBNAIL SIZE CARDS
				add_image_size( 'xs-thumbnail-card', 150, 75, true ); //USE FOR DISPLAY OF EXTRA SMALL THUMBNAIL SIZE CARDS
				
				// 16x9 ASPECT RATIO
				add_image_size( '16:9-media', 1200, 675, true ); //USE FOR DISPLAY OF FEATURED IMAGE ALONGSIDE FEATURED VIDEO
				add_image_size( '16:9-media-thumbnail', 400, 225, true ); //USE FOR DISPLAY OF FEATURED IMAGE ALONGSIDE FEATURED VIDEO
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
			   
			  
		  		<div class="col-md-<?php echo $span; ?> col-6 instagram-container">
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
			  <div class="row instarow">
				  <?php foreach ($result->data as $post) { ?>
					  <?php if ($row_i <= $rows) { ?> 
							  	<?php if ($col_i <= $cols) { ?>
									<?php get_instagram_post($post); ?>
									<?php $col_i = ++$col_i; ?>
								<?php } else { ?>
								  </div>
								  <?php $row_i = ++$row_i; ?>
								  <div class="row instarow">
						  
						  			<?php if ($row_i <= $rows) { get_instagram_post($post);} ?>
									<?php $col_i = 2; ?>
								<?php } ?>
					  <?php } ?>
				  <?php } ?>
								  </div>
								  <?php } ?>
		<?php } 
			
	


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
			
			<div class="col-md-3">
				<h1>Ooops,</h1>
				<p>We searched our whole database and couldn't find any <?php echo $post_type; ?> like that, or by that name.  But we did manage to find these guy's in there. <a href="http://www.youtube.com/watch?v=6qsH_LFRr6k">No wonder it's been slow lately...</a></p>
			</div>
			
			<div class="col-md-7">
				<img src="<?php echo get_bloginfo ('template_directory'); ?>/images/no-posts.jpg" />
			</div>
			
		</div>
	<?php }