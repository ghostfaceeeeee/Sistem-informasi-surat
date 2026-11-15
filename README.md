# Sistem Informasi Surat

Aplikasi web sederhana untuk pencatatan dan pengelolaan arsip surat masuk dan surat keluar, dibangun menggunakan Laravel 12.

Proyek ini dibuat untuk membantu pengelolaan persuratan agar pencatatan nomor surat, tanggal, pengirim, penerima, serta perihal dapat terdata dengan rapi dalam satu sistem.

## Fitur

- Dashboard ringkasan persuratan
- Manajemen data surat masuk (nomor surat, tanggal, pengirim, perihal, dan keterangan)
- Manajemen data surat keluar (nomor surat, tanggal, penerima, perihal, dan keterangan)
- Tampilan detail rincian untuk setiap surat

## Kebutuhan Sistem

- PHP >= 8.2
- Composer
- Database (MySQL / MariaDB / SQLite)
- Node.js dan npm

## Cara Menjalankan

1. Clone repositori:
   ```bash
   git clone https://github.com/ghostfaceeeeee/Sistem-informasi-surat.git
   cd Sistem-informasi-surat
   ```

2. Salin file konfigurasi environment:
   ```bash
   cp .env.example .env
   ```

3. Install dependensi:
   ```bash
   composer install
   npm install
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Sesuaikan konfigurasi database pada file `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

7. Jalankan server aplikasi:
   ```bash
   php artisan serve
   ```

Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.

## Struktur Proyek

- `app/Http/Controllers/` : Controller untuk logika surat masuk dan surat keluar
- `app/Models/` : Model Eloquent (IncomingLetter, OutgoingLetter)
- `database/migrations/` : Skema tabel database surat masuk dan surat keluar
- `resources/views/` : Template antarmuka Blade
- `routes/web.php` : Definisi rute web aplikasi

## Lisensi

Proyek ini bersifat open-source di bawah lisensi MIT.
