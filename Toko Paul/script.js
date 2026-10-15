let cart = [];

// Filter Menu
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const filter = button.getAttribute('data-filter');
        document.querySelectorAll('.menu-item').forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Tambah Keranjang
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

        renderCart();
    });
});

// Render Keranjang
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
                <img src="${item.gambar}" class="rounded object-fit-cover" width="60" height="60">
                <div class="flex-grow-1">
                    <h6 class="mb-0 fw-bold">${item.nama}</h6>
                    <small class="text-warning">Rp ${item.harga.toLocaleString('id-ID')}</small>
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateQty('${item.id}', -1)">-</button>
                        <small>${item.qty}</small>
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="updateQty('${item.id}', 1)">+</button>
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
    renderCart();
}

function removeItem(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

function checkout() {
    if (cart.length === 0) {
        alert('Keranjang belanja Anda masih kosong!');
        return;
    }
    alert('Terima kasih! Pesanan Anda telah diterima.');
    cart = [];
    renderCart();
}

// Live Search
function liveSearch() {
    const keyword = document.getElementById('search-input').value.toLowerCase();
    document.querySelectorAll('.menu-item').forEach(item => {
        const title = item.querySelector('.card-title').innerText.toLowerCase();
        if (title.includes(keyword)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

// Submit Form
function handleFormSubmit(e) {
    e.preventDefault();
    alert('Pesan Anda berhasil dikirim! Terima kasih.');
    e.target.reset();
}