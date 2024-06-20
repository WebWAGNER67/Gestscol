<?php

// Config/config.php ou AppServiceProvider.php ou toute autre classe où vous configurez votre application

return [
    'bg_image_url' => env('APP_ENV') === 'production' ? env('BG_IMAGE_URL_PROD') : env('BG_IMAGE_URL_DEV'),
];
