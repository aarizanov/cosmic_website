jQuery(document).ready( function() {
	var i = 1;
	var sampleMessages = [ "DEDICATED", "REMOTE", "SCALABLE", "TOP-NOTCH" ];
	setInterval(function() {
	  var newText = sampleMessages[i++ % sampleMessages.length];
	  jQuery("#homepage_text_rotate").fadeOut(500, function () {
	    jQuery(this).text(newText).fadeIn(500);
	  });
	}, 5 * 1000);

	
	var locations = [];
	jQuery('.description li:first b').each(function(){
		locations.push(jQuery(this).text());
	});

	jQuery('.wpcf7-radio .wpcf7-list-item-label').each(function(){
		if(jQuery.inArray(jQuery(this).text(), locations) === -1){
			jQuery(this).hide();
		}
	})

	jQuery('.eael-pricing ').each(function(){
		jQuery(this).find('.eael-pricing-tag').remove();
	})

	jQuery('.wpcf7-radio .wpcf7-list-item-label').click(function(){
		if(jQuery(this).text() == 'Belgrade' ){
			jQuery('#terms-url').attr('href', '/terms-and-conditions-sr');
		} else {
			jQuery('#terms-url').attr('href', '/terms-and-conditions-mk');
		}
	})

});