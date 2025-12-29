<?php
session_start();

/* ======================
   KONEKSI DATABASE
====================== */
$conn = mysqli_connect("localhost", "root", "", "siakad");
if (!$conn) {
    die("Koneksi database gagal");
}

/* ======================
   CEK LOGIN DOSEN
====================== */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    die("Akses ditolak. Silakan login sebagai dosen.");
}

if (!isset($_SESSION['nidn'])) {
    die("Session NIDN tidak ditemukan. Silakan login ulang.");
}

$nidn = $_SESSION['nidn'];

/* ======================
   FUNCTION COUNT AMAN
====================== */
function getCount($conn, $sql)
{
    $q = mysqli_query($conn, $sql);
    if (!$q) return 0;
    $d = mysqli_fetch_assoc($q);
    return $d['total'] ?? 0;
}

/* ======================
   DATA PROFIL DOSEN
====================== */
$qDosen = mysqli_query($conn, "
    SELECT nidn, nama, email
    FROM dosen
    WHERE nidn = '$nidn'
");

$dosen = mysqli_fetch_assoc($qDosen);
if (!$dosen) {
    // fallback supaya tidak warning
    $dosen = [
        'nidn'  => $nidn,
        'nama'  => 'Dosen',
        'email' => '-'
    ];
}

/* ======================
   STATISTIK DOSEN
====================== */
$matakuliah = getCount($conn, "
    SELECT COUNT(DISTINCT kode_mk) AS total
    FROM jadwal
    WHERE nidn = '$nidn'
");

$kelas = getCount($conn, "
    SELECT COUNT(DISTINCT kelas) AS total
    FROM jadwal
    WHERE nidn = '$nidn'
");

$mahasiswa = getCount($conn, "
    SELECT COUNT(DISTINCT krs.nim) AS total
    FROM krs
    JOIN jadwal ON krs.id_jadwal = jadwal.id_jadwal
    WHERE jadwal.nidn = '$nidn'
");

$absensi = getCount($conn, "
    SELECT COUNT(*) AS total
    FROM absensi
    JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal
    WHERE jadwal.nidn = '$nidn'
");

/* ======================
   JADWAL HARI INI
====================== */
$hariMap = [
    'Monday'    => 'SENIN',
    'Tuesday'   => 'SELASA',
    'Wednesday' => 'RABU',
    'Thursday'  => 'KAMIS',
    'Friday'    => 'JUMAT',
    'Saturday'  => 'SABTU'
];

$hariDB = $hariMap[date('l')] ?? 'SENIN';

$jadwalHariIni = mysqli_query($conn, "
    SELECT j.*, mk.nama_mk
    FROM jadwal j
    JOIN mata_kuliah mk ON j.kode_mk = mk.kode_mk
    WHERE j.nidn = '$nidn'
    AND j.hari = '$hariDB'
    ORDER BY j.jam_mulai
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
    <link rel="stylesheet" href="dosen_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3>DOSEN UNPRI</h3>
        <small><?= htmlspecialchars($dosen['nama']); ?></small>
    </div>
    <div class="menu">
        <a href="dashboard_dosen.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="jadwal_dosen.php"><i class="fas fa-calendar-alt"></i> Jadwal Mengajar</a>
        <a href="absensi_dosen.php"><i class="fas fa-clipboard-check"></i> Absensi</a>
        <a href="nilai_dosen.php"><i class="fas fa-pen"></i> Nilai</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- HEADER -->
    <div class="header-area">
        <div>
            <h2>Dashboard Dosen</h2>
            <p>Selamat datang, <?= htmlspecialchars($dosen['nama']); ?></p>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="cards-grid">
        <div class="card c-blue">
            <div class="card-info">
                <h3><?= $matakuliah; ?></h3>
                <p>Mata Kuliah</p>
            </div>
            <div class="card-icon"><i class="fas fa-book"></i></div>
        </div>

        <div class="card c-green">
            <div class="card-info">
                <h3><?= $kelas; ?></h3>
                <p>Kelas</p>
            </div>
            <div class="card-icon"><i class="fas fa-layer-group"></i></div>
        </div>

        <div class="card c-red">
            <div class="card-info">
                <h3><?= $mahasiswa; ?></h3>
                <p>Mahasiswa</p>
            </div>
            <div class="card-icon"><i class="fas fa-user-graduate"></i></div>
        </div>

        <div class="card c-yellow">
            <div class="card-info">
                <h3><?= $absensi; ?></h3>
                <p>Absensi</p>
            </div>
            <div class="card-icon"><i class="fas fa-clipboard-list"></i></div>
        </div>
    </div>

    <!-- JADWAL HARI INI -->
    <div class="table-container" style="margin-top:30px;">
        <h3>Jadwal Mengajar Hari Ini (<?= $hariDB; ?>)</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Jam</th>
                <th>Ruangan</th>
            </tr>

            <?php if (mysqli_num_rows($jadwalHariIni) > 0): ?>
                <?php $no = 1; while ($j = mysqli_fetch_assoc($jadwalHariIni)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($j['nama_mk']); ?></td>
                        <td><?= htmlspecialchars($j['kelas']); ?></td>
                        <td><?= $j['jam_mulai'].' - '.$j['jam_selesai']; ?></td>
                        <td><?= htmlspecialchars($j['ruangan']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada jadwal hari ini</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</div>

</body>
</html>
