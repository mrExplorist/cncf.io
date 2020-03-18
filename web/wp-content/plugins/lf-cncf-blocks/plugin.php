<?php
/**
 * Plugin Name: LF | CNCF Blocks
 * Plugin URI: https://www.cncf.io
 * Description: Various blocks used in the CNCF.io site.
 * Author: James Hunt
 * Author URI: https://www.cncf.io
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';