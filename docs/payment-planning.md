# Payment Planning — Curies

## Status

Integrasi Curies belum diaktifkan. Nama provider perlu dikonfirmasi bersama dokumentasi API resmi, model settlement, negara operasi, biaya, refund support, dan status legal untuk bisnis ZiuLabs.

## Desain adapter

Aplikasi tidak boleh mengikat order domain langsung ke SDK provider. Buat interface `PaymentProvider` dengan operasi berikut:

```php
interface PaymentProvider
{
    public function createPayment(PaymentRequest $request): PaymentIntent;
    public function verifyWebhook(string $rawBody, array $headers): VerifiedPaymentEvent;
    public function refund(RefundRequest $request): RefundResult;
}
```

Implementasi awal diberi nama `CuriesPaymentProvider`. Secret dibaca dari environment, bukan database atau source code. Provider adapter hanya memetakan request dan response; perubahan status order tetap dilakukan oleh `PaymentService` internal.

## Urutan implementasi

1. Validasi dokumentasi API Curies, endpoint sandbox, currency IDR, QRIS/VA/card support, webhook signature, idempotency, expiry, refund, dan settlement.
2. Buat sandbox adapter dengan contract tests, tanpa uang nyata.
3. Tambahkan checkout internal dengan status `awaiting_payment`.
4. Verifikasi webhook menggunakan raw body, signature, timestamp tolerance, dan unique provider event ID.
5. Uji duplicate event, event terlambat, signature invalid, nominal berbeda, timeout, dan retry.
6. Aktifkan production hanya setelah compliance, refund SOP, dan reconciliation report disetujui.

## Guardrails

Jangan meminta atau menyimpan PIN, OTP, password akun digital, atau private key melalui form ZiuLabs. Jangan menandai order `paid` berdasarkan redirect browser; hanya webhook yang telah diverifikasi yang boleh mengubah status. Jangan mulai charge nyata sebelum provider, terms, dan refund flow disetujui.

## Acceptance criteria

Payment provider dapat diganti tanpa mengubah katalog atau order domain. Setiap event dapat di-replay tanpa menggandakan fulfillment. Rekonsiliasi harian dapat membandingkan total internal dengan settlement provider. Semua secret dapat dirotasi tanpa deploy source code.
