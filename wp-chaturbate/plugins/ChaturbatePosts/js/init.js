	
	jQuery(function() {
		
		jQuery('.dropnav').click(function(){										
			jQuery(this).next('.gender').fadeToggle('fast');
			jQuery('.gender_nav i').toggleClass('fa-angle-down fa-angle-up');
			return false;
		});	
		
	});

/*********************************************************************************/
/* Isotope                                                                    */
/*********************************************************************************/
		
jQuery(window).load(function() {

	// Isotope
	
		jQuery('.isotope').show();
	
		jQuery('.isotope').isotope({
			itemSelector : '.element'
		});

		var iso_optionSets = jQuery('#options .option-set'),
        iso_optionLinks = iso_optionSets.find('a');

		iso_optionLinks.click(function(){
        var iso_this = jQuery(this);
		
        // don't proceed if already selected
		
        if ( iso_this.hasClass('selected') ) {
          return false;
        }
		
        var iso_optionSet = iso_this.parents('.option-set');
        iso_optionSet.find('.selected').removeClass('selected');
        iso_this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
		
        var options = {},
            key = iso_optionSet.attr('data-option-key'),
            value = iso_this.attr('data-option-value');
			
        // parse 'false' as false boolean
		
        value = value === 'false' ? false : value;
        options[ key ] = value;
		
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
		
          // changes in layout modes need extra logic
		  
          changeLayoutMode( iso_this, options )
		  
        } else {
		
          // otherwise, apply new options
		  
          jQuery('.isotope').isotope( options );
		  
        }
        
        return false;
		
      });

});




	