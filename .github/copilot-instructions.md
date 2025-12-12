<!-- GitHub Copilot / AI-agent guidance for this repository -->
# Copilot Instructions — disable-wp-health-checks-composer

This repo is a tiny Composer-packaged WordPress MU-plugin that disables specific WordPress Site Health tests when projects are managed with Composer. Keep suggestions focused, minimal, and specific to this codebase.

- **Big picture**: single-purpose MU-plugin. Main runtime file: [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php). Package metadata and scripts are in [composer.json](../composer.json).

- **Primary intent**: remove unnecessary Site Health tests for Composer-managed setups by filtering `site_status_tests`. See the hook in [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php) and the implementation in `src/functions.php`.

- **Where to change behavior**: modify the filter in the main plugin file or update `src/functions.php`. If introducing classes, place them under `src/` and update `composer.json` `autoload` when appropriate. Use WordPress naming and namespacing conventions.

- **Project specifics discovered**:
  - PHP requirement: `php >=8.2` (see `composer.json`).
  - Package `type`: `wordpress-muplugin`.
  - CI: [`.github/workflows/ci.yml`](../.github/workflows/ci.yml) runs on PHP 8.2–8.5 and executes `composer install`, `composer run phpcs`, `composer run phpstan`, and `composer run coverage`.
  - PHPStan: configuration in `phpstan.neon.dist` sets `level: max` and analyzes `disable-wp-health-checks-composer.php`, `src/`, and `tests/`.
  - Tests: PHPUnit config present (`phpunit.xml.dist`) and test files live under `tests/`.

- **Project conventions**:
  - Keep changes small — this is a minimal mu-plugin with no PSR-4 autoloading by default.
  - Coding standards: WP-Coding-Standards (WPCS) for most files and PSR-12 for test files. Run `composer run phpcs` or `composer run lint`.
  - Static analysis: Run `composer run phpstan` (uses `phpstan.neon.dist`).

- **Useful files**:
  - [composer.json](../composer.json) — dependency and script definitions (includes `phpstan`, `phpcs`, `phpunit`, `coverage`, and a `full-test` script).
  - [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php) — plugin bootstrap, protects against direct access, and registers `site_status_tests` filter.
  - [src/functions.php](../src/functions.php) — contains `disable_wp_health_checks_composer()` which unsets `async.background_updates`.
  - [.github/workflows/ci.yml](../.github/workflows/ci.yml) — CI matrix and steps.
  - `tests/` — PHPUnit tests (e.g., `AbspathTest.php`, `FunctionsTest.php`).

- **Examples for common actions**:
  - Run code style checks: `composer run phpcs` or `composer run lint`
  - Run static analysis: `composer run phpstan`
  - Run tests: `composer run test` or `composer run phpunit`
  - Bump version: update the `version` value in [composer.json](../composer.json) and tag a Git release.
  - Get coverage text output: `composer run coverage`
  - Run full pipeline locally: `composer run phpcs && composer run phpstan && composer run test`

- **What to avoid**:
  - Introducing heavy frameworks or changing the packaging type (keep `type: wordpress-muplugin`).
  - Adding autoloading without updating `composer.json` and validating packaging for MU-plugins.

- **When suggesting code changes**:
  - Provide minimal diffs/patches that edit or add a single file where possible.
  - Reference the exact hook `site_status_tests` and show the lines to change (see [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php)).

- **Testing & validation**:
  - Manual runtime verification: install as an MU-plugin in a local WP environment and verify Site Health checks list.
  - Use `composer run phpcs` and `composer run phpstan` before proposing merges.
  - Run `composer run test` to execute PHPUnit tests and `composer run coverage` for coverage output.

If you'd like this guidance expanded (CI details, suggested PR template, or contribution checklist), tell me which parts to include and I will update this file.
