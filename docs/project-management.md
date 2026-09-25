# ZiuLabs — Project Management Plan

## Outcome

Outcome fase pertama adalah katalog produk digital yang dapat dipercaya. Pengguna memahami apa yang dibeli, operator dapat menindaklanjuti inquiry, dan tim memiliki fondasi teknis yang aman untuk menambahkan pembayaran setelah proses compliance disetujui.

## Workstreams

| Workstream | Hasil | Owner | Exit criteria |
|---|---|---|---|
| Product & compliance | SKU, terms, refund, source verification | Product lead | Semua SKU punya owner dan bukti hak distribusi |
| Experience | Landing, katalog, inquiry flow | Frontend | Mobile, keyboard, empty/error state teruji |
| Backend | Catalog, order, RBAC, audit | Backend | Data model dan permission test lulus |
| Operations | Stok, fulfillment SOP, support | Ops lead | SOP eskalasi dan refund terdokumentasi |
| Reliability | Backup, monitoring, incident runbook | Tech lead | Restore drill dan alert dasar berjalan |

## Milestones

### M0 — Foundation
Scope: brand, landing page, katalog statis, docs, security baseline. Status: **in progress / delivered in this repository**.

### M1 — Database & operator console
Scope: migration MySQL/MariaDB, import 26 SKU, login admin, CRUD product/SKU, compliance status, order queue, audit log. Exit: operator dapat mengubah stok dan harga tanpa menyentuh source code.

### M2 — Safe checkout & Curies sandbox
Scope: customer order form, invoice, payment provider adapter, signed webhook, idempotency, refund state, dan contract test Curies. Exit: replay webhook tidak menggandakan fulfillment dan provider dapat diganti melalui adapter.

### M3 — Fulfillment
Scope: delivery instruction template, secret vault reference, expiry reminder, support ticket. Exit: secret tidak muncul di log, email, atau analytics.

### M4 — Growth and reliability
Scope: analytics consent, SEO, cache, backup restore drill, alerting, rate limit tuning. Exit: SLO dashboard dan incident runbook tersedia.

## Ritme kerja

Planning dilakukan mingguan dengan backlog yang diprioritaskan berdasarkan customer value dan risk reduction. Review dilakukan pada akhir milestone. Retrospective berfokus pada defect escape, waktu review, dan kualitas operational handoff.

## Prioritas keputusan

Compliance blocker mengalahkan feature request. Risiko kehilangan uang atau data mengalahkan optimasi visual. Perubahan yang mudah dibatalkan boleh menggunakan feature flag. Perubahan schema production wajib memiliki migration dan rollback plan.

## Risiko awal

Risiko terbesar adalah status legal produk, kebocoran credential, payment dispute, dan ketidakjelasan ownership inventory. Mitigasinya adalah source verification, minimisasi data, signed webhook, manual review pada fase awal, serta audit trail.

## Definition of ready

Ticket siap dikerjakan jika outcome, persona, acceptance criteria, data impact, security impact, dan rollback sudah ditulis. Ticket yang hanya berbunyi “buat checkout” belum ready.

Untuk integrasi Curies, Definition of ready juga mensyaratkan URL dokumentasi API, sandbox credentials, daftar metode pembayaran, webhook signing method, currency support, dan refund policy.
