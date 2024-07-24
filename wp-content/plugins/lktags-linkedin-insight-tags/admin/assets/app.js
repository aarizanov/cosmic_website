jQuery(document).ready(function () {
    jQuery('.lktags-alert').on('click', '.closebtn', function () {
        jQuery(this).closest('.lktags-alert').fadeOut(); //.css('display', 'none');
    });
    jQuery('.lktags-boost-robot-label input').on('click', function() {
        jQuery('.lktags-boost-robot').slideToggle();
    });
    jQuery('.lktags-boost-alt-label input').on('click', function() {
        jQuery('.lktags-boost-alt').slideToggle();
    });
    jQuery('.lktags-mobi-label input').on('click', function() {
        jQuery('.lktags-mobi').slideToggle();
    });
    jQuery('.lktags-bigta-label input').on('click', function() {
        jQuery('.lktags-bigta').slideToggle();
    });
    jQuery('.lktags-vidseo-label input').on('click', function() {
        jQuery('.lktags-vidseo').slideToggle();
    });

    jQuery("#fs_connect button[type=submit]").on("click", function(e) {
        console.log("open verify window")
        window.open('https://better-robots.com/subscribe.php?plugin=lktags','lktags','resizable,height=400,width=700');
    });
});