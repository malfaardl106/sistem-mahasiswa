<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require "koneksi.php";
require "bahasa.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
$stmt->execute([':id' => $id]);
$mhs = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mhs) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = trim($_POST['nim']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $jurusan = trim($_POST['jurusan']);
    $angkatan = trim($_POST['angkatan']);

    $stmt = $pdo->prepare("UPDATE mahasiswa SET nim = :nim, nama = :nama, email = :email, jurusan = :jurusan, angkatan = :angkatan WHERE id = :id");
    $stmt->execute([
        ':nim' => $nim,
        ':nama' => $nama,
        ':email' => $email,
        ':jurusan' => $jurusan,
        ':angkatan' => $angkatan,
        ':id' => $id
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $t['edit']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 600px;">
    <h2><?php echo $t['edit']; ?> Mahasiswa</h2>
    <form method="POST">
        <div class="mb-3">
            <label><?php echo $t['nim']; ?></label>
            <input type="text" name="nim" class="form-control" value="<?php echo htmlspecialchars($mhs['nim']); ?>" required>[cite: 61]
        </div>
        <div class="mb-3">
            <label><?php echo $t['nama']; ?></label>
            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($mhs['nama']); ?>" required>[cite: 61]
        </div>
        <div class="mb-3">
            <label><?php echo $t['email']; ?></label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($mhs['email']); ?>" required>[cite: 61]
        </div>
        <div class="mb-3">
            <label><?php echo $t['jurusan']; ?></label>
            <input type="text" name="jurusan" class="form-control" value="<?php echo htmlspecialchars($mhs['jurusan']); ?>" required>[cite: 61]
        </div>
        <div class="mb-3">
            <label><?php echo $t['angkatan']; ?></label>
            <input type="number" name="angkatan" class="form-control" value="<?php echo htmlspecialchars($mhs['angkatan']); ?>" required>[cite: 61]
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $t['ubah']; ?></button>
        <a href="index.php" class="btn btn-secondary"><?php echo $t['kembali']; ?></a>
    </form>
</body>
</html>