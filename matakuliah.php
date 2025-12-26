<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="matakuliah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h2><i class="fas fa-book-open"></i> Data Mata Kuliah</h2>
        <button class="btn-add">
            <i class="fas fa-plus"></i> Tambah Mata Kuliah
        </button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Jurusan</th>
                    <th>Dosen Pengampu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Dummy -->
                <tr>
                    <td>1</td>
                    <td>IF101</td>
                    <td>Algoritma dan Pemrograman</td>
                    <td>3</td>
                    <td>1</td>
                    <td>Informatika</td>
                    <td>Dr. Ahmad Fauzi</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>IF202</td>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>3</td>
                    <td>Informatika</td>
                    <td>Rina Marlina</td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>IF303</td>
                    <td>Pemrograman Web</td>
                    <td>3</td>
                    <td>5</td>
                    <td>Informatika</td>
                    <td>Budi Santoso</td>
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