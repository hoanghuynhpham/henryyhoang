<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodePDFController;

Route::get('/qr-pdf', [QRCodePDFController::class, 'index'])->name('qr.pdf');
Route::post('/generate-qr-pdf', [QRCodePDFController::class, 'generateQRCode'])->name('generate.qr.pdf');
