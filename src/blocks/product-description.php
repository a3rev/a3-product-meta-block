<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Server-side rendering of the `core/post-date` block.
 *
 * @package WordPress
 */

/**
 * Renders the `core/post-date` block on the server.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post date for the current post wrapped inside "time" tags.
 */
function _render_block_product_description( $attributes, $content, $block ) {

	if ( !is_singular('product') ) {
		return '';
	}

	global $a3ProductMetaBlock;

	$product_id = get_the_ID();

	$html = '';
	
	$content = '';

	$product_description = get_the_content();

	if( !empty( $product_description ) ){
		$content .= $product_description;
	}

	if( !empty( $content ) ){

		if( class_exists( '\A3Rev\PageViewsCount\A3_PVC' ) ){
			remove_filter('the_content', array( '\A3Rev\PageViewsCount\A3_PVC', 'pvc_stats_show'), 8);
		}
		
		$content = apply_filters( 'the_content', $content);
        
		$html .= '
		<div class="wccom-product-product-description">
			' . $content . '
		</div>';
		
	}
	
	return $html;
}


function _register_block_product_description() {
	
	/* Support */
	register_block_type( 
		A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'build/blocks/product-description',
		array(
			'render_callback' => '_render_block_product_description',
		)
	);

}


add_action( 'init', '_register_block_product_description' );