<?php

return [
    'MediaTypeServices' => [
        'image' => [
            'extensions' => [
                'png', 'jpg', 'jpeg'
            ],
            'handler' => \Media\Services\ImageFileService::class,
        ],
        'video' => [
            'extensions' => [
                'mp4', 'avi', 'mkv'
            ],
            'handler' => \Media\Services\VideoFileService::class,
        ],
        'zip' => [
            'extensions' => [
                'zip', 'rar', 'tar'
            ],
            'handler' => \Media\Services\ZipFileService::class,
        ]
    ]
];
