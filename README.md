# zbx-grafana-module

A Zabbix 7.x frontend module that embeds Grafana dashboards directly inside the Zabbix UI — no tab switching needed.

![Zabbix 7.x](https://img.shields.io/badge/Zabbix-7.x-red) ![PHP 8.x](https://img.shields.io/badge/PHP-8.x-blue) ![License MIT](https://img.shields.io/badge/License-MIT-green)

---

## Features

- **Sidebar menu** — Grafana → Dashboards / Add Dashboard
- **Add dashboards** by name, Grafana URL, and Dashboard UID
- **Embedded iframe viewer** — full width/height inside Zabbix
- **Edit & Delete** — admin-only
- **View** — all users
- **Persistent storage** via `data/dashboards.json`

---

## Requirements

| Component | Version |
|-----------|---------|
| Zabbix    | 7.x     |
| PHP       | 8.x     |
| Docker    | Any     |

Grafana must allow iframe embedding. Add to `grafana.ini`:

```ini
[security]
allow_embedding = true
```

If using SSO / cookies across domains:

```ini
cookie_samesite = none
```

---

## Installation (Docker – One Command)

```bash
git clone https://github.com/iqvrishab/zbx-grafana-module.git
cd zbx-grafana-module
bash install.sh
```

> By default targets the `zabbix-web` container. Pass a different name as argument:
> ```bash
> bash install.sh my-zabbix-web-container
> ```

---

## Manual Installation

```bash
# 1. Clone
git clone https://github.com/iqvrishab/zbx-grafana-module.git ~/zbx-grafana-module

# 2. Copy into container
sudo docker cp ~/zbx-grafana-module zabbix-web:/usr/share/zabbix/modules/zbx-grafana-module

# 3. Fix permissions
sudo docker exec -u root zabbix-web chown -R nginx:nginx /usr/share/zabbix/modules/zbx-grafana-module

# 4. Enable in Zabbix UI
# Administration → General → Modules → Scan directory → Enable
```

---

## Making It Persistent (Survive Restarts)

Add a volume to your `docker-compose.yml`:

```yaml
services:
  zabbix-web:
    volumes:
      - ./zbx-grafana-module:/usr/share/zabbix/modules/zbx-grafana-module
```

---

## Usage

1. Go to **Grafana → Add Dashboard** in the Zabbix sidebar
2. Fill in:
   - **Dashboard Name** — e.g. `ISP Monitoring`
   - **Grafana Base URL** — e.g. `https://grafana.company.com`
   - **Dashboard UID** — e.g. `abc123xyz`
   - **Description** — optional
3. Click **Add**
4. Dashboard appears in **Grafana → Dashboards**
5. Click a dashboard name to view it embedded inside Zabbix

---

## Permissions

| Action           | Admin | User |
|-----------------|-------|------|
| View Dashboard   | ✅    | ✅   |
| Add Dashboard    | ✅    | ❌   |
| Edit Dashboard   | ✅    | ❌   |
| Delete Dashboard | ✅    | ❌   |

---

## File Structure

```
zbx-grafana-module/
├── actions/
│   ├── ActionGrafanaList.php
│   ├── ActionGrafanaEdit.php
│   ├── ActionGrafanaDelete.php
│   └── ActionGrafanaView.php
├── views/
│   ├── grafana.list.php
│   ├── grafana.edit.php
│   └── grafana.view.php
├── data/
│   └── dashboards.json
├── Module.php
├── manifest.json
├── install.sh
└── README.md
```

---

## Author

**Vrishab Rayu** — [github.com/iqvrishab](https://github.com/iqvrishab)

---

## License

MIT
