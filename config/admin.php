<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi khusus untuk admin panel
    |
    */

    'secret' => env('ADMIN_SECRET', 'admin12345'),
    'url_prefix' => 'admin',
    'login_url' => 'admin/login',
    'dashboard_url' => 'admin/dashboard',
];
