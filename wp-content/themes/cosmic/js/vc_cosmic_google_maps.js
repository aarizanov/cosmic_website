(function($) {
	'use strict';
	
	function maps_initilize( m_id, m_zoom, m_loc_lat, m_loc_long, m_m_title, m_m_loc_lat, m_m_loc_long, m_marker_url ) {
		var mapOptions = {
			zoom: m_zoom,
			disableDefaultUI: true,
			center: new google.maps.LatLng( m_loc_lat, m_loc_long ),
			styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#7c93a3"},{"lightness":"-10"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#a0a4a5"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#62838e"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#dde3e3"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#3f4a51"},{"weight":"0.30"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"poi.attraction","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi.place_of_worship","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"},{"visibility":"on"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#bbcacf"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"lightness":"0"},{"color":"#bbcacf"},{"weight":"0.50"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#a9b4b8"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"invert_lightness":true},{"saturation":"-7"},{"lightness":"3"},{"gamma":"1.80"},{"weight":"0.01"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#a3c7df"}]}]
		};
		var mapElement = document.getElementById(m_id);
		var map = new google.maps.Map( mapElement, mapOptions );
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng( m_m_loc_lat, m_m_loc_long ),
			map: map,
			title: m_m_title,
			icon: m_marker_url,
		});
	}
	
	var m_zoom = '';
	var m_loc = '';
	var m_m_title = '';
	var m_m_loc = '';
	var m_id = '';
	var m_marker_url = '';
	var m_loc_array = [];
	var m_m_loc_array = [];
	var m_loc_lat = 0;
	var m_loc_long = 0;
	var m_m_loc_lat = 0;
	var m_m_loc_long = 0;
	
	
	$(document).ready( function() {
		if ( $( '.widget_cosmic_google_maps .cosmic-maps-wrap' ).length ) {
			$( '.widget_cosmic_google_maps .cosmic-maps-wrap' ).each( function() {
				m_marker_url = $(this).attr('data-marker');
				m_zoom = parseInt( $(this).attr('data-zoom') );
				m_loc = $(this).attr('data-loc');
				m_loc_array = m_loc.split(',');
				m_loc_lat = parseFloat( m_loc_array[0] );
				m_loc_long = parseFloat( m_loc_array[1] );
				m_m_title = $(this).attr('data-mtitle');
				m_m_loc = $(this).attr('data-mloc');
				m_m_loc_array = m_m_loc.split(',');
				m_m_loc_lat = parseFloat( m_m_loc_array[0] );
				m_m_loc_long = parseFloat( m_m_loc_array[1] );
				m_id = $(this).attr('id');

				maps_initilize( m_id, m_zoom, m_loc_lat, m_loc_long , m_m_title, m_m_loc_lat, m_m_loc_long, m_marker_url );
			});
		}
	})
} (jQuery));