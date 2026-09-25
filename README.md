# Geo Booster

Geo Booster adalah fondasi Software as a Service (SaaS) untuk katalog dan penjualan produk digital secara transparan, aman, dan mudah dioperasikan. Versi awal ini memakai **PHP 8.2+ tanpa TypeScript** untuk menjaga kurva belajar tetap rendah.

## Status proyek

Repositori ini sebelumnya berisi aplikasi React/TypeScript dari proyek lain. Fondasi Geo Booster ditambahkan sebagai aplikasi PHP mandiri di `php-app/` agar migrasi dapat dilakukan bertahap tanpa menghapus aset lama.

Versi yang tersedia saat ini adalah **catalogue-first MVP**: landing page, katalog produk, filter kategori, trust signals, dan alur permintaan pesanan yang belum terhubung ke pembayaran atau provisioning otomatis.

## Website production

Website production saat ini tersedia di [geo-booster-fauzins-projects.vercel.app](https://geo-booster-fauzins-projects.vercel.app/). Aplikasi PHP di `php-app/public/` adalah source canonical; `php-app/static/` adalah export statis yang digunakan untuk situs production.

## Menjalankan lokal

Dari root repository, jalankan:

```bash
./run-local.sh
```

Buka `http://127.0.0.1:8080`. Launcher memerlukan PHP 8.2 atau lebih baru. Panduan membuka dan bekerja pada project di Antigravity tersedia di [docs/antigravity.md](docs/antigravity.md).

## Struktur penting

- `php-app/public/` — source aplikasi PHP canonical, web root, dan asset publik.
- `php-app/config/` — konfigurasi/data aplikasi; jangan jadikan web root atau tempat menyimpan secrets.
- `php-app/static/` — export statis production yang dihasilkan dari source PHP.
- `docs/` — system design, project management, backend, frontend, API, data model, dan threat model.
- `.agent/skills/` — aturan kerja agentic engineering yang wajib diikuti saat mengembangkan fitur.

## Prinsip produk

Geo Booster tidak boleh menjual kredensial curian, akses ilegal, atau produk yang melanggar kebijakan penyedia layanan. Integrasi pembayaran dan fulfillment hanya boleh diaktifkan setelah legalitas reseller, terms of service, refund policy, dan bukti kepemilikan lisensi diverifikasi.

## Referensi internal

Mulai dari [System Design](docs/architecture.md), lalu baca [Project Management](docs/project-management.md) dan [Agentic Engineering](docs/agentic-engineering.md).

## Pengujian cepat

```bash
php -l php-app/public/index.php
php -l php-app/config/app.php
git diff --check
```

Untuk deployment, gunakan PHP-FPM/Nginx atau Apache dengan document root menunjuk ke `php-app/public/`. Jangan pernah menjadikan `config/`, `storage/`, atau `.env` sebagai web root.

Deployment production saat ini menggunakan export statis. Status push GitHub tidak memastikan deployment Vercel terjadi; jangan mengasumsikan deployment otomatis tanpa integrasi yang sudah diverifikasi.

Katalog saat ini memuat **26 SKU** dari daftar inventory 21 September 2026. Setiap kartu produk membuka WhatsApp `+62 895-6092-50509` dengan nama dan harga produk yang sudah terisi. Dua belas visual produk dibuat sebagai aset brand original; SKU lain memakai visual kategori yang dioptimalkan sebagai fallback sampai aset individual berikutnya tersedia.

Untuk langkah setup IDE, run lokal, dan validasi sebelum push, lihat [Panduan Antigravity](docs/antigravity.md).
