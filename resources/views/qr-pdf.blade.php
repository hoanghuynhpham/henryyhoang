<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Mã QR PDF</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- QRCode.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow p-5">
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-6 pe-3">
                    <div class="row row-cols-3 g-3 mb-4 text-center">
                        <div><i class="fas fa-link fa-lg"></i><p>URL</p></div>
                        <div><i class="fas fa-id-card fa-lg"></i><p>VCARD</p></div>
                        <div><i class="fas fa-file-alt fa-lg"></i><p>VĂN BẢN</p></div>
                        <div><i class="fas fa-envelope fa-lg"></i><p>E-MAIL</p></div>
                        <div><i class="fas fa-sms fa-lg"></i><p>SMS</p></div>
                        <div><i class="fas fa-wifi fa-lg"></i><p>WIFI</p></div>
                        <div><i class="fab fa-bitcoin fa-lg"></i><p>BITCOIN</p></div>
                        <div><i class="fab fa-facebook fa-lg"></i><p>FACEBOOK</p></div>
                        <div class="text-primary"><i class="fas fa-file-pdf fa-lg"></i><p>PDF</p></div>
                        <div><i class="fas fa-music fa-lg"></i><p>MP3</p></div>
                        <div><i class="fas fa-store fa-lg"></i><p>CỬA HÀNG ỨNG DỤNG</p></div>
                        <div><i class="fas fa-image fa-lg"></i><p>HÌNH ẢNH</p></div>
                    </div>

                    <h4 class="fw-bold text-center mb-4">Tạo Mã QR PDF</h4>
                    <form id="qrForm" action="{{ route('generate.qr.pdf') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Chọn tệp PDF:</label>
                            <input type="file" name="pdf_file" class="form-control" required accept="application/pdf">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-qrcode"></i> Tạo Mã QR PDF
                        </button>
                    </form>
                </div>

                <!-- QR Code Section -->
                <div class="col-md-6 text-center d-flex flex-column justify-content-center">
                    <div class="card p-4 border">
                        <div id="qrCode" class="mx-auto mb-3"></div>
                        <p class="fw-bold">SCAN ME</p>
                        <button id="download-jpg" class="btn btn-primary w-100">
                            <i class="fas fa-download"></i> Tải Xuống .JPG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('qrForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('generate.qr.pdf') }}", {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json()) // Đọc JSON từ server
            .then(data => {
                if (data.pdfUrl) {
                    document.getElementById('qrCode').innerHTML = "";
                    new QRCode(document.getElementById("qrCode"), {
                        text: data.pdfUrl,
                        width: 200,
                        height: 200
                    });
                } else {
                    alert("Lỗi khi tạo mã QR! Hãy thử lại.");
                }
            })
            .catch(error => console.error('Lỗi:', error));
        });

        document.getElementById('download-jpg').addEventListener('click', function() {
            const qrCanvas = document.querySelector('#qrCode canvas');
            if (qrCanvas) {
                const link = document.createElement('a');
                link.download = 'pdf-qr-code.jpg';
                link.href = qrCanvas.toDataURL('image/jpeg');
                link.click();
            } else {
                alert('Vui lòng tạo mã QR trước!');
            }
        });
    </script>

</body>
</html>
