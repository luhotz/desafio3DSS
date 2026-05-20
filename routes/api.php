<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/saludo', function () {
    return response()->json([
        'app' => 'CanchApp Reservas',
        'mensaje' => 'API de prueba funcionando correctamente.'
    ]);
});
