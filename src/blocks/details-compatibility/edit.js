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
			<details class="wccom-product-collapsible-list__item" open="">
				<summary class="wccom-product-collapsible-list__item-heading"><h3 class="wccom-product-collapsible-list__item-title">Details and compatibility</h3><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="arrowchevrontop" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 266.77"><path fill-rule="nonzero" d="M493.12 263.55c4.3 4.28 11.3 4.3 15.62.05 4.33-4.26 4.35-11.19.05-15.47L263.83 3.22c-4.3-4.27-11.3-4.3-15.63-.04L3.21 248.13c-4.3 4.28-4.28 11.21.05 15.47 4.32 4.25 11.32 4.23 15.62-.05L255.99 26.48l237.13 237.07z"/></svg><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" class="arrowchevronbottom" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 266.77"><path fill-rule="nonzero" d="M493.12 3.22c4.3-4.27 11.3-4.3 15.62-.04a10.85 10.85 0 0 1 .05 15.46L263.83 263.55c-4.3 4.28-11.3 4.3-15.63.05L3.21 18.64a10.85 10.85 0 0 1 .05-15.46c4.32-4.26 11.32-4.23 15.62.04L255.99 240.3 493.12 3.22z"/></svg></summary>
				<div class="wccom-product-collapsible-list__collapsible-content">
					<div class="wccom-product-box__details wccom-product-box__table"><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Requires</div><div class="wccom-product-box__table-cell">WordPress 5.6 or higher</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Tested up to</div><div class="wccom-product-box__table-cell">WordPress 6.0.0</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Requires</div><div class="wccom-product-box__table-cell">WooCommerce 6.0 or higher</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Tested up to</div><div class="wccom-product-box__table-cell">WooCommerce 6.5.1</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Minimum PHP version</div><div class="wccom-product-box__table-cell">7.4.0</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Current Version</div><div class="wccom-product-box__table-cell">2.2.0</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Last Updated</div><div class="wccom-product-box__table-cell">2022/05/24</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Released</div><div class="wccom-product-box__table-cell">2014/04/10</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">100% WPML Compatible</div><div class="wccom-product-box__table-cell">yes</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Translation ready</div><div class="wccom-product-box__table-cell">yes</div></div><div class="wccom-product-box__table-row"><div class="wccom-product-box__table-cell wccom-product-box__table-detail-title">Languages</div><div class="wccom-product-box__table-cell">English</div></div></div>
				</div>
			</details>
		</div>
	);
}
