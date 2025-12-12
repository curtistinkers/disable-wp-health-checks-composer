<?php
/**
 * Tests for disable-wp-health-checks-composer.php
 *
 * @package disable_wp_health_checks_composer
 */

declare(strict_types=1);

namespace {
    // Mock add_filter to avoid WordPress dependency.
    if (! function_exists('add_filter')) {
        /**
         * Mock add_filter function for testing.
         */
        function add_filter( string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1 ): true {
            // No-op for testing.
            return true;
        }
    }
}

namespace DisableWpHealthChecksComposer\Tests {

    use PHPUnit\Framework\TestCase;
    use PHPUnit\Framework\Assert;

    /**
     * Test class for the disable_wp_health_checks_composer function.
     */
    class FunctionsTest extends TestCase {
        /**
         * Set up the test environment.
         */
        protected function setUp(): void {
            if (! defined('ABSPATH')) {
                define('ABSPATH', __DIR__ . '/');
            }
        }

        /**
         * Test that the background_updates test is disabled.
         */
        public function test_disables_background_updates_check(): void {

            // Include the plugin file to load the function.
            require_once __DIR__ . '/../disable-wp-health-checks-composer.php';

            // Mock input array with background_updates present.

            $tests = array(
                'direct' => array(
                    'wordpress_version' => array(
                        'label' => 'WordPress Version',
                        'test'  => 'wordpress_version',
                    ),
                    'php_version' => array(
                        'label' => 'PHP Version',
                        'test'  => 'php_version',
                    ),
                ),
                'async'  => array(
                    'background_updates' => array(
                        'label' => 'Background Updates',
                        'test'  => 'background_updates',
                    ),
                    'loopback_requests' => array(
                        'label' => 'Loopback Request',
                        'test'  => '/wp-json/wp-site-health/v1/tests/loopback-requests',
                    ),
                ),
            );

            // Call the function.
            $result = disable_wp_health_checks_composer($tests);

            // Assert that background_updates is removed.
            Assert::assertArrayNotHasKey('background_updates', $result['async']);

            // Assert that other tests remain.
            Assert::assertArrayHasKey('loopback_requests', $result['async']);
            Assert::assertArrayHasKey('wordpress_version', $result['direct']);
            Assert::assertArrayHasKey('php_version', $result['direct']);

            // Assert the structure is preserved.
            Assert::assertEquals($tests['direct'], $result['direct']);
            Assert::assertEquals($tests['async']['loopback_requests'], $result['async']['loopback_requests']);
        }

        /**
         * Test that the function returns the array unchanged if background_updates is not present.
         */
        public function test_returns_unchanged_if_no_background_updates(): void {

            // Include the plugin file to load the function.
            require_once __DIR__ . '/../disable-wp-health-checks-composer.php';

            // Mock input array without background_updates.
            $tests = array(
                'direct' => array(
                    'wordpress_version' => array(
                        'label' => 'WordPress Version',
                        'test'  => 'wordpress_version',
                    ),
                    'php_version' => array(
                        'label' => 'PHP Version',
                        'test'  => 'php_version',
                    ),
                ),
                'async'  => array(
                    'loopback_requests' => array(
                        'label' => 'Loopback Request',
                        'test'  => '/wp-json/wp-site-health/v1/tests/loopback-requests',
                    ),
                ),
            );

            // Call the function.
            $result = disable_wp_health_checks_composer($tests);

            // Assert the array is unchanged.
            Assert::assertEquals($tests, $result);
        }
    }
}
