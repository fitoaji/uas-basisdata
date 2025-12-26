<?php
$fakultas = [
    "Fakultas Teknik" => [
        "Teknik Informatika",
        "Sistem Informasi",
        "Teknik Sipil",
        "Arsitektur"
    ],
    "Fakultas Hukum" => [
        "Ilmu Hukum"
    ],
    "Fakultas Ilmu Sosial dan Politik" => [
        "Ilmu Komunikasi",
        "Ilmu Politik"
    ]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Fakultas & Jurusan</title>
    <link rel="stylesheet" href="jurusan_style.css">
</head>
<body>

<div class="container">
    <h1>Data Fakultas & Jurusan</h1>

    <?php foreach ($fakultas as $namaFakultas => $jurusan): ?>
        <div class="card">
            <h2><?= $namaFakultas; ?></h2>
            <ul>
                <?php foreach ($jurusan as $j): ?>
                    <li><?= $j; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
