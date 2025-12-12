<?php
/**
 * Function implementations for Disable WordPress Health Checks Composer.
 *
 * This file declares symbols only and must not produce side effects.
 *
 * @package disable_wp_health_checks_composer
 */

declare(strict_types=1);

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
