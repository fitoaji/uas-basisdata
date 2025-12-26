<?php
session_start();

// =====================
// KONEKSI DATABASE
// =====================
$conn = mysqli_connect("localhost", "root", "", "siakad");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// =====================
// SIMULASI LOGIN DOSEN
// =====================
// Biasanya diambil dari session login
$id_dosen = $_SESSION['id_dosen'] ?? 1;

// =====================
// FUNCTION COUNT AMAN
// =====================
function getCount($conn, $query) {
    $q = mysqli_query($conn, $query);
    if (!$q) return 0;
    $d = mysqli_fetch_assoc($q);
    return $d['total'] ?? 0;
}

// =====================
// HITUNG DATA DOSEN
// =====================
$matakuliah = getCount($conn,
    "SELECT COUNT(DISTINCT id_matakuliah) AS total 
     FROM jadwal WHERE id_dosen='$id_dosen'"
);

$kelas = getCount($conn,
    "SELECT COUNT(DISTINCT kelas) AS total 
     FROM jadwal WHERE id_dosen='$id_dosen'"
);

$mahasiswa = getCount($conn,
    "SELECT COUNT(DISTINCT krs.nim) AS total
     FROM krs
     JOIN jadwal ON krs.id_jadwal = jadwal.id
     WHERE jadwal.id_dosen='$id_dosen'"
);

$pertemuan = getCount($conn,
    "SELECT COUNT(*) AS total 
     FROM pertemuan WHERE id_dosen='$id_dosen'"
);

$absensi = getCount($conn,
    "SELECT COUNT(*) AS total 
     FROM absensi WHERE id_dosen='$id_dosen'"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR DOSEN -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>DOSEN UNPRI</h3>
    </div>
    <div class="menu">
        <a href="dashboard_dosen.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="jadwal_dosen.php"><i class="fas fa-calendar-alt"></i> Jadwal Mengajar</a>
        <a href="pertemuan.php"><i class="fas fa-users"></i> Pertemuan</a>
        <a href="absensi_dosen.php"><i class="fas fa-clipboard-check"></i> Absensi</a>
        <a href="nilai.php"><i class="fas fa-pen"></i> Nilai</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="header-area">
        <div>
            <h2>Dashboard Dosen</h2>
            <p style="color:#666;">Selamat datang di Sistem Akademik</p>
        </div>
    </div>

    <div class="cards-grid">
        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $matakuliah ?></h3>
                <p>Mata Kuliah</p>
            </div>
            <div class="card-icon"><i class="fas fa-book"></i></div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= $kelas ?></h3>
                <p>Kelas</p>
            </div>
            <div class="card-icon"><i class="fas fa-layer-group"></i></div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $mahasiswa ?></h3>
                <p>Mahasiswa</p>
            </div>
            <div class="card-icon"><i class="fas fa-user-graduate"></i></div>
        </div>

        <div class="card c-yellow">
            <div class="card-info">
                <h3><?= $pertemuan ?></h3>
                <p>Pertemuan</p>
            </div>
            <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
        </div>

        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $absensi ?></h3>
                <p>Absensi</p>
            </div>
            <div class="card-icon"><i class="fas fa-clipboard-list"></i></div>
        </div>
    </div>
</div>

</body>
</html>
