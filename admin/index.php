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
            <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a>
            <a href="kurikulum.php"><i class="fas fa-book"></i> Kurikulum</a>
            <a href="jurusan.php"><i class="fas fa-university"></i> Jurusan</a>
            <a href="dosen.php"><i class="fas fa-chalkboard-teacher"></i> Dosen</a>
            <a href="mahasiswa.php"><i class="fas fa-user-graduate"></i> Mahasiswa</a>
            <a href="matakuliah.php"><i class="fas fa-book-open"></i> Matakuliah</a>
            <a href="ruangan.php"><i class="fas fa-door-open"></i> Ruangan</a>
            <a href="absensi.php"><i class="fas fa-clipboard-check"></i> Absensi</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="content">
        <div class="header-area">
            <div>
                <span class="menu-toggle" onclick="toggleSidebar()" style="display:none; margin-right:15px;">
                    <i class="fas fa-bars"></i>
                </span>
                <h2>Dashboard Overview</h2>
                <p style="color: #666;">Selamat Datang, Admin Universitas Prima Indonesia</p>
            </div>
            
            <div class="btn-group">
                <button id="btnAddStudent" class="btn btn-add">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </button>
                <a href="api.php?action=export_csv" class="btn btn-export">
                    <i class="fas fa-file-csv"></i> Ekspor Laporan
                </a>
            </div>
        </div>

        <div class="cards-grid">
            <div class="card c-blue">
                <div class="card-info">
                    <h3 id="count-kurikulum">...</h3>
                    <p>Kurikulum</p>
                </div>
                <div class="card-icon"><i class="fas fa-landmark"></i></div>
            </div>

            <div class="card c-green">
                <div class="card-info">
                    <h3 id="count-semester">...</h3>
                    <p>Semester</p>
                </div>
                <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
            </div>

            <div class="card c-red">
                <div class="card-info">
                    <h3 id="count-jurusan">...</h3>
                    <p>Jurusan</p>
                </div>
                <div class="card-icon"><i class="fas fa-book-reader"></i></div>
            </div>

            <div class="card c-yellow">
                <div class="card-info">
                    <h3 id="count-matakuliah">...</h3>
                    <p>Mata Kuliah</p>
                </div>
                <div class="card-icon"><i class="fas fa-book"></i></div>
            </div>

            <div class="card c-blue">
                <div class="card-info">
                    <h3 id="count-dosen">...</h3>
                    <p>Dosen</p>
                </div>
                <div class="card-icon"><i class="fas fa-user-tie"></i></div>
            </div>

            <div class="card c-green">
                <div class="card-info">
                    <h3 id="count-mahasiswa">...</h3>
                    <p>Mahasiswa</p>
                </div>
                <div class="card-icon"><i class="fas fa-users"></i></div>
            </div>

            <div class="card c-red">
                <div class="card-info">
                    <h3 id="count-ruangan">...</h3>
                    <p>Ruangan</p>
                </div>
                <div class="card-icon"><i class="fas fa-layer-group"></i></div>
            </div>

            <div class="card c-yellow">
                <div class="card-info">
         a           <h3 id="count-absensi">...</h3>
                    <p>Absensi</p>
                </div>
                <div class="card-icon"><i class="fas fa-clipboard-list"></i></div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>