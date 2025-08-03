<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => 'web', // default untuk pengguna biasa (frontend/mobile)
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        // Guard untuk user biasa (web atau mobile)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard untuk admin (akses dashboard web)
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        // Guard untuk API user (token-based)
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'users',
        ],

        // Guard untuk konselor (mobile via token)
        'konselor-api' => [
            'driver' => 'sanctum',
            'provider' => 'konselors', // Nama provider yang akan kita buat di bawah
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        // Admin model
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // Pengguna biasa (user frontend/mobile)
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Konselor model
        'konselors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Konselor::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'konselors' => [
            'provider' => 'konselors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */
    'password_timeout' => 10800,

];
