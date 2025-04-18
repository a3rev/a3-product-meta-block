<?php

/* whats-included */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/whats-included.php');

/* details-compatibility */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/details-compatibility.php');

/* support */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/support.php');

/* version */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/version.php');

/* documentation */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/documentation.php');

/* extension */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/extension.php');

/* call-to-action */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/call-to-action.php');

/* short-description */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/blocks/product-description.php');

add_action( 'init', '_a3_product_block_meta_enqueue_registered_block_styles' );

function _a3_product_block_meta_enqueue_registered_block_styles(){
    global $wp_scripts, $wp_styles;
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_register_style( 'a3-product-meta-block-css', A3_PRODUCT_META_BLOCK_URL .'/src/assets/css/style'. $suffix .'.css' , array(), A3_PRODUCT_META_BLOCK_VERSION, 'all'  );
    wp_register_script( 'a3-product-meta-block-script', A3_PRODUCT_META_BLOCK_URL .'/src/assets/js/script'. $suffix .'.js' , array('jquery'), false  );
}


add_filter( 'block_categories_all', '_a3_filter_block_categories_when_single_product_provided', 10, 2 );

function _a3_filter_block_categories_when_single_product_provided( $block_categories, $editor_context ) {

    if ( ! empty( $editor_context->name ) && 'core/edit-site' === $editor_context->name ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'a3-prouduct-meta-block-category',
                'title' => __( 'a3 Product Meata', 'a3-product-meta-block' ),
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="20" viewBox="0 0 240 200" style="margin-left: 7px; margin-top: -1px;"><title>Untitled-7</title><path d="M248.46,183.24v12.42c-1,16.68-12.94,24.72-25.44,32.22-4.18,2.51-9.33,1.63-13.9,3h-2.07a18.81,18.81,0,0,0-13.46,0h-3.11c-12.57-.34-21.48-8.35-31.08-14.88-8.63-5.86-17.93-9.77-28.58-8.7-11.18,1.12-22.19,2.83-31,11-3.13,2.91-7.24,4.68-10.65,7.29-6.27,4.8-13.72,4.16-20.8,4.6a113.18,113.18,0,0,1-20.63-.64c-15-1.81-23.44-11.91-31.22-23.11-1.73-2.48-1.37-5.64-1.8-8.52-1.91-12.76-.46-24.42,6.6-36.06C42.67,126.64,64,91.4,86.82,57.12,92.26,49,98.25,41.83,107.48,37.56c5.49-2.53,11.11-2.14,16.66-2.51,11.67-.79,23.45-1.44,34.24,4.8a56.64,56.64,0,0,1,19.9,19.21q30.22,48.47,60.37,97C243.88,164.48,248.1,173.12,248.46,183.24Z" transform="translate(-13.36 -34.06)" fill="#05a142"/><path d="M248.46,183.24c-16.53-41.54-45.12-76-66.86-114.52a93.72,93.72,0,0,0-13.52-18.18c-12.4-13.18-27.46-17.06-45-14.73a48,48,0,0,0-19.72,6.73A33.85,33.85,0,0,0,93,52.28c-27.59,40.24-52.8,81.94-77.21,124.14-2.54,4.39-1.48,9.17-1.13,13.63.61,7.87,2.69,15.28,8.06,21.75,13.94,16.79,31.93,20.07,52.2,16.86A27.48,27.48,0,0,0,87.29,224c4.87-3.54,10-6.7,15-10.12,14-9.69,29.41-10.58,45.32-6.6,8.17,2,14.63,7.64,21.26,12.49,6.21,4.54,12.53,8.43,20.15,10,.55.11,1,.77,1.48,1.18q-86.43,0-172.88.1c-3.55,0-4.25-.7-4.24-4.24q.21-96.28.1-192.56,115.42,0,230.86-.1c3.54,0,4.25.7,4.24,4.24C248.41,86.61,248.46,134.93,248.46,183.24Z" transform="translate(-13.36 -34.06)" fill="transparent"/><path d="M209.12,230.86c7.88-2.68,15.41-5.67,22.25-10.88a48.89,48.89,0,0,0,17.09-24.32c0,10.87-.09,21.74.06,32.61,0,2.23-.43,2.68-2.65,2.65C233.62,230.78,221.37,230.86,209.12,230.86Z" transform="translate(-13.36 -34.06)" fill="transparent"/><path d="M193.59,230.86c3.34-3,10.11-3,13.46,0h-5.18a2.41,2.41,0,0,0-3.11,0Z" transform="translate(-13.36 -34.06)" fill="#00a146"/><path d="M198.76,230.86c1-1.4,2.08-1.55,3.11,0Z" transform="translate(-13.36 -34.06)" fill="#00a146"/><path d="M110.68,118.88H122.4a15.27,15.27,0,0,0,6.13-1.36,12.27,12.27,0,0,0,3.78-2.79,8.87,8.87,0,0,0,2-3.51,13,13,0,0,0,.54-3.52v-5.41a7.29,7.29,0,0,0-2.88-6,8.52,8.52,0,0,0-11.54,0,7.29,7.29,0,0,0-2.88,6v5.59H87.79V97.79q0-9.37,3.6-15.15a25.13,25.13,0,0,1,9.11-8.83,36.76,36.76,0,0,1,12.35-4.15,82.93,82.93,0,0,1,26.68,0,36.83,36.83,0,0,1,12.35,4.15,25.1,25.1,0,0,1,9.1,8.83q3.61,5.77,3.61,15.15a105.44,105.44,0,0,1-.81,14.69,22.75,22.75,0,0,1-2.71,8.56,11.53,11.53,0,0,1-4.95,4.51,50,50,0,0,1-7.57,2.7,28,28,0,0,1,7.48,3.16A14.07,14.07,0,0,1,160.9,137a30.93,30.93,0,0,1,2.7,9.82,125.85,125.85,0,0,1,.8,15.86c0,6.25-1.19,11.31-3.59,15.14a26,26,0,0,1-9.11,8.93A35.86,35.86,0,0,1,139.35,191a82.93,82.93,0,0,1-26.68,0,35.79,35.79,0,0,1-12.35-4.24,25.73,25.73,0,0,1-9.1-8.93c-2.41-3.83-3.61-8.89-3.61-15.14v-10.1h29.74v5.78a7,7,0,0,0,2.89,5.94,8.74,8.74,0,0,0,11.53,0,7,7,0,0,0,2.89-5.94v-5.24a6.26,6.26,0,0,0-1-3.24,11.69,11.69,0,0,0-2.7-3,16.41,16.41,0,0,0-4-2.25,12.31,12.31,0,0,0-4.6-.9H110.68Z" transform="translate(-13.36 -34.06)" fill="#fff"/></svg>',
            )
        );
    }
    return $block_categories;
}


function _a3_product_block_meta_sticky_layout(){
    if( is_singular('product') ){
        global $product;

        wp_enqueue_script('a3-product-meta-block-script');

        $product_id = $product->get_ID();

        $title = $product->get_title();

        $add_to_cart = do_blocks('<!-- wp:woocommerce/add-to-cart-form /-->');

        $add_to_cart = str_replace( 'ADD TO CART', 'BUY NOW', $add_to_cart );

        $price = do_blocks('<!-- wp:woocommerce/product-price {"isDescendentOfSingleProductTemplate":true} /-->');
        ?>
        <div class="wccom-product-sticky-top-bar hidden with-monthly-pricing">
            <div class="wccom-product-sticky-top-bar__left">
                <div class="wccom-product-title">
                    <div class="wccom-product-title__product-name"><?php echo  $title; ?></div>
                    <div class="wccom-product-title__vendor">by <a href="#" target="_blank" rel="noreferrer">a3Rev</a>
                        <span class="wccom-product-title__vendor-badge"></span>
                    </div>
                </div>
            </div>
            <div class="wccom-product-sticky-top-bar__right">
                <div class="wccom-product-box__button">
                    <div class="wccom-product-price with-monthly-pricing">
                        <span class="wccom-product-price__current-previous">

                            <span class="wccom-product-price__current">
                                <?php echo $price; ?>
                                <!-- <span class="screen-reader-text">Price $19.92</span>
                                <span aria-hidden="true">$19.92</span>
                                <span class="screen-reader-text">Per month</span>
                                <span class="wccom-product-price__monthly-text" aria-hidden="true"> / month</span> -->
                            </span>
                        </span>
                        <!-- <div class="wccom-product-price-label">Billed annually at $239</div> -->
                    </div>
                    <div class="wccom-product-add-to-cart-button">
                        <!-- <a data-tracks="cart_added_click" data-tracks-has_payment_method="no" data-tracks-locale="en_US" data-tracks-position="sticky_top" data-tracks-url="https://woocommerce.com/products/woocommerce-subscriptions/?quid=cc0a3d6f7f0663e8a6f62006dc3401f0" href="?add-to-cart=27147&amp;quid=cc0a3d6f7f0663e8a6f62006dc3401f0" data-tracks-is_paid="1" class="wccom-button single_add_to_cart_button is-style-primary">
                            <span class="wccom-circular-progress wccom-button__spinner" role="progressbar"></span>
                            <div class="wccom-button__text">Buy Now</div>
                        </a> -->
                        <?php echo $add_to_cart; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="wccom-product-sticky-bottom-bar hidden">
            <div class="wccom-product-sticky-bottom-bar__left">
                <?php echo $price; ?>
                <?php echo $add_to_cart; ?>
                <a href="#single-product-sidebar" class="wccom-link wccom-product-sticky-bottom-bar__view-details is-style-link">
                    <div class="wccom-button__text">View subscription details</div>
                </a>

            </div>
        </div>
        <?php
    }
}


add_action( 'wp_footer', '_a3_product_block_meta_sticky_layout' );







