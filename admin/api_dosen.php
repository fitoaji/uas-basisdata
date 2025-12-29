<?php
include "../config/koneksi.php";

$action = $_GET['action'] ?? '';

if ($action == 'get') {
    $q = mysqli_query($conn, "SELECT * FROM dosen");
    echo json_encode(mysqli_fetch_all($q, MYSQLI_ASSOC));
    exit;
}

if ($action == 'tambah') {
    mysqli_query($conn, "INSERT INTO dosen VALUES (
        NULL,
        '$_POST[nidn]',
        '$_POST[nama]',
        '$_POST[email]'
    )");
    echo json_encode(['status'=>'ok']);
    exit;
}

if ($action == 'update') {
    mysqli_query($conn, "UPDATE dosen SET
        nidn='$_POST[nidn]',
        nama='$_POST[nama]',
        email='$_POST[email]'
        WHERE id_dosen='$_POST[id]'
    ");
    echo json_encode(['status'=>'updated']);
    exit;
}

if ($action == 'hapus') {
    mysqli_query($conn, "DELETE FROM dosen WHERE id_dosen='$_POST[id]'");
    echo json_encode(['status'=>'deleted']);
    exit;
}
