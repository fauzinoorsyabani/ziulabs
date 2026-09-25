#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
APP_DIR="$ROOT_DIR/php-app"

if ! command -v php >/dev/null 2>&1; then
  printf 'Error: PHP 8.2 or newer is required, but php was not found in PATH.\n' >&2
  exit 1
fi

PHP_VERSION_ID="$(php -r 'echo PHP_VERSION_ID;')"
if (( PHP_VERSION_ID < 80200 )); then
  printf 'Error: PHP 8.2 or newer is required (found %s).\n' "$(php -r 'echo PHP_VERSION;')" >&2
  exit 1
fi

cd "$APP_DIR"
printf 'Starting Geo Booster at http://127.0.0.1:8080\nPress Ctrl+C to stop.\n'
exec php -S 127.0.0.1:8080 -t public
