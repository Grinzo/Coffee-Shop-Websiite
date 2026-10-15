<?php
// index.php Toko Kopi Paul
require_once 'config.php';

// Fetch data menu dari database MySQL secara dinamis
$query_menu = mysqli_query($conn, "SELECT * FROM menu WHERE status = 'tersedia' ORDER BY id DESC");
$menu_kopi = [];
if ($query_menu) {
    while ($row = mysqli_fetch_assoc($query_menu)) {
        $menu_kopi[] =$row;
    }
}

// Data promo statis
$promos = [
    [
        "judul" => "Let's Party Ke-4",
        "deskripsi" => "3 CUPS Kopi PAUL",
        "harga" => "ONLY 44K",
        "kode" => "PARTY44K",
        "tag" => "SPECIAL ANNIVERSARY",
        "badge_bg" => "bg-danger",
        "gambar" => "img/Kopi-gaul.jpeg"
    ],
    [
        "judul" => "Promo Pasangan",
        "deskripsi" => "2 ES KOPI PAUL (GULA AREN)",
        "harga" => "Rp 30.000",
        "kode" => "DUOPAUL30K",
        "tag" => "PAKET HEMAT",
        "badge_bg" => "bg-warning text-dark",
        "gambar" => "img/es-aren.jpeg"
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kopi Paul Official Website</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; background-color: #121212; color: #f8f9fa; padding-top: 70px; }
        section { padding: 80px 0; }
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
        }
        .hover-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(255, 193, 7, 0.15) !important; }
        .btn-login-custom {
            border: 2px solid #8a2be2 !important;
            color: #ffffff !important;
            background-color: transparent;
            border-radius: 50px !important;
            padding: 6px 24px !important;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }
        .btn-login-custom:hover { background-color: #8a2be2 !important; color: #ffffff !important; box-shadow: 0 0 12px rgba(138, 43, 226, 0.6); }
        .promo-slide-img { height: 350px; object-fit: cover; filter: brightness(0.7); }
    </style>
</head>
<body class="bg-dark text-light" data-bs-spy="scroll" data-bs-target="#navbar-example" data-bs-offset="100">

<!-- NAVBAR -->
<nav id="navbar-example" class="navbar navbar-expand-lg navbar-dark bg-black fixed-top border-bottom border-secondary px-3">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#home">
            <i class="bi bi-cup-hot fs-4 text-white"></i>
            <span class="fw-bold text-white fs-5" style="letter-spacing: 0.5px;">paul</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center my-2 my-lg-0 me-3">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#promo">Promo</a></li>
                <li class="nav-item"><a class="nav-link" href="#catalog">Katalog</a></li>
                <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item me-lg-2"><a class="nav-link" href="#contact">Kontak</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3 fs-5 py-2 py-lg-0 ms-lg-2 text-white">
                <a href="#catalog" class="text-white text-decoration-none" title="Favorit"><i class="bi bi-heart"></i></a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#searchModal" class="text-white text-decoration-none" title="Cari"><i class="bi bi-search"></i></a>
                <button type="button" class="btn btn-link text-white text-decoration-none position-relative p-0 fs-5" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" title="Keranjang">
                    <i class="bi bi-cart3"></i>
                    <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fs-6 d-none">0</span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- HOME -->
<section id="home" class="hero-section text-center m-0">
    <div class="container position-relative text-white py-5">
        <h1 class="display-3 fw-bold">Mari Nikmati Secangkir <span class="text-warning">Kopi</span></h1>
        <p class="lead my-4 mx-auto text-light-50" style="max-width: 650px;">
            Suasana tenang, aroma kopi menyegarkan, dan kenangan indah di setiap tegukan bersama Toko Kopi Paul.
        </p>
        <a href="#catalog" class="btn btn-warning btn-lg px-4 rounded-pill fw-semibold me-2">Pesan Sekarang</a>
        <a href="#about" class="btn btn-outline-light btn-lg px-4 rounded-pill">Pelajari Lebih</a>
    </div>
</section>

<!-- TENTANG KAMI -->
<section id="about" class="bg-black border-top border-secondary">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow" alt="Tentang Toko Kopi Paul">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold text-uppercase mb-3">Tentang <span class="text-warning">Toko Kopi Paul</span></h2>
                <div class="bg-warning mb-4" style="height: 3px; width: 60px;"></div>
                <p class="text-secondary fs-5">Kami menyajikan biji kopi pilihan terbaik yang dipanggang secara presisi untuk menghadirkan rasa dan aroma otentik.</p>
                <p class="text-secondary">Didirikan dengan semangat kebersamaan, Toko Kopi Paul menjadi ruang bagi Anda untuk bersantai, bekerja, atau sekadar menikmati waktu hangat bersama orang tersayang.</p>
            </div>
        </div>
    </div>
</section>

<!-- PROMO -->
<section id="promo" class="bg-dark border-top border-secondary">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Promo <span class="text-warning">Spesial</span></h2>
            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 60px;"></div>
            <p class="text-secondary">Dapatkan penawaran terbaik untuk kopi favoritmu minggu ini.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($promos as$promo): ?>
            <div class="col-md-6 col-lg-5">
                <div class="card bg-black text-light border-secondary shadow-sm h-100 hover-card">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge <?= $promo['badge_bg']; ?> mb-3"><?= $promo['tag']; ?></span>
                            <h4 class="fw-bold text-warning"><?= $promo['judul']; ?></h4>
                            <p class="text-light fs-5"><?= $promo['deskripsi']; ?></p>
                            <h3 class="fw-bold my-3"><?= $promo['harga']; ?></h3>
                        </div>
                        <div class="pt-3 border-top border-secondary d-flex justify-content-between align-items-center">
                            <small class="text-secondary">Kode Promo: <strong class="text-warning"><?= $promo['kode']; ?></strong></small>
                            <a href="#catalog" class="btn btn-sm btn-outline-warning rounded-pill">Gunakan</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- KATALOG (DINAMIS DARI DATABASE) -->
<section id="catalog" class="bg-black border-top border-secondary">
    <div class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-uppercase">Katalog <span class="text-warning">Produk / Service</span></h2>
            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 60px;"></div>
            <p class="text-secondary">Pilih menu favoritmu di bawah ini.</p>
        </div>
        <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
            <button class="btn btn-outline-warning active filter-btn" data-filter="all">Semua</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="espresso">Espresso</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="non-coffee">Non-Kopi</button>
            <button class="btn btn-outline-warning filter-btn" data-filter="pastry">Pastry & Makanan</button>
        </div>
        <div class="row g-4" id="menu-container">
            <?php if (count($menu_kopi) > 0): ?>
                <?php foreach ($menu_kopi as$item): ?>
                <div class="col-md-6 col-lg-4 menu-item" data-category="<?= htmlspecialchars($item['kategori'] ?? 'all'); ?>">
                    <div class="card bg-dark text-light h-100 border-secondary shadow-sm hover-card">
                        <img src="<?= htmlspecialchars($item['gambar']); ?>" class="card-img-top object-fit-cover" style="height: 220px;" onerror="this.src='https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=500&q=80'">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold mb-0 fs-6"><?= htmlspecialchars($item['nama']); ?></h5>
                                <span class="badge bg-warning text-dark text-nowrap"><?= isset($item['harga']) ? 'Rp ' . number_format($item['harga'], 0, ',', '.') : '-'; ?></span>
                            </div>
                            <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($item['deskripsi']); ?></p>
                            <div class="d-flex gap-2 mt-2">
                                <button class="btn btn-warning w-100 rounded-pill fw-semibold add-to-cart btn-sm" data-id="<?= $item['id']; ?>" data-nama="<?= htmlspecialchars($item['nama'], ENT_QUOTES); ?>" data-harga="<?= $item['harga']; ?>" data-gambar="<?= htmlspecialchars($item['gambar'], ENT_QUOTES); ?>">
                                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-secondary py-5">
                    <p class="fs-5">Belum ada menu yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- BLOG -->
<section id="blog" class="bg-dark border-top border-secondary">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Artikel <span class="text-warning">Kopi</span></h2>
            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 60px;"></div>
            <p class="text-secondary">Informasi dan cerita menarik seputar dunia kopi.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-black text-light border-secondary h-100">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-warning fs-6">Tips Menyeduh Kopi Manual Brew</h5>
                        <p class="card-text text-secondary small">Temukan teknik seduh V60 yang sempurna untuk menghasilkan rasa yang jernih dan beraroma khas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black text-light border-secondary h-100">
                    <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-warning fs-6">Mengenal Biji Kopi Arabika vs Robusta</h5>
                        <p class="card-text text-secondary small">Pahami perbedaan karakteristik rasa, tingkat keasaman, dan kadar kafein antar varietas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black text-light border-secondary h-100">
                    <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-warning fs-6">Sejarah Es Kopi Gula Aren</h5>
                        <p class="card-text text-secondary small">Bagaimana perpaduan espresso lokal dan gula aren menjadi minuman kopi paling favorit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section id="faq" class="bg-black border-top border-secondary">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Pertanyaan <span class="text-warning">Populer (FAQ)</span></h2>
            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 60px;"></div>
        </div>
        <div class="accordion accordion-flush mx-auto" id="faqAccordion" style="max-width: 800px;">
            <div class="accordion-item bg-dark text-light border border-secondary mb-2 rounded">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Apakah Toko Kopi Paul menyediakan layanan Delivery?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Ya, Anda dapat memesan langsung melalui website ini atau melalui platform ojek online mitra kami.
                    </div>
                </div>
            </div>
            <div class="accordion-item bg-dark text-light border border-secondary mb-2 rounded">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Jam berapa Toko Kopi Paul buka?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary">
                        Kami buka setiap hari Senin - Minggu mulai pukul 08:00 hingga 22:00 WIB.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="contact" class="bg-dark border-top border-secondary">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Hubungi <span class="text-warning">Kami</span></h2>
            <div class="bg-warning mx-auto mb-3" style="height: 3px; width: 60px;"></div>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 bg-black border border-secondary rounded-3">
                    <i class="bi bi-geo-alt fs-1 text-warning mb-2"></i>
                    <h5 class="fw-bold">Alamat</h5>
                    <p class="text-secondary small mb-0">Jl. Kopi No. 12, Jakarta Selatan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-black border border-secondary rounded-3">
                    <i class="bi bi-telephone fs-1 text-warning mb-2"></i>
                    <h5 class="fw-bold">Telepon / WA</h5>
                    <p class="text-secondary small mb-0">+62 812-3456-7890</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-black border border-secondary rounded-3">
                    <i class="bi bi-clock fs-1 text-warning mb-2"></i>
                    <h5 class="fw-bold">Jam Operasional</h5>
                    <p class="text-secondary small mb-0">Setiap Hari: 08:00 - 22:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-black text-center text-secondary py-4 border-top border-secondary">
    <div class="container">
        <p class="mb-0 small">Toko Kopi Paul &copy; <?= date('Y'); ?>. All rights reserved.</p>
    </div>
</footer>

<!-- MODAL SEARCH -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-black text-light border border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-warning"><i class="bi bi-search me-2"></i>Cari Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchInput" class="form-control bg-dark text-light border-secondary" placeholder="Masukkan nama kopi atau makanan...">
            </div>
        </div>
    </div>
</div>

<!-- OFFCANVAS KERANJANG -->
<div class="offcanvas offcanvas-end bg-black text-light" tabindex="-1" id="cartOffcanvas" style="width: 450px;">
    <div class="offcanvas-header border-bottom border-secondary">
        <h5 class="offcanvas-title text-warning"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <div id="cart-items" class="flex-grow-1 overflow-auto mb-3">
            <p class="text-secondary text-center py-5">Keranjang Anda masih kosong.</p>
        </div>
        <div class="border-top border-secondary pt-3">
            <div class="d-flex justify-content-between fs-5 fw-bold mb-3">
                <span>Total:</span>
                <span id="cart-total" class="text-warning">Rp 0</span>
            </div>
            <button class="btn btn-warning w-100 rounded-pill fw-semibold py-2" onclick="checkout()">
                <i class="bi bi-bag-check-fill me-1"></i> Checkout Sekarang
            </button>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let cart = JSON.parse(localStorage.getItem('tokokopi_cart')) || [];

    document.addEventListener('DOMContentLoaded', () => {
        renderCart();

        // Fitur Filter Katalog
        const filterBtns = document.querySelectorAll('.filter-btn');
        const menuItems = document.querySelectorAll('.menu-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');
                menuItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Fitur Pencarian Modal
        const searchInput = document.getElementById('searchInput');
        if(searchInput) {
            searchInput.addEventListener('keyup', (e) => {
                const query = e.target.value.toLowerCase();
                menuItems.forEach(item => {
                    const title = item.querySelector('.card-title').innerText.toLowerCase();
                    if (title.includes(query)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    });

    function saveCartToStorage() {
        localStorage.setItem('tokokopi_cart', JSON.stringify(cart));
    }

    // Tambah Produk ke Keranjang
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const harga = parseInt(button.getAttribute('data-harga'));
            const gambar = button.getAttribute('data-gambar');

            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cart.push({ id, nama, harga, gambar, qty: 1 });
            }
            saveCartToStorage();
            renderCart();

            let cartCanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
            cartCanvas.show();
        });
    });

    // Render Tampilan Keranjang
    function renderCart() {
        const cartContainer = document.getElementById('cart-items');
        const cartTotal = document.getElementById('cart-total');
        const cartBadge = document.getElementById('cart-badge');

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-secondary text-center py-5">Keranjang Anda masih kosong.</p>';
            cartTotal.innerText = 'Rp 0';
            cartBadge.classList.add('d-none');
            return;
        }

        let total = 0;
        let totalQty = 0;
        cartContainer.innerHTML = '';

        cart.forEach(item => {
            total += item.harga * item.qty;
            totalQty += item.qty;
            cartContainer.innerHTML += `
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom border-secondary">
                    <img src="${item.gambar}" class="rounded object-fit-cover" width="60" height="60" onerror="this.src='https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=500&q=80'">
                    <div class="flex-grow-1">
                        <h6 class="mb-0 fw-bold fs-6">${item.nama}</h6>
                        <small class="text-warning">Rp ${item.harga.toLocaleString('id-ID')}</small>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <button class="btn btn-sm btn-outline-secondary py-0 px-2 text-light" onclick="updateQty('${item.id}', -1)">-</button>
                            <small>${item.qty}</small>
                            <button class="btn btn-sm btn-outline-secondary py-0 px-2 text-light" onclick="updateQty('${item.id}', 1)">+</button>
                        </div>
                    </div>
                    <button class="btn btn-sm text-danger" onclick="removeItem('${item.id}')"><i class="bi bi-trash"></i></button>
                </div>
            `;
        });

        cartTotal.innerText = `Rp ${total.toLocaleString('id-ID')}`;
        cartBadge.innerText = totalQty;
        cartBadge.classList.remove('d-none');
    }

    function updateQty(id, change) {
        const item = cart.find(item => item.id === id);
        if (item) {
            item.qty += change;
            if (item.qty <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
        }
        saveCartToStorage();
        renderCart();
    }

    function removeItem(id) {
        cart = cart.filter(item => item.id !== id);
        saveCartToStorage();
        renderCart();
    }

    function checkout() {
        if (cart.length === 0) {
            alert('Keranjang belanja Anda masih kosong!');
            return;
        }
        saveCartToStorage();
        window.location.href = 'checkout.php';
    }
</script>
</body>
</html>