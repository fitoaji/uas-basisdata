<?php

$conn = mysqli_connect("localhost", "root", "", "siakad");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


function getCount($conn, $table, $field = '*') {
    $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($check) == 0) return 0;

    $q = mysqli_query($conn, "SELECT COUNT($field) AS total FROM $table");
    $d = mysqli_fetch_assoc($q);
    return $d['total'] ?? 0;
}

// =====================
// HITUNG DATA
// =====================
$kurikulum  = getCount($conn, "kurikulum");
$semester   = getCount($conn, "semester");
$jurusan    = getCount($conn, "mahasiswa", field: "DISTINCT jurusan");
$matakuliah = getCount($conn, "matakuliah");
$dosen      = getCount($conn, "dosen");
$mahasiswa  = getCount($conn, "mahasiswa");
$ruangan    = getCount($conn, "ruangan");
$absensi    = getCount($conn, "absensi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Kampus</title>
    <link rel="stylesheet" href="dosen_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h3>UNPRI ADMIN</h3>
    </div>
    <div class="menu">
        <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="kurikulum.php"><i class="fas fa-book"></i> Kurikulum</a>
        <a href="Jurusan.php"><i class="fas fa-university"></i> Jurusan</a>
        <a href="dosen.php"><i class="fas fa-chalkboard-teacher"></i> Dosen</a>
        <a href="mahasiswa.php"><i class="fas fa-user-graduate"></i> Mahasiswa</a>
        <a href="matakuliah.php"><i class="fas fa-book-open"></i> Matakuliah</a>
        <a href="ruangan.php"><i class="fas fa-door-open"></i> Ruangan</a>
        <a href="absensi_mhs.php"><i class="fas fa-clipboard-check"></i> Absensi</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="content">
    <div class="header-area">
        <div>
            <h2>Dashboard Overview</h2>
            <p style="color:#666;">Selamat Datang, Admin Universitas Prima Indonesia</p>
        </div>
    </div>

    <div class="cards-grid">
        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $kurikulum ?></h3>
                <p>Kurikulum</p>
            </div>
            <div class="card-icon"><i class="fas fa-landmark"></i></div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= $semester ?></h3>
                <p>Semester</p>
            </div>
            <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $jurusan ?></h3>
                <p>Jurusan</p>
            </div>
            <div class="card-icon"><i class="fas fa-book-reader"></i></div>
        </div>

        <div class="card c-yellow">
            <div class="card-info">
                <h3><?= $matakuliah ?></h3>
                <p>Mata Kuliah</p>
            </div>
            <div class="card-icon"><i class="fas fa-book"></i></div>
        </div>

        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $dosen ?></h3>
                <p>Dosen</p>
            </div>
            <div class="card-icon"><i class="fas fa-user-tie"></i></div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= $mahasiswa ?></h3>
                <p>Mahasiswa</p>
            </div>
            <div class="card-icon"><i class="fas fa-users"></i></div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $ruangan ?></h3>
                <p>Ruangan</p>
            </div>
            <div class="card-icon"><i class="fas fa-layer-group"></i></div>
        </div>

        <div class="card c-yellow">
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