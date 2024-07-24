<?php

if ( 'yes' === $showMark ) {
	$product = qi_blocks_woo_get_global_product();

	if ( ! empty( $product ) && ! $product->is_in_stock() ) {
		echo qi_blocks_get_out_of_stock_mark(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		echo qi_blocks_woo_set_sale_flash(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
