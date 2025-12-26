<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Kampus</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>UNPRI ADMIN</h3>
        </div>
        <div class="menu">
            <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
            <a href="#"><i class="fas fa-book"></i> Kurikulum</a>
            <a href="#"><i class="fas fa-calendar-alt"></i> Semester</a>
            <a href="Jurusan.php"><i class="fas fa-university"></i> Jurusan</a>
            <a href="#"><i class="fas fa-chalkboard-teacher"></i> Dosen</a>
            <a href="#"><i class="fas fa-user-graduate"></i> Mahasiswa</a>
            <a href="#"><i class="fas fa-book-open"></i> Matakuliah</a>
            <a href="#"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="#"><i class="fas fa-clipboard-check"></i> Absensi</a>
            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
          
<?php
$jurusan = [
    "Teknik Informatika",
    "Sistem Informasi",
    "Teknik Sipil",
    "Arsitektur"
];
?>

<div class="container">
    <h1>Data Jurusan</h1>

    <div class="card-fakultas">
        <h2>Fakultas Teknik</h2>
        <ul>
            <?php foreach ($jurusan as $j): ?>
                <li>
                    <a href="mahasiswa_jurusan.php?jurusan=<?= urlencode($j) ?>">
                        <?= $j ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</div>
</div>
    <script src="script_jurusan.js"></script>
</body>
</html>