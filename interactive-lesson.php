<?php
/**
 * Plugin Name:     Interactive Lesson
 * Description:     A plugin for interactive lessons with live quizzes.
 * Version:         1.0.0
 * Author:          Y0000el
 * Requires PHP:    8.3
 * Requires at least: 6.5
 */

declare(strict_types=1);

namespace InteractiveLesson;

if (!defined('ABSPATH')) {
	exit;
}
defined( 'ABSPATH' ) || exit;

// Autoload composer.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}
// Load Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';
define('IL_VERSION', '1.0.0');
define('IL_PLUGIN_FILE', __FILE__);
define('IL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('IL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('IL_ASSETS_URL', IL_PLUGIN_URL . 'assets/');
define('IL_ASSETS_DIR', IL_PLUGIN_DIR . 'assets/');
// Initialize admin functionality
add_action('plugins_loaded', function () {
	new Admin();
});
