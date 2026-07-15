# Avatar LabLingMas — CRUD Permohonan Pengujian (CodeIgniter 3 + PostgreSQL)

Project ini sudah lengkap dengan framework CodeIgniter 3 + modul CRUD untuk
"Permohonan Pengujian Laboratorium Lingkungan" (menggantikan Google Form
Avatar LabLingMas milik DLH Kabupaten Banyumas). Tinggal extract, setting
database, jalankan.

## Struktur yang Ditambahkan/Diubah

```
application/
├── config/
│   ├── database.php          # SUDAH diubah: nama database -> avatar_lablingmas
│   └── routes.php             # SUDAH diubah: default_controller -> permohonan
├── controllers/
│   └── Permohonan.php         # BARU - controller CRUD permohonan
├── models/
│   └── Permohonan_model.php   # BARU - model query builder
└── views/
    └── permohonan/
        ├── index.php          # BARU - daftar + fitur pencarian
        ├── create.php         # BARU - form tambah
        └── edit.php           # BARU - form edit

assets/
└── style.css                  # BARU - styling halaman

sql/
└── create_table_permohonan.sql  # BARU - skema tabel permohonan
```

> Catatan: modul `Pegawai` (controller/model/view) dari project sebelumnya
> masih ada di dalam folder ini sebagai referensi belajar, tapi **tidak
> dipakai** oleh alur Permohonan ini. Boleh dihapus kalau tidak diperlukan.

## Cara Menjalankan

### 1. Buat database & tabel
Buka pgAdmin atau psql, jalankan:
```sql
CREATE DATABASE avatar_lablingmas;
```
Lalu konek ke database `avatar_lablingmas` tersebut dan jalankan isi file
`sql/create_table_permohonan.sql` (bisa copy-paste ke Query Tool pgAdmin, atau lewat terminal):
```bash
psql -U postgres -d avatar_lablingmas -f sql/create_table_permohonan.sql
```

### 2. Cek koneksi database
Buka `application/config/database.php`, pastikan `username` dan `password`
sesuai dengan PostgreSQL kamu:
```php
'username' => 'postgres',
'password' => 'ekyfebriansyah',   // <- ganti kalau password kamu beda
'database' => 'avatar_lablingmas',
'dbdriver' => 'postgre',          // penting: 'postgre', bukan 'postgresql'
```

### 3. Pastikan extension pdo_pgsql / pgsql aktif di PHP
```bash
php -m | grep pgsql
```
Kalau belum muncul, buka `php.ini`, hilangkan tanda `;` di depan baris:
```
;extension=pgsql
;extension=pdo_pgsql
```
lalu restart Apache/XAMPP/Laragon.

### 4. Extract folder ke web server
Taruh seluruh isi folder ini di `htdocs` (XAMPP) atau `www` (Laragon), misalnya:
```
htdocs/avatar-lablingmas/
```

### 5. Buka di browser
```
http://localhost/avatar-lablingmas/index.php/permohonan
```
Kalau kamu sudah aktifkan `mod_rewrite` dan set `index_page` kosong di
`application/config/config.php`, bisa langsung tanpa `index.php`:
```
http://localhost/avatar-lablingmas/permohonan
```

## Fitur yang Sudah Ada

- **Read** — daftar semua permohonan + fitur pencarian (nama/instansi/email)
- **Create** — form tambah dengan validasi server-side (`form_validation` CI3)
- **Update** — form edit, validasi sama seperti create
- **Delete** — hapus data dengan konfirmasi JavaScript
- Flash message sukses (session flashdata) setelah create/update/delete
- Query builder CI3 (`$this->db->...`) — aman dari SQL Injection secara otomatis

## Field yang Dipetakan dari Google Form Asli

| Field di Google Form | Kolom di Database |
|---|---|
| Nama | `nama` |
| Nomor Hp/Telepon | `no_hp` |
| Instansi | `instansi` |
| Email | `email` |
| Alamat instansi/Rumah | `alamat` |
| Tujuan pengujian | `tujuan_pengujian` |
| Koordinat lokasi sampel uji | `koordinat_lokasi` |
| Permintaan Waktu Pengambilan sampel | `tanggal_pengambilan` |

## Kalau Nanti Diminta Tambah Upload Foto/Avatar

1. Tambah kolom di tabel: `ALTER TABLE permohonan ADD COLUMN foto VARCHAR(255);`
2. Di `create.php`/`edit.php`, ubah `form_open` jadi:
   `form_open_multipart('permohonan/store')`
3. Tambah `<input type="file" name="foto">`
4. Di controller, pakai library `upload` bawaan CI3 (`$this->load->library('upload', $config)`)
   untuk proses simpan filenya ke folder `uploads/`.
