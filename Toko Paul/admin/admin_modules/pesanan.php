<?php
// admin/admin_modules/pesanan.php

/** @var mysqli $conn */

if (isset($_POST['update_status']) && isset($conn)) {
    $id_pesanan  = (int)$_POST['id_pesanan'];
    $status_baru = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE pesanan SET status = '$status_baru' WHERE id = $id_pesanan");
    echo "<script>alert('Status pesanan berhasil diperbarui!'); window.location.href='index.php?page=pesanan';</script>";
}

$pesanan_query = (isset($conn) && $conn) ? mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC") : false;
?>

<h3 class="fw-bold text-warning mb-4"><i class="bi bi-receipt me-2"></i>Kelola Pesanan Pelanggan</h3>

<div class="card card-custom p-4 bg-black text-light border-secondary">
    <div class="table-responsive">
        <table class="table table-dark align-middle mb-0">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Kode</th>
                    <th>Pemesan / WA</th>
                    <th>Metode</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($pesanan_query && mysqli_num_rows($pesanan_query) > 0): ?>
                    <?php while ($p = mysqli_fetch_assoc($pesanan_query)): ?>
                    <tr>
                        <td class="small text-secondary"><?= date('d/m/Y H:i', strtotime($p['created_at'])); ?></td>
                        <td class="fw-bold text-warning">#<?= htmlspecialchars($p['kode_pesanan']); ?></td>
                        <td>
                            <?= htmlspecialchars($p['nama_pemesan']); ?><br>
                            <small class="text-secondary"><?= htmlspecialchars($p['whatsapp'] ?? '-'); ?></small>
                        </td>
                        <td><span class="badge bg-dark border border-secondary"><?= strtoupper($p['metode_layanan']); ?></span></td>
                        <td class="fw-bold text-warning"><?= formatRupiah($p['total_bayar']); ?></td>
                        <td>
                            <form action="" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="id_pesanan" value="<?= $p['id']; ?>">
                                <select name="status" class="form-select form-select-sm bg-dark text-light border-secondary">
                                    <option value="Pending" <?= $p['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Diproses" <?= $p['status'] == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Selesai" <?= $p['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                    <option value="Dibatalkan" <?= $p['status'] == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-warning btn-sm"><i class="bi bi-check-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-3">Belum ada data pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>