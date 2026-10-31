<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require "koneksi.php";
require "bahasa.php";

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $jurusan = trim($_POST['jurusan']);
    $angkatan = trim($_POST['angkatan']);

    // Validasi data menggunakan if-else[cite: 59]
    if (empty($nim)) {
        $error[] = "NIM tidak boleh kosong.";
    }
    if (empty($nama)) {
        $error[] = "Nama tidak boleh kosong.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }
    if (empty($jurusan)) {
        $error[] = "Jurusan tidak boleh kosong.";
    }
    if (!is_numeric($angkatan)) {
        $error[] = "Angkatan harus berupa angka.";
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO mahasiswa (nim, nama, email, jurusan, angkatan) VALUES (:nim, :nama, :email, :jurusan, :angkatan)");
            $stmt->execute([
                ':nim' => $nim,
                ':nama' => $nama,
                ':email' => $email,
                ':jurusan' => $jurusan,
                ':angkatan' => $angkatan
            ]);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error[] = "Gagal menyimpan data (NIM mungkin sudah terdaftar): " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $t['tambah']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2><?php echo $t['tambah']; ?></h2>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php foreach ($error as $err) echo "- $err<br>"; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label><?php echo $t['nim']; ?></label>
            <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label><?php echo $t['nama']; ?></label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label><?php echo $t['email']; ?></label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label><?php echo $t['jurusan']; ?></label>
            <input type="text" name="jurusan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label><?php echo $t['angkatan']; ?></label>
            <input type="number" name="angkatan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success"><?php echo $t['simpan']; ?></button>
        <a href="index.php" class="btn btn-secondary"><?php echo $t['kembali']; ?></a>
    </form>
</body>
</html>