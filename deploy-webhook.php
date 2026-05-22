<?php
define('WEBHOOK_SECRET', 'bc57c7c5448143047647f382bcf8214acb0475956c94ac3d2e34cd867f397227');

$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expected = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);

if (!hash_equals($expected, $signature)) {
    http_response_code(403);
    exit('Forbidden');
}

$repo = '/home/freehtbn/repositories/grainnofoods';
$deploy = '/home/freehtbn/grainnofoods.com';

$output = [];
exec("cd $repo && git pull origin main 2>&1", $output);
exec("cp -R $repo/. $deploy/ 2>&1", $output);
exec("rm -rf $deploy/.git $deploy/deploy-webhook.php 2>&1", $output);

http_response_code(200);
echo implode("\n", $output);
