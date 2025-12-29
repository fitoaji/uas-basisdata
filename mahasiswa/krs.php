<?php
require_once __DIR__ . "/../config/koneksi.php";

$nim = "230001"; // nanti ganti $_SESSION['nim']

$sql = "
    SELECT 
        mk.kode_mk,
        mk.nama_mk,
        mk.sks,
        mk.semester
    FROM krs k
    JOIN mata_kuliah mk ON k.kode_mk = mk.kode_mk
    WHERE k.nim = '$nim'
";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS Mahasiswa</title>
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background: #2f3e4e;
            color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f1f5f9;
        }

        .text-left {
            text-align: left;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            background: #0d6efd;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #777;
        }

        .total-box {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .total-sks {
            background: #0d6efd;
            color: #fff;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<h2 class="page-title">Kartu Rencana Studi (KRS)</h2>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $total_sks = 0;

        if (mysqli_num_rows($query) > 0):
            while ($d = mysqli_fetch_assoc($query)):
                $total_sks += $d['sks'];
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['kode_mk'] ?></td>
                <td class="text-left"><?= ucfirst($d['nama_mk']) ?></td>
                <td><?= $d['sks'] ?></td>
                <td>
                    <span class="badge">Semester <?= $d['semester'] ?></span>
                </td>
            </tr>
        <?php endwhile; else: ?>
            <tr>
                <td colspan="5" class="empty">
                    Belum ada mata kuliah yang diambil
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="total-box">
        <div class="total-sks">
            Total SKS: <?= $total_sks ?>
        </div>
    </div>
</div>

</body>
</html>
