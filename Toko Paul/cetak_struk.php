<?php
require_once 'config.php';

$id_pesanan = (int)($_GET['id'] ?? 0);
$query = mysqli_query($conn, "SELECT * FROM pesanan WHERE id = $id_pesanan");
$p = mysqli_fetch_assoc($query);

if (!$p) {
    echo "Pesanan tidak ditemukan.";
    exit;
}

$details = mysqli_query($conn, "SELECT * FROM detail_pesanan WHERE id_pesanan = $id_pesanan");

// Teks Konfirmasi WA
$pesan_wa = "Halo Toko Kopi Paul, saya ingin mengonfirmasi pesanan *" . $p['kode_pesanan'] . "*%0ANama: " . urlencode($p['nama_pemesan']) . "%0ATotal: Rp " . number_format($p['total_bayar'], 0, ',', '.') . "%0AMetode: " . $p['metode_layanan'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan - <?= $p['kode_pesanan']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 13px; color: #000; background: #f8f9fa; padding: 20px; }
        .receipt { max-width: 300px; margin: auto; background: #fff; padding: 15px; border: 1px dashed #000; }
        .text-center { text-align: center; }
        .line { border-bottom: 1px dashed #000; margin: 10px 0; }
        .flex { display: flex; justify-content: space-between; }
        .btn-box { max-width: 300px; margin: 15px auto; text-align: center; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 5px; font-family: sans-serif; font-size: 12px; }
        .btn-print { background: #007bff; color: white; }
        .btn-wa { background: #25D366; color: white; }
        @media print { .btn-box { display: none; } body { padding: 0; background: none; } .receipt { border: none; } }
    </style>
</head>
<body>

<div class="receipt">
    <div class="text-center">
        <h2 style="margin:0;">TOKO KOPI PAUL</h2>
        <small>Jl. Raya Cikuda - Parung Panjang</small><br>
        <small>WA: 0812-3456-7890</small>
    </div>
    <div class="line"></div>
    <div>
        <strong>No: <?= $p['kode_pesanan']; ?></strong><br>
        Tgl: <?= date('d/m/Y H:i', strtotime($p['created_at'])); ?><br>
        Nama: <?= htmlspecialchars($p['nama_pemesan']); ?><br>
        Layanan: <?= strtoupper($p['metode_layanan']); ?><br>
        Bayar: <?= $p['metode_pembayaran']; ?>
        <?php if($p['metode_layanan'] === 'delivery'): ?>
            <br>Alamat: <?= htmlspecialchars($p['alamat']); ?>
        <?php endif; ?>
    </div>
    <div class="line"></div>
    <?php while($item = mysqli_fetch_assoc($details)): ?>
    <div class="flex">
        <span><?= htmlspecialchars($item['nama_menu']); ?> x<?= $item['qty']; ?></span>
        <span>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></span>
    </div>
    <?php endwhile; ?>
    <div class="line"></div>
    <div class="flex">
        <span>Subtotal</span>
        <span>Rp <?= number_format($p['subtotal'], 0, ',', '.'); ?></span>
    </div>
    <div class="flex">
        <span>Ongkir</span>
        <span>Rp <?= number_format($p['biaya_ongkir'], 0, ',', '.'); ?></span>
    </div>
    <div class="line"></div>
    <div class="flex" style="font-weight: bold; font-size: 14px;">
        <span>TOTAL</span>
        <span>Rp <?= number_format($p['total_bayar'], 0, ',', '.'); ?></span>
    </div>
    <div class="line"></div>
    <div class="text-center">
        <p style="margin: 5px 0;">Terima Kasih Atas Kunjungannya!</p>
        <small>-- Powered by Kopi Paul --</small>
    </div>
</div>

<div class="btn-box">
    <button onclick="window.print()" class="btn btn-print">🖨️ Cetak Struk</button>
    <a href="https://wa.me/6281234567890?text=<?= $pesan_wa; ?>" target="_blank" class="btn btn-wa">💬 Konfirmasi WA</a>
</div>

</body>
</html>