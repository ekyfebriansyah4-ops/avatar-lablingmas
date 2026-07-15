<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 30px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        label { display: block; margin-top: 12px; margin-bottom: 4px; font-weight: bold; font-size: 14px; }
        input[type=text], input[type=email], select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 4px; text-decoration: none; margin-top: 18px; border: none; cursor: pointer; font-size: 14px; }
        .btn-save { background: #2563eb; color: #fff; }
        .btn-back { background: #e5e7eb; color: #111; margin-left: 6px; }
        .error { color: #dc2626; font-size: 13px; margin-top: 15px; }
    </style>
</head>
<body>
<div class="container">
    <h1><?php echo $title; ?></h1>

    <?php echo validation_errors('<div class="error">', '</div>'); ?>

    <form action="<?php echo site_url('pegawai/update/' . $pegawai->id); ?>" method="post">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo set_value('nama', $pegawai->nama); ?>">

        <label for="jabatan">Jabatan</label>
        <input type="text" id="jabatan" name="jabatan" value="<?php echo set_value('jabatan', $pegawai->jabatan); ?>">

        <label for="divisi_id">Divisi</label>
        <select id="divisi_id" name="divisi_id">
            <option value="">-- Pilih Divisi --</option>
            <?php foreach ($divisi as $d): ?>
                <option value="<?php echo $d->id; ?>" <?php echo set_select('divisi_id', $d->id, ($pegawai->divisi_id == $d->id)); ?>>
                    <?php echo htmlspecialchars($d->nama_divisi); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo set_value('email', $pegawai->email); ?>">

        <label for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo set_value('no_hp', $pegawai->no_hp); ?>">

        <button type="submit" class="btn btn-save">Update</button>
        <a href="<?php echo site_url('pegawai'); ?>" class="btn btn-back">Batal</a>
    </form>
</div>
</body>
</html>