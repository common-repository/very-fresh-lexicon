(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );


    checkValue = function(elementID) {
      var val = document.getElementById(elementID).value;
      if(elementID == 'url' && val != '') {
        return 'category="' + val + '" ';
      } else {
        return '';
      }
    }

    flGenerate = function(){
      var shortCode = '[flex ';
      var container = document.getElementById('output-shortcode');
      var wrap = document.getElementById('wrap-output');

      shortCode += checkValue('url');
      shortCode = shortCode.substring(0, shortCode.length - 1);
      shortCode += ']';
      container.innerHTML = shortCode;
      wrap.classList.add("visible");
    }