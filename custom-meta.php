<?php

$prefix = '';

global $meta_boxes;

$meta_boxes = array();






//GALLERY FUNCTION TO DISPLAY ADDITIONAL IMAGE INPUT BOX

$meta_boxes[] = array(
	'title'  => 'Slider Options',
	'pages' => array( 'target_nations', 'program'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'name'             => 'Additional Images to Include',
			'id'               => "{$prefix}slide_imgs",
			'desc'				=> 'If desired, add more images in addition to the featured image.  Never set these images before a featured image has been set.',
			'type'             => 'image_advanced',
			'max_file_uploads' => 20,
		),
		
		//PHOTO CREDITS
		array(
			'name'  => 'Image Credits',
			'id'    => "{$prefix}image_credits",
			'desc'  => 'Insert, preferably in order, the names of those who have contributed photos to this site',
			'type'  => 'text',
			'std'   => '',
			'clone' => true,
		),

	),

);









//HOME PAGE CUSTOM FIELDS

$meta_boxes[] = array(
	'title'  => 'Slider Options',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		// SLIDER TEXT POSITION
		array(
			'name'    => 'Post Text Location',
			'id'      => "{$prefix}post_text_location",
			'desc'	  => 'Select where text for featured posts should be displayed.',
			'type'    => 'select',
			'options' => array(
				'topleft' => 'Top Left',
				'midleft' => 'Mid Left',
				'lowleft' => 'Lower Left',
				'topright' => 'Top Right',
				'midright' => 'Mid Right',
				'lowright' => 'Lower Right',
			),
		),
		
		// OVERRIDE FEATURED POST ID
		array(
			'name'  => 'Override Featured Post ID',
			'id'    => "{$prefix}override_post_id",
			'desc'  => 'If you would like to override the normal flow of posts (The last post to be published is automatically set as the featured post), the insert the ID number of the post you wish to display instead, otherwise leave blank for the default flow of posts to occur.',
			'type'  => 'text',
			'std'   => '',
			'cloneable' => false,
		),
		
		// FEATURED PROGRAM
		array(
			'name'    => 'Featured Program',
			'id'      => "{$prefix}feat_program",
			'desc'		=> 'Select the program to be featured',
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'program_taxo',
				'type' => 'select_tree',
				'args' => array()
			),
		),
		
		//FEATURED PROGRAM TEXT LOCATION
		array(
			'name'    => 'Program Text Location',
			'id'      => "{$prefix}program_text_location",
			'desc'	  => 'Select where text for featured programs should be displayed.',
			'type'    => 'select',
			'options' => array(
				'topleft' => 'Top Left',
				'midleft' => 'Mid Left',
				'lowleft' => 'Lower Left',
				'topright' => 'Top Right',
				'midright' => 'Mid Right',
				'lowright' => 'Lower Right',
			),
		),
		
		
		
		// FEATURED VIDEO
		array(
			'name'  => 'Featured Video Post ID',
			'id'    => "{$prefix}feat_video",
			'desc'  => 'Insert the post ID of the video to be featured.',
			'type'  => 'text',
			'std'   => '',
			'cloneable' => false,
		),


	),
	
	'only_on'    => array(
		'id'       => array(),
		//'slug'  => array( 'slug' ),
		'template' => array( 'front-page.php' ),
		'parent'   => array()
	),
	
);


$meta_boxes[] = array(
	'title'  => 'Slider Alert Override',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		// ALERT SLIDER ACTIVATION
		array(
			'name' => 'Slider Alert Override Activation',
			'id'   => "{$prefix}alert_slider_activation",
			'desc' => 'Select this box to activate the slider override, which will populate the first slide with whatever this section is filled out with, this is great for important announcements, emergencies, and alerts that need to take precedence over other types of communication.  By default this slide will take the place of the featured post slide.',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 1,
		),
	
		// SLIDER TEXT POSITION
		array(
			'name'    => 'Post Text Location',
			'id'      => "{$prefix}alert_text_location",
			'desc'	  => 'Select where test for featured posts should be displayed.',
			'type'    => 'select',
			'options' => array(
				'topleft' => 'Top Left',
				'midleft' => 'Mid Left',
				'lowleft' => 'Lower Left',
				'topright' => 'Top Right',
				'midright' => 'Mid Right',
				'lowright' => 'Lower Right',
			),
		),
		
		
		array(
			'name'  => 'Title',
			'id'    => "{$prefix}alert_title",
			'desc'  => 'Enter the title of the alert here.',
			'type'  => 'text',
			'std'   => '',
			'cloneable' => false,
		),

		array(
			'name'  => 'Alert Message',
			'id'    => "{$prefix}alert_message",
			'desc'  => 'Enter the message of the alert.',
			'type'  => 'textarea',
			'std'   => '',
		),

		// BACKGROUND IMAGE FOR SLIDE
		array(
			'name'             => 'Background Image',
			'id'               => "{$prefix}alert_bg",
			'type'             => 'plupload_image',
			'max_file_uploads' => 1,
		),
		

	),
	
	'only_on'    => array(
		'id'       => array(),
		//'slug'  => array( 'slug' ),
		'template' => array( 'front-page.php' ),
		'parent'   => array()
	),
	
);








//POST CUSTOM FIELDS

$meta_boxes[] = array(
	'title'  => 'Post Information',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'name'  => 'Sub Title',
			'id'    => "{$prefix}sub_title",
			'desc'  => 'If the post has a subtitle, enter it here, subtitles are great for giving a further glimpse into the post without the reader having to read the article.',
			'type'  => 'text',
			'std'   => '',
			'cloneable' => false,
		),

		//PULL QUOTE
		array(
			'name'  => 'Pull Quote',
			'id'    => "{$prefix}pull_quote",
			'desc'  => 'Enter the Pull Quote of the article. A Pull Quote is one phrase that the author would like to be highlighted out of the entire work.  This quote will be pulled to the side of post and highlighted in a larger font in the left column of the page.',
			'type'  => 'textarea',
			'std'   => '',
		),
		
		//PHOTO CREDITS
		array(
			'name'  => 'Image Credits',
			'id'    => "{$prefix}image_credits",
			'desc'  => 'Insert, preferably in order, the names of those who have contributed photos to this site',
			'type'  => 'text',
			'std'   => '',
			'clone' => true,
		),

	),
	
);



$meta_boxes[] = array(
	'title'  => 'Geological Reference',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'id'            => 'address',
			'name'          => 'Location Title',
			'type'          => 'text',
			'std'           => 'Lakeside, United States',
		),
		array(
			'id'            => 'longlat',
			'name'          => 'Location',
			'type'          => 'map',
			'std'           => '-6.233406,-35.049906,15',     // 'latitude,longitude[,zoom]' (zoom is optional)
			'style'         => 'width: 500px; height: 500px',
			'address_field' => 'address',                     // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
		),
	),
);





//VIDEO CUSTOM POST TYPE CUSTOM FIELDS

$meta_boxes[] = array(
	'title'  => 'Video Information',
	'pages' => array( 'videos' ),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(

		array(
			'name'  => 'Vimeo Video ID Number',
			'id'    => "{$prefix}video_id",
			'desc'  => 'Enter the ID number of the Vimeo video you would like to be displayed.  Typically this number can be found in the URL of the video, while on the Vimeo site.  The video will not function if the full URL is used.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		// SELECT - CREATIVE DEPARTMENT, STAFF PRODUCTION, STUDENT PRODUCTION
		array(
			'name'  => 'Production Source',
			'id'    => "{$prefix}production_source",
			'desc'  => 'Select the source of production for the video, for example if the video was created by a student, select the student option.  If created by staff, select staff, and if the video was created from within the creative department, select the creative department option.  In most cases, video production sources will be directly out of the creative department.',
			'type'  => 'select',
				'options'  => array(
				'creative' => 'Creative Department',
				'staff' => 'Staff Production',
				'student' => 'Student Production',
				),
		),

	),
	
);


//ABOUT PAGE CUSTOM META FIELDS




//PROGRAM (SCHOOLS) CUSTOM POST TYPE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Program Information',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		array(
			'name'  => 'Program Acronym',
			'id'    => "{$prefix}acronym",
			'desc'  => 'Insert the program acronym.  For example Discipleship Training School would be DTS.  However, not all schools have an acronym that is directly derived from the first letter in each of the words of the school name, so make sure you have the acronym given by the school leader.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),	
				
		//FILE ATTACHEMENTS
		array(
			'name' => 'File Upload',
			'id'   => "{$prefix}file",
			'type' => 'file_advanced',
		),
		
		//PREREQUISITES
		array(
			'name'  => __('Prerequisites', 'rwmb'),
			'id'    => "{$prefix}prerequisites",
			'desc'  => 'Please enter the prerequisites needed to apply for this school here.',
			'type'  => 'textarea',
			'std'   => '',
			'clone' => false,
		),
		
		//ACCREDITATION
		array(
			'name'  => 'Accreditiation',
			'id'    => "{$prefix}accreditation",
			'desc'  => 'Please insert the accreditation info here.  If you are unsure what exactly to put, please email the registrar. DO NOT GUESS HERE.',
			'type'  => 'textarea',
			'std'   => '',
			'clone' => false,
		),
	),
	
);





//PROGRAM (SCHOOLS) CUSTOM POST TYPE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Social Media Options',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		array(
			'name'  => 'Instagram Hashtag Override',
			'id'    => "{$prefix}insta_tag",
			'desc'  => 'If you would like to directly control what hashtag is used to generate your feed, you can type the tag in here.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),	
				
	),
	
);




$meta_boxes[] = array(
	'title'  => 'Program Dates/Cost',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
	
	
		array(
			'name'  => 'Season of School',
			'id'    => "{$prefix}season1",
			'desc'  => 'Insert the season of the school, such as Summer 2014.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
	
		array(
				'name' => 'Program Start Date',
				'id'   => $prefix . 'start_date1',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
			
		
			
		array(
				'name' => 'Program End Date',
				'id'   => $prefix . 'end_date1',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),	
			
		array(
			'name'  => 'Total Cost',
			'id'    => "{$prefix}total_cost1",
			'desc'  => 'Insert the program cost.  It will automatically be formatted when brought into the front end of the site, so there is no need to add commas or dollar signs.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name' => 'Leader ID(s)',
			'id'   => "{$prefix}leader_id1",
			'desc' => 'Enter the ID of each of the school leader, make sure to clone the text field each time you enter a new ID.',
			'type' => 'text',
			'std'  => '',
			'clone' => true,
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		
		
		// PROGRAM INSTANCE TWO
		array(
			'name'  => 'Season of School',
			'id'    => "{$prefix}season2",
			'desc'  => 'Insert the season of the school, such as Summer 2014.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
				'name' => 'Program Start Date',
				'id'   => $prefix . 'start_date2',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
			
		
			
		array(
				'name' => 'Program End Date',
				'id'   => $prefix . 'end_date2',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),	
			
		array(
			'name'  => 'Total Cost',
			'id'    => "{$prefix}total_cost2",
			'desc'  => 'Insert the program cost.  It will automatically be formatted when brought into the front end of the site, so there is no need to add commas or dollar signs.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name' => 'Leader ID(s)',
			'id'   => "{$prefix}leader_id2",
			'desc' => 'Enter the ID of each of the school leader, make sure to clone the text field each time you enter a new ID.',
			'type' => 'text',
			'std'  => '',
			'clone' => true,
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		
		
		// PROGRAM INSTANCE 3
		
		array(
			'name'  => 'Season of School',
			'id'    => "{$prefix}season3",
			'desc'  => 'Insert the season of the school, such as Summer 2014.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
				'name' => 'Program Start Date',
				'id'   => $prefix . 'start_date3',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
			
		
			
		array(
				'name' => 'Program End Date',
				'id'   => $prefix . 'end_date3',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),	
			
		array(
			'name'  => 'Total Cost',
			'id'    => "{$prefix}total_cost3",
			'desc'  => 'Insert the program cost.  It will automatically be formatted when brought into the front end of the site, so there is no need to add commas or dollar signs.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Total Cost',
			'id'    => "{$prefix}total_cost3",
			'desc'  => 'Insert the program cost.  It will automatically be formatted when brought into the front end of the site, so there is no need to add commas or dollar signs.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name' => 'Leader ID(s)',
			'id'   => "{$prefix}leader_id3",
			'desc' => 'Enter the ID of each of the school leader, make sure to clone the text field each time you enter a new ID.',
			'type' => 'text',
			'std'  => '',
			'clone' => true,
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
	),

);



// LECTURE PHASE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Lecture Phase',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'name' => 'Lecture Phase Title',
			'id'   => "{$prefix}lecture_phase_title",
			'desc' => 'If Lecture Phase is not an appropriate title, then use this field to change the title of this section',
			'type' => 'text',
			'std'  => 'Lecture Phase',
		),
		
		array(
			'name' => 'Lecture Phase Description',
			'id'   => "{$prefix}lecture_phase_desc",
			'desc' => 'Describe lecture phase as a whole in this section.',
			'type' => 'textarea',
			'std'  => '',
		),
		
		array(
			'name' => 'Lecture Phase Block Number',
			'id'   => "{$prefix}lecture_block_num",
			'desc' => 'If you would like WordPress to auto populate the "lecture" activity block with the lecture topics listed below, then insert the "Block Number" that has been used for the "lecture" activity',
			'type' => 'number',
			'std'  => '0',
		),
		
		array(
			'name' => 'Lecture Topics',
			'id'   => "{$prefix}lecture_topics",
			'desc' => 'Insert the lecture topics you would like to be displayed on the site.',
			'type' => 'text',
			'std'  => '',
			'clone' => true,
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 1</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title1",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week1",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description1",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 2</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title2",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week2",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description2",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 3</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title3",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week3",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description3",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 4</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title4",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week4",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description4",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 5</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title5",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week5",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description5",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 6</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title6",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week6",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description6",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 7</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title7",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week7",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description7",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 8</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title8",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week8",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description8",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 9</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title9",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week9",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description9",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Lecture Phase Info Block 10</h4>',
			'name' => 'Activity Title',
			'id'   => "{$prefix}activity_title10",
			'desc' => 'Enter the title of the activity',
			'type' => 'text',
			'std'  => '',
		),
		
		array(
			'name' => 'Hours Per Week',
			'id'   => "{$prefix}hours_per_week10",
			'desc' => 'Enter how many hours per week this activity uses.',
			'type' => 'number',
			'std'  => '',
		),
		
		array(
			'name' => 'Description',
			'id'   => "{$prefix}activity_description10",
			'desc' => 'Enter a description for the activity, the description should briefly explain the heart behind the activity, and explain what the activity is, and how it serves the purpose of the school or program',
			'type' => 'wysiwyg',
			'std'  => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),

		
	
	),
);

// LECTURE PHASE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Outreach Phase',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Description',
			'id'   => "{$prefix}outreach_phase_desc",
			'desc' => 'Enter a description for the outreach phase of the school',
			'type' => 'textarea',
			'std'  => '',
		),
	)
);



$meta_boxes[] = array(
	'title'  => 'Display Controls',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'name' => 'Current Status',
			'id'   => "{$prefix}running",
			'desc' => 'Check this box if this school should be advertised as available and running.',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 1,
		),
		
		array(
			'name' => 'Include Outreach Map',
			'id'   => "{$prefix}display_map",
			'desc' => 'Check this box if you would like the outreach map to be display on the page',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		array(
			'name' => 'Online Application',
			'id'   => "{$prefix}app_link",
			'desc' => 'Check this box if this program can be applied for online',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 1,
		),
	
	),
);

$meta_boxes[] = array(
	'title'  => 'Featured Section Information',
	'pages' => array( 'program', 'projects' ),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
	
		array(
			'name'  => 'Featured Video Post ID',
			'id'    => "{$prefix}featured_video",
			'desc'  => 'Insert the post ID of the featured video here. This provides the featured video box, with the information needed for it to be populated, and also keeps the featured video out of the related video stack',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Featured Video Vimeo ID',
			'id'    => "{$prefix}featured_video_vimeo",
			'desc'  => 'Insert the ID from vimeo. Typically this can be found in the url, it should be a string of numbers.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),

	
	),
);





//PAGE MAIN DISPLAY CONTROLS
$meta_boxes[] = array(
	'title'  => 'Display Controls',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
			'name'  => 'Menu Priority',
			'id'    => "{$prefix}menu_priority",
			'desc'  => 'Use integers such as 3, 4, and 5 to determine the menu location.  The Top of the primary menu column is determined by the lowest number, so number 1 will be at the top.  At the time of site launch, all menu items were given integers in multiples of 10 to allow for adjustment in the future.  For example, the top level menu item has been given a value of 10, and the following items were given, 20, 30, 40 etc.  This should allow for menu items to be inserted manually without having to change more than one value.',
			'type'  => 'text',
			'std'   => '1000',
			'clone' => false,
		),
	
	),
);





//PROJECT CUSTOM META FIELDS
$meta_boxes[] = array(
	'title'  => 'Project Information',
	'pages' => array( 'projects' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Project Phase 1</h4>',
			'name'  => 'Phase Title',
			'id'    => "{$prefix}phase1_title",
			'desc'  => 'Enter the title of the phase.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Total Breakdown',
			'id'    => "{$prefix}phase1_total_comp",
			'desc'  => 'Enter the total percentage of the project this phase takes up.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Actual Breakdown',
			'id'    => "{$prefix}phase1_actual_comp",
			'desc'  => 'Enter the percentage of this phases completion based on the total percentage.  For example, if this phase was only 30% of the total project, the maximum percentage for this phase would be 30.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Color',
			'id'    => "{$prefix}phase1_color",
			'desc'  => 'Enter the color of the phase.  If unsure, leave default value',
			'type'  => 'text',
			'std'   => 'D2972A',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Description',
			'id'    => "{$prefix}phase1_desc",
			'desc'  => 'Enter the phase description.',
			'type'  => 'textarea',
			'std'   => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),
		
		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Project Phase 2</h4>',
			'name'  => 'Phase Title',
			'id'    => "{$prefix}phase2_title",
			'desc'  => 'Enter the title of the phase.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Total Breakdown',
			'id'    => "{$prefix}phase2_total_comp",
			'desc'  => 'Enter the total percentage of the project this phase takes up.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Actual Breakdown',
			'id'    => "{$prefix}phase2_actual_comp",
			'desc'  => 'Enter the percentage of this phases completion based on the total percentage.  For example, if this phase was only 30% of the total project, the maximum percentage for this phase would be 30.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Color',
			'id'    => "{$prefix}phase2_color",
			'desc'  => 'Enter the color of the phase.  If unsure, leave default value',
			'type'  => 'text',
			'std'   => '339C47',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Description',
			'id'    => "{$prefix}phase2_desc",
			'desc'  => 'Enter the phase description.',
			'type'  => 'textarea',
			'std'   => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),


		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Project Phase 3</h4>',
			'name'  => 'Phase Title',
			'id'    => "{$prefix}phase3_title",
			'desc'  => 'Enter the title of the phase.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Total Breakdown',
			'id'    => "{$prefix}phase3_total_comp",
			'desc'  => 'Enter the total percentage of the project this phase takes up.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Actual Breakdown',
			'id'    => "{$prefix}phase3_actual_comp",
			'desc'  => 'Enter the percentage of this phases completion based on the total percentage.  For example, if this phase was only 30% of the total project, the maximum percentage for this phase would be 30.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Color',
			'id'    => "{$prefix}phase3_color",
			'desc'  => 'Enter the color of the phase.  If unsure, leave default value',
			'type'  => 'text',
			'std'   => 'BF202E',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Description',
			'id'    => "{$prefix}phase3_desc",
			'desc'  => 'Enter the phase description.',
			'type'  => 'textarea',
			'std'   => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),


		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Project Phase 4</h4>',
			'name'  => 'Phase Title',
			'id'    => "{$prefix}phase4_title",
			'desc'  => 'Enter the title of the phase.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Total Breakdown',
			'id'    => "{$prefix}phase4_total_comp",
			'desc'  => 'Enter the total percentage of the project this phase takes up.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Actual Breakdown',
			'id'    => "{$prefix}phase4_actual_comp",
			'desc'  => 'Enter the percentage of this phases completion based on the total percentage.  For example, if this phase was only 30% of the total project, the maximum percentage for this phase would be 30.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Color',
			'id'    => "{$prefix}phase4_color",
			'desc'  => 'Enter the color of the phase.  If unsure, leave default value',
			'type'  => 'text',
			'std'   => '099486',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Description',
			'id'    => "{$prefix}phase4_desc",
			'desc'  => 'Enter the phase description.',
			'type'  => 'textarea',
			'std'   => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),


		array(
			'before' => '<h4 style="font-size: 16px; color: #666; text-shadow: 1px 1px 1px #FFF;">Project Phase 5</h4>',
			'name'  => 'Phase Title',
			'id'    => "{$prefix}phase5_title",
			'desc'  => 'Enter the title of the phase.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Total Breakdown',
			'id'    => "{$prefix}phase5_total_comp",
			'desc'  => 'Enter the total percentage of the project this phase takes up.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Actual Breakdown',
			'id'    => "{$prefix}phase5_actual_comp",
			'desc'  => 'Enter the percentage of this phases completion based on the total percentage.  For example, if this phase was only 30% of the total project, the maximum percentage for this phase would be 30.',
			'type'  => 'text',
			'std'   => '0',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Color',
			'id'    => "{$prefix}phase5_color",
			'desc'  => 'Enter the color of the phase.  If unsure, leave default value',
			'type'  => 'text',
			'std'   => 'F36D24',
			'clone' => false,
		),
		
		array(
			'name'  => 'Phase Description',
			'id'    => "{$prefix}phase5_desc",
			'desc'  => 'Enter the phase description.',
			'type'  => 'textarea',
			'std'   => '',
			'after'=> '				<hr style="margin: 30px -12px;
									border-top: 1px solid #CCC;
									border-bottom: 1px solid #FFF;
									background-color: transparent;">',
		),


	
	),
);







//TEACHING CUSTOM POST TYPE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Media Files',
	'pages' => array( 'teachings' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
				'name' => 'Media File Upload',
				'id'   => "{$prefix}media_files",
				'type' => 'file',
		),
		
		array(
				'name' => 'Teaching Date',
				'id'   => $prefix . 'teaching_date',
				'type' => 'date',

				// jQuery date picker options. See here http://jqueryui.com/demos/datepicker
				'js_options' => array(
					'appendText'      => '(Month Day, Year)',
					'autoSize'        => true,
					'buttonText'      => 'Select Date',
					'dateFormat'      => 'yymmdd',
					'numberOfMonths'  => 2,
					'showButtonPanel' => true,
				),
			),
		
	),
);






//STORY CUSTOM POST TYPE CUSTOM FIELDS
$meta_boxes[] = array(
	'title'  => 'Story Information',
	'pages' => array( 'stories' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

		array(
			'name' => 'Anonymous',
			'id'   => "{$prefix}testimony_anonymous",
			'desc' => 'Check this box if you wish to remain anonymous.',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		array(
			'name'  => 'Full Name',
			'id'    => "{$prefix}testimony_f_name",
			'desc'  => 'Enter your full name',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		
		array(
			'name'  => 'Email',
			'id'    => "{$prefix}testimony_email",
			'desc'  => 'Enter your email',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
	),
);


/**
 * Register meta boxes
 *
 * @return void
 */
function rw_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $meta_boxes as $meta_box ) {
			if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ) {
				continue;
			}

			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'rw_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions ) {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
			break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
			break;
			case 'slug':
				$post_slug = $post->post_name;
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
			break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) ) {
					return true;
				}
			break;
		}
	}

	// If no condition matched
	return false;
}