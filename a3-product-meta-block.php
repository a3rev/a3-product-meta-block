<?php
/**
 * Plugin Name:       A3 Product Meta Block
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            mrkunau
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       a3-product-meta-block
 *
 * @package           create-block
 */

define('A3_PRODUCT_META_BLOCK_FOLDER', dirname(plugin_basename(__FILE__)));
define('A3_PRODUCT_META_BLOCK_DIR', WP_CONTENT_DIR . '/plugins/' . A3_PRODUCT_META_BLOCK_FOLDER);
define('A3_PRODUCT_META_BLOCK_PLUGIN_DIR', plugin_dir_path(__FILE__)); // The path with trailing slash
define('A3_PRODUCT_META_BLOCK_PLUGIN_NAME', plugin_basename(__FILE__));
define('A3_PRODUCT_META_BLOCK_URL', untrailingslashit(plugins_url('/', __FILE__)));
define('A3_PRODUCT_META_BLOCK_PATH', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR);
define('A3_PRODUCT_META_BLOCK_KEY', 'a3_product_meta_block');
define('A3_PRODUCT_META_BLOCK_VERSION', '0.1.0');

/**
 * Includes metas
 */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'inc/a3-product-meta-block-class.php' );

/**
 * Includes blocks
 */
include ( A3_PRODUCT_META_BLOCK_PLUGIN_DIR . 'src/index.php');
