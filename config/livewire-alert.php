<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert' => [
        'position' => 'top-end',
        'timer' => 1500,
        'toast' => true,
        'text' => null,
        'showCancelButton' => false,
        'showConfirmButton' => false
    ],
    'confirm' => [
        'icon' => 'warning',
        'position' => 'center',
        'toast' => false,
        'timer' => null,
        'showConfirmButton' => true,
        'showCancelButton' => true,
        'confirmButtonText' => 'Si, eliminar',
        'cancelButtonText' => 'No, regresar',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'onCancelled' => 'cancelled',
        'onConfirmed' => 'destroy',
    ]
];
