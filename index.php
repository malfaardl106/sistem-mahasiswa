<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require "koneksi.php";
require "bahasa.php";

$stmt = $pdo->query("SELECT * FROM mahasiswa");
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $t['judul']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo $t['judul']; ?></h2>
        <div>
            <a href="index.php?lang=id" class="btn btn-sm btn-outline-primary">ID</a>
            <a href="index.php?lang=en" class="btn btn-sm btn-outline-primary">EN</a>
            <a href="logout.php" class="btn btn-sm btn-danger ms-2"><?php echo $t['logout']; ?></a>
        </div>
    </div>

    <a href="tambah.php" class="btn btn-success mb-3"><?php echo $t['tambah']; ?></a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th><?php echo $t['nim']; ?></th>
                <th><?php echo $t['nama']; ?></th>
                <th><?php echo $t['email']; ?></th>
                <th><?php echo $t['jurusan']; ?></th>
                <th><?php echo $t['angkatan']; ?></th>
                <th><?php echo $t['aksi']; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($mhs['nim']); ?>[cite: 61]</td>
                <td><?php echo htmlspecialchars($mhs['nama']); ?>[cite: 61]</td>
                <td><?php echo htmlspecialchars($mhs['email']); ?>[cite: 61]</td>
                <td><?php echo htmlspecialchars($mhs['jurusan']); ?>[cite: 61]</td>
                <td><?php echo htmlspecialchars($mhs['angkatan']); ?>[cite: 61]</td>
                <td>
                    <a href="edit.php?id=<?php echo $mhs['id']; ?>" class="btn btn-warning btn-sm"><?php echo $t['edit']; ?></a>
                    <a href="hapus.php?id=<?php echo $mhs['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><?php echo $t['hapus']; ?></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>