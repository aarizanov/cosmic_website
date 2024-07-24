<?php
$icon = ! empty( $paginationArrowNextIcon ) && isset( $paginationArrowNextIcon['html'] ) ? $paginationArrowNextIcon['html'] : '';

if ( ! empty( $icon ) ) {
	echo qi_blocks_get_svg_icon_content( $icon );
} else {
	echo qi_blocks_get_svg_icon( 'icon-arrow-right', 'qodef-m-pagination-icon' );
}

