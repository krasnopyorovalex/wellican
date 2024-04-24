<?php

return [
    'thumb' => [
        'width' => (int) env('THUMB_WIDTH', 200),
        'height' => (int) env('THUMB_HEIGHT', 200),
    ],
    'origin' => [
        'width' => (int) env('ORIGIN_WIDTH', 1200),
        'height' => (int) env('ORIGIN_HEIGHT', 800),
    ],
    'persist' => [
        'object_images' => env('PERSIST_OBJECT_IMAGES', 'object-images'),
    ],
];
