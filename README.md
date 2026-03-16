# Kako Live Top Up Platform (Laravel 10)

Production-ready digital top-up website untuk penjualan koin **Kako Live** dengan tema premium **BLACK & GOLD**.

## Fitur Utama
- Landing page modern (Beranda, Cara Top Up, Panduan, Kontak, Login, Register)
- Top up flow (input user ID, pilih paket, checkout)
- Midtrans Snap API (`/create-transaction`) + callback webhook (`/midtrans/callback`)
- Pelacakan status order berdasarkan `order_id`
- Register/Login/Logout
- Referral system + komisi 5%
- Wallet balance + riwayat komisi
- Withdraw (min Rp50.000) via bank/e-wallet
- User dashboard
- Admin dashboard + manajemen order, produk, referral, withdraw

## Stack
- Backend: Laravel 10, PHP 8+
- Frontend: Blade, TailwindCSS, Alpine.js
- Database: MySQL
- Payment: Midtrans Snap API

## Struktur Utama
- `app/Http/Controllers` (landing, topup, checkout, payment, dashboard, admin)
- `app/Models` (User, Product, Order, Payment, Referral, Wallet, WalletTransaction, Withdrawal)
- `routes/web.php`
- `resources/views/...`
- `database/migrations/...`
- `database/seeders/DatabaseSeeder.php`

## Setup Local
1. Install dependency:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```
2. Atur `.env` (DB dan Midtrans).
3. Migrasi + seed:
   ```bash
   php artisan migrate --seed
   ```
4. Jalankan server:
   ```bash
   php artisan serve
   ```

## Konfigurasi Midtrans
- Isi variabel di `.env`:
  - `MIDTRANS_SERVER_KEY`
  - `MIDTRANS_CLIENT_KEY`
  - `MIDTRANS_IS_PRODUCTION=false` (sandbox)

## Deployment ke Shared Hosting (Hostinger/cPanel)
1. **Siapkan hosting**
   - Gunakan PHP 8.1+.
   - Buat database MySQL + user.
2. **Upload project**
   - Upload seluruh project ke folder non-public (mis. `/home/user/kako-app`).
   - Isi `public_html` dengan isi folder `public` dari project.
3. **Install dependency di hosting**
   - Jalankan composer via SSH:
     ```bash
     cd /home/user/kako-app
     composer install --no-dev --optimize-autoloader
     ```
4. **Konfigurasi .env**
   - Copy `.env.example` jadi `.env`.
   - Isi kredensial DB dan Midtrans.
   - Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domainkamu.com`.
5. **Generate key + migrate**
   ```bash
   php artisan key:generate
   php artisan migrate --seed --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
6. **Arahkan Document Root**
   - Jika memungkinkan, set document root ke `/home/user/kako-app/public`.
   - Jika tidak bisa, gunakan pola copy isi folder `public` ke `public_html` + update `index.php` path bootstrap/vendor.
7. **Cron & queue (opsional)**
   - Tambah cron untuk scheduler jika diperlukan:
     ```bash
     * * * * * php /home/user/kako-app/artisan schedule:run >> /dev/null 2>&1
     ```

## Endpoint Penting
- `POST /create-transaction` → generate snap token
- `POST /midtrans/callback` → update status order

## Default Admin Seeder
- Email: `admin@kako.live`
- Password: `password123`

> Segera ganti password admin setelah deploy.
