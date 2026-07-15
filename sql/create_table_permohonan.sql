-- =========================================================
-- Jalankan script ini di PostgreSQL (lewat pgAdmin atau psql)
-- untuk membuat database & tabel yang dipakai project CRUD ini.
-- =========================================================

-- 1. Buat database dulu (jalankan saat konek ke database "postgres")
-- CREATE DATABASE avatar_lablingmas;

-- 2. Setelah database dibuat, konek ke database "avatar_lablingmas", lalu jalankan ini:

CREATE TABLE IF NOT EXISTS permohonan (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    instansi VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    alamat TEXT NOT NULL,
    tujuan_pengujian VARCHAR(20) NOT NULL
        CHECK (tujuan_pengujian IN ('Permintaan', 'Aduan', 'Penelitian')),
    koordinat_lokasi VARCHAR(150),
    tanggal_pengambilan DATE NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 3. (Opsional) Isi beberapa data contoh
INSERT INTO permohonan
    (nama, no_hp, instansi, email, alamat, tujuan_pengujian, koordinat_lokasi, tanggal_pengambilan)
VALUES
    ('Budi Santoso', '081234567890', 'PT Sumber Makmur', 'budi@example.com',
     'Jl. Jendral Sudirman No. 10, Purwokerto', 'Permintaan', '-7.4218, 109.2318', '2026-07-20'),
    ('Siti Aminah', '082198765432', 'Perorangan', 'siti@example.com',
     'Jl. Gerilya No. 5, Purwokerto', 'Aduan', '-7.4250, 109.2400', '2026-07-22');
