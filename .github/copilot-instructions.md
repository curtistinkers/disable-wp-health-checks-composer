<!-- GitHub Copilot / AI-agent guidance for this repository -->
# Copilot Instructions — disable-wp-health-checks-composer

This repo is a tiny Composer-packaged WordPress mu-plugin that disables specific WordPress Site Health tests when projects are managed with Composer. Keep suggestions focused, minimal, and specific to this codebase.

- **Big picture**: the package is a single-purpose MU-plugin. Main runtime file: [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php). The project is distributed as a Composer package (see [composer.json](../composer.json)).

- **Primary intent**: remove unnecessary Site Health tests for Composer-managed setups by filtering `site_status_tests`. See the hook and implementation in [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php).

- **Where to change behavior**: modify or add filters to the main plugin file. If adding classes or more complex logic, prefer placing them under `src/` and update `composer.json` with an `autoload` section (currently absent). Classes should follow WordPress naming conventions and be namespaced appropriately.

- **Project conventions**:
  - This is a minimal mu-plugin — no PSR-4 autoloading configured. Keep changes small and deliberate.
  - Coding standards use WordPress Coding Standards (WPCS). Composer scripts expose checks (see `composer.json` scripts): run `composer run phpcs` or `composer run lint`.
  - Static analysis is configured via `phpstan` in `require-dev`. Run `composer run phpstan` to run analysis.

- **Useful files**:
  - [composer.json](../composer.json) — packaging, scripts, PHP version requirement (`php >=7.0`), and dev tools configuration.
  - [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php) — main plugin code and example of filter usage.
  - `src/` — suggested place for new PHP classes if the plugin grows; currently unused.
  - `tests/` — PHPUnit tests for the plugin functionality.

- **Examples for common actions**:
  - Run code style checks: `composer run phpcs` or `composer run lint`
  - Run static analysis: `composer run phpstan`
  - Run tests: `composer run test` or `composer run phpunit`
  - Bump version: update the `version` value in [composer.json](../composer.json) and tag a Git release.

- **What to avoid**:
  - Introducing heavy frameworks or changing the packaging type (it must remain `wordpress-muplugin` unless intentionally restructured).
  - Adding autoloading without updating `composer.json` and verifying packaging behavior for MU-plugins.

- **When suggesting code changes**:
  - Provide minimal diffs/patches that edit or add a single file when possible.
  - Reference the exact hook `site_status_tests` and show the exact lines to change (example in [disable-wp-health-checks-composer.php](../disable-wp-health-checks-composer.php)).

- **Testing & validation**:
  - Manual runtime verification: install as an MU-plugin in a local WP environment and verify Site Health checks list.
  - Use `composer run phpcs` and `composer run phpstan` to validate static checks before proposing a merge.
  - Run `composer run test` to execute PHPUnit tests.

If anything here is unclear or you'd like the file to include more automation commands (CI, tests), tell me what to add and I will update this guidance.
