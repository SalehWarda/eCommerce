<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 5000,
        'toast' => true,
        'showCancelButton' => false,
        'onDismissed' => '',
        'cancelButtonText' => 'Cancel',
        'showDenyButton' => false,
        'onDenied' => '',
        'text' => '',
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'cancelButtonText' => 'No',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33'
    ]
];
