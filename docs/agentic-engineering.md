# Agentic Engineering — ZiuLabs

Dokumen ini menjadi kontrak kerja antara manusia, agent, dan codebase. Agent tidak boleh mengubah perilaku produk hanya berdasarkan asumsi yang tidak tertulis.

## Prinsip kerja

Agent bekerja berdasarkan ticket yang memiliki tujuan, acceptance criteria, batasan, dan risiko. Sebelum coding, agent memetakan file yang akan disentuh serta membaca test dan dokumentasi terkait. Perubahan kecil yang dapat direview lebih baik daripada rewrite luas.

Agent wajib memisahkan tiga hal: **fakta** dari repository, **asumsi** yang perlu divalidasi, dan **keputusan** yang dicatat sebagai ADR. Agent tidak boleh mengarang status pembayaran, legalitas reseller, atau keberhasilan fulfillment.

## Loop delivery

1. **Understand.** Baca `README.md`, dokumen modul, dan file yang relevan. Cari route, schema, dan test yang sudah ada.
2. **Plan.** Tulis pendekatan, risiko keamanan, dan file yang akan berubah.
3. **Implement.** Gunakan PHP sederhana, fungsi kecil, escaping output, prepared statement, dan dependency seminimal mungkin.
4. **Verify.** Jalankan `php -l`, test unit/integrasi, lint CSS/JS bila tersedia, lalu lakukan smoke test HTTP.
5. **Review.** Periksa diff untuk secrets, perubahan scope, regresi aksesibilitas, dan data sensitif di log.
6. **Document.** Perbarui changelog atau ADR bila keputusan arsitektur berubah.

## Guardrails wajib

- Jangan commit `.env`, payment secret, password, token, atau data customer.
- Jangan menjual atau mengotomatiskan akun yang melanggar kebijakan provider.
- Jangan memproses webhook tanpa verifikasi signature, timestamp tolerance, dan idempotency key.
- Jangan menulis password atau credential produk ke log.
- Jangan menganggap client-side validation sebagai kontrol keamanan.
- Jangan menghapus data production; gunakan status dan audit trail.
- Jangan membuat route admin tanpa autentikasi, otorisasi berbasis role, CSRF token, dan rate limit.

## Definition of done

Fitur dinyatakan selesai apabila acceptance criteria terpenuhi, lint dan test lulus, error path memiliki respons yang jelas, output di-escape, perubahan terdokumentasi, dan tidak ada secret pada diff. Untuk fitur payment atau fulfillment, diperlukan test webhook replay, duplicate event, signature invalid, timeout, dan retry.

## Format ticket

```text
Goal:
User / operator impact:
Acceptance criteria:
Out of scope:
Security considerations:
Files likely affected:
Verification command:
Rollback:
```

## Prompt contract untuk agent

Agent yang mengerjakan ZiuLabs harus mengembalikan ringkasan perubahan, file yang disentuh, command verifikasi, hasil verifikasi, risiko tersisa, dan follow-up. Bila requirement bertentangan dengan legalitas atau keamanan, agent menghentikan implementasi bagian tersebut dan menawarkan desain aman yang dapat diaudit.
