<?php
session_start();
include '../koneksi.php';

/* contoh isi session saat login mahasiswa
$_SESSION['nim'] = '230001';
$_SESSION['nama'] = 'Andi Saputra';
$_SESSION['jurusan'] = 'Teknik Informatika';
*/

if ($_SESSION['role'] != 'mahasiswa') {
    header("location:../login.php");
    exit;
}

$tanggal = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Mahasiswa</title>
    <link rel="stylesheet" href="../absensi.css">
</head>
<body>

<div class="container">
    <h2>Absensi Mahasiswa</h2>

    <form method="POST" action="simpan_absensi.php">
        <input type="hidden" name="nim" value="<?= $_SESSION['nim']; ?>">
        <input type="hidden" name="nama" value="<?= $_SESSION['nama']; ?>">
        <input type="hidden" name="jurusan" value="<?= $_SESSION['jurusan']; ?>">
        <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">

        <p><b>NIM:</b> <?= $_SESSION['nim']; ?></p>
        <p><b>Nama:</b> <?= $_SESSION['nama']; ?></p>
        <p><b>Jurusan:</b> <?= $_SESSION['jurusan']; ?></p>
        <p><b>Tanggal:</b> <?= $tanggal; ?></p>

        <label>Status Kehadiran</label>
        <select name="status" required>
            <option value="">-- Pilih --</option>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
        </select>

        <br><br>
        <button type="submit">Simpan Absensi</button>
    </form>
</div>

</body>
</html>
