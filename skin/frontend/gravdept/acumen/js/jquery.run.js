/**
 * Acumen for Magento
 * http://gravitydept.com/to/acumen-magento
 *
 * @author     Brendan Falkowski
 * @package    gravdept_acumen
 * @copyright  Copyright 2012 Gravity Department http://gravitydept.com
 * @license    All rights reserved.
 * @version    1.3.4
 */


// avoid PrototypeJS conflicts, assign jQuery to $jQ instead of $
var $jQ = jQuery.noConflict();

// Create 'gravdept' namespace
var gravdept = {};

/*
Use $jQ(document).ready() because Magento executes Prototype inline 
and breaks if jQuery executes beforehand. Use function($) to maintain 
normal jQuery syntax inside
*/
$jQ(document).ready(function($){

    // ------------------------------------
    // Progressive enhancement hook
    // ------------------------------------
	
    	$('html')
    		.removeClass('no-js')
    		.addClass('js');
	
    
    // ------------------------------------
    // Navigation menu hooks
    // ------------------------------------
    
        // get nav categories
        gravdept['primary-nav'] = $('#nav').find('li.level0');
        
        // for each top-level category
        gravdept['primary-nav'].each(function(){
            var self = $(this);
            var children = self.find('li.level1');
            var menu = self.find('.menu');
            
            // specify number of columns
            if ( children.length > 0 ) {
                menu.addClass( 'cols-'+children.length );
            }
            
            // specify if columns should collapse
            if ( children.length >= 8 ) {
                menu.addClass('cols-collapse');
            }
        });
    
        
    // ------------------------------------
    // ColorBox		
    // ------------------------------------
		
    	if ( $().colorbox ) {
    	
    	    gravdept['zoom'] = $('a.zoom');
    	    
    	    if ( gravdept['zoom'].length ) {
        		gravdept['zoom'].colorbox({
        		    initialHeight: '200px',
        		    initialWidth: '200px',
        		    opacity: 0.75,
        			speed: 350
        		});
        	}
    		
    	}


    // ------------------------------------
    // Slides JS
    // ------------------------------------

    	if ( $().slides ) {
    	    
    	    // Grid Slider
    	    
    	    gravdept['gridSlider'] = $('.grid-slider');
    	    
    	    if ( gravdept['gridSlider'].length ) {
        		gravdept['gridSlider'].slides({
        			container: 'slides-container',
        			paginationClass: 'slides-pagination',
        			play: 4000,
        			slideSpeed: 400
        		});
        	}
    		
    	    // Product Slider (Catalog & New Products)
    		
    		gravdept['productSlider'] = $('.product-slider');
    		
    		if ( gravdept['productSlider'].length ) {
        		gravdept['productSlider'].slides({
        			autoHeight: true,
        			container: 'slides-container',
        			generatePagination: false,
        			slideSpeed: 400
        		});
        	}
    		
    	    // Promo Slider
    		
    		gravdept['promoSlider'] = $('.promo-slider');
    		
    		if ( gravdept['promoSlider'].length ) {
        		gravdept['promoSlider'].slides({
        			container: 'slides-container',
        			paginationClass: 'slides-pagination',
        			play: 4000,
        			pause: 4000,
        			slideSpeed: 400
        		});
        	}
    		
    	    // Thumb Slider
    		
    		gravdept['thumbSlider'] = $('.thumb-slider');
    		
    		if ( gravdept['thumbSlider'].length ) {
        		gravdept['thumbSlider'].slides({
        			container: 'slides-container',
        			generatePagination: false,
        			paginationClass: 'slides-pagination',
        			play: 4000,
        			pause: 4000,
        			slideSpeed: 400
        		});
        	}
    	
    	} // END if()
	
	
	// ------------------------------------
	// Tabs
	// ------------------------------------
	
    	gravdept['tabs'] = $('.tabs');
    	
    	if ( gravdept['tabs'].length ) {
        	$(function () {
        	    var tabsContent = $('.tabs-content').children(),
        	        tabsLinks = $('.tabs-nav').find('a');
        	    
        	    // detect click on nav item
        	    tabsLinks.on('click', function (e) {
        	        
        	        // hide all content, then show content for hash
        	        tabsContent
        	            .hide()
        	            .filter(this.hash).show();
        	        
        	        // remove 'current' class from all links
        	        tabsLinks.removeClass('current');
        	        
        	        // add 'current' class to clicked link
                    $(this).addClass('current');
        	        
        	        e.preventDefault();
        	        
        	    }).filter(':first').click();
        	});
    	}
	

});  // END $jQ(document).ready()
