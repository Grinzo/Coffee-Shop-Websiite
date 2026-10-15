<?php
// admin/admin_modules/dashboard.php
/** @var mysqli $conn */

// Mengambil Statistik Ringkasan
$q_pesanan   = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesanan");
$tot_pesanan = $q_pesanan ? mysqli_fetch_assoc($q_pesanan)['total'] : 0;

$q_omset     = mysqli_query($conn, "SELECT SUM(total_bayar) as omset FROM pesanan WHERE status = 'Selesai'");
$tot_omset   = $q_omset ? (mysqli_fetch_assoc($q_omset)['omset'] ?? 0) : 0;

$q_menu      = mysqli_query($conn, "SELECT COUNT(*) as total FROM menu");
$tot_menu    = $q_menu ? mysqli_fetch_assoc($q_menu)['total'] : 0;

$q_pelanggan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pelanggan");
$tot_pelanggan = $q_pelanggan ? mysqli_fetch_assoc($q_pelanggan)['total'] : 0;

$pesanan_terbaru = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC LIMIT 5");
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-warning mb-1"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</h3>
        <p class="text-secondary small mb-0">Ringkasan aktivitas dan performa Toko Kopi Paul.</p>
    </div>
    <span class="badge bg-dark border border-secondary px-3 py-2 text-warning"><i class="bi bi-calendar3 me-1"></i> <?= date('d M Y'); ?></span>
</div>

<!-- KARTU STATISTIK -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-custom p-3 text-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small d-block mb-1">Total Pesanan</span>
                    <h3 class="fw-bold mb-0 text-warning"><?= number_format($tot_pesanan); ?></h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 text-warning">
                    <i class="bi bi-receipt fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 text-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small d-block mb-1">Total Pendapatan</span>
                    <h3 class="fw-bold mb-0 text-success"><?= formatRupiah($tot_omset); ?></h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-3 text-success">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 text-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small d-block mb-1">Menu Aktif</span>
                    <h3 class="fw-bold mb-0 text-info"><?= number_format($tot_menu); ?></h3>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded-3 text-info">
                    <i class="bi bi-cup-straw fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-custom p-3 text-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-secondary small d-block mb-1">Pelanggan</span>
                    <h3 class="fw-bold mb-0 text-primary"><?= number_format($tot_pelanggan); ?></h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TABEL PESANAN TERBARU -->
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-light mb-0"><i class="bi bi-clock-history text-warning me-2"></i>Pesanan Terbaru</h5>
        <a href="index.php?page=pesanan" class="btn btn-outline-warning btn-sm rounded-pill">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-dark table-dark-custom align-middle mb-0">
            <thead>
                <tr class="text-secondary">
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($pesanan_terbaru && mysqli_num_rows($pesanan_terbaru) > 0): ?>
                    <?php while ($p = mysqli_fetch_assoc($pesanan_terbaru)): ?>
                        <tr>
                            <td class="fw-bold text-warning"><?= htmlspecialchars($p['kode_pesanan']); ?></td>
                            <td><?= htmlspecialchars($p['nama_pemesan']); ?></td>
                            <td><span class="badge bg-secondary"><?= strtoupper($p['metode_layanan']); ?></span></td>
                            <td class="fw-semibold"><?= formatRupiah($p['total_bayar']); ?></td>
                            <td>
                                <?php
                                $badge = 'bg-warning text-dark';
                                if ($p['status'] == 'Diproses') $badge = 'bg-info text-dark';
                                if ($p['status'] == 'Selesai') $badge = 'bg-success';
                                if ($p['status'] == 'Dibatalkan') $badge = 'bg-danger';
                                ?>
                                <span class="badge <?= $badge; ?>"><?= $p['status']; ?></span>
                            </td>
                            <td class="small text-secondary"><?= date('d/m/Y H:i', strtotime($p['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">Belum ada pesanan masuk.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>