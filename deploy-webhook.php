<?php
// Rotating off the secret that was previously exposed while this repo was
// public. Accept both during the transition so the pipeline doesn't break
// mid-rotation; OLD_WEBHOOK_SECRET gets dropped in the follow-up commit
// once the workflow is confirmed signing with the new one.
define('WEBHOOK_SECRET', '26342726929b37a24d88bc70647ebaffe3b46e7d84a928a6826fdb3ecbda47f7');
define('OLD_WEBHOOK_SECRET', 'bc57c7c5448143047647f382bcf8214acb0475956c94ac3d2e34cd867f397227');

$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expectedNew = 'sha256=' . hash_hmac('sha256', $payload, WEBHOOK_SECRET);
$expectedOld = 'sha256=' . hash_hmac('sha256', $payload, OLD_WEBHOOK_SECRET);

if (!hash_equals($expectedNew, $signature) && !hash_equals($expectedOld, $signature)) {
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
