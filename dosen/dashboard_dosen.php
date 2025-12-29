<?php
session_start();
include "../config/koneksi.php";

// ================== CEK LOGIN DOSEN ==================
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
    header("Location: ../login.php");
    exit;
}

$nidn = $_SESSION['username']; // username = nidn

// ================== DATA DOSEN ==================
$qDosen = mysqli_query($conn, "SELECT * FROM dosen WHERE nidn='$nidn'");
$dosen  = mysqli_fetch_assoc($qDosen) ?? ['nama' => $nidn];

// ================== DATA KHUSUS DOSEN ==================
$qJadwal = mysqli_query($conn, "
    SELECT COUNT(*) total 
    FROM jadwal 
    WHERE nidn='$nidn'
");
$jadwal = mysqli_fetch_assoc($qJadwal)['total'];

// ================== DATA GLOBAL (VIEW) ==================
$ip = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT ip_rata_rata FROM v_ip_rata_rata")
) ?? ['ip_rata_rata' => 0];


$mhsAktif = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT total_mahasiswa_aktif FROM v_mahasiswa_aktif")
) ?? ['total_mahasiswa_aktif' => 0];


$kelulusan = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM v_stat_kelulusan")
) ?? [
    'lulus' => 0,
    'belum_lulus' => 0
];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
    <link rel="stylesheet" href="dosen_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>UNPRI DOSEN</h3>
        <small>Sistem Akademik</small>
    </div>
    <div class="menu">
        <a href="dashboard_dosen.php" class="active">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="jadwal_dosen.php">
            <i class="fas fa-calendar"></i> Jadwal Mengajar
        </a>
        <a href="absensi.php">
            <i class="fas fa-clipboard-check"></i> Absensi
        </a>
        <a href="nilai.php">
            <i class="fas fa-pen"></i> Nilai
        </a>
        <a href="logout.php">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<!-- ================= CONTENT ================= -->
<div class="content">

    <div class="header-area">
        <div>
            <h2>Dashboard Dosen</h2>
            <p>Selamat datang, <?= $dosen['nama']; ?></p>
        </div>
    </div>

    <div class="cards-grid">

        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $jadwal; ?></h3>
                <p>Jadwal Mengajar</p>
            </div>
            <div class="card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= number_format($ip['ip_rata_rata'], 2); ?></h3>
                <p>IP Rata-rata</p>
            </div>
            <div class="card-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <div class="card c-yellow">
            <div class="card-info">
                <h3><?= $mhsAktif['total_mahasiswa_aktif']; ?></h3>
                <p>Mahasiswa Aktif</p>
            </div>
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $kelulusan['lulus']; ?></h3>
                <p>Lulus</p>
            </div>
            <div class="card-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>

        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $kelulusan['belum_lulus']; ?></h3>
                <p>Belum Lulus</p>
            </div>
            <div class="card-icon">
                <i class="fas fa-user-clock"></i>
            </div>
        </div>

    </div>

</div>

</body>
</html>
