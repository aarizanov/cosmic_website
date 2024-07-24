<?php

namespace Pagup\Lktags\Controllers;

use  Pagup\Lktags\Core\Option ;
class TrackingController
{
    public function __construct()
    {
        add_action( 'wp_head', array( &$this, 'linkedin_pixel' ) );
    }
    
    public function linkedin_pixel()
    {
        if ( Option::check( 'enable_lktags' ) && Option::check( 'lktags_id' ) ) {
            
            if ( class_exists( 'woocommerce' ) ) {
                if ( !is_singular( 'product' ) && !is_cart() && !is_checkout() ) {
                    echo  $this->linkedin( Option::get( 'lktags_id' ) ) . "\n" ;
                }
            } else {
                echo  $this->linkedin( Option::get( 'lktags_id' ) ) . "\n" ;
            }
        
        }
        if ( lktags_fs()->can_use_premium_code__premium_only() && Option::check( 'lktags_id' ) ) {
            echo  $this->linkedin_event() ;
        }
    }
    
    protected function linkedin( $tag )
    {
        return "<!-- Linkedin Insight Base Code --!><script type='text/javascript'>_linkedin_partner_id = '{$tag}';window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];window._linkedin_data_partner_ids.push(_linkedin_partner_id);</script><script type='text/javascript'>(function(){var s = document.getElementsByTagName('script')[0];var b = document.createElement('script');b.type = 'text/javascript';b.async = true;b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';s.parentNode.insertBefore(b, s);})();</script><noscript><img height='1' width='1' style='display:none;' alt='' src='https://dc.ads.linkedin.com/collect/?pid={$tag}&fmt=gif' /></noscript><!-- End Linkedin Insight Base Code --!>";
    }
    
    protected function linkedin_event()
    {
        return;
    }

}
$TrackingControllers = new TrackingController();