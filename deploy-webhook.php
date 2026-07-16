<?php
define('WEBHOOK_SECRET', '26342726929b37a24d88bc70647ebaffe3b46e7d84a928a6826fdb3ecbda47f7');

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
exec("rm -rf $deploy/.git 2>&1", $output);

http_response_code(200);
echo implode("\n", $output);
