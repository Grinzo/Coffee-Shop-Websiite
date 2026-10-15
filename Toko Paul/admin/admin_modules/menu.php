<?php
// admin/admin_modules/menu.php

/** @var mysqli $conn */

// Menentukan direktori folder img di root proyek
$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/Toko Paul/img/';
if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
}

// PROSES TAMBAH MENU
if (isset($_POST['tambah_menu']) && isset($conn)) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga     = (int)$_POST['harga'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar    = 'img/default.jpeg';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileName   = $_FILES['gambar']['name'];
        $fileTmp    = $_FILES['gambar']['tmp_name'];
        $ext        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowedExt)) {
            $newName     = time() . '_' . uniqid() . '.' . $ext;
            $target_file = $upload_dir . $newName;

            if (move_uploaded_file($fileTmp, $target_file)) {
                $gambar = 'img/' . $newName;
            }
        }
    }

    mysqli_query($conn, "INSERT INTO menu (nama, kategori, harga, gambar, deskripsi, status) VALUES ('$nama', '$kategori', $harga, '$gambar', '$deskripsi', 'tersedia')");
    echo "<script>alert('Menu baru berhasil ditambahkan!'); window.location.href='index.php?page=menu';</script>";
}

// PROSES EDIT MENU
if (isset($_POST['update_menu']) && isset($conn)) {
    $id          = (int)$_POST['id_menu'];
    $nama        = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori    = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga       = (int)$_POST['harga'];
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar_lama = $_POST['gambar_lama'];
    $gambar      = $gambar_lama;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $fileName   = $_FILES['gambar']['name'];
        $fileTmp    = $_FILES['gambar']['tmp_name'];
        $ext        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowedExt)) {
            $newName     = time() . '_' . uniqid() . '.' . $ext;
            $target_file = $upload_dir . $newName;

            if (move_uploaded_file($fileTmp, $target_file)) {
                $gambar = 'img/' . $newName;
            }
        }
    }

    mysqli_query($conn, "UPDATE menu SET nama='$nama', kategori='$kategori', harga=$harga, gambar='$gambar', deskripsi='$deskripsi' WHERE id=$id");
    echo "<script>alert('Menu berhasil diperbarui!'); window.location.href='index.php?page=menu';</script>";
}

// PROSES HAPUS MENU
if (isset($_GET['hapus_menu']) && isset($conn)) {
    $id = (int)$_GET['hapus_menu'];
    mysqli_query($conn, "DELETE FROM menu WHERE id = $id");
    echo "<script>alert('Menu berhasil dihapus!'); window.location.href='index.php?page=menu';</script>";
}

$menus = (isset($conn) && $conn) ? mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC") : false;
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-warning mb-0"><i class="bi bi-cup-straw me-2"></i>Kelola Menu & Produk</h3>
    <button class="btn btn-warning rounded-pill fw-semibold" data-bs-toggle="modal" data-bs-target="#modalTambahMenu">
        <i class="bi bi-plus-lg me-1"></i> Tambah Menu
    </button>
</div>

<div class="card card-custom p-4 bg-black text-light border-secondary">
    <div class="table-responsive">
        <table class="table table-dark align-middle mb-0">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($menus && mysqli_num_rows($menus) > 0): ?>
                    <?php while ($m = mysqli_fetch_assoc($menus)): ?>
                    <tr>
                        <td>
                            <img src="../<?= htmlspecialchars($m['gambar']); ?>" width="50" height="50" class="rounded object-fit-cover" onerror="this.src='../img/default.jpeg';">
                        </td>
                        <td class="fw-bold"><?= htmlspecialchars($m['nama']); ?></td>
                        <td><span class="badge bg-warning text-dark"><?= strtoupper($m['kategori']); ?></span></td>
                        <td class="text-warning"><?= formatRupiah($m['harga']); ?></td>
                        <td class="small text-secondary"><?= htmlspecialchars($m['deskripsi']); ?></td>
                        <td><span class="badge bg-success"><?= htmlspecialchars($m['status']); ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEditMenu<?= $m['id']; ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="index.php?page=menu&hapus_menu=<?= $m['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus menu ini?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- MODAL EDIT MENU -->
                    <div class="modal fade" id="modalEditMenu<?= $m['id']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-dark text-light border-secondary">
                                <div class="modal-header border-secondary">
                                    <h5 class="modal-title text-warning fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Menu</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_menu" value="<?= $m['id']; ?>">
                                    <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($m['gambar']); ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label text-secondary small fw-semibold">Nama Menu</label>
                                            <input type="text" name="nama" class="form-control bg-black text-light border-secondary shadow-none" value="<?= htmlspecialchars($m['nama']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-secondary small fw-semibold">Kategori</label>
                                            <select name="kategori" class="form-select bg-black text-light border-secondary shadow-none" required>
                                                <option value="espresso" <?= $m['kategori'] == 'espresso' ? 'selected' : ''; ?>>Espresso</option>
                                                <option value="non-coffee" <?= $m['kategori'] == 'non-coffee' ? 'selected' : ''; ?>>Non-Kopi</option>
                                                <option value="pastry" <?= $m['kategori'] == 'pastry' ? 'selected' : ''; ?>>Pastry & Makanan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-secondary small fw-semibold">Harga (Rp)</label>
                                            <input type="number" name="harga" class="form-control bg-black text-light border-secondary shadow-none" value="<?= $m['harga']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-secondary small fw-semibold">Ganti Gambar (Pilih File)</label>
                                            <input type="file" name="gambar" class="form-control bg-black text-light border-secondary shadow-none" accept="image/*">
                                            <small class="text-secondary">Kosongkan jika tidak ingin mengubah gambar.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-secondary small fw-semibold">Deskripsi Singkat</label>
                                            <textarea name="deskripsi" class="form-control bg-black text-light border-secondary shadow-none" rows="3"><?= htmlspecialchars($m['deskripsi']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-secondary">
                                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" name="update_menu" class="btn btn-warning rounded-pill fw-bold">Update Menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-secondary py-3">Belum ada menu tersimpan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH MENU -->
<div class="modal fade" id="modalTambahMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-warning fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Menu Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Nama Menu</label>
                        <input type="text" name="nama" class="form-control bg-black text-light border-secondary shadow-none" placeholder="Contoh: Es Kopi Aren" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select bg-black text-light border-secondary shadow-none" required>
                            <option value="espresso">Espresso</option>
                            <option value="non-coffee">Non-Kopi</option>
                            <option value="pastry">Pastry & Makanan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control bg-black text-light border-secondary shadow-none" placeholder="18000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Pilih Gambar Produk</label>
                        <input type="file" name="gambar" class="form-control bg-black text-light border-secondary shadow-none" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control bg-black text-light border-secondary shadow-none" rows="3" placeholder="Komposisi/Keterangan menu..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah_menu" class="btn btn-warning rounded-pill fw-bold">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>