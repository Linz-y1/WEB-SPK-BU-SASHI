<?php
// Tambahkan bagian ini ke config/auth.php yang sudah ada
// di dalam array 'guards' dan 'providers'

/*
|--------------------------------------------------------------------------
| TAMBAHKAN ke config/auth.php
|--------------------------------------------------------------------------
*/

return [

    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        // ← Tambahkan guard ini
        'siswa' => [
            'driver'   => 'session',
            'provider' => 'siswas',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        // ← Tambahkan provider ini
        'siswas' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Siswa::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],

        'siswas' => [
            'provider' => 'siswas',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];