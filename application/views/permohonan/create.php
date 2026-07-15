<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Avatar LabLingMas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .form-label { font-weight: 600; color: #495057; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-success shadow-sm mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1">🌳 AVATAR LABLINGMAS</span>
    </div>
</nav>

<div class="container mb-5" style="max-width: 800px;">
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white py-3">
            <h4 class="mb-0 fw-bold">Tambah Permohonan Pengujian Baru</h4>
        </div>
        <div class="card-body p-4">

            <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

            <?= form_open('permohonan/store') ?>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama *</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>" placeholder="Nama lengkap">
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">Nomor Hp/Telepon *</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= set_value('no_hp') ?>" placeholder="Contoh: 08123456789">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="instansi" class="form-label">Instansi *</label>
                        <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Nama instansi/perorangan" value="<?= set_value('instansi') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" placeholder="email@contoh.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Instansi/Rumah *</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Tuliskan alamat lengkap..."><?= set_value('alamat') ?></textarea>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="tujuan_pengujian" class="form-label">Tujuan Pengujian *</label>
                        <select class="form-select" id="tujuan_pengujian" name="tujuan_pengujian">
                            <option value="">-- Pilih Tujuan --</option>
                            <?php foreach ($tujuan_options as $opt): ?>
                                <option value="<?= $opt ?>" <?= set_select('tujuan_pengujian', $opt) ?>><?= $opt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="koordinat_lokasi" class="form-label">Koordinat Lokasi Uji</label>
                        <input type="text" class="form-control" id="koordinat_lokasi" name="koordinat_lokasi" placeholder="-7.4218, 109.2318" value="<?= set_value('koordinat_lokasi') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_pengambilan" class="form-label">Waktu Pengambilan *</label>
                        <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" value="<?= set_value('tanggal_pengambilan') ?>">
                    </div>
                </div>

                <hr class="my-4">
                
                <h5 class="fw-bold mb-3 text-success">Jenis Layanan yang Dibutuhkan</h5>
                <p class="text-muted small mb-3">* Anda bisa memilih lebih dari satu layanan.</p>
                
                <div class="bg-light p-3 rounded border mb-4">
                    <?php foreach ($list_layanan as $l): ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="layanan[]" value="<?= $l->id ?>" id="layanan_<?= $l->id ?>">
                            <label class="form-check-label" for="layanan_<?= $l->id ?>">
                                <?= $l->nama_layanan ?> <span class="badge bg-secondary ms-1">Rp <?= number_format($l->harga, 0, ',', '.') ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-4">
                    <label for="tujuan_ipal_pertek" class="form-label">Pertanyaan Khusus Pengujian Air Limbah (Tujuan IPAL sesuai PERTEK)</label>
                    <textarea class="form-control" id="tujuan_ipal_pertek" name="tujuan_ipal_pertek" rows="2" placeholder="Contoh: Dibuang ke media air atau pemanfaatan untuk penyiraman"><?= set_value('tujuan_ipal_pertek') ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= site_url('permohonan') ?>" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-success px-5 fw-bold">Simpan Data</button>
                </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>