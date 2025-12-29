<?php
session_start();
include "../config/koneksi.php";

/* ================== CEK LOGIN DOSEN ================== */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../login.php");
    exit;
}

$nidn = $_SESSION['username'];

/* ================== AMBIL JADWAL DOSEN ================== */
$query = mysqli_query($conn, "
    SELECT 
        j.hari,
        j.jam_mulai,
        j.jam_selesai,
        j.ruangan,
        mk.nama_mk,
        mk.sks,
        ta.tahun,
        ta.semester
    FROM jadwal j
    JOIN mata_kuliah mk ON j.kode_mk = mk.kode_mk
    JOIN tahun_akademik ta ON j.id_ta = ta.id_ta
    WHERE j.nidn = '$0012345601'
    ORDER BY FIELD(j.hari,'SENIN','SELASA','RABU','KAMIS','JUMAT'), j.jam_mulai
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Mengajar</title>
    <link rel="stylesheet" href="dosen_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>UNPRI DOSEN</h3>
        <small>Sistem Akademik</small>
    </div>
    <div class="menu">
        <a href="dashboard_dosen.php">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="jadwal_dosen.php" class="active">
            <i class="fas fa-calendar"></i> Jadwal Mengajar
        </a>
        <a href="absensi.php">
            <i class="fas fa-clipboard-check"></i> Absensi
        </a>
        <a href="nilai.php">
            <i class="fas fa-pen"></i> Nilai
        </a>
        <a href="../logout.php">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="header-area">
        <h2>Jadwal Mengajar</h2>
        <p>NIDN: <b><?= htmlspecialchars($nidn) ?></b></p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Ruangan</th>
                    <th>Tahun Akademik</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['hari'] ?></td>
                        <td><?= substr($row['jam_mulai'],0,5) ?> - <?= substr($row['jam_selesai'],0,5) ?></td>
                        <td><?= $row['nama_mk'] ?></td>
                        <td><?= $row['sks'] ?></td>
                        <td><?= $row['ruangan'] ?></td>
                        <td><?= $row['tahun'] ?> (<?= $row['semester'] ?>)</td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">Tidak ada jadwal mengajar</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
