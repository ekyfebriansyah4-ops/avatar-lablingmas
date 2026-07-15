<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVATAR LABLINGMAS - DLH Kabupaten Banyumas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background-color: #198754; /* Warna hijau khas lingkungan */
            color: white;
            padding: 80px 0;
        }
        .step-box {
            background: #f8f9fa;
            border-left: 5px solid #198754;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🌳 AVATAR LABLINGMAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur">Alur Layanan</a></li>
                    <li class="nav-item"><a class="btn btn-success ms-2" href="<?= site_url('permohonan/create') ?>">Buat Permohonan</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">AVATAR LABLINGMAS</h1>
            <p class="lead">Akurat, Valid, Terpercaya Laboratorium Lingkungan Banyumas</p>
            <p>Layanan permohonan pengujian kualitas lingkungan (air, udara, kebisingan) secara mudah, cepat, dan transparan.</p>
            <a href="<?= site_url('permohonan/create') ?>" class="btn btn-light btn-lg mt-3 fw-bold text-success">Ajukan Pengujian Sekarang</a>
        </div>
    </section>

    <section id="tentang" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Mengapa Kami Hadir?</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Kabupaten Banyumas memiliki wilayah yang luas dengan kawasan perairan penting seperti Sungai Serayu[cite: 3, 4]. Dengan puluhan ribu industri dan fasilitas kesehatan yang beroperasi [cite: 6], risiko pencemaran lingkungan akibat pembuangan limbah semakin tinggi[cite: 8].</p>
                    <p>Saat ini, Indeks Kualitas Lingkungan Hidup (IKLH) Kabupaten Banyumas pada tahun 2024 berada di angka 67.00, masih di bawah rata-rata nasional[cite: 10].</p>
                    <p><strong>AVATAR LABLINGMAS</strong> hadir sebagai inovasi untuk memudahkan para pelaku usaha dan masyarakat mematuhi peraturan lingkungan melalui fasilitas pengujian laboratorium yang terakreditasi KAN, guna mencapai target IKLH 76.37 di masa depan[cite: 11, 13, 14].</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=500&q=80" alt="Laboratorium" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <section id="alur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Alur Pelayanan Permintaan Pengujian</h2>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-success mb-3">1. Tahap Administrasi</h4>
                    <div class="step-box">
                        <strong>Mengisi Formulir</strong> <br>
                        Pemohon mengisi data diri dan memilih jenis layanan secara mandiri melalui aplikasi[cite: 20].
                    </div>
                    <div class="step-box">
                        <strong>Verifikasi & Persetujuan</strong> <br>
                        Verifikasi kapasitas lab[cite: 22]. Persetujuan oleh Kepala UPTD (maksimal 1x30 menit) dan penerbitan kode bayar/QRIS jika disetujui. Jika ditolak, akan disertai alasan penolakan.
                    </div>
                    <div class="step-box">
                        <strong>Pembayaran & Sampling</strong> <br>
                        Pengambilan contoh uji oleh petugas dilakukan setelah pelunasan pembayaran dikonfirmasi.
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="text-success mb-3">2. Tahap Pengujian & Hasil</h4>
                    <div class="step-box">
                        <strong>Pengujian Laboratorium</strong> <br>
                        Penerimaan contoh uji, proses pengujian, penyeliaan, dan verifikasi hasil[cite: 38].
                    </div>
                    <div class="step-box">
                        <strong>Penerbitan LHU (TTE)</strong> <br>
                        Pembuatan Lembar Hasil Uji (LHU) resmi dengan Tanda Tangan Elektronik (TTE) selambat-lambatnya 14 hari kerja setelah pengambilan contoh uji.
                    </div>
                    <div class="step-box">
                        <strong>Survey & Unduh Hasil</strong> <br>
                        Pelanggan wajib mengisi survey kepuasan masyarakat sebelum dapat mengunduh dokumen LHU secara mandiri[cite: 34, 42].
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2026 UPTD Laboratorium Lingkungan Hidup DLH Kabupaten Banyumas. Inovasi AVATAR LABLINGMAS.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>