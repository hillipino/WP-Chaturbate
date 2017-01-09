jQuery.fn.exists = function() { return (jQuery(this).length > 0); }
	
/*********************************************************************************/
/* Initialize                                                                    */
/*********************************************************************************/


	// jQuery
		jQuery(function() {
		
			var _body = jQuery('body'), _window = jQuery(window), _isTouch = !!('ontouchstart' in window);
		
			var $window = jQuery(window),
				_IEVersion = (navigator.userAgent.match(/MSIE ([0-9]+)\./) ? parseInt(RegExp.$1) : 99);
			

				
		// Hides iframes behind modals
				
			jQuery("iframe").each(function(){
				  var ifr_source = jQuery(this).attr('src');
				  var wmode = "wmode=transparent";
				  if(ifr_source.indexOf('?') != -1) jQuery(this).attr('src',ifr_source+'&'+wmode);
				  else $(this).attr('src',ifr_source+'?'+wmode);
			});	

		// Strip ul from comments
		
			jQuery('#comments ul').children().unwrap();
			
		// Offsite
			jQuery('a.offsite').attr('target', '_blank');
		
		// Gender Dropdown		
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
	
	
    
		  var container = jQuery('.isotope');
		  
			jQuery('.gender li a').click(function(){
			  var selector = jQuery(this).attr('data-filter');
			  container.isotope({ filter: selector });
			  return false;
			});		  
		  
		  container.isotope({
			itemSelector : '.element',
			getSortData : {
			  symbol : function( $elem ) {
				return $elem.attr('data-symbol');
			  },
			  category : function( $elem ) {
				return $elem.attr('data-category');
			  },		  
			  age : function( $elem ) {
				return parseInt( $elem.find('.age').text(), 10 );
			  },
			  viewers : function( $elem ) {
				return parseInt( $elem.find('.viewers').text(), 10 );
			  },			  
			  online : function( $elem ) {
				return parseInt( $elem.find('.online').text(), 10 );
			  },
			  name : function ( $elem ) {
				return $elem.find('.name').text();
			  },
			  
			}
		  });
		  		  
		  var $optionSets = jQuery('#options .option-set'),
			  $optionLinks = $optionSets.find('a');

		  $optionLinks.click(function(){
			var $this = jQuery(this);
			// don't proceed if already selected
			if ( $this.hasClass('selected') ) {
			  return false;
			}
			var $optionSet = $this.parents('.option-set');
			$optionSet.find('.selected').removeClass('selected');
			$this.addClass('selected');
	  
			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[ key ] = value;
			if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
			  // changes in layout modes need extra logic
			  changeLayoutMode( $this, options )
			} else {
			  // otherwise, apply new options
			  container.isotope( options );
			}
			
			return false;
		  });		  
    
	});		




