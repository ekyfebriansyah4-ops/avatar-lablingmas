-- =========================================================
-- Jalankan script ini di PostgreSQL (lewat pgAdmin atau psql)
-- untuk membuat database & tabel yang dipakai contoh CRUD ini.
-- =========================================================

-- 1. Buat database (jalankan ini di luar database manapun, misal saat konek ke "postgres")
-- CREATE DATABASE granolah_intern;

-- 2. Setelah database dibuat, konek ke database "granolah_intern", lalu jalankan ini:

CREATE TABLE pegawai (
    id          SERIAL PRIMARY KEY,          -- auto increment, PK
    nama        VARCHAR(100) NOT NULL,
    jabatan     VARCHAR(100) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    no_hp       VARCHAR(20),
    created_at  TIMESTAMP DEFAULT NOW()
);

-- 3. (Opsional) Isi beberapa data contoh
INSERT INTO pegawai (nama, jabatan, email, no_hp) VALUES
('Budi Santoso', 'Staff IT', 'budi@example.com', '081234567890'),
('Siti Aminah', 'HRD', 'siti@example.com', '081298765432');
