<?php

return [
    'base_url' => env('JOUWHOESJE_API_BASE_URL'),

    // Korte timeouts voor GET-requests, zodat hangende workers snel vrijkomen.
    'connect_timeout' => env('JOUWHOESJE_API_CONNECT_TIMEOUT', 2),
    'read_timeout' => env('JOUWHOESJE_API_READ_TIMEOUT', 5),
];
