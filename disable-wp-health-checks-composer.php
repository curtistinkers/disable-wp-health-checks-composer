<?php
/**
 * Plugin Name: Disable WordPress Health Checks Composer
 * Plugin URI:  https://github.com/curtistinkers/disable-wp-health-checks-composer
 * Description: Disables unnecessary health checks for Composer managed projects
 * Version:     1.0.2
 * Author:      curtistinkers
 * Author URI:  https://curtistinkers.com/
 * License:     MIT
 *
 * @package disable_wp_health_checks_composer
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct access not allowed.' );
}

require_once __DIR__ . '/src/functions.php';

// Add a filter to disable unnecessary health checks.
add_filter( 'site_status_tests', 'disable_wp_health_checks_composer' );
