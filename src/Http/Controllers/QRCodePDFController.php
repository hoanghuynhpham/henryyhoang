<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QRCodePDFController extends Controller
{
    public function index()
    {
        return view('qr-pdf');
    }

    public function generateQRCode(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240'
        ]);

        // Lưu file vào thư mục storage
        $path = $request->file('pdf_file')->store('pdfs', 'public');

        // Tạo URL tải xuống
        $pdfUrl = asset('storage/' . $path);

        return response()->json(['pdfUrl' => $pdfUrl]);
    }
}
