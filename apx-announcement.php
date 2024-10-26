<?php

/**
 * Plugin Name:       Announcement
 * Plugin URI:        aptex.de
 * Description:       Publish announcements on your website and hide them when they&#39;re no longer needed
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            Aptex, Martin Staudt
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       apx-announcement
 * Domain Path:       apx-announcement
 *
 * @package Aptex
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function apx_announcement_block_init()
{
	register_block_type(__DIR__ . '/build');
}
add_action('init', 'apx_announcement_block_init');

add_filter('load_script_translation_file', function (string $file, string $handle, string $domain) {
	if (strpos($handle, 'apx-announcement') !== false && 'apx-announcement' === $domain) {
		$file = str_replace(WP_LANG_DIR . '/plugins', plugin_dir_path(__FILE__) . 'languages', $file);
	}
	return $file;
}, 10, 3);

function apx_load_plugin_textdomain()
{
	load_plugin_textdomain(
		'apx-announcement',
		false,
		plugin_basename(__FILE__) . '/languages/'
	);
}
add_action('plugins_loaded', 'apx_load_plugin_textdomain');
