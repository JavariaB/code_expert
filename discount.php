<?php

if (!(isset($_GET['ref']) && !empty($_GET['ref']))) {
    die(json_encode([
        'success' => false,
        'code' => 403,
        'message' => 'Unathorized'
    ]));
}

echo json_encode([
    'success' => true,
    'code' => 200,
    'message' => 'Your voucher has been collected.',
    'data' => [
        'discount' => 100,
        'currency' => 'pkr'
    ]
]);

