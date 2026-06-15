<?php
/**
 * @var array $data
 */

$d = $data['dashboard'];
$is_edit = ($d['id'] !== '');
$title = $is_edit ? _('Edit Grafana Dashboard') : _('Add Grafana Dashboard');
?>

<div class="grafana-module">
    <h1><?= $title ?></h1>

    <form method="post" action="zabbix.php?action=grafana.edit">
        <input type="hidden" name="save" value="1">
        <?php if ($is_edit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($d['id']) ?>">
        <?php endif; ?>

        <table class="form-table">
            <tr>
                <th><label for="name"><?= _('Dashboard Name') ?> <span style="color:red">*</span></label></th>
                <td>
                    <input type="text" id="name" name="name"
                           value="<?= htmlspecialchars($d['name']) ?>"
                           placeholder="e.g. ISP Monitoring"
                           style="width: 400px;"
                           required autofocus>
                </td>
            </tr>
            <tr>
                <th><label for="grafana_url"><?= _('Grafana Base URL') ?> <span style="color:red">*</span></label></th>
                <td>
                    <input type="url" id="grafana_url" name="grafana_url"
                           value="<?= htmlspecialchars($d['grafana_url']) ?>"
                           placeholder="https://grafana.company.com"
                           style="width: 400px;"
                           required>
                </td>
            </tr>
            <tr>
                <th><label for="dashboard_uid"><?= _('Dashboard UID') ?> <span style="color:red">*</span></label></th>
                <td>
                    <input type="text" id="dashboard_uid" name="dashboard_uid"
                           value="<?= htmlspecialchars($d['dashboard_uid']) ?>"
                           placeholder="abc123xyz"
                           style="width: 400px;"
                           required>
                    <div style="font-size:12px;color:#888;margin-top:4px;">
                        Found in the Grafana dashboard URL: /d/<strong>UID</strong>/dashboard-name
                    </div>
                </td>
            </tr>
            <tr>
                <th><label for="description"><?= _('Description') ?></label></th>
                <td>
                    <textarea id="description" name="description"
                              placeholder="Optional description..."
                              style="width: 400px; height: 80px;"><?= htmlspecialchars($d['description'] ?? '') ?></textarea>
                </td>
            </tr>
            <?php if (!empty($d['grafana_url']) && !empty($d['dashboard_uid'])): ?>
            <tr>
                <th><?= _('Preview URL') ?></th>
                <td>
                    <a href="<?= htmlspecialchars(rtrim($d['grafana_url'], '/') . '/d/' . $d['dashboard_uid']) ?>"
                       target="_blank" style="color: #1f83c6;">
                        <?= htmlspecialchars(rtrim($d['grafana_url'], '/') . '/d/' . $d['dashboard_uid']) ?>
                    </a>
                </td>
            </tr>
            <?php endif; ?>
        </table>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-main"><?= $is_edit ? _('Update') : _('Add') ?></button>
            &nbsp;
            <a href="zabbix.php?action=grafana.list" class="btn-cancel"><?= _('Cancel') ?></a>
        </div>
    </form>
</div>

<style>
.grafana-module h1 { margin-bottom: 20px; }
.grafana-module .form-table { border-collapse: collapse; }
.grafana-module .form-table th {
    text-align: right;
    padding: 8px 15px 8px 0;
    font-weight: bold;
    vertical-align: top;
    white-space: nowrap;
    width: 180px;
}
.grafana-module .form-table td { padding: 8px 0; }
.grafana-module .form-table input[type="text"],
.grafana-module .form-table input[type="url"],
.grafana-module .form-table textarea {
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 13px;
}
.grafana-module .btn-main {
    padding: 7px 18px;
    background: #1f83c6;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 13px;
    cursor: pointer;
}
.grafana-module .btn-main:hover { background: #1668a0; }
.grafana-module .btn-cancel {
    display: inline-block;
    padding: 7px 18px;
    background: #e0e0e0;
    color: #333;
    border-radius: 3px;
    text-decoration: none;
    font-size: 13px;
}
.grafana-module .btn-cancel:hover { background: #ccc; }
</style>
