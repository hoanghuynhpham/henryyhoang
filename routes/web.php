<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

Route::get('/wifi-qr', [QrCodeController::class, 'index'])->name('wifi.qr');
Route::post('/wifi-qr/generate', [QrCodeController::class, 'generate'])->name('generate.qr');
Route::get('/download-qr', [QrCodeController::class, 'download'])->name('download.qr');
