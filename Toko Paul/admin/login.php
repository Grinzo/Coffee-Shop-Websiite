<?php
// admin/login.php
require_once '../config.php';

/** @var mysqli $conn */

// Redirect jika sudah login
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (isset($conn) && $conn) {
        $email_clean = mysqli_real_escape_string($conn, $email);
        $query       = mysqli_query($conn, "SELECT * FROM users_admin WHERE email = '$email_clean'");
        $admin       = $query ? mysqli_fetch_assoc($query) : null;

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id']        = $admin['id'];
            $_SESSION['admin_nama']      = $admin['nama'];
            $_SESSION['admin_email']     = $admin['email'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Email atau password salah!";
        }
    } else {
        $error = "Koneksi database terputus!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Toko Kopi Paul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #121212; color: #f8f9fa; }
    </style>
</head>
<body class="bg-dark text-light d-flex align-items-center justify-content-center vh-100">
    <div class="card bg-black text-light border-secondary p-4 shadow-lg" style="width: 380px;">
        <div class="text-center mb-3">
            <i class="bi bi-cup-hot-fill fs-1 text-warning"></i>
            <h4 class="text-warning fw-bold mt-2">PAUL ADMIN</h4>
            <p class="text-secondary small">Masukkan kredensial admin Anda</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger py-2 small"><?= $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small text-secondary fw-semibold">Email Admin</label>
                <input type="email" name="email" class="form-control bg-dark text-light border-secondary shadow-none" placeholder="admin@tokokopipaul.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label small text-secondary fw-semibold">Password</label>
                <input type="password" name="password" class="form-control bg-dark text-light border-secondary shadow-none" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill mt-2">Login Masuk</button>
        </form>
    </div>
</body>
</html>