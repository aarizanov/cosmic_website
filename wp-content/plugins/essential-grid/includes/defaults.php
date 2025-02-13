<?php
/**
* Essential Grid.
*
* @package   Essential_Grid
* @author    ThemePunch <info@themepunch.com>
* @link      http://www.themepunch.com/essential/
* @copyright 2023 ThemePunch
*/

if( !defined( 'ABSPATH') ) exit();

final class EssentialGridDefaults {

	/**
	 * @var null|EssentialGridDefaults 
	 */
	private static $instance = null;

	/**
	 * @return EssentialGridDefaults
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function getData($grid_id = '') {
		return array(
			"id" => $grid_id,
			"name" => "gridform",
			"handle" => "gridform",
			"postparams" => array(
				"source-type" => "post",
				"post_types" => "post",
				"post_category" => "",
				"category-relation" => "OR",
				"additional-query" => "",
				"search_pages" => "",
				"selected_pages" => "",
				"max_entries" => "-1",
				"max_entries_preview" => "20",
				"stream-source-type" => "instagram",
				"youtube-api" => "",
				"youtube-channel-id" => "",
				"youtube-type-source" => "channel",
				"youtube-playlist" => "",
				"youtube-playlist-select" => "",
				"youtube-thumb-size" => "default",
				"youtube-full-size" => "default",
				"youtube-count" => "12",
				"youtube-transient-sec" => "86400",
				"vimeo-type-source" => "user",
				"vimeo-username" => "",
				"vimeo-groupname" => "",
				"vimeo-albumid" => "",
				"vimeo-channelname" => "",
				"vimeo-thumb-size" => "thumbnail_small",
				"vimeo-count" => "12",
				"vimeo-transient-sec" => "86400",
				"instagram-token-source" => "account",
				"instagram-connected-to" => "",
				"instagram-api-key" => "",
				"instagram-count" => "12",
				"instagram-transient-sec" => "86400",
				"flickr-api-key" => "",
				"flickr-type" => "publicphotos",
				"flickr-user-url" => "",
				"flickr-photoset" => "",
				"flickr-photoset-select" => "",
				"flickr-gallery-url" => "",
				"flickr-group-url" => "",
				"flickr-thumb-size" => "Small 320",
				"flickr-full-size" => "Medium 800",
				"flickr-count" => "12",
				"flickr-transient-sec" => "86400",
				"facebook-token-source" => "account",
				"facebook-connected-to" => "",
				"facebook-access-token" => "",
				"facebook-page-id" => "",
				"facebook-type-source" => "timeline",
				"facebook-album" => "",
				"facebook-album-select" => "",
				"facebook-count" => "12",
				"facebook-transient-sec" => "86400",
				"twitter-consumer-key" => "",
				"twitter-consumer-secret" => "",
				"twitter-access-token" => "",
				"twitter-access-secret" => "",
				"twitter-user-id" => "",
				"twitter-image-only" => "true",
				"twitter-include-retweets" => "on",
				"twitter-exclude-replies" => "on",
				"twitter-count" => "12",
				"twitter-transient-sec" => "86400",
				"behance-api" => "",
				"behance-user-id" => "",
				"behance-type" => "projects",
				"behance-project" => "",
				"behance-project-select" => "",
				"behance-projects-thumb-size" => "202",
				"behance-projects-full-size" => "202",
				"behance-project-thumb-size" => "max_1240",
				"behance-project-full-size" => "max1240",
				"behance-count" => "12",
				"behance-transient-sec" => "86400",
				"media-source-order" => array("vimeo","youtube","html5","featured-image"),
				"poster-source-order" => array("alternate-image","featured-image"),
				"image-source-type" => "full",
				"image-source-type-mobile" => "full",
				"default-image" => "",
				"youtube-default-image" => "",
				"vimeo-default-image" => "",
				"html-default-image" => ""
			),
			"params" => array(
				"layout-sizing" => "boxed",
				"fullscreen-offset-container" => "",
				"layout" => "even",
				"content-push" => "off",
				"x-ratio" => "4",
				"y-ratio" => "3",
				"auto-ratio" => true,
				"rtl" => "off",
				"videoplaybackingrid" => "on",
				"videoloopingrid" => "on",
				"videoplaybackonhover" => "off",
				"videocontrolsinline" => "off",
				"videomuteinline" => "on",
				"keeplayersovermedia" => "off",
				"show-even-on-device" => "0",
				"use-cobbles-pattern" => "off",
				"columns-advanced" => "off",
				"columns-height" => array("0","0","0","0","0","0","0"),
				"columns-width" => array("1400","1170","1024","960","778","640","480"),
				"mascontent-height" => array("0","0","0","0","0","0","0"),
				"columns" => array("3","3","2","2","2","2","1"),
				"blank-item-breakpoint" => "1",
				"rows-unlimited" => "on",
				"rows" => "3",
				"enable-rows-mobile" => "off",
				"rows-mobile" => "3",
				"pagination-autoplay" => "off",
				"pagination-autoplay-speed" => "5000",
				"pagination-touchswipe" => "off",
				"pagination-dragvertical" => "on",
				"pagination-swipebuffer" => "30",
				"load-more" => "button",
				"load-more-hide" => "off",
				"load-more-text" => "Load More",
				"load-more-error" => "",
				"load-more-show-number" => "on",
				"load-more-start" => "3",
				"load-more-amount" => "3",
				"lazy-loading" => "off",
				"lazy-loading-blur" => "on",
				"lazy-load-color" => "#FFFFFF",
				"spacings" => "0",
				"grid-padding" => array("0","0","30","0"),
				"main-background-color" => "transparent",
				"navigation-skin" => "minimal-dark",
				"navigation-preview-bg" => "dark",
				"entry-skin" => "18",
				"grid-start-animation" => "reveal",
				"hide-markup-before-load" => "on",
				"grid-start-animation-speed" => "1000",
				"grid-start-animation-delay" => "100",
				"grid-start-animation-type" => "item",
				"start-anime-in-viewport" => "off",
				"start-anime-viewport-buffer" => "20",
				"grid-animation" => "fade",
				"grid-animation-speed" => "1000",
				"grid-animation-delay" => "1",
				"grid-animation-type" => "item",
				"grid-item-animation" => "none",
				"grid-item-animation-zoomin" => "125",
				"grid-item-animation-zoomout" => "75",
				"grid-item-animation-fade" => "75",
				"grid-item-animation-blur" => "5",
				"grid-item-animation-rotate" => "30",
				"grid-item-animation-shift" => "up",
				"grid-item-animation-shift-amount" => "10",
				"grid-item-animation-other" => "none",
				"grid-item-other-zoomin" => "125",
				"grid-item-other-zoomout" => "75",
				"grid-item-other-fade" => "75",
				"grid-item-other-blur" => "5",
				"grid-item-other-rotate" => "30",
				"grid-item-other-shift" => "up",
				"grid-item-other-shift-amount" => "10",
				"top-1-align" => "center",
				"top-1-margin-bottom" => "0",
				"top-2-align" => "center",
				"top-2-margin-bottom" => "0",
				"bottom-1-align" => "center",
				"bottom-1-margin-top" => "0",
				"bottom-2-align" => "center",
				"bottom-2-margin-top" => "0",
				"left-margin-left" => "0",
				"right-margin-right" => "0",
				"module-spacings" => "5",
				"pagination-numbers" => "smart",
				"pagination-scroll" => "off",
				"pagination-scroll-offset" => "0",
				"filter-arrows" => "single",
				"filter-logic" => "or",
				"add-filters-by" => "default",
				"filter-start" => "",
				"filter-deep-link" => "off",
				"filter-show-on" => "hover",
				"convert-mobile-filters" => "off",
				"convert-mobile-filters-width" => "768",
				"filter-all-visible" => "on",
				"filter-all-text" => "Filter - All",
				"filter-listing" => "list",
				"filter-dropdown-text" => "Filter Categories",
				"filter-counter" => "off",
				"filter-selected" => array("category_2","category_5","category_4","category_3"),
				"sort-by-text" => "Sort By ",
				"sorting-order-by" => "date",
				"sorting-order-by-start" => "none",
				"sorting-order-by-start-meta" => "",
				"sorting-order-type" => "ASC",
				"search-text" => "Search...",
				"lb-source-order" => array("featured-image"),
				"lightbox-mode" => "filterpage",
				"lightbox-exclude-media" => "off",
				"lightbox-deep-link" => "group",
				"lightbox-videoautoplay" => "on",
				"lightbox-title" => "off",
				"lightbox-title-source" => "title",
				"lightbox-description" => "off",
				"lightbox-description-source" => "description",
				"lightbox-title-strip" => "on",
				"lightbox-title-position" => "bottom",
				"lightbox-override-ui-colors" => "off",
				"lightbox-overlay-bg-color" => "rgba(30,30,30,0.9)",
				"lightbox-ui-bg-color" => "#28303d",
				"lightbox-ui-color" => "#ffffff",
				"lightbox-ui-hover-bg-color" => "#000000",
				"lightbox-ui-hover-color" => "#ffffff",
				"lightbox-ui-text-color" => "#eeeeee",
				"lbox-padding" => array("0","0","0","0"),
				"lightbox-effect-open-close" => "fade",
				"lightbox-effect-open-close-speed" => "500",
				"lightbox-effect-next-prev" => "fade",
				"lightbox-effect-next-prev-speed" => "500",
				"lightbox-autoplay" => "off",
				"lbox-playspeed" => "3000",
				"lightbox-arrows" => "on",
				"lightbox-loop" => "on",
				"lightbox-numbers" => "on",
				"lightbox-mousewheel" => "off",
				"lightbox-post-content-min-width" => "75",
				"lightbox-post-content-min-perc" => "on",
				"lightbox-post-content-max-width" => "75",
				"lightbox-post-content-max-perc" => "on",
				"lightbox-post-content-overflow" => "on",
				"lbox-content_padding" => array("0","0","0","0"),
				"lightbox-post-spinner" => "off",
				"lightbox-post-content-img" => "off",
				"lightbox-post-content-img-position" => "top",
				"lightbox-post-content-img-width" => "50",
				"lightbox-post-content-img-margin" => array("0","0","0","0"),
				"lightbox-post-content-title" => "off",
				"lightbox-post-content-title-tag" => "h2",
				"ajax-container-id" => "ess-grid-ajax-container-",
				"ajax-container-position" => "top",
				"ajax-container-shortcode" => "[ess_grid_ajax_target alias=\"media_grid_howardtaft\"][/ess_grid_ajax_target]",
				"ajax-scroll-onload" => "on",
				"ajax-scrollto-offset" => "0",
				"ajax-close-button" => "off",
				"ajax-button-text" => "Close",
				"ajax-nav-button" => "off",
				"ajax-button-skin" => "light",
				"ajax-button-type" => "type1",
				"ajax-button-inner" => "false",
				"ajax-button-h-pos" => "r",
				"ajax-button-v-pos" => "t",
				"ajax-container-pre" => "",
				"ajax-container-post" => "",
				"ajax-container-css" => "",
				"ajax-callback" => "",
				"ajax-callback-arg" => true,
				"ajax-css-url" => "",
				"ajax-js-url" => "",
				"use-spinner" => "0",
				"spinner-color" => "#FFFFFF",
				"custom-javascript" => "",
				"do-not-save" => "essapi_34.esquickdraw();",
				"cookie-save-time" => "30",
				"cookie-save-search" => "off",
				"cookie-save-filter" => "off",
				"cookie-save-pagination" => "off",
				"navigation-layout" => array(
					"pagination" => array(),
					"left" => array(),
					"right" => array(),
					"filter" => array(),
					"filter2" => array(),
					"filter3" => array(),
					"cart" => array(),
					"sorting" => array(),
					"search-input" => array()
				),
				"css-id" => ""
			)
		);
	}
}

EssentialGridDefaults::instance();
