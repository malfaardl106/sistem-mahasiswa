<?php
// hapus.php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require "koneksi.php";

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
header("Location: index.php");
exit;
?>