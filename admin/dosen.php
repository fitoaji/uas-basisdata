<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: Arial; padding: 40px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; }
        th { background: #2f363d; color: white; }
        button { padding: 5px 10px; margin: 2px; cursor: pointer; }
        #formDosen input { margin: 5px; padding: 5px; }
    </style>
</head>
<body>

<h1>Data Dosen</h1>

<button onclick="showForm()">➕ Tambah Dosen</button>

<!-- FORM -->
<div id="formDosen" style="display:none; margin:20px 0;">
    <input type="hidden" id="id_dosen">
    <input type="text" id="nidn" placeholder="NIDN">
    <input type="text" id="nama" placeholder="Nama">
    <input type="email" id="email" placeholder="Email">
    <button onclick="simpan()">💾 Simpan</button>
    <button onclick="batal()">❌ Batal</button>
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

<script src="script_dosen.js"></script>
</body>
</html>
