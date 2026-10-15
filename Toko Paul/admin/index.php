<?php
// admin/index.php
require_once '../config.php'; // Menggunakan ../ agar memanggil config.php di folder utama
check_admin_login();

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toko Kopi Paul</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #121212; color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #0a0a0a; border-right: 1px solid #2d2d2d; }
        .sidebar .nav-link { color: #aaa; font-size: 0.9rem; padding: 0.75rem 1.25rem; border-radius: 8px; margin-bottom: 4px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #ffc107; background-color: #1f1f1f; font-weight: 600; }
        .card-custom { background-color: #1a1a1a; border: 1px solid #2d2d2d; border-radius: 12px; }
        .table-dark-custom { --bs-table-bg: #1a1a1a; --bs-table-border-color: #2d2d2d; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR MENU -->
        <div class="col-md-3 col-lg-2 sidebar p-3 d-flex flex-column justify-content-between">
            <div>
                <a href="index.php" class="d-flex align-items-center gap-2 mb-4 text-decoration-none text-white px-2">
                    <i class="bi bi-cup-hot-fill fs-3 text-warning"></i>
                    <span class="fs-5 fw-bold">PAUL ADMIN</span>
                </a>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'dashboard' ? 'active' : ''; ?>" href="index.php?page=dashboard">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'pesanan' ? 'active' : ''; ?>" href="index.php?page=pesanan">
                            <i class="bi bi-receipt me-2"></i> Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'menu' ? 'active' : ''; ?>" href="index.php?page=menu">
                            <i class="bi bi-cup-straw me-2"></i> Menu & Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'stok' ? 'active' : ''; ?>" href="index.php?page=stok">
                            <i class="bi bi-box-seam me-2"></i> Stok Bahan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'pelanggan' ? 'active' : ''; ?>" href="index.php?page=pelanggan">
                            <i class="bi bi-people me-2"></i> Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'laporan' ? 'active' : ''; ?>" href="index.php?page=laporan">
                            <i class="bi bi-graph-up-arrow me-2"></i> Laporan Penjualan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'pengaturan' ? 'active' : ''; ?>" href="index.php?page=pengaturan">
                            <i class="bi bi-gear me-2"></i> Pengaturan
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="px-2 mb-3 text-secondary small">
                    Logged in as: <br><strong class="text-light"><?= htmlspecialchars($_SESSION['admin_nama'] ?? 'Admin'); ?></strong>
                </div>
                <a href="logout.php" class="btn btn-outline-danger w-100 rounded-pill btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="col-md-9 col-lg-10 p-4">
            <?php
            switch ($page) {
                case 'dashboard':
                    include 'admin_modules/dashboard.php';
                    break;
                case 'pesanan':
                    include 'admin_modules/pesanan.php';
                    break;
                case 'menu':
                    include 'admin_modules/menu.php';
                    break;
                case 'stok':
                    include 'admin_modules/stok.php';
                    break;
                case 'pelanggan':
                    include 'admin_modules/pelanggan.php';
                    break;
                case 'laporan':
                    include 'admin_modules/laporan.php';
                    break;
                case 'pengaturan':
                    include 'admin_modules/pengaturan.php';
                    break;
                default:
                    include 'admin_modules/dashboard.php';
                    break;
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>