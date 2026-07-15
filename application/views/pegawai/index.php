<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 30px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        h1 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #fafafa; }
        .btn { display: inline-block; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-right: 4px; }
        .btn-add { background: #2563eb; color: #fff; padding: 8px 16px; }
        .btn-edit { background: #f59e0b; color: #fff; }
        .btn-delete { background: #dc2626; color: #fff; border: none; cursor: pointer; }
        .btn-back { background: #e5e7eb; color: #111; }
        .alert { background: #dcfce7; color: #166534; padding: 10px 14px; border-radius: 4px; margin-bottom: 15px; }
        .empty { color: #888; padding: 20px 0; text-align: center; }
        .empty-text { color: #ccc; }
        .search-form { margin-top: 15px; display: flex; gap: 8px; align-items: center; }
        .search-form input[type=text] { padding: 7px 10px; border: 1px solid #ccc; border-radius: 4px; width: 260px; }
        .btn-search { background: #111827; color: #fff; padding: 7px 14px; }
    </style>
</head>
<body>
<div class="container">
    <h1><?php echo $title; ?></h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <a href="<?php echo site_url('pegawai/create'); ?>" class="btn btn-add">+ Tambah Pegawai</a>

    <form action="<?php echo site_url('pegawai'); ?>" method="get" class="search-form">
        <input type="text" name="keyword" placeholder="Cari nama pegawai..." value="<?php echo htmlspecialchars($keyword); ?>">
        <button type="submit" class="btn btn-search">Cari</button>
        <?php if (!empty($keyword)): ?>
            <a href="<?php echo site_url('pegawai'); ?>" class="btn btn-back">Reset</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Divisi</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pegawai)): ?>
                <tr><td colspan="7" class="empty">Belum ada data pegawai.</td></tr>
            <?php else: ?>
                <?php $no = 1; foreach ($pegawai as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row->nama); ?></td>
                    <td><?php echo htmlspecialchars($row->jabatan); ?></td>
                    <td><?php echo $row->nama_divisi ? htmlspecialchars($row->nama_divisi) : '<span class="empty-text">-</span>'; ?></td>
                    <td><?php echo htmlspecialchars($row->email); ?></td>
                    <td><?php echo htmlspecialchars($row->no_hp); ?></td>
                    <td>
                        <a class="btn btn-edit" href="<?php echo site_url('pegawai/edit/' . $row->id); ?>">Edit</a>
                        <form action="<?php echo site_url('pegawai/delete/' . $row->id); ?>" method="post" style="display:inline"
                              onsubmit="return confirm('Yakin hapus data ini?');">
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>