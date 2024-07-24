<?php
$icon = ! empty( $paginationArrowPrevIcon ) && isset( $paginationArrowPrevIcon['html'] ) ? $paginationArrowPrevIcon['html'] : '';

if ( ! empty( $icon ) ) {
	echo qi_blocks_get_svg_icon_content( $icon );
} else {
	echo qi_blocks_get_svg_icon( 'icon-arrow-left', 'qodef-m-pagination-icon' );
}
