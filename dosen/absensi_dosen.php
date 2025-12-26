<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "siakad");
$id_dosen = $_SESSION['id_dosen'] ?? 1;
$id_jadwal = $_GET['id_jadwal'];

$mhs = mysqli_query($conn, "
    SELECT krs.nim, mahasiswa.nama
    FROM krs
    JOIN mahasiswa ON krs.nim = mahasiswa.nim
    WHERE krs.id_jadwal='$id_jadwal'
");

if(isset($_POST['simpan'])) {
    foreach($_POST['status'] as $nim => $status) {
        mysqli_query($conn, "
            INSERT INTO absensi (id_dosen, nim, id_jadwal, status)
            VALUES ('$id_dosen','$nim','$id_jadwal','$status')
        ");
    }
    echo "<script>alert('Absensi tersimpan');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absensi Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="content">
    <div class="header-area">
        <h2>Absensi Mahasiswa</h2>
    </div>

    <form method="post">
        <div class="table-container">
            <table>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
                <?php $no=1; while($d=mysqli_fetch_assoc($mhs)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nim'] ?></td>
                    <td><?= $d['nama'] ?></td>
                    <td>
                        <select name="status[<?= $d['nim'] ?>]" required>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Alfa">Alfa</option>
                        </select>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <br>
        <button class="btn btn-add" name="simpan">Simpan Absensi</button>
    </form>
</div>

</body>
</html>
