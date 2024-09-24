<?php

const routes = [
    '/'             => [\App\Controllers\HomeController::class, 'index'],
    '/order-now'    => [\App\Controllers\HomeController::class, 'orderNow'],
    '/dashboard'        =>[\App\Controllers\AdminController::class, 'orders'],
    '/order/status/update' => [\App\Controllers\AdminController::class, 'updateStatus'],
    '/order/delete' => [\App\Controllers\AdminController::class, 'deleteOrder']
];
