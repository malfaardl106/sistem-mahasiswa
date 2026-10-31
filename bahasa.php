<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'id';
}

if (isset($_GET['lang']) && ($_GET['lang'] == 'en' || $_GET['lang'] == 'id')) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = [
    'id' => [
        'judul' => 'Sistem Manajemen Data Mahasiswa',
        'login' => 'Login Administrator',
        'username' => 'Username',
        'password' => 'Password',
        'btn_login' => 'Masuk',
        'tambah' => 'Tambah Mahasiswa Baru',
        'nim' => 'NIM',
        'nama' => 'Nama Lengkap',
        'email' => 'Email',
        'jurusan' => 'Jurusan',
        'angkatan' => 'Angkatan',
        'aksi' => 'Aksi',
        'edit' => 'Ubah',
        'hapus' => 'Hapus',
        'logout' => 'Keluar',
        'kembali' => 'Kembali',
        'simpan' => 'Simpan Data',
        'ubah' => 'Perbarui Data'
    ],
    'en' => [
        'judul' => 'Student Data Management System',
        'login' => 'Administrator Login',
        'username' => 'Username',
        'password' => 'Password',
        'btn_login' => 'Login',
        'tambah' => 'Add New Student',
        'nim' => 'Student ID (NIM)',
        'nama' => 'Full Name',
        'email' => 'Email',
        'jurusan' => 'Major',
        'angkatan' => 'Batch Year',
        'aksi' => 'Action',
        'edit' => 'Edit',
        'hapus' => 'Delete',
        'logout' => 'Logout',
        'kembali' => 'Back',
        'simpan' => 'Save Data',
        'ubah' => 'Update Data'
    ]
];

$t = $lang[$_SESSION['lang']];
?>