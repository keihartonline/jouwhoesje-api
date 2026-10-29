<?php

return [
    'base_url' => env('JOUWHOESJE_API_BASE_URL'),

    'connect_timeout' => env('JOUWHOESJE_API_CONNECT_TIMEOUT', 2),

    // Korte timeout voor bezoekersverkeer (filters, enkel resultaat, kleine
    // resultaatpagina's). Zware calls zoals feeds en sitemaps houden de
    // standaard timeout.
    'read_timeout' => env('JOUWHOESJE_API_READ_TIMEOUT', 5),
];
