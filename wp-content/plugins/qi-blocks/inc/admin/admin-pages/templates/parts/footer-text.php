<?php
esc_html_e( 'We hope you\'re having a great time using the Qi Blocks for Gutenberg', 'qi-blocks' );
?>
<br />
<?php
printf(
	esc_html__( 'Leave a %s let us know about your experience!', 'qi-blocks' ),
	'<a href="https://wordpress.org/plugins/qi-blocks/#reviews">' . esc_html__( 'rating', 'qi-blocks' ) . '</a>'
);
