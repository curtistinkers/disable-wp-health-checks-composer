<?php
/**
 * Complete coverage tests for the Disable WP Health Checks Composer plugin.
 */

declare(strict_types=1);

namespace DisableWpHealthChecksComposer\Tests;

use PHPUnit\Framework\TestCase;

final class AbspathTest extends TestCase
{
    /**
     * Run in a separate process so ABSPATH state is isolated.
     *
     * @runInSeparateProcess
     */
    public function test_plugin_throws_when_abspath_not_defined(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Direct access to this file is not allowed.');

        require __DIR__ . '/../disable-wp-health-checks-composer.php';
    }
}
