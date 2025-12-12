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

    /**
     * Test class for the disable_wp_health_checks_composer function.
     */
    class DisableWpHealthChecksComposerTest extends TestCase {
    /**
     * Test that the background_updates test is disabled.
     */
    public function test_disables_background_updates_check() {

        // Include the plugin file to load the function.
        require_once __DIR__ . '/../disable-wp-health-checks-composer.php';

        // Mock input array with background_updates present.
        $tests = array(
            'async'  => array(
                'background_updates' => array(
                    'label' => 'Background updates',
                    'test'  => 'background_updates_test',
                ),
                'other_test'         => array(
                    'label' => 'Other test',
                    'test'  => 'other_test_function',
                ),
            ),
            'direct' => array(
                'some_direct_test' => array(
                    'label' => 'Direct test',
                    'test'  => 'direct_test_function',
                ),
            ),
        );

        // Call the function.
        $result = disable_wp_health_checks_composer($tests);

        // Assert that background_updates is removed.
        $this->assertArrayNotHasKey('background_updates', $result['async']);

        // Assert that other tests remain.
        $this->assertArrayHasKey('other_test', $result['async']);
        $this->assertArrayHasKey('some_direct_test', $result['direct']);

        // Assert the structure is preserved.
        $this->assertEquals($tests['direct'], $result['direct']);
        $this->assertEquals($tests['async']['other_test'], $result['async']['other_test']);
    }

    /**
     * Test that the function returns the array unchanged if background_updates is not present.
     */
    public function test_returns_unchanged_if_no_background_updates() {

        // Include the plugin file to load the function.
        require_once __DIR__ . '/../disable-wp-health-checks-composer.php';

        // Mock input array without background_updates.
        $tests = array(
            'async'  => array(
                'other_test' => array(
                    'label' => 'Other test',
                    'test'  => 'other_test_function',
                ),
            ),
            'direct' => array(
                'some_direct_test' => array(
                    'label' => 'Direct test',
                    'test'  => 'direct_test_function',
                ),
            ),
        );

        // Call the function.
        $result = disable_wp_health_checks_composer($tests);

        // Assert the array is unchanged.
        $this->assertEquals($tests, $result);
    }
    }

}
