<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="dosen.css">
</head>
<body>

<div class="container">

    <div class="header">
        <h2>📘 Data Dosen</h2>
        <button class="btn-add" onclick="showForm()">+ Tambah Dosen</button>
    </div>

    <!-- FORM -->
    <div id="formDosen" class="form-box">
        <input type="hidden" id="id_dosen">
        <input type="text" id="nidn" placeholder="NIDN">
        <input type="text" id="nama" placeholder="Nama">
        <input type="email" id="email" placeholder="Email">
        <button class="btn-add" onclick="simpan()">Simpan</button>
        <button class="btn-delete" onclick="batal()">Batal</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="data-dosen"></tbody>
    </table>

</div>

<script src="script_dosen.js"></script>
</body>
</html>
