#!/usr/bin/env bash
#
# Per-boot reconciliation. Runs on every environment start, must be idempotent,
# and returns once the database schema is in place.
set -euo pipefail

REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$REPO_ROOT"

# Ensure the SQLite database file exists (in case the boot starts from a clean
# volume without the install-time artifact).
if [ ! -f database/database.sqlite ]; then
  touch database/database.sqlite
fi

# Apply any pending migrations. CACHE_STORE=array keeps this safe on a
# brand-new database whose `cache` table does not exist yet (see install.sh).
# `migrate --force` is a no-op when the schema is already current.
CACHE_STORE=array php artisan migrate --force --ansi

echo "Cloud Agent start reconciliation complete."
