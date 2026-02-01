<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShipmentController;

Route::get('/', function () {
    return redirect()->route('shipments.index');
});

Route::resource('shipments', ShipmentController::class)->only(['index', 'show', 'create', 'store']);
Route::post('/shipments/{id}/status', [ShipmentController::class, 'updateStatus'])->name('shipments.status.update');
