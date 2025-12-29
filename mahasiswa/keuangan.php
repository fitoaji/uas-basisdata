<?php
require_once __DIR__ . "/../config/koneksi.php";

$nim = "230001"; // nanti ganti $_SESSION['nim']

$sql = "
    SELECT 
        jenis_transaksi,
        jumlah,
        tanggal,
        status
    FROM keuangan
    WHERE nim = '$nim'
    ORDER BY tanggal DESC
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
<title>Keuangan Mahasiswa</title>
<style>
body{
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
    padding:40px;
}
h2{
    font-weight:700;
    margin-bottom:20px;
}
.card{
    background:#fff;
    border-radius:14px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}
table{
    width:100%;
    border-collapse:collapse;
}
thead{
    background:#2f3e4e;
    color:#fff;
}
th,td{
    padding:12px;
    text-align:center;
}
tbody tr{
    border-bottom:1px solid #eee;
}
tbody tr:hover{
    background:#f1f5f9;
}
.text-left{ text-align:left; }

.badge{
    padding:6px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
    color:#fff;
}
.lunas{ background:#28a745; }
.belum{ background:#dc3545; }

.summary{
    display:flex;
    gap:15px;
    margin-bottom:20px;
}
.box{
    flex:1;
    background:#0d6efd;
    color:#fff;
    padding:15px;
    border-radius:12px;
    text-align:center;
}
.box span{
    font-size:22px;
    font-weight:700;
    display:block;
}

.empty{
    padding:20px;
    text-align:center;
    color:#777;
}
</style>
</head>

<body>

<h2> Keuangan Mahasiswa</h2>

<?php
$lunas = $belum = 0;
$total_lunas = $total_belum = 0;
$data = [];

while($d = mysqli_fetch_assoc($query)){
    $data[] = $d;
    if($d['status'] == 'LUNAS'){
        $lunas++;
        $total_lunas += $d['jumlah'];
    } else {
        $belum++;
        $total_belum += $d['jumlah'];
    }
}
?>

<div class="summary">
    <div class="box" style="background:#28a745;">
        <span><?= $lunas ?></span>Transaksi Lunas
    </div>
    <div class="box" style="background:#dc3545;">
        <span><?= $belum ?></span>Belum Lunas
    </div>
    <div class="box">
        <span>Rp <?= number_format($total_lunas,0,',','.') ?></span>Total Dibayar
    </div>
    <div class="box" style="background:#ffc107;color:#000;">
        <span>Rp <?= number_format($total_belum,0,',','.') ?></span>Sisa Tagihan
    </div>
</div>

<div class="card">
<table>
<thead>
<tr>
    <th>No</th>
    <th>Jenis Transaksi</th>
    <th>Jumlah</th>
    <th>Tanggal</th>
    <th>Status</th>
</tr>
</thead>
<tbody>
<?php if(count($data) > 0): $no=1; foreach($data as $d): 
    $cls = ($d['status']=='LUNAS') ? 'lunas' : 'belum';
?>
<tr>
    <td><?= $no++ ?></td>
    <td class="text-left"><?= $d['jenis_transaksi'] ?></td>
    <td>Rp <?= number_format($d['jumlah'],0,',','.') ?></td>
    <td><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
    <td><span class="badge <?= $cls ?>"><?= $d['status'] ?></span></td>
</tr>
<?php endforeach; else: ?>
<tr>
    <td colspan="5" class="empty">Belum ada data keuangan</td>
</tr>
<?php endif; ?>
</tbody>
</table>
</div>

</body>
</html>
