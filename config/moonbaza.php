<?php

return [
    'name' => 'Moonbaza',
    'tagline' => 'A game developed by wade028',

    // Where the markdown content lives, relative to the project root
    // (or an absolute path inside the container).
    'content_path' => env('MOONBAZA_CONTENT_PATH', base_path('content')),

    'nav' => [ /* ... */ ],
    'cta' => ['label' => 'Wishlist', 'url' => '#'],
];