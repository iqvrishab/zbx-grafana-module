<?php
/**
 * @var array $data
 */

$is_admin = ($data['user']['type'] >= USER_TYPE_ZABBIX_ADMIN);
$dashboards = $data['dashboards'];
?>

<div class="grafana-module">
    <h1><?= _('Grafana Dashboards') ?></h1>

    <?php if ($is_admin): ?>
    <div style="margin-bottom: 15px;">
        <a href="zabbix.php?action=grafana.edit" class="btn-alt">+ <?= _('Add Dashboard') ?></a>
    </div>
    <?php endif; ?>

    <?php if (empty($dashboards)): ?>
        <div class="nothing-to-show">
            <p><?= _('No Grafana dashboards added yet.') ?></p>
        </div>
    <?php else: ?>
    <table class="list-table">
        <thead>
            <tr>
                <th><?= _('Name') ?></th>
                <th><?= _('Grafana URL') ?></th>
                <th><?= _('Dashboard UID') ?></th>
                <th><?= _('Description') ?></th>
                <th><?= _('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($dashboards as $d): ?>
            <tr>
                <td>
                    <a href="zabbix.php?action=grafana.view&id=<?= urlencode($d['id']) ?>">
                        <?= htmlspecialchars($d['name']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($d['grafana_url']) ?></td>
                <td><?= htmlspecialchars($d['dashboard_uid']) ?></td>
                <td><?= htmlspecialchars($d['description'] ?? '') ?></td>
                <td>
                    <a href="zabbix.php?action=grafana.view&id=<?= urlencode($d['id']) ?>">View</a>
                    <?php if ($is_admin): ?>
                    &nbsp;|&nbsp;
                    <a href="zabbix.php?action=grafana.edit&id=<?= urlencode($d['id']) ?>">Edit</a>
                    &nbsp;|&nbsp;
                    <a href="zabbix.php?action=grafana.delete&id=<?= urlencode($d['id']) ?>"
                       onclick="return confirm('<?= _('Delete this dashboard?') ?>');">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<style>
.grafana-module h1 { margin-bottom: 15px; }
.grafana-module .list-table { width: 100%; border-collapse: collapse; }
.grafana-module .list-table th,
.grafana-module .list-table td { padding: 8px 12px; border: 1px solid #d0d0d0; text-align: left; }
.grafana-module .list-table th { background: #f0f0f0; font-weight: bold; }
.grafana-module .list-table tr:hover td { background: #f9f9f9; }
.grafana-module .nothing-to-show { padding: 20px; color: #888; }
.grafana-module .btn-alt {
    display: inline-block;
    padding: 6px 14px;
    background: #1f83c6;
    color: #fff;
    border-radius: 3px;
    text-decoration: none;
    font-size: 13px;
}
.grafana-module .btn-alt:hover { background: #1668a0; }
</style>
