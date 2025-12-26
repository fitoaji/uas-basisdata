<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Ruangan</title>
    <link rel="stylesheet" href="ruangan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2><i class="fas fa-door-open"></i> Data Ruangan</h2>
        <button class="btn-add">
            <i class="fas fa-plus"></i> Tambah Ruangan
        </button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Gedung</th>
                    <th>Kapasitas</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Dummy -->
                <tr>
                    <td>1</td>
                    <td>R-101</td>
                    <td>Lab Komputer 1</td>
                    <td>Gedung A</td>
                    <td>30</td>
                    <td>Praktikum</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>R-202</td>
                    <td>Ruang Teori</td>
                    <td>Gedung B</td>
                    <td>40</td>
                    <td>Kelas Reguler</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>R-303</td>
                    <td>Lab Jaringan</td>
                    <td>Gedung C</td>
                    <td>25</td>
                    <td>Praktikum</td>
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