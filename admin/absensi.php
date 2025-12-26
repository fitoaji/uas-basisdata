<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Absensi</title>
    <link rel="stylesheet" href="absensi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2><i class="fas fa-clipboard-check"></i> Data Absensi</h2>
        <button class="btn-add">
            <i class="fas fa-plus"></i> Tambah Absensi
        </button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Dummy -->
                <tr>
                    <td>1</td>
                    <td>220401001</td>
                    <td>Andi Saputra</td>
                    <td>Basis Data</td>
                    <td>2025-01-10</td>
                    <td class="hadir">Hadir</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>220401002</td>
                    <td>Siti Aisyah</td>
                    <td>Pemrograman Web</td>
                    <td>2025-01-10</td>
                    <td class="izin">Izin</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>220401003</td>
                    <td>Budi Santoso</td>
                    <td>Algoritma</td>
                    <td>2025-01-10</td>
                    <td class="alpha">Alpha</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>