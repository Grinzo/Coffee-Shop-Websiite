<?php
// admin/admin_modules/pengaturan.php

/** @var mysqli $conn */

if (isset($_POST['simpan_pengaturan']) && isset($conn)) {
    $nama_toko = mysqli_real_escape_string($conn, $_POST['nama_toko']);
    $wa        = mysqli_real_escape_string($conn, $_POST['telepon_wa']);
    $ongkir    = (int)$_POST['biaya_delivery'];
    
    mysqli_query($conn, "UPDATE pengaturan SET nama_toko='$nama_toko', telepon_wa='$wa', biaya_delivery=$ongkir WHERE id=1");
    echo "<script>alert('Pengaturan berhasil disimpan!'); window.location.href='index.php?page=pengaturan';</script>";
}

$setting = (isset($conn) && $conn) ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengaturan WHERE id=1")) : [];
?>
<h3 class="fw-bold text-warning mb-4"><i class="bi bi-gear me-2"></i>Pengaturan Toko</h3>
<div class="card card-custom p-4 bg-black text-light border-secondary" style="max-width: 600px;">
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label text-secondary small">Nama Toko Kopi</label>
            <input type="text" name="nama_toko" class="form-control bg-dark text-light border-secondary" value="<?= htmlspecialchars($setting['nama_toko'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label text-secondary small">Nomor WA Admin</label>
            <input type="text" name="telepon_wa" class="form-control bg-dark text-light border-secondary" value="<?= htmlspecialchars($setting['telepon_wa'] ?? ''); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label text-secondary small">Biaya Pengiriman Normal (Rp)</label>
            <input type="number" name="biaya_delivery" class="form-control bg-dark text-light border-secondary" value="<?= htmlspecialchars($setting['biaya_delivery'] ?? 0); ?>" required>
        </div>
        <button type="submit" name="simpan_pengaturan" class="btn btn-warning rounded-pill fw-bold py-2 px-4">Simpan Perubahan</button>
    </form>
</div>