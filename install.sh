#!/bin/bash
# ─────────────────────────────────────────────
# Zabbix Grafana Module – Docker Installer
# Tested on Zabbix 7.x (Alpine-based Docker)
# ─────────────────────────────────────────────
set -e

CONTAINER=${1:-zabbix-web}
DEST=/usr/share/zabbix/modules/zbx-grafana-module
MODULE_DIR="$(cd "$(dirname "$0")" && pwd)"

echo "==> Installing zbx-grafana-module into container: $CONTAINER"

# Remove old version if present
docker exec -u root "$CONTAINER" rm -rf "$DEST" 2>/dev/null || true

# Copy module files
docker cp "$MODULE_DIR" "$CONTAINER":"$DEST"

# Fix permissions (alpine nginx user)
docker exec -u root "$CONTAINER" chown -R nginx:nginx "$DEST"
docker exec -u root "$CONTAINER" chmod -R 755 "$DEST"
docker exec -u root "$CONTAINER" chmod 775 "$DEST/data"

echo ""
echo "✅ Module installed successfully!"
echo ""
echo "Next steps:"
echo "  1. Open Zabbix → Administration → General → Modules"
echo "  2. Click 'Scan directory'"
echo "  3. Enable 'Grafana Dashboards'"
echo "  4. A new 'Grafana' menu item will appear in the sidebar"
echo ""
echo "Note: Make sure Grafana has 'allow_embedding = true' in grafana.ini"
