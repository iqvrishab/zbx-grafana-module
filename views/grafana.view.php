<?php
/**
 * @var array $data
 */

$d = $data['dashboard'];
$is_admin = ($data['user']['type'] >= USER_TYPE_ZABBIX_ADMIN);

if (!$d): ?>
<div class="grafana-module">
    <p style="color: red;"><?= _('Dashboard not found.') ?></p>
    <a href="zabbix.php?action=grafana.list">← <?= _('Back to Dashboards') ?></a>
</div>
<?php return; endif;

$iframe_url = rtrim($d['grafana_url'], '/') . '/d/' . $d['dashboard_uid'];
?>

<div class="grafana-module-view">
    <div class="grafana-nav">
        <a href="zabbix.php?action=grafana.list">← <?= _('All Dashboards') ?></a>
        <?php if ($is_admin): ?>
        &nbsp;|&nbsp;
        <a href="zabbix.php?action=grafana.edit&id=<?= urlencode($d['id']) ?>">✏ <?= _('Edit') ?></a>
        &nbsp;|&nbsp;
        <a href="<?= htmlspecialchars($iframe_url) ?>" target="_blank">↗ <?= _('Open in Grafana') ?></a>
        <?php endif; ?>
        <span class="grafana-title"><?= htmlspecialchars($d['name']) ?></span>
    </div>

    <?php if (!empty($d['description'])): ?>
    <div class="grafana-desc"><?= htmlspecialchars($d['description']) ?></div>
    <?php endif; ?>

    <iframe
        src="<?= htmlspecialchars($iframe_url) ?>"
        frameborder="0"
        allowfullscreen
        class="grafana-iframe">
    </iframe>
</div>

<style>
body .grafana-module-view {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 80px);
    padding: 0;
    margin: 0;
}
.grafana-nav {
    padding: 8px 15px;
    background: #f5f5f5;
    border-bottom: 1px solid #ddd;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}
.grafana-nav a { color: #1f83c6; text-decoration: none; }
.grafana-nav a:hover { text-decoration: underline; }
.grafana-title {
    margin-left: auto;
    font-weight: bold;
    color: #333;
}
.grafana-desc {
    padding: 6px 15px;
    font-size: 12px;
    color: #888;
    background: #fafafa;
    border-bottom: 1px solid #eee;
    flex-shrink: 0;
}
.grafana-iframe {
    flex: 1;
    width: 100%;
    border: none;
    display: block;
}
</style>
