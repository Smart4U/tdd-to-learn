<?php

$debug = (getenv('APP_ENV') === 'dev') ? true : false;

return [
    // APP
    'app.debug' => $debug,
    'app.domain' => getenv('APP_HOST')
];