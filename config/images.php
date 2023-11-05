<?php

return [
    'thumb' => [
        'width' => (int) env('THUMB_WIDTH', 200),
        'height' => (int) env('THUMB_HEIGHT', 200),
    ],
    'persist' => [
        'object_images' => env('PERSIST_OBJECT_IMAGES', 'object-images'),
    ],
];
