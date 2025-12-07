<?php
/**
 * Disable WordPress Health Checks Composer
 *
 * Disables built-in WordPress health checks that aren't useful when using
 * Composer to manage your WordPress site.
 *
 * @package disable_wp_health_checks_composer
 */

declare(strict_types=1);

/**
 * Plugin Name: Disable WordPress Health Checks Composer
 * Plugin URI:  https://github.com/curtistinkers/disable-wp-health-checks-composer
 * Description: Disables unneccesary health checks for Composer managed projects
 * Version:     1.0.2
 * Author:      curtistinkers
 * Author URI:  https://curtistinkers.com/
 * License:     MIT
 */

/**
 * Disables superfluous health checks.
 *
 * @since 1.0.0
 *
 * @param array<array<string>> $tests Array of WordPress health check tests.
 *
 * @return array<array<string>> Array containing remaining tests
 */
function disable_wp_health_checks_composer( array $tests ): array {

	// Disables the Background Updates health check.
	unset( $tests['async']['background_updates'] );

	return $tests;
}

add_filter( 'site_status_tests', 'disable_wp_health_checks_composer' );
