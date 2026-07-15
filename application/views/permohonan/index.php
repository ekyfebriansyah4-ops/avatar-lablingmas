<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Avatar LabLingMas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .navbar-brand { font-weight: 700; letter-spacing: 1px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-success shadow-sm mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1">🌳 AVATAR LABLINGMAS</span>
    </div>
</nav>

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 text-success fw-bold">Daftar Permohonan Pengujian</h5>
            <a href="<?= site_url('permohonan/create') ?>" class="btn btn-success btn-sm fw-bold">+ Tambah Permohonan</a>
        </div>
        <div class="card-body">
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('permohonan') ?>" method="GET" class="mb-4">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" class="form-control" name="keyword" value="<?= html_escape($keyword) ?>" placeholder="Cari nama, instansi, atau email...">
                    <button class="btn btn-outline-success" type="submit">Cari Data</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Email</th>
                            <th>Tujuan</th>
                            <th width="25%">Jenis Layanan</th>
                            <th>Tgl Pengambilan</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($permohonan)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Tidak ada data permohonan yang ditemukan.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($permohonan as $p): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="fw-medium"><?= html_escape($p->nama) ?></td>
                                    <td><?= html_escape($p->instansi) ?></td>
                                    <td><?= html_escape($p->email) ?></td>
                                    <td class="text-center"><span class="badge bg-secondary"><?= html_escape($p->tujuan_pengujian) ?></span></td>
                                    <td class="small"><?= html_escape($p->daftar_layanan ? $p->daftar_layanan : 'Belum ada layanan') ?></td>
                                    <td class="text-center"><?= html_escape($p->tanggal_pengambilan) ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('permohonan/edit/'.$p->id) ?>" class="btn btn-warning btn-sm text-dark fw-bold">Edit</a>
                                        <a href="<?= site_url('permohonan/delete/'.$p->id) ?>" class="btn btn-danger btn-sm fw-bold" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>