<?php
include "../config/koneksi.php";

/* =====================
   AJAX HANDLER
===================== */
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'get') {
        $q = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY angkatan DESC, nama ASC");
        echo json_encode(mysqli_fetch_all($q, MYSQLI_ASSOC));
        exit;
    }

    if ($_GET['action'] === 'tambah') {
        mysqli_query($conn, "INSERT INTO mahasiswa VALUES (
            NULL,
            '$_POST[nim]',
            '$_POST[nama]',
            '$_POST[email]',
            '$_POST[jurusan]',
            '$_POST[angkatan]',
            '$_POST[status]'
        )");
        exit;
    }

    if ($_GET['action'] === 'update') {
        mysqli_query($conn, "UPDATE mahasiswa SET
            nim='$_POST[nim]',
            nama='$_POST[nama]',
            email='$_POST[email]',
            jurusan='$_POST[jurusan]',
            angkatan='$_POST[angkatan]',
            status='$_POST[status]'
            WHERE id_mahasiswa='$_POST[id]'
        ");
        exit;
    }

    if ($_GET['action'] === 'hapus') {
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id_mahasiswa='$_POST[id]'");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="mahasiswa.css">
</head>
<body>

<div class="content">
    <div class="container">

        <!-- HEADER -->
        <div class="header-area">
            <h1>📘 Data Mahasiswa</h1>
            <button class="btn btn-add" onclick="showForm()">+ Tambah Mahasiswa</button>
        </div>

        <!-- FORM -->
        <div id="formMahasiswa" class="table-container" style="display:none; margin-bottom:20px;">
            <input type="hidden" id="id_mhs">

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <input class="search-input" id="nim" placeholder="NIM">
                <input class="search-input" id="nama" placeholder="Nama">
                <input class="search-input" id="email" placeholder="Email">
                <input class="search-input" id="jurusan" placeholder="Jurusan">
                <input class="search-input" id="angkatan" placeholder="Angkatan">
                <input class="search-input" id="status" placeholder="Status">
            </div>

            <div class="btn-group" style="margin-top:15px;">
                <button class="btn btn-add" onclick="simpan()">Simpan</button>
                <button class="btn btn-export" onclick="batal()">Batal</button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="data-mahasiswa"></tbody>
            </table>
        </div>

    </div>
</div>

<script>
let mode = "tambah";

document.addEventListener("DOMContentLoaded", loadMahasiswa);

function loadMahasiswa() {
    fetch("mahasiswa.php?action=get")
        .then(res => res.json())
        .then(data => {
            let html = "";
            data.forEach((m, i) => {
                html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${m.nim}</td>
                    <td>${m.nama}</td>
                    <td>${m.email}</td>
                    <td>${m.jurusan}</td>
                    <td>${m.angkatan}</td>
                    <td>
                        <span class="status ${m.status.toLowerCase()}">
                            ${m.status.toUpperCase()}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-export" onclick="edit(${m.id_mahasiswa}, '${m.nim}', '${m.nama}', '${m.email}', '${m.jurusan}', '${m.angkatan}', '${m.status}')">Edit</button>
                        <button class="btn btn-add" style="background:#dc3545" onclick="hapus(${m.id_mahasiswa})">Hapus</button>
                    </td>
                </tr>`;
            });
            document.getElementById("data-mahasiswa").innerHTML = html;
        });
}

function showForm() {
    mode = "tambah";
    formMahasiswa.style.display = "block";
    id_mhs.value = nim.value = nama.value = email.value = jurusan.value = angkatan.value = status.value = "";
}

function batal() {
    formMahasiswa.style.display = "none";
}

function simpan() {
    let data = new URLSearchParams({
        nim: nim.value,
        nama: nama.value,
        email: email.value,
        jurusan: jurusan.value,
        angkatan: angkatan.value,
        status: status.value
    });

    let url = "mahasiswa.php?action=tambah";

    if (mode === "edit") {
        data.append("id", id_mhs.value);
        url = "mahasiswa.php?action=update";
    }

    fetch(url, { method: "POST", body: data })
        .then(() => {
            loadMahasiswa();
            formMahasiswa.style.display = "none";
        });
}

function edit(id, nimM, namaM, emailM, jurM, angkM, statM) {
    mode = "edit";
    formMahasiswa.style.display = "block";
    id_mhs.value = id;
    nim.value = nimM;
    nama.value = namaM;
    email.value = emailM;
    jurusan.value = jurM;
    angkatan.value = angkM;
    status.value = statM;
}

function hapus(id) {
    if (!confirm("Yakin hapus data?")) return;

    fetch("mahasiswa.php?action=hapus", {
        method: "POST",
        body: new URLSearchParams({ id })
    }).then(() => loadMahasiswa());
}
</script>

</body>
</html>
