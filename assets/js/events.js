$(document).ready(function() {				   

        
	jQuery(function(){
					
		/* makes my fancy menus */		
		jQuery('ul.sf-menu').superfish();
	});
	
	
		/* My slide code */
		$('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
		
		/* Makes tables id'd businessTable sortable */
		$("#businessTable").tablesorter()
		.tablesorterPager({container: $("#pager")});
		 
		/* Sends external links to new window, no need for target="_blank" */
		/*$('a[href^=http]').click( function() {
		window.open(this.href);
		return false;
	});*/

}); 

