# Disable WordPress health checks for Composer projects

Small MU-plugin that disables specific WordPress Site Health checks for projects managed with Composer.

## Features

- Disables the Background Updates Site Health test which is unnecessary in Composer-managed deployments.

## Installation

Install dependencies and project packages with Composer:

```bash
composer require curtistinkers/disable-wp-health-checks-composer
```

The package is a Composer `wordpress-muplugin` type; how it is installed into `mu-plugins` depends on your project installer configuration.

There is no runtime configuration — the plugin runs when loaded and filters the `site_status_tests` hook.

## Usage

No runtime configuration is required. The plugin unsets `async.background_updates` so the Background Updates health test does not appear in Site Health.

## Development & Testing

- PHP: `>=8.2` (see `composer.json`).
- Run code style checks: `composer run lint`
- Run static analysis: `composer run phpstan`
- Run tests: `composer run test`
- Get coverage: `composer run coverage`

CI is defined in `.github/workflows/ci.yml` and runs on PHP 8.2–8.5.

## Contributing

Contributions should be small and focused. Follow the repository coding standards (WPCS) and run the static checks before opening a PR.
