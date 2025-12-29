<?php
// ==========================
// KONEKSI DATABASE
// ==========================
$conn = mysqli_connect("localhost", "root", "", "siakad");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ==========================
// DEMO LOGIN (HARD CODE)
// ==========================
$nim = '230001'; // Andi Saputra

// ==========================
// AMBIL DATA MAHASISWA
// ==========================
$qMhs = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$mahasiswa = mysqli_fetch_assoc($qMhs);

if (!$mahasiswa) {
    die("Mahasiswa tidak ditemukan");
}

// ==========================
// FUNCTION COUNT WHERE
// ==========================
function getCountWhere($conn, $sql) {
    $q = mysqli_query($conn, $sql);
    if (!$q) return 0;
    $d = mysqli_fetch_assoc($q);
    return $d['total'] ?? 0;
}

// ==========================
// HITUNG DATA DASHBOARD
// ==========================

// KRS
$krs = getCountWhere($conn,
    "SELECT COUNT(*) AS total FROM krs WHERE nim='$nim'"
);

// NILAI (AMBIL DARI KRS)
$nilai = getCountWhere($conn,
    "SELECT COUNT(*) AS total 
     FROM nilai 
     WHERE id_krs IN (
        SELECT id_krs FROM krs WHERE nim='$nim'
     )"
);

// ABSENSI
$absensi = getCountWhere($conn,
    "SELECT COUNT(*) AS total FROM absensi WHERE nim='$nim'"
);

// PEMBAYARAN
$pembayaran = getCountWhere($conn,
    "SELECT COUNT(*) AS total FROM keuangan WHERE nim='$nim'"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>

    <link rel="stylesheet" href="../admin/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>UNPRI</h3>
        <small>Mahasiswa</small>
    </div>

    <div class="menu">
        <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="krs.php"><i class="fas fa-book"></i> KRS</a>
        <a href="nilai.php"><i class="fas fa-chart-line"></i> Nilai</a>
        <a href="absensi.php"><i class="fas fa-clipboard-check"></i> Absensi</a>
        <a href="pembayaran.php"><i class="fas fa-money-bill"></i> Pembayaran</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <div class="header-area">
        <div>
            <h2>Dashboard Mahasiswa</h2>
            <p style="color:#666;">
                Selamat datang, <b><?= $mahasiswa['nama']; ?></b> (<?= $mahasiswa['nim']; ?>)
            </p>
        </div>
    </div>

    <div class="cards-grid">

        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $krs ?></h3>
                <p>KRS</p>
            </div>
            <div class="card-icon"><i class="fas fa-book"></i></div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= $nilai ?></h3>
                <p>Nilai</p>
            </div>
            <div class="card-icon"><i class="fas fa-chart-line"></i></div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $absensi ?></h3>
                <p>Absensi</p>
            </div>
            <div class="card-icon"><i class="fas fa-clipboard-check"></i></div>
        </div>

        <div class="card c-yellow">
            <div class="card-info">
                <h3><?= $pembayaran ?></h3>
                <p>Pembayaran</p>
            </div>
            <div class="card-icon"><i class="fas fa-money-bill-wave"></i></div>
        </div>

    </div>

</div>

</body>
</html>
