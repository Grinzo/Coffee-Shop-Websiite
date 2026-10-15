<?php
// admin/admin_modules/laporan.php

/** @var mysqli $conn */

$laporan = (isset($conn) && $conn) ? mysqli_query($conn, "SELECT DATE(created_at) AS tgl, COUNT(*) AS total_trx, SUM(total_bayar) AS omset FROM pesanan WHERE status = 'Selesai' GROUP BY DATE(created_at) ORDER BY tgl DESC") : false;
?>
<h3 class="fw-bold text-warning mb-4"><i class="bi bi-graph-up-arrow me-2"></i>Laporan Penjualan Harian</h3>
<div class="card card-custom p-4 bg-black text-light border-secondary">
    <div class="table-responsive">
        <table class="table table-dark align-middle mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Transaksi Selesai</th>
                    <th>Total Omset Harian</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($laporan && mysqli_num_rows($laporan) > 0): ?>
                    <?php while ($l = mysqli_fetch_assoc($laporan)): ?>
                    <tr>
                        <td><?= date('d F Y', strtotime($l['tgl'])); ?></td>
                        <td><span class="badge bg-secondary"><?= $l['total_trx']; ?> Trx</span></td>
                        <td class="fw-bold text-warning"><?= formatRupiah($l['omset']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-secondary py-3">Belum ada transaksi selesai.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>