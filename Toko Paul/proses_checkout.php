<?php
header('Content-Type: application/json');
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Data tidak valid.']);
    exit;
}

$nama           = mysqli_real_escape_string($conn, $data['nama'] ?? '');
$whatsapp       = mysqli_real_escape_string($conn, $data['whatsapp'] ?? '-');
$email          = mysqli_real_escape_string($conn, $data['email'] ?? '-');
$alamat         = mysqli_real_escape_string($conn, $data['alamat'] ?? '-');
$metode_layanan = mysqli_real_escape_string($conn, $data['metode_layanan'] ?? 'dine_in');
$pembayaran     = mysqli_real_escape_string($conn, $data['pembayaran'] ?? 'Tunai');
$catatan        = mysqli_real_escape_string($conn, $data['catatan'] ?? '');
$cart           = $data['cart'] ?? [];

if (empty($nama) || empty($whatsapp)) {
    echo json_encode(['success' => false, 'message' => 'Nama dan WhatsApp wajib diisi.']);
    exit;
}

if (empty($cart)) {
    echo json_encode(['success' => false, 'message' => 'Keranjang pesanan kosong.']);
    exit;
}

// 1. Simpan / Update Pelanggan
$id_pelanggan = null;
$check_pelanggan = mysqli_query($conn, "SELECT id FROM pelanggan WHERE whatsapp = '$whatsapp'");

if (mysqli_num_rows($check_pelanggan) > 0) {
    $p = mysqli_fetch_assoc($check_pelanggan);
    $id_pelanggan = $p['id'];
    mysqli_query($conn, "UPDATE pelanggan SET nama = '$nama', email = '$email', alamat = '$alamat' WHERE id = $id_pelanggan");
} else {
    mysqli_query($conn, "INSERT INTO pelanggan (nama, whatsapp, email, alamat) VALUES ('$nama', '$whatsapp', '$email', '$alamat')");
    $id_pelanggan = mysqli_insert_id($conn);
}

// 2. Kalkulasi
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += ($item['harga'] * $item['qty']);
}
$biaya_ongkir = ($metode_layanan === 'delivery') ? 5000 : 0;
$total_bayar  = $subtotal + $biaya_ongkir;
$kode_pesanan = 'ORD-' . date('Ymd') . '-' . rand(100, 999);

// 3. Insert Pesanan
$query_pesanan = "INSERT INTO pesanan (kode_pesanan, id_pelanggan, nama_pemesan, metode_layanan, whatsapp, email, alamat, metode_pembayaran, catatan, subtotal, biaya_ongkir, total_bayar, status) 
                  VALUES ('$kode_pesanan', $id_pelanggan, '$nama', '$metode_layanan', '$whatsapp', '$email', '$alamat', '$pembayaran', '$catatan', $subtotal, $biaya_ongkir, $total_bayar, 'Pending')";

if (mysqli_query($conn, $query_pesanan)) {
    $id_pesanan = mysqli_insert_id($conn);

    foreach ($cart as $item) {
        $id_menu   = (int)$item['id'];
        $nama_menu = mysqli_real_escape_string($conn, $item['nama']);
        $harga     = (int)$item['harga'];
        $qty       = (int)$item['qty'];
        $sub       = $harga * $qty;

        mysqli_query($conn, "INSERT INTO detail_pesanan (id_pesanan, id_menu, nama_menu, harga, qty, subtotal) VALUES ($id_pesanan, $id_menu, '$nama_menu', $harga, $qty, $sub)");
    }

    echo json_encode([
        'success'    => true,
        'id_pesanan' => $id_pesanan,
        'kode'       => $kode_pesanan
    ]);
} else {
    echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
}
?>