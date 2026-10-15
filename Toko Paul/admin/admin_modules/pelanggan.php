<?php
// admin/admin_modules/pelanggan.php

/** @var mysqli $conn */

// Mengambil data pelanggan dari database
$pelanggan = (isset($conn) && $conn) ? mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id DESC") : false;
?>
<h3 class="fw-bold text-warning mb-4"><i class="bi bi-people me-2"></i>Data Pelanggan</h3>
<div class="card card-custom p-4 bg-black text-light border-secondary">
    <div class="table-responsive">
        <table class="table table-dark align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Pelanggan</th>
                    <th>WhatsApp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($pelanggan && mysqli_num_rows($pelanggan) > 0): ?>
                    <?php while ($c = mysqli_fetch_assoc($pelanggan)): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($c['nama']); ?></td>
                        <td>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $c['whatsapp']); ?>" target="_blank" class="text-warning text-decoration-none">
                                <i class="bi bi-whatsapp me-1"></i><?= htmlspecialchars($c['whatsapp']); ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($c['email'] ?? '-'); ?></td>
                        <td class="small text-secondary"><?= htmlspecialchars($c['alamat'] ?? '-'); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-secondary py-3">Belum ada data pelanggan tersimpan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>