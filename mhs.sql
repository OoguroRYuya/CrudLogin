-- 1. Buat Database
CREATE DATABASE IF NOT EXISTS mhs;
USE mhs;

-- 2. Buat Tabel 'identitas'
CREATE TABLE identitas (
    npm VARCHAR(12) PRIMARY KEY,
    nama VARCHAR(20) NOT NULL,
    alamat VARCHAR(100) NOT NULL,
    jk CHAR(1) CHECK (jk IN ('L', 'P')),
    tgl_lhr DATE NOT NULL,
    email VARCHAR(40) UNIQUE
);

-- 3. Buat Tabel 'users'
CREATE TABLE users (
    username VARCHAR(20) PRIMARY KEY,
    pass VARCHAR(100) NOT NULL,
    npm VARCHAR(12),
    level CHAR(1) CHECK (level IN ('1', '2')),
    FOREIGN KEY (npm) REFERENCES identitas(npm) ON DELETE SET NULL
);

-- 4. Entri Data Contoh ke Tabel 'identitas'
INSERT INTO identitas (npm, nama, alamat, jk, tgl_lhr, email) VALUES
('123456789012', 'Budi', 'Jl. Anggrek No. 12', 'L', '2000-01-15', 'budi@mail.com'),
('987654321098', 'Siti', 'Jl. Melati No. 10', 'P', '1999-05-25', 'siti@mail.com');

-- 5. Entri Data Contoh ke Tabel 'users' (Menggunakan MD5 untuk Demonstrasi)
INSERT INTO users (username, pass, npm, level) VALUES
('budi123', MD5('password123'), '123456789012', '1'),  -- User Biasa
('admin1', MD5('adminpassword'), NULL, '2');            -- Admin

-- 6. Verifikasi Data
SELECT * FROM identitas;
SELECT * FROM users;
