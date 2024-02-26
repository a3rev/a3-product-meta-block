/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( props ) {

	return (
		<div { ...useBlockProps() }>
			<div class="wccom-product-box__button">
				<summary class="wccom-product-collapsible-list__item-heading"><h3>Try For FREE</h3></summary>
				<div class="wccom-product-collapsible-list__collapsible-content">
					<div class="wccom-product-collapsible-list__collapsible-description">
						<ul class="wccom-tick-list">
							<li>Use for 14 Day's Completely free</li>
							<li>Full support for the trail period</li>
							<li>Free upgrades for the trail period</li>
							<li>Easy 1 click cancel</li>
							<li>Includes all a3rev premium plugins and themes</li>
							<li>Download and Install a3rev Dashboard</li>
							<li>Activate WooCommerce Predictive Search Premium from the dashboard</li>
						</ul>
					</div>
					<div class="wccom-product-add-to-cart-button">
						<a href="#" class="wccom-button single_add_to_cart_button is-style-primary"><span class="wccom-circular-progress wccom-button__spinner" role="progressbar"></span><div class="wccom-button__text">FREE TRIAL</div></a>
					</div>
					<div class="wccom-product-link-to-product">
						<a href="#" class="wccom-product-box__vendor-privacy-link">14 Day Free Trial</a>
					</div>
				</div>
			</div>
		</div>
	);
}
