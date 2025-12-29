<?php
require_once __DIR__ . "/../config/koneksi.php";

$nim = "230001";

$sql = "
    SELECT 
        mk.kode_mk,
        mk.nama_mk,
        mk.sks,
        n.nilai_huruf,
        n.nilai_angka
    FROM nilai n
    JOIN krs k ON n.id_krs = k.id_krs
    JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk
    WHERE k.nim = '$nim'
";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}
?>

<link rel="stylesheet" href="style_2.css">


<link rel="stylesheet" href="../assets/css/mahasiswa_ui.css">

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="page-header">
        <h3>📊 Nilai Mahasiswa</h3>
    </div>

    <!-- CARD -->
    <div class="card-custom">

        <h5 style="margin-bottom:15px;font-weight:1000; font-size: x-large;">Daftar Nilai</h5>

        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php $no=1; while($d = mysqli_fetch_assoc($query)): 

                    // warna badge otomatis
                    $huruf = $d['nilai_huruf'];
                    if ($huruf == 'A') $badge = 'badge-a';
                    elseif ($huruf == 'B') $badge = 'badge-b';
                    elseif ($huruf == 'C') $badge = 'badge-c';
                    else $badge = 'badge-d';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['kode_mk'] ?></td>
                    <td style="text-align:left"><?= ucfirst($d['nama_mk']) ?></td>
                    <td><?= $d['sks'] ?></td>
                    <td>
                        <span class="badge-nilai <?= $badge ?>">
                            <?= $d['nilai_huruf'] ?> (<?= $d['nilai_angka'] ?>)
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="empty-data">
                        Belum ada data nilai
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

