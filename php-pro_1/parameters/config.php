<?php
return [
    'dbFile' => __DIR__ . '/../storage/db.json',
    'monolog' => [
        'channel' => 'general',
        'level' => [
            'error' => __DIR__ . '/../logs/error.log',
            'info' => __DIR__ . '/../logs/info.log',
        ],
    ],
    'urlConverter' => [
        'codeLength' => 8,
    ],
];
