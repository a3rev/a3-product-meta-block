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
function _render_block_support( $attributes, $content, $block ) {

	if ( !is_singular('product') ) {
		return '';
	}

	global $a3ProductMetaBlock;


	$product_id = get_the_ID();

	$product_metas 						= metadata_exists( 'post', $product_id, $a3ProductMetaBlock->meta_prefix.'meta' ) ? get_post_meta( $product_id, $a3ProductMetaBlock->meta_prefix.'meta', true ) : array();

	$support_title 						= is_array($product_metas) && isset( $product_metas['support'] ) && isset( $product_metas['support']['title'] ) ? $product_metas['support']['title'] : '';
	$support_text_before 				= is_array($product_metas) && isset( $product_metas['support'] ) && isset( $product_metas['support']['text_before'] ) ? $product_metas['support']['text_before'] : '';
	$support_button_text 				= is_array($product_metas) && isset( $product_metas['support'] ) && isset( $product_metas['support']['button_text'] ) ? $product_metas['support']['button_text'] : '';
	$support_button_url 				= is_array($product_metas) && isset( $product_metas['support'] ) && isset( $product_metas['support']['button_url'] ) ? $product_metas['support']['button_url'] : '';
	$support_text_after 				= is_array($product_metas) && isset( $product_metas['support'] ) && isset( $product_metas['support']['text_after'] ) ? $product_metas['support']['text_after'] : '';

	$html = '';
	
	$title = '';
	if( !empty( $support_title ) ){
		$title = '<summary class="wccom-product-collapsible-list__item-heading"><h3 class="wccom-product-collapsible-list__item-title">' . $support_title . '</h3><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="arrowchevrontop" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 266.77"><path fill-rule="nonzero" d="M493.12 263.55c4.3 4.28 11.3 4.3 15.62.05 4.33-4.26 4.35-11.19.05-15.47L263.83 3.22c-4.3-4.27-11.3-4.3-15.63-.04L3.21 248.13c-4.3 4.28-4.28 11.21.05 15.47 4.32 4.25 11.32 4.23 15.62-.05L255.99 26.48l237.13 237.07z"/></svg><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="arrowchevronbottom" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 266.77"><path fill-rule="nonzero" d="M493.12 3.22c4.3-4.27 11.3-4.3 15.62-.04a10.85 10.85 0 0 1 .05 15.46L263.83 263.55c-4.3 4.28-11.3 4.3-15.63.05L3.21 18.64a10.85 10.85 0 0 1 .05-15.46c4.32-4.26 11.32-4.23 15.62.04L255.99 240.3 493.12 3.22z"/></svg></summary>';
	}

	$content = '';

	if( !empty( $support_text_before ) ){
		$content .= '<p class="wccom-product-box__paragraph">' . $support_text_before . '</p>';
	}

	if( !empty( $support_button_text ) && !empty( $support_button_url ) ){
		$content .= '<a href="' . $support_button_url . '" target="_blank" rel="noopener" class="wccom-button wccom-product-box__documentation-link is-style-secondary">' . $support_button_text. '</a>';
	}

	if( !empty( $support_text_after ) ){
		$content .= '<p class="wccom-product-box__paragraph">' . $support_text_after . '</p>';
	}

	if( !empty( $content ) ){

		$html .= '
		<details class="wccom-product-collapsible-list__item">
			' . $title . '
			<div class="wccom-product-collapsible-list__collapsible-content">
				' . $content . '
			</div>
		</details>';
		
	}
	
	return $html;
}


function _register_block_support() {
	
	/* Support */
	register_block_type( 
		A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'build/blocks/support',
		array(
			'render_callback' => '_render_block_support',
		)
	);

}


add_action( 'init', '_register_block_support' );