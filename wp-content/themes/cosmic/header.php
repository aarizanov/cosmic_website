<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cosmic
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-49007218-1"></script>
	
	<script>
 	 window.dataLayer = window.dataLayer || [];
 	 function gtag(){dataLayer.push(arguments);}
  	 gtag('js', new Date());

 	 gtag('config', 'UA-49007218-1');
	</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>

    <meta name="p:domain_verify" content="d2b64613631146bf7feed7deeea2cc2b"/>

    <!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		 fbq('init', '589631771909135'); 
		fbq('track', 'PageView');
	</script>
	<noscript>
		 <img height="1" width="1" 
		src="https://www.facebook.com/tr?id=589631771909135&ev=PageView
		&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->


</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="vc_container">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<i class="fal fa-bars bars"></i>
					<i class="fal fa-times times"></i>
				</button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav><!-- #site-navigation -->		
		</div><!-- .vc_container -->
	</header><!-- #masthead -->
	<header class="side_menu" id="side_header">
		<?php dynamic_sidebar( 'side-menu-1' ); ?>
	</header>
	<div id="content" class="site-content">
