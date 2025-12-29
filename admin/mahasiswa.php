<?php
include "../config/koneksi.php";

// SEARCH
$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM mahasiswa";
if ($keyword != '') {
    $sql .= " WHERE nim LIKE '%$keyword%' 
              OR nama LIKE '%$keyword%'";
}

$sql .= " ORDER BY angkatan DESC, nama ASC";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Data Mahasiswa</h1>

    <!-- SEARCH -->
    <form method="GET" style="margin-bottom:20px; display:flex; gap:10px;">
        <input type="text" name="keyword" placeholder="Cari NIM / Nama..."
               value="<?= htmlspecialchars($keyword) ?>" class="search-input">
        <button type="submit" class="btn btn-add">Cari</button>
        <a href="mahasiswa.php" class="btn btn-export">Reset</a>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php $no=1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['jurusan'] ?></td>
                        <td><?= $row['angkatan'] ?></td>
                        <td>
                            <span class="status <?= strtolower($row['status']) ?>">
                                <?= strtoupper($row['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">Data tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>