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
function _render_block_call_to_action( $attributes, $content, $block ) {

	if ( !is_singular('product') ) {
		return '';
	}

	global $a3ProductMetaBlock;


	$product_id = get_the_ID();

	$product_metas 								= metadata_exists( 'post', $product_id, $a3ProductMetaBlock->meta_prefix.'meta' ) ? get_post_meta( $product_id, $a3ProductMetaBlock->meta_prefix.'meta', true ) : array();
	$call_to_action_title 						= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['title'] ) ? $product_metas['action_box']['title'] : '';
	$action_box_description 					= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['description'] ) ? $product_metas['action_box']['description'] : '';
	$action_box_add_to_cart_shortcode 			= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['add_to_cart_shortcode'] ) ? $product_metas['action_box']['add_to_cart_shortcode'] : '';
	$action_box_add_to_cart_text 				= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['add_to_cart_text'] ) ? $product_metas['action_box']['add_to_cart_text'] : __( 'Get it For Free', 'a3-product-meta-block' );
	$action_box_more_details_url 				= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['more_details_url'] ) ? $product_metas['action_box']['more_details_url'] : '';
	$action_box_pageid 							= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['pageid'] ) ? $product_metas['action_box']['pageid'] : '';
	$action_box_more_details_text 				= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['more_details_text'] ) ? $product_metas['action_box']['more_details_text'] : __( '14 day free trial & pricing', 'a3-product-meta-block' );

	$html = '';
	
	$title = '';
	if( !empty( $call_to_action_title ) ){
		$title = '<summary class="wccom-product-collapsible-list__item-heading"><h3>' . $call_to_action_title . '</h3></summary>';
	}

	$description = '';
	if( !empty( $action_box_description ) ){
		$description = '
		<div class="wccom-product-collapsible-list__collapsible-description">
			'. $action_box_description .'
		</div>';
	}

	$external_link = '';

	$external_url = trim( $action_box_more_details_url) != '' ? $action_box_more_details_url : '';
	if( '' == $external_url && $action_box_pageid > 0 ){
		$external_url = get_permalink( $action_box_pageid );
	}

	if( !empty( $action_box_more_details_text ) && !empty( $external_url ) ){
		$external_link .= '
		<div class="wccom-product-link-to-product">
			<a href="'.$external_url.'" class="wccom-product-box__vendor-privacy-link" title="'. $action_box_more_details_text .'">'. $action_box_more_details_text .'</a>
		</div>
		';
	}

	$add_to_cart_button = '';

	if( !empty( $action_box_add_to_cart_shortcode) && $action_box_add_to_cart_shortcode > 0 ){
		$_product = wc_get_product( $action_box_add_to_cart_shortcode );
		if( $_product ){
			$add_to_cart_url = do_shortcode('[add_to_cart_url id='.$action_box_add_to_cart_shortcode.']');
			if( !empty($add_to_cart_url ) ){
				$add_to_cart_button = '
				<div class="wccom-product-add-to-cart-button">
					<a href="'.$add_to_cart_url.'" class="wccom-button single_add_to_cart_button is-style-primary"><span class="wccom-circular-progress wccom-button__spinner" role="progressbar"></span><div class="wccom-button__text">'.  $action_box_add_to_cart_text .'</div></a>
				</div>
				';
			}
		}
	}

	if( !empty( $description ) || !empty( $external_link ) || !empty($add_to_cart_button) ){

		$html .= '
		<div class="wccom-product-box__button">
			'. $title .'
			<div class="wccom-product-collapsible-list__collapsible-content">
				'. $description .'
				'. $add_to_cart_button .'
				'.$external_link.'
			</div>
		</div>';
		
	}
	
	return $html;
}


function _register_block_call_to_action() {
	
	/* Call to action */
	register_block_type( 
		A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'build/blocks/call-to-action',
		array(
			'render_callback' => '_render_block_call_to_action',
		)
	);

}


add_action( 'init', '_register_block_call_to_action' );