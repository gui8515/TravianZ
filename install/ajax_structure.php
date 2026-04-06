<?php
// install/ajax_structure.php
// Streams DB structure creation progress via SSE.

require_once __DIR__ . '/include/i18n.php';

if (file_exists(__DIR__ . '/../var/installed')) {
    http_response_code(409);
    header('Content-Type: text/plain; charset=utf-8');
    echo install_t('index_err_installed', 'Installation appears to have been completed.');
    exit;
}

require_once __DIR__ . '/../GameEngine/config.php';
require_once __DIR__ . '/../GameEngine/Database.php';
require_once __DIR__ . '/../GameEngine/Admin/database.php';

header('Content-Type: text/event-stream; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
header('Connection: keep-alive');
header('X-Accel-Buffering: no');

@ini_set('zlib.output_compression', '0');
@ini_set('output_buffering', 'off');
@ini_set('implicit_flush', '1');
@set_time_limit(0);

while (ob_get_level() > 0) {
    @ob_end_flush();
}
ob_implicit_flush(true);

if (session_status() === PHP_SESSION_ACTIVE) {
    @session_write_close();
}

function sse_send(array $payload) {
    echo 'data: ' . json_encode($payload, JSON_UNESCAPED_SLASHES) . "\n\n";
    @ob_flush();
    @flush();
}

function sse_ping() {
    echo ":\n\n";
    @ob_flush();
    @flush();
}

$lastPing = time();

$reporter = function ($done, $total, $pct, $message) use (&$lastPing) {
    sse_send([
        'done' => (int) $done,
        'total' => (int) $total,
        'pct' => (int) $pct,
        'msg' => (string) $message,
    ]);

    if (time() - $lastPing >= 10) {
        sse_ping();
        $lastPing = time();
    }

    if (connection_aborted()) {
        exit;
    }
};

global $database;

sse_send([
    'done' => 0,
    'total' => 0,
    'pct' => 0,
    'msg' => install_t('dataform_sse_starting', 'Starting database structure creation...'),
]);

$result = $database->createDbStructure($reporter);

if ($result === true) {
    sse_send([
        'done' => 1,
        'total' => 1,
        'pct' => 100,
        'ok' => true,
        'msg' => install_t('dataform_sse_done', 'Database structure created successfully.'),
        'next' => 'index.php?s=3',
    ]);
    exit;
}

if ($result === false) {
    sse_send([
        'done' => 0,
        'total' => 0,
        'pct' => 0,
        'error' => true,
        'code' => 'existing',
        'msg' => install_t('dataform_sse_existing', 'Existing structure was found in the database. Remove old game tables and try again.'),
    ]);
    exit;
}

sse_send([
    'done' => 0,
    'total' => 0,
    'pct' => 0,
    'error' => true,
    'code' => 'import',
    'msg' => install_t('dataform_sse_import_fail', 'Error importing database structure. Check configuration and SQL permissions.'),
]);
exit;
