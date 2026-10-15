<?php
// admin/admin_modules/stok.php

/** @var mysqli $conn */

// Proses Tambah Stok Bahan
if (isset($_POST['tambah_stok']) && isset($conn)) {
    $nama_bahan   = mysqli_real_escape_string($conn, $_POST['nama_bahan']);
    $stok         = (int)$_POST['stok'];
    $satuan       = mysqli_real_escape_string($conn, $_POST['satuan']);
    $minimal_stok = (int)$_POST['minimal_stok'];

    mysqli_query($conn, "INSERT INTO stok_bahan (nama_bahan, stok, satuan, minimal_stok) VALUES ('$nama_bahan', $stok, '$satuan', $minimal_stok)");
    echo "<script>alert('Bahan baku baru berhasil ditambahkan!'); window.location.href='index.php?page=stok';</script>";
}

// Proses Hapus Stok Bahan
if (isset($_GET['hapus_stok']) && isset($conn)) {
    $id_stok = (int)$_GET['hapus_stok'];
    mysqli_query($conn, "DELETE FROM stok_bahan WHERE id = $id_stok");
    echo "<script>alert('Bahan baku berhasil dihapus!'); window.location.href='index.php?page=stok';</script>";
}

$stok_query = isset($conn) ? mysqli_query($conn, "SELECT * FROM stok_bahan ORDER BY nama_bahan ASC") : false;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-warning mb-0"><i class="bi bi-box-seam me-2"></i>Stok Bahan Baku Kedai</h3>
    <button class="btn btn-warning rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
        <i class="bi bi-plus-lg me-1"></i> Tambah Bahan
    </button>
</div>

<div class="card card-custom p-4 bg-black text-light border-secondary">
    <div class="table-responsive">
        <table class="table table-dark align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Bahan</th>
                    <th>Sisa Stok</th>
                    <th>Satuan</th>
                    <th>Batas Minimal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stok_query && mysqli_num_rows($stok_query) > 0): ?>
                    <?php while ($s = mysqli_fetch_assoc($stok_query)): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($s['nama_bahan']); ?></td>
                        <td class="fs-5 text-warning fw-bold"><?= $s['stok']; ?></td>
                        <td><?= htmlspecialchars($s['satuan']); ?></td>
                        <td><?= $s['minimal_stok']; ?></td>
                        <td>
                            <?php if ($s['stok'] <= $s['minimal_stok']): ?>
                                <span class="badge bg-danger">Menipis!</span>
                            <?php else: ?>
                                <span class="badge bg-success">Aman</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?page=stok&hapus_stok=<?= $s['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus stok bahan ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">Belum ada data stok bahan baku.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH STOK -->
<div class="modal fade" id="modalTambahStok" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-warning fw-bold"><i class="bi bi-box-seam me-2"></i>Tambah Stok Bahan Baku</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan" class="form-control bg-black text-light border-secondary shadow-none" placeholder="Contoh: Milk/Susu UHT" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Jumlah Stok Awal</label>
                        <input type="number" name="stok" class="form-control bg-black text-light border-secondary shadow-none" placeholder="20" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Satuan</label>
                        <input type="text" name="satuan" class="form-control bg-black text-light border-secondary shadow-none" placeholder="Liter / Gram / Pcs" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Batas Minimal Stok Alert</label>
                        <input type="number" name="minimal_stok" class="form-control bg-black text-light border-secondary shadow-none" placeholder="5" required>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah_stok" class="btn btn-warning rounded-pill fw-bold">Simpan Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>