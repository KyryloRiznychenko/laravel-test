<?php

use App\Http\Controllers\Api\DestinationController;
use Illuminate\Support\Facades\Route;

Route::prefix('destinations')
    ->name('destinations.')
    ->group(function () {
        Route::post('find', DestinationController::class)->name('find-cities-within-radius');
    });
