<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Kopi Paul</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #121212; color: #f8f9fa; }
    </style>
</head>
<body class="bg-dark text-light py-5">

<div class="container" style="max-width: 1000px;">
    <div class="mb-4">
        <a href="index.php" class="btn btn-outline-warning rounded-pill px-4 fw-semibold">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Menu
        </a>
    </div>

    <h2 class="fw-bold mb-4 text-warning"><i class="bi bi-bag-check-fill me-2"></i>Checkout Pesanan</h2>

    <div class="row g-4">
        <!-- Form Pemesan -->
        <div class="col-lg-7">
            <div class="card bg-black text-light border-secondary p-4 shadow-sm h-100">
                <h4 class="fw-bold mb-3 text-warning"><i class="bi bi-person-lines-fill me-2"></i>Informasi Pemesan</h4>
                
                <form id="checkout-form">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control bg-dark text-light border-secondary shadow-none" placeholder="Masukkan nama pemesan..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-semibold">Nomor WhatsApp</label>
                            <input type="text" id="whatsapp" class="form-control bg-dark text-light border-secondary shadow-none" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-semibold">Email (Opsional)</label>
                            <input type="email" id="email" class="form-control bg-dark text-light border-secondary shadow-none" placeholder="nama@email.com">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Metode Layanan</label>
                        <select id="metode_layanan" class="form-select bg-dark text-light border-secondary shadow-none" onchange="renderCheckoutSummary()" required>
                            <option value="dine_in">Dine-in (Makan di Tempat)</option>
                            <option value="delivery">Delivery (Pengiriman Kurir)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Alamat Lengkap Pengiriman</label>
                        <textarea id="alamat" class="form-control bg-dark text-light border-secondary shadow-none" rows="2" placeholder="Wajib diisi jika memilih Delivery..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Metode Pembayaran</label>
                        <select id="pembayaran" class="form-select bg-dark text-light border-secondary shadow-none" onchange="togglePaymentInfo()" required>
                            <option value="">-- Pilih Metode Pembayaran --</option>
                            <option value="Tunai / Cash">Tunai / Cash</option>
                            <option value="QRIS">QRIS All Payment</option>
                            <option value="Transfer Bank">Transfer Bank (BCA)</option>
                        </select>
                    </div>

                    <!-- Panel Info QRIS & Transfer -->
                    <div id="qris-info" class="card bg-dark text-light border-warning p-3 mb-3" style="display: none;">
                        <h6 class="fw-bold text-warning mb-2"><i class="bi bi-qr-code-scan me-2"></i>Pembayaran via QRIS</h6>
                        <p class="small text-secondary mb-2">Silakan scan kode QRIS di bawah ini dengan aplikasi e-Wallet / Mobile Banking Anda:</p>
                        <div class="text-center my-2">
                            <img src="img/qris-sample.png" onerror="this.src='https://via.placeholder.com/200x200?text=QRIS+KOPI+PAUL';" width="180" class="img-thumbnail bg-white p-2">
                        </div>
                    </div>

                    <div id="transfer-info" class="card bg-dark text-light border-warning p-3 mb-3" style="display: none;">
                        <h6 class="fw-bold text-warning mb-2"><i class="bi bi-bank me-2"></i>Transfer Bank BCA</h6>
                        <p class="small text-secondary mb-1">Nomor Rekening: <strong class="text-white">123-456-7890</strong></p>
                        <p class="small text-secondary mb-0">Atas Nama: <strong class="text-white">Toko Kopi Paul</strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-semibold">Catatan Pesanan (Opsional)</label>
                        <textarea id="catatan" class="form-control bg-dark text-light border-secondary shadow-none" rows="2" placeholder="Contoh: Es sedikit saja, nomor meja, dll."></textarea>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-lg-5">
            <div class="card bg-black text-light border-secondary p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                <div>
                    <h4 class="fw-bold mb-3 text-warning"><i class="bi bi-receipt me-2"></i>Ringkasan Pesanan</h4>
                    <div id="checkout-items" class="mb-3 overflow-auto" style="max-height: 250px;"></div>
                    <hr class="border-secondary">
                    <div class="d-flex justify-content-between mb-2 text-secondary small">
                        <span>Subtotal Menu</span>
                        <span id="subtotal-text" class="text-light">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-secondary small">
                        <span>Biaya Pengiriman</span>
                        <span id="ongkir-text" class="text-light">Rp 0</span>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between fs-5 fw-bold mb-3 pt-2 border-top border-secondary">
                        <span>Total Bayar</span>
                        <span id="total-text" class="text-warning">Rp 0</span>
                    </div>
                    <button type="button" class="btn btn-warning w-100 rounded-pill fw-semibold py-2" onclick="prosesPesan()">
                        <i class="bi bi-check-circle-fill me-1"></i> Buat Pesanan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let cart = JSON.parse(localStorage.getItem('tokokopi_cart')) || [];
    const ongkirNormal = 5000;

    document.addEventListener('DOMContentLoaded', () => {
        renderCheckoutSummary();
    });

    function togglePaymentInfo() {
        const pembayaran = document.getElementById('pembayaran').value;
        document.getElementById('qris-info').style.display = (pembayaran === 'QRIS') ? 'block' : 'none';
        document.getElementById('transfer-info').style.display = (pembayaran === 'Transfer Bank') ? 'block' : 'none';
    }

    function renderCheckoutSummary() {
        const container = document.getElementById('checkout-items');
        const subtotalText = document.getElementById('subtotal-text');
        const ongkirText = document.getElementById('ongkir-text');
        const totalText = document.getElementById('total-text');
        const metodeLayanan = document.getElementById('metode_layanan').value;

        if (cart.length === 0) {
            container.innerHTML = '<p class="text-secondary text-center py-3">Keranjang Anda kosong.</p>';
            subtotalText.innerText = 'Rp 0';
            ongkirText.innerText = 'Rp 0';
            totalText.innerText = 'Rp 0';
            return;
        }

        let subtotal = 0;
        container.innerHTML = '';

        cart.forEach(item => {
            subtotal += item.harga * item.qty;
            container.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-secondary">
                    <div>
                        <h6 class="mb-0 fs-6 fw-semibold">${item.nama}</h6>
                        <small class="text-secondary">${item.qty}x Rp ${item.harga.toLocaleString('id-ID')}</small>
                    </div>
                    <span class="text-warning small">Rp ${(item.harga * item.qty).toLocaleString('id-ID')}</span>
                </div>
            `;
        });

        let ongkir = (metodeLayanan === 'delivery') ? ongkirNormal : 0;
        let total = subtotal + ongkir;

        subtotalText.innerText = `Rp ${subtotal.toLocaleString('id-ID')}`;
        ongkirText.innerText = `Rp ${ongkir.toLocaleString('id-ID')}`;
        totalText.innerText = `Rp ${total.toLocaleString('id-ID')}`;
    }

    function prosesPesan() {
        const nama = document.getElementById('nama').value.trim();
        const whatsapp = document.getElementById('whatsapp').value.trim();
        const email = document.getElementById('email').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const metodeLayanan = document.getElementById('metode_layanan').value;
        const pembayaran = document.getElementById('pembayaran').value;
        const catatan = document.getElementById('catatan').value.trim();

        if (!nama || !whatsapp) {
            alert('Mohon lengkapi Nama dan Nomor WhatsApp.');
            return;
        }

        if (!pembayaran) {
            alert('Mohon pilih Metode Pembayaran.');
            return;
        }

        if (metodeLayanan === 'delivery' && !alamat) {
            alert('Untuk pengiriman kurir (Delivery), Alamat Lengkap wajib diisi!');
            document.getElementById('alamat').focus();
            return;
        }

        if (cart.length === 0) {
            alert('Keranjang belanja Anda kosong!');
            return;
        }

        const payload = {
            nama: nama,
            whatsapp: whatsapp,
            email: email,
            alamat: alamat,
            metode_layanan: metodeLayanan,
            pembayaran: pembayaran,
            catatan: catatan,
            cart: cart
        };

        fetch('proses_checkout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.removeItem('tokokopi_cart');
                // Redirect ke Halaman Cetak Struk
                window.location.href = 'cetak_struk.php?id=' + data.id_pesanan;
            } else {
                alert('Gagal memproses pesanan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan.');
        });
    }
</script>
</body>
</html>