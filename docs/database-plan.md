# Database Plan — ZiuLabs

## Keputusan fase sekarang

Katalog saat ini tetap dapat dirender dari PHP agar website cepat dipublikasikan. Database disiapkan sebagai **source of truth** pada milestone berikutnya. Jangan memasukkan credential produk atau payment secret ke tabel katalog.

## Database yang direkomendasikan

Gunakan MySQL atau MariaDB dengan `utf8mb4`. Aplikasi PHP mengaksesnya melalui PDO prepared statements. Production database harus berada di jaringan privat, memiliki user dengan least privilege, backup harian, dan restore drill.

## Tabel inti

```sql
CREATE TABLE products (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  slug VARCHAR(160) NOT NULL UNIQUE,
  name VARCHAR(180) NOT NULL,
  category VARCHAR(80) NOT NULL,
  description TEXT NULL,
  status ENUM('draft','published','archived') NOT NULL DEFAULT 'draft',
  compliance_status ENUM('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE skus (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  product_id BIGINT UNSIGNED NOT NULL,
  label VARCHAR(180) NOT NULL,
  price_minor BIGINT UNSIGNED NOT NULL,
  currency CHAR(3) NOT NULL DEFAULT 'IDR',
  stock_status ENUM('available','sold_out','paused') NOT NULL DEFAULT 'paused',
  terms_version VARCHAR(40) NOT NULL,
  source_reference VARCHAR(255) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_skus_product FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  public_id CHAR(26) NOT NULL UNIQUE,
  customer_name VARCHAR(120) NULL,
  customer_phone VARCHAR(32) NOT NULL,
  status ENUM('inquiry','awaiting_payment','paid','fulfilling','fulfilled','cancelled','refunded') NOT NULL DEFAULT 'inquiry',
  total_minor BIGINT UNSIGNED NOT NULL,
  currency CHAR(3) NOT NULL DEFAULT 'IDR',
  terms_version VARCHAR(40) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE order_items (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  order_id BIGINT UNSIGNED NOT NULL,
  sku_id BIGINT UNSIGNED NOT NULL,
  sku_name_snapshot VARCHAR(180) NOT NULL,
  unit_price_minor BIGINT UNSIGNED NOT NULL,
  quantity SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  CONSTRAINT fk_items_order FOREIGN KEY (order_id) REFERENCES orders(id),
  CONSTRAINT fk_items_sku FOREIGN KEY (sku_id) REFERENCES skus(id)
);

CREATE TABLE payments (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  order_id BIGINT UNSIGNED NOT NULL,
  provider VARCHAR(40) NOT NULL,
  provider_event_id VARCHAR(180) NOT NULL,
  status ENUM('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  amount_minor BIGINT UNSIGNED NOT NULL,
  raw_payload_hash CHAR(64) NOT NULL,
  verified_at TIMESTAMP NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_provider_event (provider, provider_event_id),
  CONSTRAINT fk_payments_order FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE audit_logs (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  actor_type VARCHAR(32) NOT NULL,
  actor_id BIGINT UNSIGNED NULL,
  action VARCHAR(100) NOT NULL,
  entity_type VARCHAR(80) NOT NULL,
  entity_id BIGINT UNSIGNED NULL,
  metadata_json JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

## Import produk awal

Daftar 26 SKU dari owner di-import sebagai `products` dan `skus`. Produk dengan label **Tersedia** masuk sebagai `stock_status=available`. Produk dengan label **Habis** masuk sebagai `stock_status=sold_out`. Semua produk baru tetap `compliance_status=pending` sampai sumber dan hak distribusinya diverifikasi.

## Acceptance criteria database

Admin dapat mengubah status SKU tanpa mengedit kode. Harga pada order tersimpan sebagai snapshot sehingga perubahan harga katalog tidak mengubah order lama. Duplicate payment event ditolak oleh unique key. Penghapusan produk dilakukan melalui status `archived`, bukan hard delete.
