<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'subscriptions',
    'as' => 'subscriptions.',
], function () {
    Route::post('/', \App\Http\Controllers\Api\Subscriptions\StoreController::class)->name('store');
});
