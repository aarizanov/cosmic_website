<div class="wrap lktags-containter">

    <?php 
Pagup\Lktags\Core\Plugin::view( 'inc/top', compact( 'active_tab' ) );
?>

    <!-- start main settings column -->
    <div class="lktags-row">
        <div class="lktags-column col-9">
            <div class="lktags-main">
                <form method="post">

                    <?php 
if ( function_exists( 'wp_nonce_field' ) ) {
    wp_nonce_field( 'lktags__settings', 'lktags__nonce' );
}
?>
                    
                    <br />

                    <div class="lktags-note">
                        <h3><?php 
echo  esc_html__( 'Linkedin Insight tag, how does it work?', $text_domain ) ;
?></h3>
                        <p><?php 
echo  sprintf( wp_kses( __( 'LinkedIn Insight tag (or pixel) allows you to measure the activity of users on your website and track conversion to help you understand which campaign or ad is driving the most conversions. You can also build audiences using the tag, such as people who visited a specific page on your site, or build an audience of people who converted in the past to create a remarketing ad for them. Don\'t forget to check on your pages to find META BOX feature under WordPress post editor (for Event pixel). If you have any doubt, please refer to <a href="%s" target="_blank">Linkedin documentation</a>. Enjoy.', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( 'https://www.linkedin.com/help/lms/answer/65521/the-linkedin-insight-tag-frequently-asked-questions?lang=en' ) ) ;
?></p>
                    </div>
                    
                    <div class="lktags-segment">

                        <h2><?php 
echo  esc_html__( 'LINKEDIN INSIGHT TAGS', $text_domain ) ;
?></h2>

                        <div class="lktags-row">

                            <div class="lktags-column col-4">
                                <span class="lktags-label"><?php 
echo  esc_html__( 'Enable LinkedIn Insight Tag', $text_domain ) ;
?></span>
                            </div>

                            <div class="lktags-column col-8">
                                <label class="lktags-switch">
                                    <input type="checkbox" id="enable_lktags" name="enable_lktags" value="enable_lktags"
                                    <?php 
if ( $options::check( 'enable_lktags' ) ) {
    echo  'checked' ;
}
?> />
                                    <span class="lktags-slider lktags-round"></span>
                                </label>
                                &nbsp;
                                <span><?php 
echo  esc_html__( 'This feature will add the Linkedin base code to all pages', $text_domain ) ;
?></span>
                            </div>

                        </div>

                        <div class="lktags-row">

                            <div class="lktags-column col-4">
                                <span class="lktags-label"><?php 
echo  esc_html__( 'Enter LinkedIn Insight TAG ID', $text_domain ) ;
?></span>
                                &nbsp;
                                <div class="lktags-tooltip">
                                    <span class="dashicons dashicons-editor-help"></span>
                                    <span class="lktags-tooltiptext"><?php 
echo  __( 'Please refer to FAQ section : How to find your TAG ID - Please do NOT enter anything else BUT your TAG ID', $text_domain ) ;
?></span>
                                </div>
                            </div>

                            <div class="lktags-column col-8">
                                <input type="text" name="lktags_id" id="lktags_id" class="lktags-field" value="<?php 
if ( $options::check( 'lktags_id' ) ) {
    echo  $options::get( 'lktags_id' ) ;
}
?>" placeholder="1234567890">

                                <?php 

if ( $options::check( 'enable_lktags' ) && !$options::check( 'lktags_id' ) ) {
    ?>

                                    <div class="lktags-alert lktags-warning"><span class="closebtn">&times;</span><?php 
    echo  __( 'It seems you enabled LinkedIn Insight tag above but forgot to enter TAG ID. Please make sure to enter TAG ID otherwise it won\'t work.', $text_domain ) ;
    ?></div>

                                <?php 
}

?>
                            </div>

                        </div>

                    </div>

                    <div class="lktags-segment">

                        <h2><?php 
echo  esc_html__( 'LINKEDIN INSIGHT TAG ON WOOCOMMERCE', $text_domain ) ;
?></h2>
                        
                        <div class="lktags-row">

                            <div class="lktags-column col-4">
                                <span class="lktags-label"><?php 
echo  esc_html__( 'Enable Linkedin Insight Tag on your store', $text_domain ) ;
?></span>
                            </div>

                            <div class="lktags-column col-8">

                            <?php 
// free only
?>

                                    <label class="lktags-switch"><input id="enable_on_products" type="checkbox" name="enable_on_products" value="enable_on_products" disabled />
                                    <span class='lktags-slider lktags-round'></span></label>
                                    &nbsp;
                                    <div class="lktags-tooltip">
                                        <span class="dashicons dashicons-editor-help"></span>
                                        <span class="lktags-tooltiptext"><?php 
echo  sprintf( wp_kses( __( 'This feature will add a "addtocart" event on your <a href="%s" target="_blank">CART PAGE</a>, just after your base code', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( LKTAGS_PLUGIN_DIR . '/admin/assets/imgs/code.jpg' ) ) ;
?></span>
                                    </div>
                                    <br />
                                    <div class="lktags-alert lktags-info">
                                        <span class="closebtn">&times;</span> 
                                        <?php 
echo  $get_pro . " " . __( 'Lktags on Woocommerce product pages.', $text_domain ) ;
?>
                                    </div>

                                <?php 
?>

                            </div>

                        </div>
                        
                    </div>
                    

                    

                    <?php 
// free only
?>

                        <div class="lktags-alert lktags-info"><span class="closebtn">&times;</span><?php 
echo  $get_pro . sprintf( wp_kses( __( ' specific "Event pixels", which are managed with a &nbsp;<a href="%s" target="_blank">META BOX feature</a>', 'pctag' ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( LKTAGS_PLUGIN_DIR . '/admin/assets/imgs/meta-box.png' ) ) ;
?></div>

                    <?php 
?>

                    <div class="lktags-segment">

                        <div class="lktags-row">

                        <div class="lktags-column col-4">
                            <span class="lktags-label"><?php 
echo  __( 'Allow Linkedin from crawling your website', $text_domain ) ;
?></span>
                        </div>
                        
                        <div class="lktags-column col-8">
                            
                        <label class="lktags-switch lktags-boost-robot-label">
                            <input type="checkbox" id="boost-robot" name="boost-robot" value="boost-robot" <?php 
if ( $options::check( 'boost-robot' ) ) {
    echo  'checked="checked"' ;
}
?> />
                            <span class="lktags-slider lktags-round"></span>
                        </label>

                            &nbsp; <span><?php 
echo  __( 'Optimize site\'s crawlability with an optimized robots.txt', $text_domain ) ;
?></span>
                            
                            <div class="lktags-boost-robot" <?php 

if ( $options::check( 'boost-robot' ) ) {
    echo  'style="display: inline;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

                            <div class="lktags-alert lktags-success" style="margin-top: 10px;"><?php 
echo  sprintf( wp_kses( __( 'Optimize your <a href="%2s" target="_blank">robots.txt</a> for Linkedin crawlers (<a href="%s" target="_blank">HERE</a>)', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://wordpress.org/plugins/better-robots-txt/" ), esc_url( "https://wordpress.org/plugins/better-robots-txt/" ) ) ;
?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="lktags-row">

                        <div class="lktags-column col-4">
                            <span class="lktags-label"><?php 
echo  __( 'Boost your Alt texts', $text_domain ) ;
?></span>
                        </div>
                        
                        <div class="lktags-column col-8">
                            
                        <label class="lktags-switch lktags-boost-alt-label">
                            <input type="checkbox" id="boost-alt" name="boost-alt" value="boost-alt" <?php 
if ( $options::check( 'boost-alt' ) ) {
    echo  'checked="checked"' ;
}
?> />
                            <span class="lktags-slider lktags-round"></span>
                        </label>

                            &nbsp; <span><?php 
echo  __( 'Boost your ranking with optimized Alt tags', $text_domain ) ;
?></span>
                            
                            <div class="lktags-boost-alt" <?php 

if ( $options::check( 'boost-alt' ) ) {
    echo  'style="display: inline;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

                                <div class="lktags-alert lktags-success" style="margin-top: 10px;"><?php 
echo  sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">BIALTY Wordpress plugin</a> & auto-optimize all your alt texts for FREE', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://wordpress.org/plugins/bulk-image-alt-text-with-yoast/" ), esc_url( "https://wordpress.org/plugins/bulk-image-alt-text-with-yoast/" ) ) ;
?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="lktags-row">

                        <div class="lktags-column col-4">
                            <span class="lktags-label"><?php 
echo  __( 'Mobile-Friendly & responsive design', $text_domain ) ;
?></span>
                        </div>
                        
                        <div class="lktags-column col-8">
                            
                        <label class="lktags-switch lktags-mobi-label">
                            <input type="checkbox" id="lktags-mobilook" name="lktags-mobilook" value="lktags-mobilook" <?php 
if ( $options::check( 'lktags-mobilook' ) ) {
    echo  'checked="checked"' ;
}
?> />
                            <span class="lktags-slider lktags-round"></span>
                        </label>

                            &nbsp; <span><?php 
echo  __( 'Get dynamic mobile previews of your pages/posts/products + Facebook debugger', $text_domain ) ;
?></span>
                            
                            <div class="lktags-mobi" <?php 

if ( $options::check( 'lktags-mobilook' ) ) {
    echo  'style="display: inline;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

                                <div class="lktags-alert lktags-success" style="margin-top: 10px;"><?php 
echo  sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">Mobilook</a> and test your website on Dualscreen format (Galaxy fold)', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://wordpress.org/plugins/mobilook/" ), esc_url( "https://wordpress.org/plugins/mobilook/" ) ) ;
?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
        
                    <div class="lktags-row">

                    <div class="lktags-column col-4">
                        <span class="lktags-label"><?php 
echo  __( 'Boost your image title attribute', $text_domain ) ;
?></span>
                    </div>

                    <div class="lktags-column col-8">

                    <label class="lktags-switch lktags-bigta-label">
                        <input type="checkbox" id="lktags-bigta" name="lktags-bigta" value="lktags-bigta" <?php 
if ( $options::check( 'lktags-bigta' ) ) {
    echo  'checked="checked"' ;
}
?> />
                        <span class="lktags-slider lktags-round"></span>
                    </label>

                    &nbsp; <span><?php 
echo  __( 'Optimize all your image title attributes for UX & search engines performance', $text_domain ) ;
?></span>

                        <div class="lktags-bigta" <?php 

if ( $options::check( 'lktags-bigta' ) ) {
    echo  'style="display: inline;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

                            <div class="lktags-alert lktags-success" style="margin-top: 10px;"><?php 
echo  sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to Install <a href="%2s" target="_blank">BIGTA</a> Wordpress plugin & auto-optimize all your image title attributes for FREE', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://wordpress.org/plugins/bulk-image-title-attribute/" ), esc_url( "https://wordpress.org/plugins/bulk-image-title-attribute/" ) ) ;
?>
                            </div>
                        </div>
                    </div>

                    </div>

                    <div class="lktags-row">

                    <div class="lktags-column col-4">
                        <span class="lktags-label no-colon"><?php 
echo  __( 'Looking for FREE unlimited content for SEO?', $text_domain ) ;
?></span>
                    </div>

                    <div class="lktags-column col-8">

                    <label class="lktags-switch lktags-vidseo-label">
                        <input type="checkbox" id="lktags-vidseo" name="lktags-vidseo" value="lktags-vidseo" <?php 
if ( $options::check( 'lktags-vidseo' ) ) {
    echo  'checked="checked"' ;
}
?> />
                        <span class="lktags-slider lktags-round"></span>
                    </label>

                    &nbsp; <span><?php 
echo  __( 'Get access to billions of non-indexed content with Video transcripts (Youtube)', $text_domain ) ;
?></span>

                        <div class="lktags-vidseo" <?php 

if ( $options::check( 'lktags-vidseo' ) ) {
    echo  'style="display: inline;"' ;
} else {
    echo  'style="display: none;"' ;
}

?>>

                            <div class="lktags-alert lktags-success" style="margin-top: 10px;"><?php 
echo  sprintf( wp_kses( __( 'Click <a href="%s" target="_blank">HERE</a> to learn more about <a href="%2s" target="_blank">VidSEO</a> Wordpress plugin & how to skyrocket your SEO', $text_domain ), array(
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
    'a' => array(
    'href'   => array(),
    'target' => array(),
),
) ), esc_url( "https://wordpress.org/plugins/vidseo/" ), esc_url( "https://wordpress.org/plugins/vidseo/" ) ) ;
?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="lktags-segment">

                        <div class="lktags-row">

                            <div class="lktags-column col-4">
                                <span class="lktags-label"><?php 
echo  esc_html__( 'Delete Settings', $text_domain ) ;
?></span>
                            </div>

                            <div class="lktags-column col-8">
                                <label class="lktags-switch">
                                    <input type="checkbox" id="lktags_remove_settings" name="lktags_remove_settings" value="lktags_remove_settings"
                                    <?php 
if ( $options::check( 'lktags_remove_settings' ) ) {
    echo  'checked="checked"' ;
}
?> />
                                    <span class="lktags-slider lktags-round"></span>
                                </label>
                                &nbsp;
                                <span><?php 
echo  esc_html__( 'Checking this box will remove all settings when you deactivate plugin.', $text_domain ) ;
?></span>
                            </div>

                        </div>

                    </div>

                
                    <p class="submit"><input type="submit" name="update" class="button-primary" value="<?php 
echo  esc_html__( 'Save Changes', $text_domain ) ;
?>" /></p>
                </form>

                <div class="lktags-note"><p><?php 
echo  __( "Note: once the codes are added, make sure to clear your cache. Then, you must add the domain for approval. To do this, go to the Insight Tag page, and on the right side, you must add your domain. WWW is not required. Once users enter your website, the tag will recognize and start running. At this point, you will see that LinkedIn has confirmed your domain.", $text_domain ) ;
?></p></div>
    
            </div>
            <!-- end lktags-main -->
        </div>
        <!-- end main settings lktags-column col-8 -->

        <div class="lktags-column col-3 lktags-txt">

            <?php 
Pagup\Lktags\Core\Plugin::view( 'inc/side', compact( 'text_domain' ) );
?>

        </div>

    </div>

</div>