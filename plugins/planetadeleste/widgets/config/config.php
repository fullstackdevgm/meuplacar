<?php

return [
    'autosize' => [
        'models'     => [
            '\RainLab\User\Models\User' => 'avatar',
            '\RainLab\Blog\Models\Post' => ['featured_images', 'content_images']
        ],
        'max_width'  => 1920,
        'max_height' => 1080
    ]
];