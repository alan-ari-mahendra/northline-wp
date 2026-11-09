#!/usr/bin/env bash
# ONE-TIME migration: local WordPress -> VPS. Run from the repo root on the local machine (WSL).
# Requires: server-setup.sh already run; SSH alias `sukun-vps-brata` (root) and the deploy key.
# NOTE: PHP not available in WSL — run steps manually per PLAYBOOK.md.
set -euo pipefail
ROOT_HOST="${ROOT_HOST:-sukun-vps-brata}"
DEPLOY_HOST="${DEPLOY_HOST:-46.250.232.141}"
DEPLOY_KEY="${DEPLOY_KEY:-/tmp/northline-ci-deploy}"
OLD_URL="${OLD_URL:-http://northline-wp.local}"
PROJECT="${PROJECT:-northline}"
SITE_PORT="${SITE_PORT:-8637}"
NEW_URL="${NEW_URL:-http://$DEPLOY_HOST$([ "$SITE_PORT" != 80 ] && echo ":$SITE_PORT")}"
REMOTE_ROOT="/var/www/$PROJECT"
MU_PLUGIN_DIR="${MU_PLUGIN_DIR:-northline-assets}"
TMP="$(mktemp -d)"; trap 'rm -rf "$TMP"' EXIT
DSSH="ssh -i $DEPLOY_KEY -o IdentitiesOnly=yes -o BatchMode=yes"
RW() { printf 'set -e; cd %s && %s\n' "$REMOTE_ROOT" "$*" | ssh -o BatchMode=yes "$ROOT_HOST" "runuser -u deploy -- bash -l -s"; }

echo "==> rsync wp-content (plugins/themes/uploads; mu-plugins deployed by deploy.sh after)"
rsync -az --no-owner --no-group --chmod=Du=rwx,Dgo=rx,Fu=rw,Fgo=r \
  --exclude='/cache' --exclude='/upgrade' --exclude='*.log' --exclude='debug.log' \
  --exclude="/mu-plugins/$MU_PLUGIN_DIR" \
  --exclude='/plugins/index.php' \
  -e "$DSSH" wp-content/ "deploy@$DEPLOY_HOST:$REMOTE_ROOT/wp-content/"
$DSSH "deploy@$DEPLOY_HOST" "chmod -R g+w $REMOTE_ROOT/wp-content/uploads; mkdir -p $REMOTE_ROOT/wp-content/cache"

echo "==> wp-config.php (DB credentials stay on the server)"
ssh -o BatchMode=yes "$ROOT_HOST" "set -e; . /root/$PROJECT-db.env; cd $REMOTE_ROOT;
  [ -f wp-config.php ] || runuser -u deploy -- wp config create --dbname=\"\$DB_NAME\" --dbuser=\"\$DB_USER\" --dbpass=\"\$DB_PASS\" --dbprefix='wp_' --dbcharset=utf8mb4 --skip-check --extra-php <<'PHP'
define( 'WP_HOME', '$NEW_URL' );
define( 'WP_SITEURL', '$NEW_URL' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISABLE_WP_CRON', true );
define( 'WP_ENVIRONMENT_TYPE', 'production' );
define( 'FS_METHOD', 'direct' );
define( 'WP_MEMORY_LIMIT', '256M' );
PHP
  chmod 640 wp-config.php; chown deploy:www-data wp-config.php"

echo "==> import DB (SQL file must already be at /tmp/${PROJECT}-local.sql on server)"
RW "wp db import /tmp/${PROJECT}-local.sql && rm -f /tmp/${PROJECT}-local.sql"

echo "==> URL rewrite $OLD_URL -> $NEW_URL"
RW "wp search-replace '$OLD_URL' '$NEW_URL' --all-tables --skip-columns=guid --report-changed-only"

echo "==> first deploy of mu-plugin assets"
DEPLOY_HOST="$DEPLOY_HOST" DEPLOY_USER=deploy REMOTE_ROOT="$REMOTE_ROOT" PROJECT="$PROJECT" \
MU_PLUGIN_DIR="$MU_PLUGIN_DIR" SSH_OPTS="-i $DEPLOY_KEY -o IdentitiesOnly=yes" SITE_URL="$NEW_URL" \
bash deploy/deploy.sh || true

echo "==> also rsync mu-plugin loader and northline-setup.php"
rsync -az --no-owner --no-group --chmod=Fu=rw,Fgo=r \
  -e "$DSSH" wp-content/mu-plugins/northline-assets.php \
  "deploy@$DEPLOY_HOST:$REMOTE_ROOT/wp-content/mu-plugins/northline-assets.php"
rsync -az --no-owner --no-group --chmod=Fu=rw,Fgo=r \
  -e "$DSSH" northline-setup.php \
  "deploy@$DEPLOY_HOST:$REMOTE_ROOT/northline-setup.php"

echo "==> finalize (permalinks, cache, no-index until domain)"
RW "wp option update blog_public 0; wp rewrite structure '/%postname%/'; wp rewrite flush; wp cache flush"
echo "MIGRATION_DONE -> $NEW_URL  (change the admin password!)"
