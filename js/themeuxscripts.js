			
			//DESKTOP MENU BLOGROLL ENGINE
			$(document).ready(function() {
				$('[id^=related-post-menu-item]').hover(function() {
					var postID = $(this).attr('data-id');
					var postSection = $(this).attr('data-section');
					$('#' + postSection + ' .active-related-post-menu-item').removeClass('active-related-post-menu-item');
					$('#' + postSection + ' .active-related-post').removeClass('active-related-post');
					
					$('#' + postSection + ' #related-post-' + postID).addClass('active-related-post');
					$(this).addClass('active-related-post-menu-item');
				})
			});
			
			
			
			//ENABLE SMOOTHSCROLL ON SCROLLSPY OBJECTS
			$("#scrollspy-nav ul li a[href^='#']").on('click', function(e) {
			   e.preventDefault();
			   $('html, body').animate({ scrollTop: $(this.hash).offset().top }, 300);
			
			   // edit: Opera and IE requires the "html" elm. animated
			});
			
			
			//PROGRAM ARCHIVE MORE INFO BUTTONS
			
			
			$('.program-archive-school-footer-button').click(function() {
	
				var contentBox = $(this).attr('data-target-container');
	
				if (!$(this).hasClass('active')){
					
					if ($('.program-archive-school-footer-button').hasClass('active')) {
						$('.program-archive-school-footer-button').removeClass('active');
						$(this).toggleClass('active');
						$('.program-archive-school-footer-content .slidedown').animate({height: 0}, 200, function() {
							$('.program-archive-school-footer-content .slidedown').removeClass('slidedown');
							var containerHeight = $('#' + contentBox + ' .program-archive-footer-dropdown-content-container').height();
							$('#' + contentBox).animate({height: containerHeight}, 200);
							$('#' + contentBox).addClass('slidedown');
						});
					} else {
						$(this).toggleClass('active');
						var containerHeight = $('#' + contentBox + ' .program-archive-footer-dropdown-content-container').height();
						$('#' + contentBox).animate({height: containerHeight}, 200);
						$('#' + contentBox).addClass('slidedown');
					}
				
				
					
					
				} else {
					$('.program-archive-school-footer-content .slidedown').animate({height: 0}, 200);
					$('.program-archive-school-footer-content .slidedown').removeClass('slidedown');
					$(this).toggleClass('active');
				}
			
			});
			
			
			//COMPARE SCHOOLS ENGINE 
			$(document).ready(function() {
			
			var programCompareCounter = 0;

				$('[id^=compare-programs-checkbox]').click(function() {
					var programID = $(this).attr("data-programId");
					var programTitle = $(this).attr("data-programTitle");
					
					if (programCompareCounter < 3) {  //ONLY ALLOW 3 BOXES TO BE CHECKED AT ONCE
					
						//INITIATE BOX BEING CHECKED
						$(this).toggleClass('icon-check-empty icon-check').promise().done(function() {
							if($(this).hasClass('icon-check')) {
								$('#compare-programs-link').each(function(){
									if(programCompareCounter != 0) {
										this.href += '-' + programID;
								  } else {
									  	this.href += programID;
								  } 
								}).promise().done(function(){
									$('#compare-programs-list').append('<li id="compare-programs-list-item-' + programID + '"><i class="icon-plus-sign"></i>' + programTitle + '</li>');
									programCompareCounter++;
								});
								
							} else {
								// CODE TO HANDLE UNCHECKED BOXES
								$('#compare-programs-link').each(function(){
									var firstPass = $(this).attr('href').replace( programID, '');
										secondPass = firstPass.replace( '--', '-');
										thirdPass = secondPass.replace( '=-', '=');
										finalPass = thirdPass.replace( /-+$/, '');
									$(this).attr('href', finalPass).promise().done(function(){
										var programListItemID = 'compare-programs-list-item-' + programID;
										$('#' + programListItemID).remove();
										programCompareCounter--;
									});
								});
								
							}
						}).promise().done(function() {
							if(programCompareCounter > 1) {
								$('.compare-programs-list-container').css('height', '180');
							} else {
								$('.compare-programs-list-container').css('height', '0');
							}
						});
						
					} else { //RUN CHECK ON BOXES AFTER 3 HAVE BEEN SELECTED - SHOULD BE IDENTICAL TO CODE ABOVE
						if($(this).hasClass('icon-check')) {
							//CODE TO HANDLE UNCHECKED BOXES
							$(this).toggleClass('icon-check-empty icon-check').promise().done(function() {
								$('#compare-programs-link').each(function(){
									var firstPass = $(this).attr('href').replace( programID, '');
										secondPass = firstPass.replace( '--', '-');
										thirdPass = secondPass.replace( '=-', '=');
										finalPass = thirdPass.replace( /-+$/, '');
									$(this).attr('href', finalPass).promise().done(function(){
										var programListItemID = 'compare-programs-list-item-' + programID;
										$('#' + programListItemID).remove();
										programCompareCounter--;
									});
								});
							});
						}
					}
							
				});
			});
			
		

			//BANNER GALLERY FOR ROYAL SLIDER
			jQuery(document).ready(function($) {		   
				$('#homepage-banner-gallery').royalSlider({
					autoScaleSliderWidth: 1350,     
					autoScaleSliderHeight: 450,
					imageScaleMode: 'fill',
					
					controlNavigation: 'bullets',
					arrowsNav: true,
					arrowsNavAutoHide: false,
					
					slidesSpacing: 0,
					
					imgWidth: 1350,
					imgHeight: 450,
					
					loopRewind: true,
					autoPlay: {
			    		enabled: true,
			    		delay: 4000,
			    		pauseOnHover: true,
			    	},
			    	
			    	video: {
				    	vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
				    	autoHidArrows: false,
				    	autoHideControlNav: false,
			    	},
				})
			});

			//BANNER GALLERY FOR ROYAL SLIDER
			jQuery(document).ready(function($) {		   
				$('#banner-gallery').royalSlider({
					autoScaleSliderWidth: 1350,     
					autoScaleSliderHeight: 450,
					
					controlNavigation: 'bullets',
					arrowsNav: true,
					arrowsNavAutoHide: false,
					
					slidesSpacing: 0,
					
					imgWidth: 1350,
					imgHeight: 450,
				})   
			});
		   
		   //VIDEO GALLERY FOR SCHOOL PAGES
		   jQuery(document).ready(function($) {
			  $('#video-gallery').royalSlider({
			    arrowsNav: false,
			    fadeinLoadedSlide: true,
			    transitionSpeed: 200,
			    controlNavigationSpacing: 0,
			    controlNavigation: 'thumbnails',
			
			    thumbs: {
			      autoCenter: false,
			      fitInViewport: true,
			      orientation: 'vertical',
			      spacing: 0,
			      paddingBottom: 0
			    },
			    keyboardNavEnabled: true,
			    imageScaleMode: 'fill',
			    imageAlignCenter:true,
			    slidesSpacing: 0,
			    loop: false,
			    loopRewind: true,
			    numImagesToPreload: 3,
			    video: {
			      autoHideArrows:true,
			      autoHideControlNav:false,
			      autoHideBlocks: true,
			      vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="700" height="393" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
			    }, 
			    autoScaleSlider: true, 
			    autoScaleSliderWidth: 960,     
			    autoScaleSliderHeight: 380,
			
			    /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
			    imgWidth: 640,
			    imgHeight: 360
			    
			    
			    
			
			  });
			});

			//VIDEO FUNCTION 1
			jQuery(document).ready(function($) {		   
				$('#video1').royalSlider({
					autoScaleSlider: true,
					autoScaleSliderWidth: 1280,
					autoScaleSliderHeight: 720,
					autoScaleMode: 'fit-if-smaller',
					imageAlignCenter: true,
					
					sliderDrag: false,
					navigateByClick: false,
					
					video: {
				      autoHideArrows:true,
				      autoHideControlNav:false,
				      autoHideBlocks: true,
				      vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="700" height="393" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
				    }, 
					
					controlNavigation: 'none',
					arrowsNav: true,
					arrowsNavAutoHide: false,
					
					slidesSpacing: 0,
				})   
			});
			
			
			//VIDEO FUNCTION 1
			jQuery(document).ready(function($) {		   
				$('#video2').royalSlider({
					autoScaleSlider: true,
					autoScaleSliderWidth: 1280,
					autoScaleSliderHeight: 720,
					autoScaleMode: 'fit-if-smaller',
					imageAlignCenter: true,
					
					sliderDrag: false,
					navigateByClick: false,
					
					video: {
				      autoHideArrows:true,
				      autoHideControlNav:false,
				      autoHideBlocks: true,
				      vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="700" height="393" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
				    }, 
					
					controlNavigation: 'none',
					arrowsNav: true,
					arrowsNavAutoHide: false,
					
					slidesSpacing: 0,
				})   
			});
			
			
			//VIDEO FUNCTION 1
			jQuery(document).ready(function($) {		   
				$('#video3').royalSlider({
					autoScaleSlider: true,
					autoScaleSliderWidth: 1280,
					autoScaleSliderHeight: 720,
					autoScaleMode: 'fit-if-smaller',
					imageAlignCenter: true,
					
					sliderDrag: false,
					navigateByClick: false,
					
					video: {
				      autoHideArrows:true,
				      autoHideControlNav:false,
				      autoHideBlocks: true,
				      vimeoCode: '<iframe src="http://player.vimeo.com/video/%id%?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="700" height="393" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
				    }, 
					
					controlNavigation: 'none',
					arrowsNav: true,
					arrowsNavAutoHide: false,
					
					slidesSpacing: 0,
				})   
			});


		
		//REVEAL MAP BUTTON FOR PROGRAMS
		$(document).ready(function() {
		    $(".map-reveal-button").click(function () {
		      $("#map_canvas").toggleClass("show-map");
		      $(".map-reveal-button-container").toggleClass("mobile-map-active");
		      $("body").toggleClass("lock-body");
			  
			  
			  	if ($("body").hasClass('touch')) {
			  		if($('#map_canvas').hasClass('show-map')) {
				  		document.ontouchmove = function(e){ e.preventDefault(); }
				  	} else {
					  	document.ontouchmove = function(e){ return true; }
				  	}
			  	}
			  
			  
				if($('#map_canvas').hasClass('show-map')) {
				  $(".hide-map-text").css("display", "block");
				  $(".show-map-text").css("display", "none");
				} else {
				  $(".hide-map-text").css("display", "none");
				  $(".show-map-text").css("display", "block");
				}
			  
		    });
		});
		

		
		//ACTIVATE SEARCH FORM ON HEADER
		$(document).ready(function() {
		    $("#header-search-form").click(function () {
				if (!$("#header-search-form").hasClass("search-active")) {
					$("#header-search-form").toggleClass("search-active");
					$("#header-search").focus();
				}
			});
			
			$("#header-search").focusout(function() {
				var searchString = $("#header-search").val();

				if (jQuery.trim(searchString).length > 0) {
				} else {
					$("#header-search-form").toggleClass("search-active");
				}
			});
			
		});
		
			
			
		//REVEAL PHASE DESCRIPTIONS ON PROJECT PAGE
			function expandPhaseDesc(id) {
				var iconid = id.id+'Icon';
				var icon = document.getElementById(iconid);

				$(id).toggleClass("show-phase-description");
				$(icon).toggleClass('icon-plus, icon-minus' );
			}
