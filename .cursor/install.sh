#!/usr/bin/env bash
#
# Idempotent repository bootstrap for the Cloud Agent environment.
# Safe to run repeatedly: every step is guarded or naturally idempotent.
set -euo pipefail

# Resolve the repository root (this script lives in <repo>/.cursor).
REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$REPO_ROOT"

# NOTE: config/config.php in the Core module eagerly reads a database-backed
# cache entry while the framework boots. On a brand-new database the `cache`
# table does not exist yet, so any artisan/composer-script invocation that runs
# before migrations would fail. Overriding CACHE_STORE=array for the bootstrap
# steps avoids that chicken-and-egg without touching application defaults.

# 1. PHP dependencies. Skip the post-autoload scripts here because package
#    discovery boots the app (see note above) before .env exists.
composer install --no-interaction --prefer-dist --no-progress --no-scripts

# 2. Environment file.
if [ ! -f .env ]; then
  cp .env.example .env
fi

# 3. Application key (only when one is not already set).
if ! grep -q '^APP_KEY=base64:' .env; then
  CACHE_STORE=array php artisan key:generate --force --ansi
fi

# 4. SQLite database file used by the default local configuration.
if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite
fi

# 5. Regenerate the optimized autoloader and run package discovery now that
#    .env exists (array cache keeps this independent of the database schema).
CACHE_STORE=array composer dump-autoload --optimize --no-interaction

# 6. Front-end dependencies and production asset build.
npm install --no-audit --no-fund
npm run build

echo "Cloud Agent install complete."
