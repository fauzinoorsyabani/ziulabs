<?php

declare(strict_types=1);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
header("Content-Security-Policy: default-src 'self'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self' 'unsafe-inline'; img-src 'self' data:; connect-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self'");

$app = require __DIR__ . '/../config/app.php';

$products = [
    ['name' => 'Gemini Pro 18 Months Head (Link)', 'category' => 'AI & Productivity', 'price' => 'Rp12.900', 'usd' => '$0.81', 'available' => true, 'class' => 'violet', 'icon' => '✦'],
    ['name' => 'CapCut Pro 7D FW', 'category' => 'Creative & Design', 'price' => 'Rp3.500', 'usd' => '$0.22', 'available' => true, 'class' => 'orange', 'icon' => '▶'],
    ['name' => 'Microsoft Office 365 Plus 1 Year', 'category' => 'Business & Education', 'price' => 'Rp7.400', 'usd' => '$0.46', 'available' => true, 'class' => 'blue', 'icon' => '▦'],
    ['name' => 'Adobe Express 12M', 'category' => 'Creative & Design', 'price' => 'Rp10.000', 'usd' => '$0.62', 'available' => true, 'class' => 'pink', 'icon' => '✺'],
    ['name' => 'Adobe Express 12M', 'category' => 'Creative & Design', 'price' => 'Rp11.100', 'usd' => '$0.69', 'available' => true, 'class' => 'pink', 'icon' => '✺'],
    ['name' => 'Duolingo Super 12M', 'category' => 'Business & Education', 'price' => 'Rp11.100', 'usd' => '$0.69', 'available' => true, 'class' => 'lime', 'icon' => '◈'],
    ['name' => 'Canva Pro 2 YRS FW', 'category' => 'Creative & Design', 'price' => 'Rp13.300', 'usd' => '$0.83', 'available' => true, 'class' => 'cyan', 'icon' => '◌'],
    ['name' => 'iLovePDF Premium 1YR', 'category' => 'Business & Education', 'price' => 'Rp14.000', 'usd' => '$0.88', 'available' => true, 'class' => 'orange', 'icon' => '↗'],
    ['name' => 'Gmails Accounts', 'category' => 'Utilities', 'price' => 'Rp16.700', 'usd' => '$1.04', 'available' => true, 'class' => 'blue', 'icon' => '@'],
    ['name' => 'Crunchyroll MegaFan 15 Day', 'category' => 'Entertainment', 'price' => 'Rp17.800', 'usd' => '$1.11', 'available' => true, 'class' => 'orange', 'icon' => '▶'],
    ['name' => 'Avira Prime 3 Months', 'category' => 'Utilities', 'price' => 'Rp17.800', 'usd' => '$1.11', 'available' => true, 'class' => 'lime', 'icon' => '✓'],
    ['name' => 'Notion Plus 12M', 'category' => 'Business & Education', 'price' => 'Rp24.500', 'usd' => '$1.53', 'available' => true, 'class' => 'violet', 'icon' => 'N'],
    ['name' => 'EDX Premium 12 Months', 'category' => 'Business & Education', 'price' => 'Rp24.500', 'usd' => '$1.53', 'available' => true, 'class' => 'blue', 'icon' => 'E'],
    ['name' => 'CapCut Pro 1 Month FW', 'category' => 'Creative & Design', 'price' => 'Rp27.500', 'usd' => '$1.72', 'available' => true, 'class' => 'orange', 'icon' => '▶'],
    ['name' => 'Prime Video 6 Months', 'category' => 'Entertainment', 'price' => 'Rp33.400', 'usd' => '$2.09', 'available' => true, 'class' => 'violet', 'icon' => 'P'],
    ['name' => 'CapCut Pro 1600 Credits', 'category' => 'Creative & Design', 'price' => 'Rp35.600', 'usd' => '$2.23', 'available' => true, 'class' => 'pink', 'icon' => '▶'],
    ['name' => 'JetBrains Edu Pack 12M', 'category' => 'Business & Education', 'price' => 'Rp66.700', 'usd' => '$4.17', 'available' => true, 'class' => 'cyan', 'icon' => 'J'],
    ['name' => 'Figma Pro Edu 2YRS', 'category' => 'Creative & Design', 'price' => 'Rp93.400', 'usd' => '$5.84', 'available' => true, 'class' => 'pink', 'icon' => 'F'],
    ['name' => 'Framer AI 1 Year', 'category' => 'AI & Productivity', 'price' => 'Rp133.400', 'usd' => '$8.34', 'available' => true, 'class' => 'violet', 'icon' => '⌁'],
    ['name' => 'CapCut Pro 6 Months', 'category' => 'Creative & Design', 'price' => 'Rp173.900', 'usd' => '$10.87', 'available' => true, 'class' => 'orange', 'icon' => '▶'],
    ['name' => 'Miro Lifetime Panel 100 Invite', 'category' => 'Business & Education', 'price' => 'Rp177.900', 'usd' => '$11.12', 'available' => true, 'class' => 'cyan', 'icon' => 'M'],
    ['name' => 'Autodesk Admin 3000 Invite', 'category' => 'Creative & Design', 'price' => 'Rp266.900', 'usd' => '$16.68', 'available' => true, 'class' => 'blue', 'icon' => 'A'],
    ['name' => 'YT Premium 1 Bulan Invit', 'category' => 'Entertainment', 'price' => 'Rp3.000', 'usd' => '$0.19', 'available' => false, 'class' => 'orange', 'icon' => '▶'],
    ['name' => 'HBO Max 3 Months', 'category' => 'Entertainment', 'price' => 'Rp22.200', 'usd' => '$1.39', 'available' => false, 'class' => 'violet', 'icon' => 'H'],
    ['name' => 'Super Grok 9-10 Days (W3D)', 'category' => 'AI & Productivity', 'price' => 'Rp69.800', 'usd' => '$4.36', 'available' => false, 'class' => 'blue', 'icon' => 'G'],
    ['name' => 'Canva Pro Admin (500 Invitations)', 'category' => 'Creative & Design', 'price' => 'Rp128.200', 'usd' => '$8.01', 'available' => false, 'class' => 'cyan', 'icon' => 'C'],
];

$imageFiles = [
    'gemini-pro.png', 'capcut-7d.png', 'office-365.png', 'adobe-express-10k.png', 'adobe-express-11k.png',
    'duolingo-super.png', 'canva-2yrs.png', 'ilovepdf.png', 'gmails.png', 'crunchyroll.png', 'avira-prime.png',
    'notion-plus.png', 'edx-premium.png', 'capcut-1m.png', 'prime-video.png', 'capcut-credits.png',
    'jetbrains-edu.png', 'figma-edu.png', 'framer-ai.png', 'capcut-6m.png', 'miro-lifetime.png', 'autodesk-admin.png',
    'yt-premium.png', 'hbo-max.png', 'super-grok.png', 'canva-admin.png',
];

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function whatsappLink(string $number, string $name, string $price, bool $available): string {
    $message = $available
        ? "Halo ZiuLabs, saya tertarik dengan {$name} ({$price}). Mohon info detail dan prosesnya."
        : "Halo ZiuLabs, saya ingin mendapat notifikasi saat {$name} ({$price}) tersedia kembali.";
    return 'https://wa.me/' . preg_replace('/[^0-9]/', '', $number) . '?text=' . rawurlencode($message);
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ZiuLabs — katalog produk digital dengan proses yang jelas, cepat, dan aman.">
    <title><?= e($app['name']) ?> — Digital access, made clear.</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header class="site-header"><a class="brand" href="#top" aria-label="ZiuLabs home"><span class="brand-mark">Z</span><span>Ziu<span class="brand-accent">Labs</span></span></a><nav class="nav" aria-label="Navigasi utama"><a href="#catalog">Katalog</a><a href="#how-it-works">Cara kerja</a><a href="#faq">FAQ</a></nav><a class="header-cta" href="<?= e($app['support_url']) ?>" target="_blank" rel="noopener">Chat support <span>↗</span></a></header>
<main id="top">
<section class="hero section-shell"><div class="hero-copy"><div class="pill"><span class="pulse"></span> <?= count(array_filter($products, fn(array $p): bool => $p['available'])) ?> produk tersedia</div><h1>Produk premium.<br><em>Jelas</em> sejak awal.</h1><p class="hero-lead">Pilih produk digital yang kamu butuhkan, lihat harga dan statusnya, lalu langsung chat ZiuLabs melalui WhatsApp.</p><div class="hero-actions"><a class="button button-primary" href="#catalog">Lihat katalog <span>↓</span></a><a class="text-link" href="#how-it-works">Cara order <span>↗</span></a></div><div class="mini-proof"><div class="avatars"><i>Z</i><i>L</i><i>W</i><i>+</i></div><span><strong><?= count($products) ?> SKU</strong> sudah masuk katalog</span></div></div><div class="hero-art" aria-label="Ilustrasi ZiuLabs"><div class="orbit orbit-one"></div><div class="orbit orbit-two"></div><div class="float-card card-top"><span class="card-dot"></span><b>WHATSAPP ORDER</b><small>Langsung terhubung ke tim</small></div><div class="main-orb"><div class="orb-grid"></div><span>Z<span class="brand-accent">L</span></span></div><div class="float-card card-bottom"><span class="check">✓</span><div><b>Clear pricing</b><small>Status tersedia terlihat</small></div></div><div class="spark spark-one">✦</div><div class="spark spark-two">✧</div></div></section>
<section class="trustbar"><div class="section-shell trust-inner"><span class="trust-label">Dibuat untuk akses yang lebih tenang</span><span>✦ Transparency first</span><span>◌ Human support</span><span>⌁ Curated products</span></div></section>
<section id="catalog" class="section-shell catalog-section"><div class="section-heading"><div><div class="eyebrow">01 / CATALOG</div><h2>Pick your <em>access.</em></h2></div><p><?= count($products) ?> produk terdaftar. Klik kartu produk untuk langsung menghubungi ZiuLabs melalui WhatsApp.</p></div><div class="filter-row" role="group" aria-label="Filter katalog"><button class="filter active" data-filter="all">Semua (<?= count($products) ?>)</button><?php foreach (['AI & Productivity', 'Creative & Design', 'Business & Education', 'Entertainment', 'Utilities'] as $category): ?><button class="filter" data-filter="<?= e($category) ?>"><?= e($category) ?></button><?php endforeach; ?></div><div class="product-grid">
<?php foreach ($products as $index => $product): $status = $product['available'] ? 'Tersedia' : 'Habis'; ?><a class="product-card <?= $product['available'] ? '' : 'sold-out' ?>" data-category="<?= e($product['category']) ?>" href="<?= e(whatsappLink($app['whatsapp_number'], $product['name'], $product['price'], $product['available'])) ?>" target="_blank" rel="noopener"><div class="product-visual <?= e($product['class']) ?>"><img class="product-image" src="/assets/products/<?= e($imageFiles[$index]) ?>" alt="Visual <?= e($product['name']) ?>" loading="lazy"><span class="product-icon"><?= e($product['icon']) ?></span><span class="product-orbit"></span><span class="product-label <?= $product['available'] ? 'is-available' : 'is-sold-out' ?>"><?= $status ?></span></div><div class="product-body"><span class="product-category"><?= e($product['category']) ?></span><h3><?= e($product['name']) ?></h3><p class="product-note">Klik untuk chat via WhatsApp</p><div class="product-foot"><div><strong><?= e($product['price']) ?></strong><small><?= e($product['usd']) ?></small></div><span class="product-arrow">↗</span></div></div></a><?php endforeach; ?></div></section>
<section id="how-it-works" class="process-section"><div class="section-shell"><div class="section-heading light"><div><div class="eyebrow">02 / SIMPLE PROCESS</div><h2>From curious<br>to <em>covered.</em></h2></div><p>Pilih produk, klik kartu, dan percakapan WhatsApp dengan tim ZiuLabs akan terbuka dengan pesan yang sudah disiapkan.</p></div><div class="process-grid"><div class="process-step"><span>01</span><h3>Pilih produk</h3><p>Gunakan filter untuk menemukan kategori yang relevan dan cek status stoknya.</p></div><div class="process-step"><span>02</span><h3>Chat via WhatsApp</h3><p>Nama produk dan harga otomatis ikut terkirim agar proses lebih cepat.</p></div><div class="process-step"><span>03</span><h3>Konfirmasi detail</h3><p>Tim mengonfirmasi stok, durasi, terms, dan cara pembayaran sebelum order.</p></div></div></div></section>
<section id="faq" class="section-shell faq-section"><div class="section-heading"><div><div class="eyebrow">03 / GOOD TO KNOW</div><h2>Pertanyaan<br>yang <em>sering</em> muncul.</h2></div></div><div class="faq-list"><details open><summary>Bagaimana cara membeli produk?</summary><p>Klik kartu produk yang tersedia. WhatsApp akan terbuka dengan pesan otomatis berisi produk dan harga yang kamu pilih.</p></details><details><summary>Bagaimana dengan produk yang habis?</summary><p>Produk berstatus Habis tidak dijanjikan tersedia. Klik produknya jika ingin meminta notifikasi saat stok tersedia kembali.</p></details><details><summary>Apakah pembayaran otomatis sudah tersedia?</summary><p>Belum. Untuk fase ini, tim melakukan konfirmasi manual melalui WhatsApp. Database dan payment gateway akan masuk pada milestone berikutnya.</p></details></div></section>
</main><footer class="site-footer"><div class="section-shell footer-inner"><a class="brand" href="#top"><span class="brand-mark">Z</span><span>Ziu<span class="brand-accent">Labs</span></span></a><p>Digital access, made clear.</p><span>© <?= date('Y') ?> ZiuLabs</span></div></footer>
<script>document.querySelectorAll('.filter').forEach(function(button){button.addEventListener('click',function(){document.querySelectorAll('.filter').forEach(function(item){item.classList.remove('active')});button.classList.add('active');var value=button.dataset.filter;document.querySelectorAll('.product-card').forEach(function(card){card.hidden=value!=='all'&&card.dataset.category!==value})})});</script>
</body></html>
